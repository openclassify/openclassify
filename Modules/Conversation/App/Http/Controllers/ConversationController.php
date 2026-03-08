<?php

namespace Modules\Conversation\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Modules\Conversation\App\Models\Conversation;
use Modules\Conversation\App\Models\ConversationMessage;
use Modules\Conversation\App\Support\QuickMessageCatalog;
use Modules\Listing\Models\Listing;
use Throwable;

class ConversationController extends Controller
{
    public function inbox(Request $request): View
    {
        $user = $request->user();
        $userId = $user ? (int) $user->getKey() : null;
        $requiresLogin = ! $user;
        $messageFilter = $this->resolveMessageFilter($request);

        $conversations = collect();
        $selectedConversation = null;

        if ($userId && $this->messagingTablesReady()) {
            try {
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
            } catch (Throwable) {
                $conversations = collect();
                $selectedConversation = null;
            }
        }

        return view('conversation::inbox', [
            'conversations' => $conversations,
            'selectedConversation' => $selectedConversation,
            'messageFilter' => $messageFilter,
            'quickMessages' => QuickMessageCatalog::all(),
            'requiresLogin' => $requiresLogin,
        ]);
    }

    public function start(Request $request, Listing $listing): RedirectResponse | JsonResponse
    {
        if (! $this->messagingTablesReady()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Messaging is not available yet.'], 503);
            }

            return back()->with('error', 'Messaging is not available yet.');
        }

        $user = $request->user();

        if (! $listing->user_id) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'A conversation cannot be started for this listing.'], 422);
            }

            return back()->with('error', 'A conversation cannot be started for this listing.');
        }

        if ((int) $listing->user_id === (int) $user->getKey()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'You cannot message your own listing.'], 422);
            }

            return back()->with('error', 'You cannot message your own listing.');
        }

        $messageBody = trim((string) $request->string('message'));

        if ($request->expectsJson() && $messageBody === '') {
            return response()->json(['message' => 'Message cannot be empty.'], 422);
        }

        $conversation = Conversation::openForListingBuyer($listing, (int) $user->getKey());

        $user->favoriteListings()->syncWithoutDetaching([$listing->getKey()]);

        $message = null;
        if ($messageBody !== '') {
            $message = $conversation->messages()->create([
                'sender_id' => $user->getKey(),
                'body' => $messageBody,
            ]);

            $conversation->forceFill(['last_message_at' => $message->created_at])->save();
        }

        if ($request->expectsJson()) {
            return $this->conversationJsonResponse($conversation, $message, (int) $user->getKey());
        }

        return redirect()
            ->route('panel.inbox.index', array_merge($this->inboxFilters($request), ['conversation' => $conversation->getKey()]))
            ->with('success', $messageBody !== '' ? 'Message sent.' : 'Conversation started.');
    }

    public function send(Request $request, Conversation $conversation): RedirectResponse | JsonResponse
    {
        if (! $this->messagingTablesReady()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Messaging is not available yet.'], 503);
            }

            return back()->with('error', 'Messaging is not available yet.');
        }

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
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Message cannot be empty.'], 422);
            }

            return back()->with('error', 'Message cannot be empty.');
        }

        $message = $conversation->messages()->create([
            'sender_id' => $userId,
            'body' => $messageBody,
        ]);

        $conversation->forceFill(['last_message_at' => $message->created_at])->save();

        if ($request->expectsJson()) {
            return $this->conversationJsonResponse($conversation, $message, $userId);
        }

        return redirect()
            ->route('panel.inbox.index', array_merge($this->inboxFilters($request), ['conversation' => $conversation->getKey()]))
            ->with('success', 'Message sent.');
    }

    private function conversationJsonResponse(Conversation $conversation, ?ConversationMessage $message, int $userId): JsonResponse
    {
        return response()->json([
            'conversation_id' => (int) $conversation->getKey(),
            'send_url' => route('conversations.messages.send', $conversation),
            'message' => $message ? $this->messagePayload($message, $userId) : null,
        ]);
    }

    private function messagePayload(ConversationMessage $message, int $userId): array
    {
        return [
            'id' => (int) $message->getKey(),
            'body' => (string) $message->body,
            'time' => $message->created_at?->format('H:i') ?? now()->format('H:i'),
            'is_mine' => (int) $message->sender_id === $userId,
        ];
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

    private function messagingTablesReady(): bool
    {
        try {
            return Schema::hasTable('conversations') && Schema::hasTable('conversation_messages');
        } catch (Throwable) {
            return false;
        }
    }
}
