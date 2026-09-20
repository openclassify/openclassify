export type Result<T, E = Error> = { readonly ok: true; readonly value: T } | { readonly ok: false; readonly error: E };

export function success<T>(value: T): Result<T, never> {
    return { ok: true, value };
}

export function failure<E>(error: E): Result<never, E> {
    return { ok: false, error };
}

export function toError(cause: unknown): Error {
    if (cause instanceof Error) {
        return cause;
    }

    return new Error(typeof cause === 'string' ? cause : 'Unexpected error');
}
