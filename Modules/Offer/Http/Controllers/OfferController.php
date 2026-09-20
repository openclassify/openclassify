<?php

declare(strict_types=1);

namespace Modules\Offer\Http\Controllers;

use App\Support\ListingDirectory;
use App\Support\UserDirectory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Notification\Models\UserNotification;
use Modules\Offer\Models\Offer;

class OfferController extends Controller
{
    public function index(Request $request): View
    {
        $userId = (int) $request->user()->getKey();
        $status = (string) $request->query('status', 'all');
        $direction = $request->query('direction') === 'sent' ? 'sent' : 'received';

        $offers = $direction === 'sent'
            ? Offer::sentByBuyer($userId)
            : Offer::receivedBySeller($userId, $status);

        $listings = ListingDirectory::resolve(
            $offers->getCollection()->map(static fn (Offer $offer): int => $offer->listingId())->all()
        );

        $counterpartIds = $offers->getCollection()
            ->map(static fn (Offer $offer): int => $direction === 'sent'
                ? (int) $offer->getAttribute('seller_id')
                : $offer->buyerId())
            ->all();

        return view('offer::index', [
            'offers' => $offers,
            'listings' => $listings,
            'people' => UserDirectory::resolve($counterpartIds),
            'counts' => Offer::statusCountsForSeller($userId),
            'status' => $status,
            'direction' => $direction,
        ]);
    }

    public function store(Request $request, int $listing): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1', 'max:99999999'],
            'message' => ['nullable', 'string', 'max:500'],
        ]);

        $summary = ListingDirectory::find($listing);

        if ($summary === null || $summary['seller_id'] === null) {
            abort(404);
        }

        $buyerId = (int) $request->user()->getKey();

        if ($buyerId === $summary['seller_id']) {
            return back()->with('error', __('offer::messages.cannot_offer_own'));
        }

        $offer = Offer::place(
            $listing,
            $buyerId,
            $summary['seller_id'],
            (float) $validated['amount'],
            (string) $request->input('currency', config('app.default_currency', 'USD')),
            $validated['message'] ?? null,
        );

        UserNotification::publish(
            $summary['seller_id'],
            UserNotification::TYPE_OFFER,
            __('offer::messages.notification_received_title'),
            __('offer::messages.notification_received_body', [
                'amount' => $offer->amountLabel(),
                'listing' => $summary['title'],
            ]),
            route('panel.offers.index'),
        );

        return back()->with('success', __('offer::messages.sent'));
    }

    public function accept(Request $request, Offer $offer): RedirectResponse
    {
        $this->authorizeSeller($request, $offer);

        $offer->accept();
        $this->notifyBuyer($offer, __('offer::messages.notification_accepted_title'), __('offer::messages.notification_accepted_body', [
            'listing' => ListingDirectory::titleFor($offer->listingId()),
        ]));

        return back()->with('success', __('offer::messages.accepted'));
    }

    public function decline(Request $request, Offer $offer): RedirectResponse
    {
        $this->authorizeSeller($request, $offer);

        $offer->decline();
        $this->notifyBuyer($offer, __('offer::messages.notification_declined_title'), __('offer::messages.notification_declined_body', [
            'listing' => ListingDirectory::titleFor($offer->listingId()),
        ]));

        return back()->with('success', __('offer::messages.declined'));
    }

    public function withdraw(Request $request, Offer $offer): RedirectResponse
    {
        abort_unless($offer->belongsToBuyer((int) $request->user()->getKey()), 403);

        $offer->withdraw();

        return back()->with('success', __('offer::messages.withdrawn'));
    }

    private function authorizeSeller(Request $request, Offer $offer): void
    {
        abort_unless($offer->belongsToSeller((int) $request->user()->getKey()), 403);
        abort_unless($offer->isPending(), 422);
    }

    private function notifyBuyer(Offer $offer, string $title, string $body): void
    {
        UserNotification::publish(
            $offer->buyerId(),
            UserNotification::TYPE_OFFER,
            $title,
            $body,
            route('panel.offers.index', ['direction' => 'sent']),
        );
    }
}
