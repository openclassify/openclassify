export interface Behavior<T extends HTMLElement = HTMLElement> {
    readonly name: string;
    readonly selector: string;
    readonly mount: (element: T) => void;
}

const mounted = new WeakMap<HTMLElement, Set<string>>();

function isMounted(element: HTMLElement, name: string): boolean {
    return mounted.get(element)?.has(name) ?? false;
}

function markMounted(element: HTMLElement, name: string): void {
    const names = mounted.get(element) ?? new Set<string>();
    names.add(name);
    mounted.set(element, names);
}

export function defineBehavior<T extends HTMLElement>(behavior: Behavior<T>): Behavior<T> {
    return behavior;
}

export function startBehaviors(behaviors: readonly Behavior<never>[], scope: ParentNode = document): void {
    for (const behavior of behaviors) {
        const elements = Array.from(scope.querySelectorAll(behavior.selector)).filter(
            (element): element is HTMLElement => element instanceof HTMLElement,
        );

        for (const element of elements) {
            if (isMounted(element, behavior.name)) {
                continue;
            }

            markMounted(element, behavior.name);
            (behavior as Behavior).mount(element);
        }
    }
}
