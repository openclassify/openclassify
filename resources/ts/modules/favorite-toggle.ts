import { defineBehavior } from '../core/behavior';
import { attribute, query, toggleClass } from '../core/dom';
import { post } from '../core/http';
import type { FavoriteToggleResponse } from '../core/types';

function isFavoriteResponse(value: unknown): value is FavoriteToggleResponse {
    if (typeof value !== 'object' || value === null) {
        return false;
    }

    const candidate = value as Record<string, unknown>;

    return typeof candidate['favorited'] === 'boolean' && typeof candidate['count'] === 'number';
}

export const favoriteToggle = defineBehavior<HTMLButtonElement>({
    name: 'favorite-toggle',
    selector: '[data-favorite-toggle]',
    mount(button) {
        const endpoint = attribute(button, 'data-favorite-toggle');
        const redirect = attribute(button, 'data-favorite-redirect');
        const counter = query<HTMLElement>('[data-favorite-count]', HTMLElement, button);

        if (endpoint === null) {
            return;
        }

        button.addEventListener('click', () => {
            if (redirect !== null) {
                window.location.assign(redirect);

                return;
            }

            button.disabled = true;

            void post<unknown>(endpoint).then((result) => {
                button.disabled = false;

                if (!result.ok || !isFavoriteResponse(result.value)) {
                    return;
                }

                toggleClass(button, 'is-active', result.value.favorited);
                button.setAttribute('aria-pressed', result.value.favorited ? 'true' : 'false');

                if (counter !== null) {
                    counter.textContent = String(result.value.count);
                }
            });
        });
    },
});
