import { defineBehavior } from '../core/behavior';
import { attribute, query, setText } from '../core/dom';
import { get } from '../core/http';
import { isStoredLocation, readJson, writeJson, type StoredLocation } from '../core/storage';
import { isLocationOptionList, type LocationOption } from '../core/types';

const STORAGE_KEY = 'openclassify.location';

function normalize(value: string): string {
    return value
        .toLocaleLowerCase('en-US')
        .normalize('NFD')
        .replace(/[̀-ͯ]/g, '')
        .trim();
}

function label(location: StoredLocation | null, fallback: string): string {
    if (location === null) {
        return fallback;
    }

    if (location.cityName !== '' && location.countryName !== '') {
        return `${location.cityName}, ${location.countryName}`;
    }

    return location.countryName === '' ? fallback : location.countryName;
}

function buildCitiesUrl(template: string, countryId: string): string {
    if (template === '' || countryId === '') {
        return '';
    }

    return template.replace('__COUNTRY__', encodeURIComponent(countryId));
}

function replaceOptions(select: HTMLSelectElement, options: readonly LocationOption[], placeholder: string): void {
    select.replaceChildren();

    const empty = document.createElement('option');
    empty.value = '';
    empty.textContent = placeholder;
    select.append(empty);

    for (const option of options) {
        const node = document.createElement('option');
        node.value = String(option.id);
        node.textContent = option.name;
        node.dataset['name'] = option.name;
        select.append(node);
    }
}

function placeholderOnly(select: HTMLSelectElement, text: string): void {
    select.replaceChildren();
    const empty = document.createElement('option');
    empty.value = '';
    empty.textContent = text;
    select.append(empty);
    select.disabled = true;
}

export const locationPicker = defineBehavior<HTMLElement>({
    name: 'location-picker',
    selector: '[data-location-picker]',
    mount(root) {
        const countrySelect = query<HTMLSelectElement>('[data-location-country]', HTMLSelectElement, root);
        const citySelect = query<HTMLSelectElement>('[data-location-city]', HTMLSelectElement, root);
        const applyButton = query<HTMLButtonElement>('[data-location-apply]', HTMLButtonElement, root);
        const status = query<HTMLElement>('[data-location-status]', HTMLElement, root);
        const disclosure = root.closest('details');
        const template = attribute(root, 'data-cities-url') ?? '';
        const fallbackLabel = attribute(root, 'data-location-fallback') ?? 'All locations';
        const labels = Array.from(document.querySelectorAll('[data-location-label]'));

        if (countrySelect === null || citySelect === null || applyButton === null) {
            return;
        }

        const paint = (location: StoredLocation | null): void => {
            const text = label(location, fallbackLabel);

            for (const node of labels) {
                setText(node, text);
            }
        };

        const announce = (message: string): void => {
            if (status !== null) {
                setText(status, message);
            }
        };

        const loadCities = async (countryId: string, preselect: StoredLocation | null): Promise<void> => {
            const url = buildCitiesUrl(template, countryId);

            if (url === '') {
                placeholderOnly(citySelect, fallbackLabel);

                return;
            }

            citySelect.disabled = true;
            placeholderOnly(citySelect, 'Loading');

            const result = await get<unknown>(url);

            if (!result.ok || !isLocationOptionList(result.value)) {
                placeholderOnly(citySelect, 'Unavailable');
                announce('City list could not be loaded.');

                return;
            }

            if (result.value.length === 0) {
                placeholderOnly(citySelect, 'No cities');

                return;
            }

            replaceOptions(citySelect, result.value, 'All cities');
            citySelect.disabled = false;

            if (preselect === null) {
                return;
            }

            if (preselect.cityId !== null) {
                citySelect.value = String(preselect.cityId);

                return;
            }

            const match = Array.from(citySelect.options).find(
                (option) => normalize(option.dataset['name'] ?? '') === normalize(preselect.cityName),
            );

            if (match !== undefined) {
                citySelect.value = match.value;
            }
        };

        const persist = (): void => {
            const countryOption = countrySelect.selectedOptions[0];
            const cityOption = citySelect.selectedOptions[0];

            const location: StoredLocation = {
                countryId: countrySelect.value === '' ? null : Number(countrySelect.value),
                countryCode: (countryOption?.dataset['code'] ?? '').toUpperCase(),
                countryName: countrySelect.value === '' ? '' : (countryOption?.dataset['name'] ?? ''),
                cityId: citySelect.value === '' ? null : Number(citySelect.value),
                cityName: citySelect.value === '' ? '' : (cityOption?.dataset['name'] ?? ''),
            };

            writeJson(STORAGE_KEY, location);
            paint(location);
            announce('Saved.');

            if (disclosure !== null) {
                disclosure.open = false;
            }
        };

        const stored = readJson(STORAGE_KEY, isStoredLocation);
        paint(stored);

        const restore = async (): Promise<void> => {
            if (stored === null) {
                return;
            }

            const match = Array.from(countrySelect.options).find((option) => {
                if (stored.countryId !== null && option.value === String(stored.countryId)) {
                    return true;
                }

                return stored.countryCode !== '' && (option.dataset['code'] ?? '') === stored.countryCode;
            });

            if (match === undefined) {
                return;
            }

            countrySelect.value = match.value;
            await loadCities(match.value, stored);
        };

        void restore();

        countrySelect.addEventListener('change', () => {
            void loadCities(countrySelect.value, null);
        });

        applyButton.addEventListener('click', () => {
            persist();
        });
    },
});
