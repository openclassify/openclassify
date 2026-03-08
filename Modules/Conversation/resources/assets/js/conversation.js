const onReady = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });
        return;
    }

    callback();
};

const csrfToken = () => document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

const socketHeaders = () => {
    const socketId = window.Echo?.socketId?.();

    return socketId ? { 'X-Socket-ID': socketId } : {};
};

const jsonHeaders = () => ({
    Accept: 'application/json',
    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
    'X-CSRF-TOKEN': csrfToken(),
    'X-Requested-With': 'XMLHttpRequest',
    ...socketHeaders(),
});

const toFormBody = (values) => {
    const params = new URLSearchParams();

    Object.entries(values).forEach(([key, value]) => {
        if (value === null || value === undefined) {
            return;
        }

        params.append(key, String(value));
    });

    return params.toString();
};

const formatCount = (count) => (count > 99 ? '99+' : String(count));

const setBadgeCount = (badge, count) => {
    if (!badge) {
        return;
    }

    if (!count || count < 1) {
        badge.textContent = '0';
        badge.classList.add('hidden');
        return;
    }

    badge.textContent = formatCount(count);
    badge.classList.remove('hidden');
};

const updateHeaderInboxBadge = (count) => {
    setBadgeCount(document.querySelector('[data-header-inbox-badge]'), count);
};

const subscribeInboxChannel = () => {
    const body = document.body;
    const userId = String(body.dataset.authUserId || '').trim();
    const channelName = String(body.dataset.inboxChannel || '').trim();

    if (!userId || !channelName || !window.Echo?.private || window.__ocInboxChannel === channelName) {
        return;
    }

    const channel = window.Echo.private(channelName);

    channel.listen('.inbox.message.created', (payload) => {
        updateHeaderInboxBadge(payload?.counts?.unread_messages_total ?? 0);
        document.dispatchEvent(new CustomEvent('oc:inbox-message-created', { detail: payload }));
    });

    channel.listen('.inbox.read.updated', (payload) => {
        updateHeaderInboxBadge(payload?.counts?.unread_messages_total ?? 0);
        document.dispatchEvent(new CustomEvent('oc:inbox-read-updated', { detail: payload }));
    });

    window.__ocInboxChannel = channelName;
};

const buildMessageItem = (message) => {
    const item = document.createElement('div');
    item.dataset.messageId = String(message.id);
    item.className = `lt-chat-item${message.is_mine ? ' is-mine' : ''}`;

    const bubble = document.createElement('div');
    bubble.className = 'lt-chat-bubble';
    bubble.textContent = message.body;

    const time = document.createElement('span');
    time.className = 'lt-chat-time';
    time.textContent = message.time || '';

    item.append(bubble, time);

    return item;
};

const appendInlineChatMessage = (thread, emptyState, message) => {
    if (!thread || !message?.body || thread.querySelector(`[data-message-id="${message.id}"]`)) {
        return;
    }

    const item = buildMessageItem(message);
    thread.appendChild(item);
    emptyState?.classList.add('is-hidden');
    thread.scrollTop = thread.scrollHeight;
};

