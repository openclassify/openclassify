<?php

declare(strict_types=1);

namespace Tests\Feature;

use Modules\Listing\Models\Listing;
use Modules\Notification\Models\UserNotification;
use Modules\Offer\Models\Offer;
use Modules\Promotion\Models\PromotionOrder;
use Modules\Promotion\Models\PromotionPlan;
use Modules\Report\Models\Report;
use Modules\Review\Models\Review;
use Modules\User\App\Models\User;
use Tests\TestCase;

class MarketplaceFlowTest extends TestCase
{
    private function listingWithOtherSeller(User $buyer): Listing
    {
        return Listing::query()
            ->active()
            ->whereNotNull('user_id')
            ->whereNotNull('price')
            ->where('user_id', '!=', $buyer->getKey())
            ->firstOrFail();
    }

    public function test_buyer_can_place_offer_and_seller_is_notified(): void
    {
        $buyer = User::query()->where('email', 'b@b.com')->firstOrFail();
        $listing = $this->listingWithOtherSeller($buyer);
        $sellerId = (int) $listing->getAttribute('user_id');
        $before = UserNotification::query()->where('user_id', $sellerId)->count();

        $this->actingAs($buyer)
            ->from(route('listings.show', $listing))
            ->post(route('offers.store', $listing), ['amount' => 123.45, 'message' => 'Test offer'])
            ->assertRedirect();

        $offer = Offer::query()
            ->where('listing_id', $listing->getKey())
            ->where('buyer_id', $buyer->getKey())
            ->where('amount', 123.45)
            ->firstOrFail();

        $this->assertTrue($offer->isPending());
        $this->assertSame($before + 1, UserNotification::query()->where('user_id', $sellerId)->count());
    }

    public function test_seller_can_accept_offer(): void
    {
        $buyer = User::query()->where('email', 'c@c.com')->firstOrFail();
        $listing = $this->listingWithOtherSeller($buyer);
        $sellerId = (int) $listing->getAttribute('user_id');
        $seller = User::query()->findOrFail($sellerId);

        $offer = Offer::place((int) $listing->getKey(), (int) $buyer->getKey(), $sellerId, 99.0, 'USD', null);

        $this->actingAs($seller)
            ->post(route('offers.accept', $offer))
            ->assertRedirect();

        $this->assertSame(Offer::STATUS_ACCEPTED, $offer->fresh()?->getAttribute('status'));
    }

    public function test_offer_on_own_listing_is_rejected(): void
    {
        $listing = Listing::query()->active()->whereNotNull('user_id')->whereNotNull('price')->firstOrFail();
        $seller = User::query()->findOrFail((int) $listing->getAttribute('user_id'));

        $this->actingAs($seller)
            ->from(route('listings.show', $listing))
            ->post(route('offers.store', $listing), ['amount' => 10])
            ->assertRedirect()
            ->assertSessionHas('error');
    }

    public function test_member_can_review_a_seller(): void
    {
        $author = User::query()->where('email', 'd@d.com')->firstOrFail();
        $listing = $this->listingWithOtherSeller($author);
        $sellerId = (int) $listing->getAttribute('user_id');

        Review::query()->where('author_id', $author->getKey())->forceDelete();

        $this->actingAs($author)
            ->from(route('sellers.show', $sellerId))
            ->post(route('reviews.store', $sellerId), ['rating' => 5, 'title' => 'Great', 'body' => 'Smooth deal'])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertTrue(
            Review::query()->where('author_id', $author->getKey())->where('seller_id', $sellerId)->exists()
        );
    }

    public function test_review_summary_reflects_new_rating(): void
    {
        $seller = User::query()->where('email', 'e@e.com')->firstOrFail();
        $sellerId = (int) $seller->getKey();
        $author = User::query()->where('email', 'b@b.com')->firstOrFail();

        Review::record($sellerId, (int) $author->getKey(), null, 4, null, null);

        $summary = Review::summaryForSeller($sellerId);

        $this->assertGreaterThan(0, $summary['total']);
        $this->assertGreaterThanOrEqual(1.0, $summary['average']);
    }

    public function test_member_can_report_a_listing_once(): void
    {
        $reporter = User::query()->where('email', 'c@c.com')->firstOrFail();
        $listing = Listing::query()->active()->firstOrFail();

        Report::query()
            ->where('reporter_id', $reporter->getKey())
            ->where('subject_id', $listing->getKey())
            ->forceDelete();

        $payload = [
            'subject_type' => Report::SUBJECT_LISTING,
            'subject_id' => $listing->getKey(),
            'reason' => 'spam',
            'details' => 'Duplicate posting',
        ];

        $this->actingAs($reporter)->from('/')->post(route('reports.store'), $payload)
            ->assertRedirect()->assertSessionHas('success');

        $this->actingAs($reporter)->from('/')->post(route('reports.store'), $payload)
            ->assertRedirect()->assertSessionHas('error');
    }

    public function test_seller_can_activate_a_promotion(): void
    {
        $listing = Listing::query()->active()->whereNotNull('user_id')->firstOrFail();
        $seller = User::query()->findOrFail((int) $listing->getAttribute('user_id'));
        $plan = PromotionPlan::catalog()->firstOrFail();

        $this->actingAs($seller)
            ->post(route('panel.promotions.store'), [
                'listing_id' => $listing->getKey(),
                'plan' => $plan->getAttribute('slug'),
            ])
            ->assertRedirect(route('panel.promotions.index'));

        $order = PromotionOrder::activeForListing((int) $listing->getKey());

        $this->assertNotNull($order);
        $this->assertTrue($order->isRunning());
    }

    public function test_promotion_on_foreign_listing_is_forbidden(): void
    {
        $listing = Listing::query()->active()->whereNotNull('user_id')->firstOrFail();
        $intruder = User::query()->where('id', '!=', $listing->getAttribute('user_id'))->firstOrFail();
        $plan = PromotionPlan::catalog()->firstOrFail();

        $this->actingAs($intruder)
            ->post(route('panel.promotions.store'), [
                'listing_id' => $listing->getKey(),
                'plan' => $plan->getAttribute('slug'),
            ])
            ->assertForbidden();
    }

    public function test_notifications_can_be_marked_read(): void
    {
        $user = User::query()->where('email', 'b@b.com')->firstOrFail();
        $userId = (int) $user->getKey();

        UserNotification::publish($userId, UserNotification::TYPE_LISTING, 'Test');

        $this->assertGreaterThan(0, UserNotification::unreadCountForUser($userId));

        $this->actingAs($user)->from(route('panel.notifications.index'))
            ->post(route('panel.notifications.read-all'))
            ->assertRedirect();

        $this->assertSame(0, UserNotification::unreadCountForUser($userId));
    }

    public function test_guest_cannot_place_offer(): void
    {
        $listing = Listing::query()->active()->whereNotNull('price')->firstOrFail();

        $this->post(route('offers.store', $listing), ['amount' => 50])->assertRedirect(route('login'));
    }
}
