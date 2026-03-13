<?php

namespace Modules\Listing\Support;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\Category\Models\Category;
use Throwable;

use function Laravel\Ai\agent;

class QuickListingCategorySuggester
{
    public function suggestFromImage(UploadedFile $image): array
    {
        $provider = (string) config('quick-listing.ai_provider', 'openai');
        $model = config('quick-listing.ai_model');
        $providerKey = config("ai.providers.{$provider}.key");

        if (blank($providerKey)) {
            return [
                'detected' => false,
                'category_id' => null,
                'confidence' => null,
                'reason' => 'AI provider key is missing.',
                'alternatives' => [],
                'error' => 'AI provider key is missing.',
            ];
        }

        $categories = Category::activeAiCatalog();

        if ($categories->isEmpty()) {
            return [
                'detected' => false,
                'category_id' => null,
                'confidence' => null,
                'reason' => 'No active categories available.',
                'alternatives' => [],
                'error' => 'No active categories available.',
            ];
        }

        $catalog = $this->buildCatalog($categories);
        $categoryIds = $catalog->pluck('id')->values()->all();
        $catalogText = $catalog
            ->map(fn (array $category): string => "{$category['id']}: {$category['path']}")
            ->implode("\n");

        try {
            $response = agent(
                instructions: 'You are an e-commerce listing assistant. Classify the product image into the best matching category ID from the provided catalog. Never invent IDs.',
                schema: fn (JsonSchema $schema): array => [
                    'detected' => $schema->boolean()->required(),
                    'category_id' => $schema->integer()->enum($categoryIds)->nullable(),
                    'confidence' => $schema->number()->min(0)->max(1)->nullable(),
                    'reason' => $schema->string()->required(),
                    'alternatives' => $schema->array()->items(
                        $schema->integer()->enum($categoryIds)
                    )->max(3)->default([]),
                ],
            )->prompt(
                prompt: <<<PROMPT
                    Classify the uploaded image into one category from this catalog.

                    Catalog:
                    {$catalogText}

                    Rules:
                    - Use only IDs listed above.
                    - If unsure, set detected=false and category_id=null.
                    - Confidence must be between 0 and 1.
                    PROMPT,
                attachments: [$image],
                provider: $provider,
                model: is_string($model) && $model !== '' ? $model : null,
            );

            $categoryId = isset($response['category_id']) && is_numeric($response['category_id'])
                ? (int) $response['category_id']
                : null;

            $confidence = isset($response['confidence']) && is_numeric($response['confidence'])
                ? (float) $response['confidence']
                : null;

            $alternatives = collect($response['alternatives'] ?? [])
                ->filter(fn ($value): bool => is_numeric($value))
                ->map(fn ($value): int => (int) $value)
                ->filter(fn (int $id): bool => in_array($id, $categoryIds, true))
                ->unique()
                ->values()
                ->all();

            $detected = (bool) ($response['detected'] ?? false) && $categoryId !== null;

            return [
                'detected' => $detected,
                'category_id' => $detected ? $categoryId : null,
                'confidence' => $confidence,
                'reason' => (string) ($response['reason'] ?? 'No reason provided.'),
                'alternatives' => $alternatives,
                'error' => null,
            ];
        } catch (Throwable $exception) {
            report($exception);

            return [
                'detected' => false,
                'category_id' => null,
                'confidence' => null,
                'reason' => 'Category could not be detected automatically.',
                'alternatives' => [],
                'error' => $exception->getMessage(),
            ];
        }
    }

    private function buildCatalog(Collection $categories): Collection
    {
        $byId = $categories->keyBy('id');

        return $categories->map(function (Category $category) use ($byId): array {
            $path = [$category->name];
            $parentId = $category->parent_id;

            while ($parentId && $byId->has($parentId)) {
                $parent = $byId->get($parentId);
                $path[] = $parent->name;
                $parentId = $parent->parent_id;
            }

            return [
                'id' => (int) $category->id,
                'path' => implode(' > ', array_reverse($path)),
            ];
        });
    }
}
