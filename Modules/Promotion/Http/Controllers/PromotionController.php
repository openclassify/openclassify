<?php

declare(strict_types=1);

namespace Modules\Promotion\Http\Controllers;

use App\Support\ListingDirectory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Notification\Models\UserNotification;
use Modules\Promotion\Models\PromotionOrder;
use Modules\Promotion\Models\PromotionPlan;

class PromotionController extends Controller
{
    public function plans(): View
    {
        return view('promotion::plans', [
            'plans' => PromotionPlan::catalog(),
        ]);
    }

    public function index(Request $request): View
    {
        $userId = (int) $request->user()->getKey();
        $orders = PromotionOrder::paginateForUser($userId);

        return view('promotion::index', [
            'orders' => $orders,
            'plans' => PromotionPlan::catalog(),
            'listings' => ListingDirectory::resolve(
                $orders->getCollection()->map(static fn (PromotionOrder $order): int => $order->listingId())->all()
            ),
            'activeCount' => PromotionOrder::activeCountForUser($userId),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'listing_id' => ['required', 'integer', 'min:1'],
            'plan' => ['required', 'string', 'max:64'],
        ]);

        $plan = PromotionPlan::findActiveBySlug((string) $validated['plan']);

        if ($plan === null) {
            abort(404);
        }

        $listingId = (int) $validated['listing_id'];
        $userId = (int) $request->user()->getKey();

        abort_unless(ListingDirectory::sellerIdFor($listingId) === $userId, 403);

        $order = PromotionOrder::open($plan, $userId, $listingId);

        UserNotification::publish(
            $userId,
            UserNotification::TYPE_PROMOTION,
            __('promotion::messages.notification_title'),
            __('promotion::messages.notification_body', [
                'plan' => (string) $plan->getAttribute('name'),
                'days' => $order->remainingDays(),
            ]),
            route('panel.promotions.index'),
        );

        return redirect()
            ->route('panel.promotions.index')
            ->with('success', __('promotion::messages.activated'));
    }
}
