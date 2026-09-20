export type ElementConstructor<T extends Element> = new () => T;

export function query<T extends Element>(
    selector: string,
    type: ElementConstructor<T>,
    scope: ParentNode = document,
): T | null {
    const found = scope.querySelector(selector);

    return found instanceof type ? found : null;
}

export function queryAll<T extends Element>(
    selector: string,
    type: ElementConstructor<T>,
    scope: ParentNode = document,
): T[] {
    return Array.from(scope.querySelectorAll(selector)).filter(
        (element): element is T => element instanceof type,
    );
}

export function closestOf<T extends Element>(
    origin: Element,
    selector: string,
    type: ElementConstructor<T>,
): T | null {
    const found = origin.closest(selector);

    return found instanceof type ? found : null;
}

export function attribute(element: Element, name: string): string | null {
    const value = element.getAttribute(name);

    return value === null || value.trim() === '' ? null : value;
}

export function numericAttribute(element: Element, name: string): number | null {
    const value = attribute(element, name);

    if (value === null) {
        return null;
    }

    const parsed = Number.parseInt(value, 10);

    return Number.isNaN(parsed) ? null : parsed;
}

export function booleanAttribute(element: Element, name: string): boolean {
    const value = attribute(element, name);

    return value !== null && value !== 'false' && value !== '0';
}

export function toggleClass(element: Element, className: string, active: boolean): void {
    element.classList.toggle(className, active);
}

export function setHidden(element: HTMLElement, hidden: boolean): void {
    element.hidden = hidden;
    element.classList.toggle('is-hidden', hidden);
}

export function setText(element: Element, value: string): void {
    element.textContent = value;
}

export function on<K extends keyof HTMLElementEventMap>(
    target: HTMLElement,
    event: K,
    handler: (event: HTMLElementEventMap[K]) => void,
): () => void {
    target.addEventListener(event, handler);

    return (): void => {
        target.removeEventListener(event, handler);
    };
}

export function onDocument<K extends keyof DocumentEventMap>(
    event: K,
    handler: (event: DocumentEventMap[K]) => void,
): () => void {
    document.addEventListener(event, handler);

    return (): void => {
        document.removeEventListener(event, handler);
    };
}

export function onWindow<K extends keyof WindowEventMap>(
    event: K,
    handler: (event: WindowEventMap[K]) => void,
    options?: AddEventListenerOptions,
): () => void {
    window.addEventListener(event, handler, options);

    return (): void => {
        window.removeEventListener(event, handler, options);
    };
}

export function focusFirst(scope: ParentNode): void {
    const focusable = queryAll<HTMLElement>(
        'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])',
        HTMLElement,
        scope,
    );

    focusable[0]?.focus();
}

export function lockScroll(locked: boolean): void {
    document.documentElement.classList.toggle('is-scroll-locked', locked);
}
