import { defineBehavior } from '../core/behavior';
import { lockScroll, onDocument, onWindow, query, queryAll, toggleClass } from '../core/dom';

const DESKTOP_BREAKPOINT = 1024;

export const navigationDrawer = defineBehavior<HTMLElement>({
    name: 'navigation-drawer',
    selector: '[data-nav-drawer]',
    mount(drawer) {
        const triggers = queryAll<HTMLButtonElement>('[data-nav-drawer-open]', HTMLButtonElement);
        const dismissers = queryAll<HTMLButtonElement>('[data-nav-drawer-close]', HTMLButtonElement, drawer);

        const setOpen = (open: boolean): void => {
            toggleClass(drawer, 'is-open', open);
            drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
            lockScroll(open);

            for (const trigger of triggers) {
                trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
            }
        };

        setOpen(false);

        for (const trigger of triggers) {
            trigger.addEventListener('click', () => {
                setOpen(true);
            });
        }

        for (const dismisser of dismissers) {
            dismisser.addEventListener('click', () => {
                setOpen(false);
            });
        }

        for (const link of queryAll<HTMLAnchorElement>('a[href]', HTMLAnchorElement, drawer)) {
            link.addEventListener('click', () => {
                setOpen(false);
            });
        }

        onDocument('keydown', (event) => {
            if (event.key === 'Escape') {
                setOpen(false);
            }
        });

        onWindow('resize', () => {
            if (window.innerWidth >= DESKTOP_BREAKPOINT) {
                setOpen(false);
            }
        });
    },
});

export const disclosureGroup = defineBehavior<HTMLElement>({
    name: 'disclosure-group',
    selector: '[data-disclosure-group]',
    mount(group) {
        const panels = queryAll<HTMLDetailsElement>('[data-disclosure]', HTMLDetailsElement, group);

        for (const panel of panels) {
            panel.addEventListener('toggle', () => {
                if (!panel.open) {
                    return;
                }

                for (const other of panels) {
                    if (other !== panel) {
                        other.open = false;
                    }
                }
            });
        }

        onDocument('click', (event) => {
            const target = event.target;

            if (target instanceof Node && group.contains(target)) {
                return;
            }

            for (const panel of panels) {
                panel.open = false;
            }
        });
    },
});

export const stickyHeader = defineBehavior<HTMLElement>({
    name: 'sticky-header',
    selector: '[data-sticky-header]',
    mount(header) {
        const sync = (): void => {
            toggleClass(header, 'is-scrolled', window.scrollY > 8);
        };

        sync();
        onWindow('scroll', sync, { passive: true });
    },
});

export const searchSuggest = defineBehavior<HTMLFormElement>({
    name: 'search-suggest',
    selector: '[data-search-form]',
    mount(form) {
        const input = query<HTMLInputElement>('[data-search-input]', HTMLInputElement, form);
        const clear = query<HTMLButtonElement>('[data-search-clear]', HTMLButtonElement, form);

        if (input === null || clear === null) {
            return;
        }

        const sync = (): void => {
            clear.hidden = input.value.trim() === '';
        };

        sync();
        input.addEventListener('input', sync);

        clear.addEventListener('click', () => {
            input.value = '';
            sync();
            input.focus();
        });
    },
});
