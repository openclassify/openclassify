<?php

declare(strict_types=1);

namespace Modules\Review\Http\Controllers;

use App\Support\ListingDirectory;
use App\Support\UserDirectory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Notification\Models\UserNotification;
use Modules\Review\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, int $seller): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:'.Review::MIN_RATING, 'max:'.Review::MAX_RATING],
            'title' => ['nullable', 'string', 'max:120'],
            'body' => ['nullable', 'string', 'max:2000'],
            'listing_id' => ['nullable', 'integer'],
        ]);

        $authorId = (int) $request->user()->getKey();

        if ($authorId === $seller) {
            return back()->with('error', __('review::messages.cannot_review_self'));
        }

        if (! UserDirectory::exists($seller)) {
            abort(404);
        }

        $listingId = isset($validated['listing_id']) ? (int) $validated['listing_id'] : null;

        if ($listingId !== null && ! ListingDirectory::exists($listingId)) {
            $listingId = null;
        }

        if ($listingId !== null && Review::authorHasReviewed($authorId, $listingId)) {
            return back()->with('error', __('review::messages.already_reviewed'));
        }

        Review::record(
            $seller,
            $authorId,
            $listingId,
            (int) $validated['rating'],
            $validated['title'] ?? null,
            $validated['body'] ?? null,
        );

        UserNotification::publish(
            $seller,
            UserNotification::TYPE_REVIEW,
            __('review::messages.notification_title'),
            __('review::messages.notification_body', ['name' => UserDirectory::nameFor($authorId)]),
            route('sellers.show', ['seller' => $seller]),
        );

        return back()->with('success', __('review::messages.created'));
    }

    public function destroy(Request $request, Review $review): RedirectResponse
    {
        abort_unless($review->authorId() === (int) $request->user()->getKey(), 403);

        $review->delete();

        return back()->with('success', __('review::messages.deleted'));
    }
}
