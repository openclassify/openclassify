import { failure, success, toError, type Result } from './result';

export type HttpMethod = 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE';

export interface HttpRequest {
    readonly url: string;
    readonly method?: HttpMethod;
    readonly body?: Readonly<Record<string, unknown>> | FormData;
    readonly signal?: AbortSignal;
}

export class HttpError extends Error {
    public constructor(
        message: string,
        public readonly status: number,
    ) {
        super(message);
        this.name = 'HttpError';
    }
}

function csrfToken(): string {
    const meta = document.querySelector('meta[name="csrf-token"]');

    return meta instanceof HTMLMetaElement ? meta.content : '';
}

function buildBody(body: HttpRequest['body']): { payload: BodyInit | null; contentType: string | null } {
    if (body === undefined) {
        return { payload: null, contentType: null };
    }

    if (body instanceof FormData) {
        return { payload: body, contentType: null };
    }

    return { payload: JSON.stringify(body), contentType: 'application/json' };
}

export async function request<T>(options: HttpRequest): Promise<Result<T, HttpError>> {
    const method = options.method ?? 'GET';
    const { payload, contentType } = buildBody(options.body);
    const headers = new Headers({
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfToken(),
    });

    if (contentType !== null) {
        headers.set('Content-Type', contentType);
    }

    const init: RequestInit = {
        method,
        headers,
        credentials: 'same-origin',
    };

    if (payload !== null) {
        init.body = payload;
    }

    if (options.signal !== undefined) {
        init.signal = options.signal;
    }

    try {
        const response = await fetch(options.url, init);

        if (!response.ok) {
            return failure(new HttpError(response.statusText, response.status));
        }

        if (response.status === 204) {
            return success(undefined as T);
        }

        const parsed = (await response.json()) as T;

        return success(parsed);
    } catch (cause: unknown) {
        return failure(new HttpError(toError(cause).message, 0));
    }
}

export function get<T>(url: string, signal?: AbortSignal): Promise<Result<T, HttpError>> {
    return signal === undefined ? request<T>({ url }) : request<T>({ url, signal });
}

export function post<T>(url: string, body?: Readonly<Record<string, unknown>> | FormData): Promise<Result<T, HttpError>> {
    return body === undefined ? request<T>({ url, method: 'POST' }) : request<T>({ url, method: 'POST', body });
}