const initInlineListingChat = () => {
    const root = document.querySelector('[data-inline-chat]');

    if (!root || root.dataset.chatBound === '1') {
        return;
    }

    root.dataset.chatBound = '1';

    const launcher = root.querySelector('[data-inline-chat-launcher]');
    const panel = root.querySelector('[data-inline-chat-panel]');
    const thread = root.querySelector('[data-inline-chat-thread]');
    const emptyState = root.querySelector('[data-inline-chat-empty]');
    const form = root.querySelector('[data-inline-chat-form]');
    const input = root.querySelector('[data-inline-chat-input]');
    const error = root.querySelector('[data-inline-chat-error]');
    const submitButton = root.querySelector('[data-inline-chat-submit]');
    const launcherBadge = root.querySelector('[data-inline-chat-badge]');

    const currentConversationId = () => String(root.dataset.conversationId || '').trim();

    const resolveReadUrl = () => {
        if (root.dataset.readUrl) {
            return root.dataset.readUrl;
        }

        const conversationId = currentConversationId();
        const template = String(root.dataset.readUrlTemplate || '');

        return conversationId && template ? template.replace('__CONVERSATION__', conversationId) : '';
    };

    const setState = (state) => {
        const isOpen = state === 'open' || state === 'sending';

        root.dataset.state = state;
        root.classList.toggle('is-open', isOpen);
        root.classList.toggle('is-collapsed', state === 'collapsed');
        root.classList.toggle('is-sending', state === 'sending');

        launcher?.toggleAttribute('hidden', isOpen);
        panel?.toggleAttribute('hidden', !isOpen);

        if (isOpen) {
            window.requestAnimationFrame(() => {
                thread?.scrollTo({ top: thread.scrollHeight });
                input?.focus();
            });
        }
    };

    const showError = (message) => {
        if (!error) {
            return;
        }

        if (!message) {
            error.textContent = '';
            error.classList.add('is-hidden');
            return;
        }

        error.textContent = message;
        error.classList.remove('is-hidden');
    };

    const setUnreadCount = (count) => {
        setBadgeCount(launcherBadge, count);
    };

    const markConversationRead = async () => {
        const readUrl = resolveReadUrl();

        if (!readUrl || !currentConversationId()) {
            return;
        }

        const response = await fetch(readUrl, {
            method: 'POST',
            headers: jsonHeaders(),
        });

        const payload = await response.json().catch(() => ({}));

        if (!response.ok) {
            return;
        }

        setUnreadCount(payload?.conversation?.unread_count ?? 0);
        updateHeaderInboxBadge(payload?.counts?.unread_messages_total ?? 0);
    };

    const openChat = async (event) => {
        event?.preventDefault();
        event?.stopPropagation();

        if (root.dataset.state === 'open' || root.dataset.state === 'sending') {
            return;
        }

        showError('');
        setState('open');
        await markConversationRead();
    };

    document.querySelectorAll('[data-inline-chat-trigger]').forEach((button) => {
        button.addEventListener('click', openChat);
    });

    launcher?.addEventListener('click', openChat);

    root.querySelector('[data-inline-chat-close]')?.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        if (root.dataset.state === 'collapsed') {
            return;
        }

        showError('');
        setState('collapsed');
    });

    root.addEventListener('click', (event) => {
        if (event.target.closest('[data-inline-chat-panel]')) {
            event.stopPropagation();
        }
    });

    form?.addEventListener('submit', async (event) => {
        event.preventDefault();
        event.stopPropagation();

        if (!input || !submitButton || root.dataset.state === 'sending') {
            return;
        }

        const message = input.value.trim();
        if (message === '') {
            showError('Message cannot be empty.');
            input.focus();
            return;
        }

        const targetUrl = root.dataset.sendUrl || root.dataset.startUrl;
        if (!targetUrl) {
            showError('Messaging is not available right now.');
            return;
        }

        showError('');
        submitButton.disabled = true;
        setState('sending');

        try {
            const response = await fetch(targetUrl, {
                method: 'POST',
                headers: jsonHeaders(),
                body: toFormBody({ message }),
            });

            const payload = await response.json().catch(() => ({}));
            if (!response.ok) {
                throw new Error(payload?.message || payload?.errors?.message?.[0] || 'Message could not be sent.');
            }

            if (payload.send_url) {
                root.dataset.sendUrl = payload.send_url;
            }

            if (payload.read_url) {
                root.dataset.readUrl = payload.read_url;
            }

            if (payload.conversation_id) {
                root.dataset.conversationId = String(payload.conversation_id);
            }

            if (payload.message) {
                appendInlineChatMessage(thread, emptyState, payload.message);
            }

            updateHeaderInboxBadge(payload?.counts?.unread_messages_total ?? 0);
            setUnreadCount(payload?.conversation?.unread_count ?? 0);
            input.value = '';
            setState('open');
        } catch (requestError) {
            showError(requestError instanceof Error ? requestError.message : 'Message could not be sent.');
            setState('open');
        } finally {
            submitButton.disabled = false;
        }
    });

    document.addEventListener('oc:inbox-message-created', async ({ detail }) => {
        if (String(detail?.conversation?.id || '') !== currentConversationId()) {
            return;
        }

        if (root.dataset.state === 'open') {
            appendInlineChatMessage(thread, emptyState, detail.message);

            if (!detail?.message?.is_mine && document.visibilityState === 'visible') {
                await markConversationRead();
            }

            return;
        }

        if (!detail?.message?.is_mine) {
            setUnreadCount(detail?.conversation?.unread_count ?? 0);
        }
    });

    document.addEventListener('oc:inbox-read-updated', ({ detail }) => {
        if (String(detail?.conversation?.id || '') !== currentConversationId()) {
            return;
        }

        setUnreadCount(detail?.conversation?.unread_count ?? 0);
    });

    document.addEventListener('visibilitychange', async () => {
        if (document.visibilityState === 'visible' && root.dataset.state === 'open') {
            await markConversationRead();
        }
    });

    setState('collapsed');
};

