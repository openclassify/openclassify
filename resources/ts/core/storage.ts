export interface StoredLocation {
    readonly countryId: number | null;
    readonly countryCode: string;
    readonly countryName: string;
    readonly cityId: number | null;
    readonly cityName: string;
}

export function readJson<T>(key: string, guard: (value: unknown) => value is T): T | null {
    try {
        const raw = localStorage.getItem(key);

        if (raw === null) {
            return null;
        }

        const parsed: unknown = JSON.parse(raw);

        return guard(parsed) ? parsed : null;
    } catch {
        return null;
    }
}

export function writeJson(key: string, value: unknown): void {
    try {
        localStorage.setItem(key, JSON.stringify(value));
    } catch {
        return;
    }
}

export function isStoredLocation(value: unknown): value is StoredLocation {
    if (typeof value !== 'object' || value === null) {
        return false;
    }

    const candidate = value as Record<string, unknown>;

    return (
        (typeof candidate['countryId'] === 'number' || candidate['countryId'] === null) &&
        typeof candidate['countryCode'] === 'string' &&
        typeof candidate['countryName'] === 'string' &&
        (typeof candidate['cityId'] === 'number' || candidate['cityId'] === null) &&
        typeof candidate['cityName'] === 'string'
    );
}
