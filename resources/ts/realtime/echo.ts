import type { InboxMessagePayload } from '../core/types';

type InboxListener = (payload: InboxMessagePayload) => void;

interface EchoChannel {
    listen: (event: string, handler: (payload: unknown) => void) => EchoChannel;
}

interface EchoClient {
    private: (channel: string) => EchoChannel;
}

declare global {
    interface Window {
        Echo?: EchoClient;
    }
}

const listeners = new Set<InboxListener>();
let connected = false;

function isInboxPayload(value: unknown): value is InboxMessagePayload {
    if (typeof value !== 'object' || value === null) {
        return false;
    }

    const candidate = value as Record<string, unknown>;

    return (
        typeof candidate['conversationId'] === 'number' &&
        typeof candidate['body'] === 'string' &&
        typeof candidate['senderId'] === 'number' &&
        typeof candidate['createdAt'] === 'string'
    );
}

function channelName(): string | null {
    const value = document.body.dataset['inboxChannel'];

    return value === undefined || value === '' ? null : value;
}

function connect(): void {
    if (connected) {
        return;
    }

    const client = window.Echo;
    const channel = channelName();

    if (client === undefined || channel === null) {
        return;
    }

    connected = true;

    client.private(channel).listen('.inbox.message', (payload: unknown) => {
        if (!isInboxPayload(payload)) {
            return;
        }

        for (const listener of listeners) {
            listener(payload);
        }
    });
}

export function subscribeToInbox(listener: InboxListener): () => void {
    listeners.add(listener);
    connect();

    return (): void => {
        listeners.delete(listener);
    };
}
