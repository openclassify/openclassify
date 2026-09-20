import { defineBehavior } from '../core/behavior';
import { attribute, query, setHidden } from '../core/dom';
import { get } from '../core/http';

interface ContactResponse {
    readonly phone: string | null;
    readonly email: string | null;
}

function isContactResponse(value: unknown): value is ContactResponse {
    if (typeof value !== 'object' || value === null) {
        return false;
    }

    const candidate = value as Record<string, unknown>;

    return (
        (typeof candidate['phone'] === 'string' || candidate['phone'] === null) &&
        (typeof candidate['email'] === 'string' || candidate['email'] === null)
    );
}

export const contactReveal = defineBehavior<HTMLElement>({
    name: 'contact-reveal',
    selector: '[data-contact-reveal]',
    mount(root) {
        const trigger = query<HTMLButtonElement>('[data-contact-trigger]', HTMLButtonElement, root);
        const output = query<HTMLElement>('[data-contact-output]', HTMLElement, root);
        const phoneNode = query<HTMLAnchorElement>('[data-contact-phone]', HTMLAnchorElement, root);
        const emailNode = query<HTMLAnchorElement>('[data-contact-email]', HTMLAnchorElement, root);
        const endpoint = attribute(root, 'data-contact-reveal');

        if (trigger === null || output === null || endpoint === null) {
            return;
        }

        setHidden(output, true);

        trigger.addEventListener('click', () => {
            trigger.disabled = true;

            void get<unknown>(endpoint).then((result) => {
                trigger.disabled = false;

                if (!result.ok || !isContactResponse(result.value)) {
                    return;
                }

                const { phone, email } = result.value;

                if (phoneNode !== null) {
                    setHidden(phoneNode, phone === null);

                    if (phone !== null) {
                        phoneNode.href = `tel:${phone}`;
                        phoneNode.textContent = phone;
                    }
                }

                if (emailNode !== null) {
                    setHidden(emailNode, email === null);

                    if (email !== null) {
                        emailNode.href = `mailto:${email}`;
                        emailNode.textContent = email;
                    }
                }

                setHidden(output, false);
                setHidden(trigger, true);
            });
        });
    },
});

export const shareAction = defineBehavior<HTMLButtonElement>({
    name: 'share-action',
    selector: '[data-share]',
    mount(button) {
        const url = attribute(button, 'data-share') ?? window.location.href;
        const title = attribute(button, 'data-share-title') ?? document.title;
        const done = attribute(button, 'data-share-done') ?? 'Copied';
        const original = attribute(button, 'data-share-label') ?? 'Share';

        button.addEventListener('click', () => {
            if (typeof navigator.share === 'function') {
                void navigator.share({ title, url }).catch(() => undefined);

                return;
            }

            void navigator.clipboard.writeText(url).then(() => {
                button.textContent = done;
                window.setTimeout(() => {
                    button.textContent = original;
                }, 2000);
            });
        });
    },
});