const buildInboxMessageItem = (message) => {
    const wrapper = document.createElement('div');
    wrapper.dataset.messageId = String(message.id);
    wrapper.className = `mb-4 flex ${message.is_mine ? 'justify-end' : 'justify-start'}`;

    const shell = document.createElement('div');
    shell.className = 'max-w-[80%]';

    const bubble = document.createElement('div');
    bubble.className = `${message.is_mine ? 'bg-amber-100 text-slate-900' : 'bg-white text-slate-900 border border-slate-200'} rounded-2xl px-4 py-2 text-base shadow-sm`;
    bubble.textContent = message.body;

    const time = document.createElement('p');
    time.className = `text-xs text-slate-500 mt-1 ${message.is_mine ? 'text-right' : 'text-left'}`;
    time.textContent = message.time || '';

    shell.append(bubble, time);
    wrapper.appendChild(shell);

    return wrapper;
};

const initInboxRealtime = () => {
    const root = document.querySelector('[data-inbox-root]');

    if (!root) {
        return;
    }

    const listContainer = root.querySelector('[data-inbox-list-container]');
    const threadContainer = root.querySelector('[data-inbox-thread-container]');

    if (!listContainer || !threadContainer) {
        return;
    }

    const currentSelectedConversationId = () => {
        const panel = threadContainer.querySelector('[data-inbox-thread-panel]');

        return String(
            root.dataset.selectedConversationId ||
            panel?.dataset.selectedConversationId ||
            '',
        ).trim();
    };

    const readUrlFor = (conversationId) => {
        const template = String(root.dataset.readUrlTemplate || '');

        return conversationId && template ? template.replace('__CONVERSATION__', conversationId) : '';
    };

    const currentFilter = () => {
        const params = new URLSearchParams(window.location.search);

        return params.get('message_filter') || 'all';
    };

    const syncBrowserUrl = (conversationId) => {
        const url = new URL(window.location.href);
        const filter = currentFilter();

        if (filter === 'all') {
            url.searchParams.delete('message_filter');
        } else {
            url.searchParams.set('message_filter', filter);
        }

        if (conversationId) {
            url.searchParams.set('conversation', conversationId);
        } else {
            url.searchParams.delete('conversation');
        }

        window.history.replaceState({}, '', url);
    };

    const refreshState = async ({ conversationId = currentSelectedConversationId(), scrollToBottom = false } = {}) => {
        const params = new URLSearchParams();

        if (currentFilter() !== 'all') {
            params.set('message_filter', currentFilter());
        }

        if (conversationId) {
            params.set('conversation', conversationId);
        }

        const targetUrl = `${root.dataset.stateUrl}${params.toString() ? `?${params.toString()}` : ''}`;
        const response = await fetch(targetUrl, {
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });

        if (!response.ok) {
            return;
        }

        const payload = await response.json().catch(() => null);
        if (!payload) {
            return;
        }

        listContainer.innerHTML = payload.list_html || '';
        threadContainer.innerHTML = payload.thread_html || '';
        root.dataset.selectedConversationId = payload.selected_conversation_id ? String(payload.selected_conversation_id) : '';
        updateHeaderInboxBadge(payload?.counts?.unread_messages_total ?? 0);
        syncBrowserUrl(root.dataset.selectedConversationId);

        if (scrollToBottom) {
            const thread = threadContainer.querySelector('[data-inbox-thread]');
            thread?.scrollTo({ top: thread.scrollHeight });
        }
    };

    const showThreadError = (message) => {
        const error = threadContainer.querySelector('[data-inbox-send-error]');

        if (!error) {
            return;
        }

        if (!message) {
            error.textContent = '';
            error.classList.add('hidden');
            return;
        }

        error.textContent = message;
        error.classList.remove('hidden');
    };

    const appendInboxMessage = (message) => {
        const thread = threadContainer.querySelector('[data-inbox-thread]');
        const emptyState = threadContainer.querySelector('[data-inbox-empty]');

        if (!thread || !message?.body || thread.querySelector(`[data-message-id="${message.id}"]`)) {
            return;
        }

        if (emptyState) {
            emptyState.remove();
        }

        thread.appendChild(buildInboxMessageItem(message));
        thread.scrollTop = thread.scrollHeight;
    };

    const markConversationRead = async (conversationId) => {
        const readUrl = readUrlFor(conversationId);

        if (!readUrl) {
            return;
        }

        const response = await fetch(readUrl, {
            method: 'POST',
            headers: jsonHeaders(),
        });

        const payload = await response.json().catch(() => null);

        if (payload) {
            updateHeaderInboxBadge(payload?.counts?.unread_messages_total ?? 0);
        }
    };

    root.addEventListener('submit', async (event) => {
        const form = event.target.closest('[data-inbox-send-form]');

        if (!form) {
            return;
        }

        event.preventDefault();

        const formData = new FormData(form);
        const message = String(formData.get('message') || '').trim();
        const submitButton = form.querySelector('[data-inbox-send-button]') || form.querySelector('button[type="submit"]');
        const textInput = threadContainer.querySelector('[data-inbox-message-input]');

        if (message === '') {
            showThreadError('Message cannot be empty.');
            textInput?.focus();
            return;
        }

        showThreadError('');
        submitButton?.setAttribute('disabled', 'disabled');

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: jsonHeaders(),
                body: new URLSearchParams(formData).toString(),
            });

            const payload = await response.json().catch(() => ({}));

            if (!response.ok) {
                throw new Error(payload?.message || payload?.errors?.message?.[0] || 'Message could not be sent.');
            }

            if (payload.message && String(payload.conversation_id || '') === currentSelectedConversationId()) {
                appendInboxMessage(payload.message);
            }

            if (textInput && form.contains(textInput)) {
                textInput.value = '';
                textInput.focus();
            }

            root.dataset.selectedConversationId = String(payload.conversation_id || currentSelectedConversationId());
            await refreshState({ conversationId: root.dataset.selectedConversationId, scrollToBottom: true });
        } catch (requestError) {
            showThreadError(requestError instanceof Error ? requestError.message : 'Message could not be sent.');
        } finally {
            submitButton?.removeAttribute('disabled');
        }
    });

    document.addEventListener('oc:inbox-message-created', async ({ detail }) => {
        const selectedConversationId = currentSelectedConversationId();
        const eventConversationId = String(detail?.conversation?.id || '');

        if (selectedConversationId && eventConversationId === selectedConversationId) {
            appendInboxMessage(detail.message);

            if (!detail?.message?.is_mine && document.visibilityState === 'visible') {
                await markConversationRead(selectedConversationId);
            }

            await refreshState({ conversationId: selectedConversationId, scrollToBottom: true });
            return;
        }

        await refreshState({ conversationId: selectedConversationId });
    });

    document.addEventListener('oc:inbox-read-updated', async () => {
        await refreshState({ conversationId: currentSelectedConversationId() });
    });

    document.addEventListener('visibilitychange', async () => {
        const selectedConversationId = currentSelectedConversationId();

        if (document.visibilityState !== 'visible' || !selectedConversationId) {
            return;
        }

        await markConversationRead(selectedConversationId);
        await refreshState({ conversationId: selectedConversationId });
    });
};

onReady(() => {
    subscribeInboxChannel();
    initInlineListingChat();
    initInboxRealtime();
});
