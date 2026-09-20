<?php

declare(strict_types=1);

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Page\Models\Page;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::findPublished($slug);

        abort_if($page === null, 404);

        return view('page::show', [
            'page' => $page,
        ]);
    }

    public function sitemap(): Response
    {
        $entries = collect([
            ['url' => route('home'), 'updated' => now()->toAtomString()],
            ['url' => route('listings.index'), 'updated' => now()->toAtomString()],
            ['url' => route('categories.index'), 'updated' => now()->toAtomString()],
            ['url' => route('promotions.plans'), 'updated' => now()->toAtomString()],
        ])->concat(
            Page::publishedSlugs()->map(static fn (Page $page): array => [
                'url' => route('pages.show', ['slug' => $page->getAttribute('slug')]),
                'updated' => $page->getAttribute('updated_at')?->toAtomString(),
            ])
        );

        $lines = ['<?xml version="1.0" encoding="UTF-8"?>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'];

        foreach ($entries as $entry) {
            $lines[] = '    <url>';
            $lines[] = '        <loc>'.e($entry['url']).'</loc>';

            if ($entry['updated'] !== null) {
                $lines[] = '        <lastmod>'.e($entry['updated']).'</lastmod>';
            }

            $lines[] = '    </url>';
        }

        $lines[] = '</urlset>';

        return response(implode("\n", $lines), 200)
            ->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /panel/',
            'Disallow: /admin/',
            'Sitemap: '.route('sitemap'),
        ];

        return response(implode("\n", $lines)."\n", 200)
            ->header('Content-Type', 'text/plain');
    }
}
