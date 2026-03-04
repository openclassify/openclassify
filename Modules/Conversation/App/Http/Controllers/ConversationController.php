<?php

namespace Modules\Conversation\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Conversation\App\Models\Conversation;
use Modules\Conversation\App\Support\QuickMessageCatalog;
use Modules\Listing\Models\Listing;

class ConversationController extends Controller
{
    public function inbox(Request $request): View
    {
        $userId = (int) $request->user()->getKey();
        $messageFilter = $this->resolveMessageFilter($request);

        $conversations = Conversation::inboxForUser($userId, $messageFilter);
        $selectedConversation = Conversation::resolveSelected($conversations, $request->integer('conversation'));

        if ($selectedConversation) {
            $selectedConversation->loadThread();
            $selectedConversation->markAsReadFor($userId);

            $conversations = $conversations->map(function (Conversation $conversation) use ($selectedConversation): Conversation {
                if ((int) $conversation->getKey() === (int) $selectedConversation->getKey()) {
                    $conversation->unread_count = 0;
                }

                return $conversation;
            });
        }

        return view('conversation::inbox', [
            'conversations' => $conversations,
            'selectedConversation' => $selectedConversation,
            'messageFilter' => $messageFilter,
            'quickMessages' => QuickMessageCatalog::all(),
        ]);
    }

    public function start(Request $request, Listing $listing): RedirectResponse
    {
        $user = $request->user();

        if (! $listing->user_id) {
            return back()->with('error', 'Bu ilan için mesajlaşma açılamadı.');
        }

        if ((int) $listing->user_id === (int) $user->getKey()) {
            return back()->with('error', 'Kendi ilanına mesaj gönderemezsin.');
        }

        $conversation = Conversation::openForListingBuyer($listing, (int) $user->getKey());

        $user->favoriteListings()->syncWithoutDetaching([$listing->getKey()]);

        $messageBody = trim((string) $request->string('message'));

        if ($messageBody !== '') {
            $message = $conversation->messages()->create([
                'sender_id' => $user->getKey(),
                'body' => $messageBody,
            ]);

            $conversation->forceFill(['last_message_at' => $message->created_at])->save();
        }

        return redirect()
            ->route('panel.inbox.index', array_merge($this->inboxFilters($request), ['conversation' => $conversation->getKey()]))
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

        $messageBody = trim($payload['message']);

        if ($messageBody === '') {
            return back()->with('error', 'Mesaj boş olamaz.');
        }

        $message = $conversation->messages()->create([
            'sender_id' => $userId,
            'body' => $messageBody,
        ]);

        $conversation->forceFill(['last_message_at' => $message->created_at])->save();

        return redirect()
            ->route('panel.inbox.index', array_merge($this->inboxFilters($request), ['conversation' => $conversation->getKey()]))
            ->with('success', 'Mesaj gönderildi.');
    }

    private function inboxFilters(Request $request): array
    {
        $messageFilter = $this->resolveMessageFilter($request);

        return $messageFilter === 'all' ? [] : ['message_filter' => $messageFilter];
    }

    private function resolveMessageFilter(Request $request): string
    {
        $messageFilter = (string) $request->string('message_filter', 'all');

        return in_array($messageFilter, ['all', 'unread', 'important'], true) ? $messageFilter : 'all';
    }
}
