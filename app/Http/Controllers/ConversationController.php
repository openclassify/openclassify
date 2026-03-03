<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Listing\Models\Listing;

class ConversationController extends Controller
{
    public function start(Request $request, Listing $listing): RedirectResponse
    {
        $user = $request->user();

        if (! $listing->user_id) {
            return back()->with('error', 'Bu ilan için mesajlaşma açılamadı.');
        }

        if ((int) $listing->user_id === (int) $user->getKey()) {
            return back()->with('error', 'Kendi ilanına mesaj gönderemezsin.');
        }

        $conversation = Conversation::query()->firstOrCreate(
            [
                'listing_id' => $listing->getKey(),
                'buyer_id' => $user->getKey(),
            ],
            [
                'seller_id' => $listing->user_id,
            ],
        );

        if ((int) $conversation->seller_id !== (int) $listing->user_id) {
            $conversation->forceFill([
                'seller_id' => $listing->user_id,
            ])->save();
        }

        $user->favoriteListings()->syncWithoutDetaching([$listing->getKey()]);

        $messageBody = trim((string) $request->string('message'));

        if ($messageBody !== '') {
            $message = $conversation->messages()->create([
                'sender_id' => $user->getKey(),
                'body' => $messageBody,
            ]);

            $conversation->forceFill([
                'last_message_at' => $message->created_at,
            ])->save();
        }

        return redirect()
            ->route('favorites.index', array_merge(
                $this->listingTabFilters($request),
                ['conversation' => $conversation->getKey()],
            ))
            ->with('success', $messageBody !== '' ? 'Mesaj gönderildi.' : 'Sohbet açıldı.');
    }

    public function send(Request $request, Conversation $conversation): RedirectResponse
    {
        $user = $request->user();
        $userId = (int) $user->getKey();

        if ((int) $conversation->buyer_id !== $userId && (int) $conversation->seller_id !== $userId) {
            abort(403);
        }

        $payload = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => $userId,
            'body' => trim($payload['message']),
        ]);

        $conversation->forceFill([
            'last_message_at' => $message->created_at,
        ])->save();

        return redirect()
            ->route('favorites.index', array_merge(
                $this->listingTabFilters($request),
                ['conversation' => $conversation->getKey()],
            ))
            ->with('success', 'Mesaj gönderildi.');
    }

    private function listingTabFilters(Request $request): array
    {
        $filters = [
            'tab' => 'listings',
        ];

        $status = (string) $request->string('status');
        if (in_array($status, ['all', 'active'], true)) {
            $filters['status'] = $status;
        }

        $categoryId = $request->integer('category');
        if ($categoryId > 0) {
            $filters['category'] = $categoryId;
        }

        $messageFilter = (string) $request->string('message_filter');
        if (in_array($messageFilter, ['all', 'unread', 'important'], true)) {
            $filters['message_filter'] = $messageFilter;
        }

        return $filters;
    }
}
