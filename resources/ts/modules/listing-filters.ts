import { defineBehavior } from '../core/behavior';
import { lockScroll, query, queryAll, toggleClass } from '../core/dom';

export const listingFilters = defineBehavior<HTMLFormElement>({
    name: 'listing-filters',
    selector: '[data-filter-form]',
    mount(form) {
        const autoInputs = queryAll<HTMLSelectElement>('[data-filter-auto]', HTMLSelectElement, form);
        const resetButton = query<HTMLButtonElement>('[data-filter-reset]', HTMLButtonElement, form);

        for (const input of autoInputs) {
            input.addEventListener('change', () => {
                form.requestSubmit();
            });
        }

        if (resetButton !== null) {
            resetButton.addEventListener('click', () => {
                for (const field of queryAll<HTMLInputElement>('input[type="text"], input[type="number"]', HTMLInputElement, form)) {
                    field.value = '';
                }

                for (const checkbox of queryAll<HTMLInputElement>('input[type="checkbox"]', HTMLInputElement, form)) {
                    checkbox.checked = false;
                }

                for (const select of queryAll<HTMLSelectElement>('select', HTMLSelectElement, form)) {
                    select.selectedIndex = 0;
                }

                form.requestSubmit();
            });
        }
    },
});

export const filterDrawer = defineBehavior<HTMLElement>({
    name: 'filter-drawer',
    selector: '[data-filter-drawer]',
    mount(drawer) {
        const openers = queryAll<HTMLButtonElement>('[data-filter-drawer-open]', HTMLButtonElement);
        const closers = queryAll<HTMLButtonElement>('[data-filter-drawer-close]', HTMLButtonElement, drawer);

        const setOpen = (open: boolean): void => {
            toggleClass(drawer, 'is-open', open);
            drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
            lockScroll(open);
        };

        setOpen(false);

        for (const opener of openers) {
            opener.addEventListener('click', () => {
                setOpen(true);
            });
        }

        for (const closer of closers) {
            closer.addEventListener('click', () => {
                setOpen(false);
            });
        }
    },
});

export const viewModeToggle = defineBehavior<HTMLElement>({
    name: 'view-mode-toggle',
    selector: '[data-view-toggle]',
    mount(toggle) {
        const target = query<HTMLElement>('[data-listing-collection]', HTMLElement);

        if (target === null) {
            return;
        }

        const buttons = queryAll<HTMLButtonElement>('[data-view-mode]', HTMLButtonElement, toggle);

        const apply = (mode: string): void => {
            target.dataset['viewMode'] = mode;

            for (const button of buttons) {
                const active = button.dataset['viewMode'] === mode;
                button.setAttribute('aria-pressed', active ? 'true' : 'false');
            }

            try {
                localStorage.setItem('openclassify.viewMode', mode);
            } catch {
                return;
            }
        };

        let initial = 'grid';

        try {
            initial = localStorage.getItem('openclassify.viewMode') ?? 'grid';
        } catch {
            initial = 'grid';
        }

        apply(initial === 'list' ? 'list' : 'grid');

        for (const button of buttons) {
            button.addEventListener('click', () => {
                apply(button.dataset['viewMode'] ?? 'grid');
            });
        }
    },
});
