<?php

declare(strict_types=1);

namespace Modules\Site\App\View;

use Illuminate\View\View;
use Modules\Category\Models\Category;
use Modules\Location\Models\Country;
use Modules\Page\Models\Page;
use Modules\User\App\Models\User;
use Throwable;

final class SiteLayoutComposer
{
    public function compose(View $view): void
    {
        $pages = $this->safely(static fn (): array => Page::navigationByPlacement(), []);

        $view->with([
            'headerNavCategories' => $this->safely(static fn (): array => Category::headerNavigationItems(), []),
            'headerLocationCountries' => $this->safely(static fn (): array => Country::headerLocationOptions(), []),
            'headerAccountMeta' => $this->accountMeta(),
            'helpPages' => $pages[Page::PLACEMENT_HELP] ?? collect(),
            'footerPages' => $pages[Page::PLACEMENT_FOOTER] ?? collect(),
            'legalPages' => $pages[Page::PLACEMENT_LEGAL] ?? collect(),
        ]);
    }

    private function accountMeta(): ?array
    {
        $user = auth()->user();

        if (! $user instanceof User) {
            return null;
        }

        return ['name' => $user->getDisplayName(), ...$user->headerBadgeCounts()];
    }

    private function safely(callable $resolver, mixed $fallback): mixed
    {
        try {
            return $resolver();
        } catch (Throwable) {
            return $fallback;
        }
    }
}
