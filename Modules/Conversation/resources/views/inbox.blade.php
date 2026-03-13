@extends('app::layouts.app')

@section('title', 'Inbox')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        @include('panel::partials.sidebar', ['activeMenu' => 'inbox'])

        <section class="space-y-4">
            @include('panel::partials.page-header', [
                'title' => 'Inbox',
                'description' => 'Read and reply to buyer messages from the same panel shell used across the site.',
                'actions' => $requiresLogin ?? false
                    ? new \Illuminate\Support\HtmlString('<a href="' . e(route('login', ['redirect' => request()->fullUrl()])) . '" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Log in</a>')
                    : null,
            ])

            <div
                class="panel-surface overflow-hidden p-0"
                @auth
                data-inbox-root
                data-state-url="{{ route('panel.inbox.state') }}"
                data-read-url-template="{{ route('conversations.read', ['conversation' => '__CONVERSATION__']) }}"
                data-selected-conversation-id="{{ $selectedConversation?->id ?? '' }}"
                @endauth
            >
            @if($requiresLogin ?? false)
            <div class="border-b border-slate-200 px-5 py-4 bg-slate-50">
                <div>
                    <h1 class="text-xl font-semibold text-slate-900">Inbox</h1>
                    <p class="mt-1 text-sm text-slate-500">Stay on this page and log in when you want to access your conversations.</p>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-[420px,1fr] min-h-[620px]">
                <div data-inbox-list-container>
                    @include('conversation::partials.inbox-list-pane', [
                        'conversations' => $conversations,
                        'messageFilter' => $messageFilter,
                        'selectedConversation' => $selectedConversation,
                    ])
                </div>

                <div data-inbox-thread-container>
                    @include('conversation::partials.inbox-thread-pane', [
                        'selectedConversation' => $selectedConversation,
                        'messageFilter' => $messageFilter,
                        'quickMessages' => $quickMessages,
                    ])
                </div>
            </div>
            </div>
        </section>
    </div>
</div>
@endsection
