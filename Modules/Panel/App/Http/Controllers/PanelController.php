<?php

namespace Modules\Panel\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingCustomFieldSchemaBuilder;
use Modules\Listing\Support\ListingPanelHelper;
use Modules\Panel\App\Http\Requests\StoreVideoRequest;
use Modules\Panel\App\Http\Requests\UpdateListingRequest;
use Modules\Panel\App\Http\Requests\UpdateVideoRequest;
use Modules\Video\Models\Video;

class PanelController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('panel.listings.index');
    }

    public function create(): View
    {
        return view('panel::create');
    }

    public function listings(Request $request): View
    {
        $user = $request->user();
        $search = trim((string) $request->string('search'));
        $status = (string) $request->string('status', 'all');

        if (! in_array($status, ['all', 'sold', 'expired'], true)) {
            $status = 'all';
        }

        $payload = Listing::panelIndexDataForUser($user, $search, $status);

        return view('panel::listings', [
            'listings' => $payload['listings'],
            'status' => $status,
            'search' => $search,
            'counts' => $payload['counts'],
        ]);
    }

    public function editListing(Request $request, Listing $listing): View
    {
        $listing->assertOwnedBy($request->user());

        return view('panel::edit-listing', [
            'listing' => $listing->loadPanelEditor(),
            'customFieldValues' => ListingCustomFieldSchemaBuilder::presentableValues(
                $listing->category_id ? (int) $listing->category_id : null,
                (array) $listing->custom_fields,
            ),
            'statusOptions' => Listing::panelStatusOptions(),
        ]);
    }

    public function updateListing(UpdateListingRequest $request, Listing $listing): RedirectResponse
    {
        $listing->assertOwnedBy($request->user());

        $listing->updateFromPanel($request->validated() + [
            'currency' => $listing->currency ?: ListingPanelHelper::defaultCurrency(),
        ]);

        return redirect()
            ->route('panel.listings.edit', $listing)
            ->with('success', 'Listing updated.');
    }

    public function videos(Request $request): View
    {
        return view('panel::videos', Video::panelIndexDataForUser($request->user()));
    }

    public function storeVideo(StoreVideoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

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
        $video->assertOwnedBy($request->user());

        return view('panel::video-edit', [
            'video' => $video->load('listing:id,title,user_id'),
            'listingOptions' => $request->user()->panelListingOptions(),
        ]);
    }

    public function updateVideo(UpdateVideoRequest $request, Video $video): RedirectResponse
    {
        $video->assertOwnedBy($request->user());
        $validated = $request->validated();

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
        $video->assertOwnedBy($request->user());
        $video->delete();

        return redirect()
            ->route('panel.videos.index')
            ->with('success', 'Video deleted.');
    }

    public function profile(Request $request): View
    {
        $user = $request->user()->loadPanelProfile();

        return view('panel::profile', [
            'user' => $user,
        ]);
    }

    public function destroyListing(Request $request, Listing $listing): RedirectResponse
    {
        $listing->assertOwnedBy($request->user());
        $listing->delete();

        return back()->with('success', 'Listing removed.');
    }

    public function markListingAsSold(Request $request, Listing $listing): RedirectResponse
    {
        $listing->assertOwnedBy($request->user());
        $listing->markAsSold();

        return back()->with('success', 'Listing marked as sold.');
    }

    public function republishListing(Request $request, Listing $listing): RedirectResponse
    {
        $listing->assertOwnedBy($request->user());
        $listing->republish();

        return back()->with('success', 'Listing republished.');
    }
}
