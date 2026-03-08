<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingCustomFieldSchemaBuilder;
use Modules\Listing\Support\ListingPanelHelper;
use Modules\Video\Enums\VideoStatus;
use Modules\Video\Models\Video;

class PanelController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('panel.listings.index');
    }

    public function create(): View
    {
        return view('panel.create');
    }

    public function listings(Request $request): View
    {
        $user = $request->user();
        $search = trim((string) $request->string('search'));
        $status = (string) $request->string('status', 'all');

        if (! in_array($status, ['all', 'sold', 'expired'], true)) {
            $status = 'all';
        }

        $listings = Listing::query()
            ->ownedByUser($user->getKey())
            ->with('category:id,name')
            ->withCount('favoritedByUsers')
            ->withCount('videos')
            ->withCount([
                'videos as ready_videos_count' => fn ($query) => $query->whereNotNull('path')->where('is_active', true),
                'videos as pending_videos_count' => fn ($query) => $query->whereIn('status', [
                    VideoStatus::Pending->value,
                    VideoStatus::Processing->value,
                ]),
            ])
            ->searchTerm($search)
            ->forPanelStatus($status)
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('panel.listings', [
            'listings' => $listings,
            'status' => $status,
            'search' => $search,
            'counts' => Listing::panelStatusCountsForUser($user->getKey()),
        ]);
    }

    public function editListing(Request $request, Listing $listing): View
    {
        $this->guardListingOwner($request, $listing);

        return view('panel.edit-listing', [
            'listing' => $listing->load(['category:id,name', 'videos:id,listing_id,title,status,is_active,path,upload_path,duration_seconds,size']),
            'customFieldValues' => ListingCustomFieldSchemaBuilder::presentableValues(
                $listing->category_id ? (int) $listing->category_id : null,
                (array) $listing->custom_fields,
            ),
            'statusOptions' => Listing::panelStatusOptions(),
        ]);
    }

    public function updateListing(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(array_keys(Listing::panelStatusOptions()))],
            'contact_phone' => ['nullable', 'string', 'max:60'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'expires_at' => ['nullable', 'date'],
        ]);

        $listing->updateFromPanel($validated + [
            'currency' => $listing->currency ?: ListingPanelHelper::defaultCurrency(),
        ]);

        return redirect()
            ->route('panel.listings.edit', $listing)
            ->with('success', 'Listing updated.');
    }

    public function videos(Request $request): View
    {
        $user = $request->user();

        return view('panel.videos', [
            'videos' => Video::query()
                ->ownedByUser($user->getKey())
                ->with('listing:id,title,user_id')
                ->latest('id')
                ->paginate(10)
                ->withQueryString(),
            'listingOptions' => $user->listings()
                ->latest('id')
                ->get(['id', 'title', 'status']),
        ]);
    }

    public function storeVideo(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'listing_id' => ['required', 'integer'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'video_file' => ['required', 'file', 'mimes:mp4,mov,webm,m4v', 'max:256000'],
        ]);

        $listing = $request->user()->listings()->whereKey($validated['listing_id'])->firstOrFail();

        $video = Video::createFromUploadedFile($listing, $request->file('video_file'), [
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => Video::nextSortOrderForListing($listing),
            'is_active' => true,
        ]);

        return redirect()
            ->route('panel.videos.edit', $video)
            ->with('success', 'Video uploaded.');
    }

    public function editVideo(Request $request, Video $video): View
    {
        $this->guardVideoOwner($request, $video);

        return view('panel.video-edit', [
            'video' => $video->load('listing:id,title,user_id'),
            'listingOptions' => $request->user()->listings()
                ->latest('id')
                ->get(['id', 'title', 'status']),
        ]);
    }

    public function updateVideo(Request $request, Video $video): RedirectResponse
    {
        $this->guardVideoOwner($request, $video);

        $validated = $request->validate([
            'listing_id' => ['required', 'integer'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'video_file' => ['nullable', 'file', 'mimes:mp4,mov,webm,m4v', 'max:256000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $listing = $request->user()->listings()->whereKey($validated['listing_id'])->firstOrFail();

        $video->updateFromPanel([
            'listing_id' => $listing->getKey(),
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'video_file' => $request->file('video_file'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('panel.videos.edit', $video)
            ->with('success', 'Video updated.');
    }

    public function destroyVideo(Request $request, Video $video): RedirectResponse
    {
        $this->guardVideoOwner($request, $video);
        $video->delete();

        return redirect()
            ->route('panel.videos.index')
            ->with('success', 'Video deleted.');
    }

    public function profile(Request $request): View
    {
        $user = $request->user()->loadCount([
            'listings',
            'favoriteListings',
            'favoriteSearches',
            'favoriteSellers',
        ]);

        return view('panel.profile', [
            'user' => $user,
        ]);
    }

    public function destroyListing(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);
        $listing->delete();

        return back()->with('success', 'Listing removed.');
    }

    public function markListingAsSold(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);
        $listing->forceFill([
            'status' => 'sold',
        ])->save();

        return back()->with('success', 'Listing marked as sold.');
    }

    public function republishListing(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);
        $listing->forceFill([
            'status' => 'active',
            'expires_at' => now()->addDays(30),
        ])->save();

        return back()->with('success', 'Listing republished.');
    }

    private function guardListingOwner(Request $request, Listing $listing): void
    {
        if ((int) $listing->user_id !== (int) $request->user()->getKey()) {
            abort(403);
        }
    }

    private function guardVideoOwner(Request $request, Video $video): void
    {
        if ((int) $video->user_id !== (int) $request->user()->getKey()) {
            abort(403);
        }
    }
}
