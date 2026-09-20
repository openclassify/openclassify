import { defineBehavior } from '../core/behavior';
import { attribute, query, queryAll, setHidden, setText, toggleClass } from '../core/dom';
import { get } from '../core/http';
import { isLocationOptionList } from '../core/types';

export const characterCounter = defineBehavior<HTMLElement>({
    name: 'character-counter',
    selector: '[data-counter-for]',
    mount(counter) {
        const id = attribute(counter, 'data-counter-for');

        if (id === null) {
            return;
        }

        const field = document.getElementById(id);

        if (!(field instanceof HTMLInputElement) && !(field instanceof HTMLTextAreaElement)) {
            return;
        }

        const limit = field.maxLength > 0 ? field.maxLength : null;

        const sync = (): void => {
            setText(counter, limit === null ? String(field.value.length) : `${String(field.value.length)} / ${String(limit)}`);
        };

        sync();
        field.addEventListener('input', sync);
    },
});

export const dependentSelect = defineBehavior<HTMLSelectElement>({
    name: 'dependent-select',
    selector: '[data-dependent-source]',
    mount(source) {
        const targetId = attribute(source, 'data-dependent-target');
        const template = attribute(source, 'data-dependent-url');

        if (targetId === null || template === null) {
            return;
        }

        const target = document.getElementById(targetId);

        if (!(target instanceof HTMLSelectElement)) {
            return;
        }

        const placeholder = attribute(target, 'data-placeholder') ?? 'Select';

        const load = async (value: string): Promise<void> => {
            target.replaceChildren();

            const empty = document.createElement('option');
            empty.value = '';
            empty.textContent = placeholder;
            target.append(empty);

            if (value === '') {
                target.disabled = true;

                return;
            }

            target.disabled = true;
            const result = await get<unknown>(template.replace('__VALUE__', encodeURIComponent(value)));

            if (!result.ok || !isLocationOptionList(result.value)) {
                return;
            }

            for (const option of result.value) {
                const node = document.createElement('option');
                node.value = String(option.id);
                node.textContent = option.name;
                target.append(node);
            }

            target.disabled = result.value.length === 0;
        };

        source.addEventListener('change', () => {
            void load(source.value);
        });
    },
});

export const imagePreview = defineBehavior<HTMLInputElement>({
    name: 'image-preview',
    selector: '[data-image-input]',
    mount(input) {
        const targetId = attribute(input, 'data-image-preview');

        if (targetId === null) {
            return;
        }

        const preview = document.getElementById(targetId);

        if (!(preview instanceof HTMLElement)) {
            return;
        }

        input.addEventListener('change', () => {
            preview.replaceChildren();

            const files = input.files;

            if (files === null) {
                return;
            }

            for (const file of Array.from(files)) {
                const figure = document.createElement('figure');
                figure.className = 'upload__preview';

                const image = document.createElement('img');
                image.src = URL.createObjectURL(file);
                image.alt = file.name;
                image.addEventListener('load', () => {
                    URL.revokeObjectURL(image.src);
                });

                figure.append(image);
                preview.append(figure);
            }
        });
    },
});

export const confirmAction = defineBehavior<HTMLFormElement>({
    name: 'confirm-action',
    selector: '[data-confirm]',
    mount(form) {
        const message = attribute(form, 'data-confirm');

        if (message === null) {
            return;
        }

        form.addEventListener('submit', (event) => {
            if (!window.confirm(message)) {
                event.preventDefault();
            }
        });
    },
});

export const ratingInput = defineBehavior<HTMLElement>({
    name: 'rating-input',
    selector: '[data-rating-input]',
    mount(root) {
        const field = query<HTMLInputElement>('[data-rating-value]', HTMLInputElement, root);
        const stars = queryAll<HTMLButtonElement>('[data-rating-star]', HTMLButtonElement, root);

        if (field === null || stars.length === 0) {
            return;
        }

        const apply = (score: number): void => {
            field.value = String(score);

            for (const [index, star] of stars.entries()) {
                toggleClass(star, 'is-active', index < score);
                star.setAttribute('aria-pressed', index < score ? 'true' : 'false');
            }
        };

        apply(Number.parseInt(field.value, 10) || 0);

        for (const [index, star] of stars.entries()) {
            star.addEventListener('click', () => {
                apply(index + 1);
            });
        }
    },
});

export const revealPanel = defineBehavior<HTMLButtonElement>({
    name: 'reveal-panel',
    selector: '[data-reveal-target]',
    mount(trigger) {
        const targetId = attribute(trigger, 'data-reveal-target');

        if (targetId === null) {
            return;
        }

        const panel = document.getElementById(targetId);

        if (!(panel instanceof HTMLElement)) {
            return;
        }

        setHidden(panel, true);
        trigger.setAttribute('aria-expanded', 'false');

        trigger.addEventListener('click', () => {
            const open = panel.hidden;
            setHidden(panel, !open);
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    },
});
