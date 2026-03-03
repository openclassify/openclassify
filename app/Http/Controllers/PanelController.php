<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Listing\Models\Listing;

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

        $listings = $user->listings()
            ->with('category:id,name')
            ->withCount('favoritedByUsers')
            ->when($search !== '', fn ($query) => $query->where('title', 'like', "%{$search}%"))
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $statusCounts = $user->listings()
            ->selectRaw('status, COUNT(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        $counts = [
            'all' => (int) $statusCounts->sum(),
            'sold' => (int) ($statusCounts['sold'] ?? 0),
            'expired' => (int) ($statusCounts['expired'] ?? 0),
        ];

        return view('panel.listings', [
            'listings' => $listings,
            'status' => $status,
            'search' => $search,
            'counts' => $counts,
        ]);
    }

    public function inbox(Request $request): View
    {
        $userId = (int) $request->user()->getKey();

        $messageFilter = (string) $request->string('message_filter', 'all');
        if (! in_array($messageFilter, ['all', 'unread', 'important'], true)) {
            $messageFilter = 'all';
        }

        $conversations = Conversation::query()
            ->forUser($userId)
            ->when(
                in_array($messageFilter, ['unread', 'important'], true),
                fn ($query) => $query->whereHas('messages', fn ($messageQuery) => $messageQuery
                    ->where('sender_id', '!=', $userId)
                    ->whereNull('read_at'))
            )
            ->with([
                'listing:id,title,price,currency,user_id',
                'buyer:id,name',
                'seller:id,name',
                'lastMessage:id,conversation_id,sender_id,body,created_at',
            ])
            ->withCount([
                'messages as unread_count' => fn ($query) => $query
                    ->where('sender_id', '!=', $userId)
                    ->whereNull('read_at'),
            ])
            ->orderByDesc('last_message_at')
            ->orderByDesc('updated_at')
            ->get();

        $selectedConversation = null;
        $selectedConversationId = $request->integer('conversation');

        if ($selectedConversationId <= 0 && $conversations->isNotEmpty()) {
            $selectedConversationId = (int) $conversations->first()->getKey();
        }

        if ($selectedConversationId > 0) {
            $selectedConversation = $conversations->firstWhere('id', $selectedConversationId);

            if ($selectedConversation) {
                $selectedConversation->load([
                    'listing:id,title,price,currency,user_id',
                    'messages' => fn ($query) => $query
                        ->with('sender:id,name')
                        ->orderBy('created_at'),
                ]);

                ConversationMessage::query()
                    ->where('conversation_id', $selectedConversation->getKey())
                    ->where('sender_id', '!=', $userId)
                    ->whereNull('read_at')
                    ->update([
                        'read_at' => now(),
                        'updated_at' => now(),
                    ]);

                $conversations = $conversations->map(function (Conversation $conversation) use ($selectedConversation): Conversation {
                    if ((int) $conversation->getKey() === (int) $selectedConversation->getKey()) {
                        $conversation->unread_count = 0;
                    }

                    return $conversation;
                });
            }
        }

        return view('panel.inbox', [
            'conversations' => $conversations,
            'selectedConversation' => $selectedConversation,
            'messageFilter' => $messageFilter,
            'quickMessages' => [
                'Merhaba',
                'İlan hâlâ satışta mı?',
                'Son fiyat nedir?',
                'Teşekkürler',
            ],
        ]);
    }

    public function destroyListing(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);
        $listing->delete();

        return back()->with('success', 'İlan kaldırıldı.');
    }

    public function markListingAsSold(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);
        $listing->forceFill([
            'status' => 'sold',
        ])->save();

        return back()->with('success', 'İlan satıldı olarak işaretlendi.');
    }

    public function republishListing(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);
        $listing->forceFill([
            'status' => 'active',
            'expires_at' => now()->addDays(30),
        ])->save();

        return back()->with('success', 'İlan yeniden yayına alındı.');
    }

    private function guardListingOwner(Request $request, Listing $listing): void
    {
        if ((int) $listing->user_id !== (int) $request->user()->getKey()) {
            abort(403);
        }
    }
}
