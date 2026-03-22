<?php

namespace Modules\Category\Filament\Admin\Resources\CategoryResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Modules\Category\Filament\Admin\Resources\CategoryResource;
use Modules\Category\Models\Category;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    #[Url(as: 'expanded')]
    public array $expandedParents = [];

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }

    public function toggleChildren(Category $record): void
    {
        if ($record->parent_id !== null || $record->children_count < 1) {
            return;
        }

        $recordId = (int) $record->getKey();

        if (in_array($recordId, $this->expandedParents, true)) {
            $this->expandedParents = array_values(array_diff($this->expandedParents, [$recordId]));

            return;
        }

        $this->expandedParents[] = $recordId;
        $this->expandedParents = array_values(array_unique(array_map('intval', $this->expandedParents)));
    }

    public function hasExpandedChildren(Category $record): bool
    {
        return in_array((int) $record->getKey(), $this->expandedParents, true);
    }

    protected function getTableQuery(): Builder
    {
        return Category::query()->forAdminHierarchy($this->expandedParents);
    }
}
