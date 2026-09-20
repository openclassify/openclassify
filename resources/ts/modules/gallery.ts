import { defineBehavior } from '../core/behavior';
import { onDocument, query, queryAll, toggleClass } from '../core/dom';

export const listingGallery = defineBehavior<HTMLElement>({
    name: 'listing-gallery',
    selector: '[data-gallery]',
    mount(gallery) {
        const stage = query<HTMLImageElement>('[data-gallery-stage]', HTMLImageElement, gallery);
        const thumbs = queryAll<HTMLButtonElement>('[data-gallery-thumb]', HTMLButtonElement, gallery);
        const counter = query<HTMLElement>('[data-gallery-counter]', HTMLElement, gallery);
        const previous = query<HTMLButtonElement>('[data-gallery-previous]', HTMLButtonElement, gallery);
        const next = query<HTMLButtonElement>('[data-gallery-next]', HTMLButtonElement, gallery);

        if (stage === null || thumbs.length === 0) {
            return;
        }

        let index = 0;

        const show = (target: number): void => {
            const total = thumbs.length;
            index = ((target % total) + total) % total;

            const thumb = thumbs[index];

            if (thumb === undefined) {
                return;
            }

            const source = thumb.dataset['gallerySource'];

            if (source !== undefined) {
                stage.src = source;
                stage.alt = thumb.dataset['galleryAlt'] ?? '';
            }

            for (const [position, node] of thumbs.entries()) {
                const active = position === index;
                toggleClass(node, 'is-active', active);
                node.setAttribute('aria-current', active ? 'true' : 'false');
            }

            if (counter !== null) {
                counter.textContent = `${String(index + 1)} / ${String(total)}`;
            }
        };

        show(0);

        for (const [position, thumb] of thumbs.entries()) {
            thumb.addEventListener('click', () => {
                show(position);
            });
        }

        previous?.addEventListener('click', () => {
            show(index - 1);
        });

        next?.addEventListener('click', () => {
            show(index + 1);
        });

        onDocument('keydown', (event) => {
            if (event.key === 'ArrowLeft') {
                show(index - 1);
            }

            if (event.key === 'ArrowRight') {
                show(index + 1);
            }
        });
    },
});
