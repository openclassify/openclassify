const initLocationWidget = () => {
    const widgetRoots = Array.from(document.querySelectorAll('[data-location-widget]'));
    const storageKey = 'oc2.header.location';

    if (widgetRoots.length === 0) {
        return;
    }

    const normalize = (value) => (value ?? '')
        .toString()
        .toLocaleLowerCase('tr-TR')
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .trim();

    const readStored = () => {
        try {
            const raw = localStorage.getItem(storageKey);
            if (!raw) {
                return null;
            }

            return JSON.parse(raw);
        } catch (error) {
            return null;
        }
    };

    const writeStored = (value) => {
        localStorage.setItem(storageKey, JSON.stringify(value));
    };

    const formatLocationLabel = (location) => {
        if (!location || typeof location !== 'object') {
            return 'Choose location';
        }

        const cityName = (location.cityName ?? '').toString().trim();
        const countryName = (location.countryName ?? '').toString().trim();

        if (cityName && countryName) {
            return cityName + ', ' + countryName;
        }

        if (countryName) {
            return countryName;
        }

        return 'Choose location';
    };

    const updateLabels = (location) => {
        const label = formatLocationLabel(location);
        widgetRoots.forEach((root) => {
            const target = root.querySelector('[data-location-label]');
            if (target) {
                target.textContent = label;
            }
        });
    };

    const fetchCityOptions = async (url) => {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error('city_fetch_failed');
        }

        const payload = await response.json();

        if (Array.isArray(payload)) {
            return payload;
        }

        return Array.isArray(payload?.data) ? payload.data : [];
    };

    const buildCitiesUrl = (template, countryId) => {
        const normalizedTemplate = (template ?? '').toString().trim();
        const normalizedCountryId = (countryId ?? '').toString().trim();
        const encodedCountryId = encodeURIComponent(normalizedCountryId);

        if (normalizedTemplate === '' || normalizedCountryId === '') {
            return '';
        }

        if (normalizedTemplate.includes('__COUNTRY__')) {
            return normalizedTemplate.replace('__COUNTRY__', encodedCountryId);
        }

        return normalizedTemplate.endsWith('/')
            ? normalizedTemplate + encodedCountryId
            : `${normalizedTemplate}/${encodedCountryId}`;
    };

    const loadCities = async (root, countryId, selectedCityId = null, selectedCityName = null) => {
        const citySelect = root.querySelector('[data-location-city]');
        const countrySelect = root.querySelector('[data-location-country]');
        const statusText = root.querySelector('[data-location-status]');
        const template = root.dataset.citiesUrlTemplate ?? '';
        const normalizedCountryId = (countryId ?? '').toString().trim();

        if (!citySelect || !countrySelect) {
            return;
        }

        if (normalizedCountryId === '' || template === '') {
            citySelect.innerHTML = '<option value="">Select country first</option>';
            citySelect.disabled = true;
            return;
        }

        citySelect.disabled = true;
        citySelect.innerHTML = '<option value="">Loading cities...</option>';

        try {
            const primaryUrl = buildCitiesUrl(template, normalizedCountryId);

            if (primaryUrl === '') {
                throw new Error('city_url_invalid');
            }

            let cityOptions;

            try {
                cityOptions = await fetchCityOptions(primaryUrl);
            } catch (primaryError) {
                if (!/^https?:\/\//i.test(primaryUrl)) {
                    throw primaryError;
                }

                let fallbackUrl = null;

                try {
                    const parsed = new URL(primaryUrl);
                    fallbackUrl = `${parsed.pathname}${parsed.search}`;
                } catch (urlError) {
                    fallbackUrl = null;
                }

                if (!fallbackUrl) {
                    throw primaryError;
                }

                cityOptions = await fetchCityOptions(fallbackUrl);
            }

            citySelect.innerHTML = '<option value="">Select city</option>';

            if (cityOptions.length === 0) {
                citySelect.innerHTML = '<option value="">No cities found</option>';
                citySelect.disabled = true;
                return;
            }

            cityOptions.forEach((city) => {
                const option = document.createElement('option');
                option.value = String(city.id ?? '');
                option.textContent = city.name ?? '';
                option.dataset.name = city.name ?? '';
                citySelect.appendChild(option);
            });

            citySelect.disabled = false;

            if (selectedCityId) {
                citySelect.value = String(selectedCityId);
            } else if (selectedCityName) {
                const matched = Array.from(citySelect.options).find((option) => normalize(option.dataset.name) === normalize(selectedCityName));
                if (matched) {
                    citySelect.value = matched.value;
                }
            }
        } catch (error) {
            citySelect.innerHTML = '<option value="">Could not load cities</option>';
            citySelect.disabled = true;
            if (statusText) {
                statusText.textContent = 'Could not load the city list. Please try again.';
            }
        }
    };

    const findMatchingCityOption = (citySelect, candidates) => {
        const normalizedCandidates = candidates
            .map((candidate) => normalize(candidate))
            .filter((candidate) => candidate !== '');

        if (normalizedCandidates.length === 0) {
            return null;
        }

        const options = Array.from(citySelect.options).filter((option) => option.value !== '');

        for (const candidate of normalizedCandidates) {
            const exactMatch = options.find((option) => normalize(option.dataset.name || option.textContent) === candidate);

            if (exactMatch) {
                return exactMatch;
            }
        }

        for (const candidate of normalizedCandidates) {
            const containsMatch = options.find((option) => {
                const optionName = normalize(option.dataset.name || option.textContent);

                return optionName.includes(candidate) || candidate.includes(optionName);
            });

            if (containsMatch) {
                return containsMatch;
            }
        }

        return null;
    };

    const saveFromInputs = (root, extra = {}) => {
        const countrySelect = root.querySelector('[data-location-country]');
        const citySelect = root.querySelector('[data-location-city]');
        const details = root.closest('details');

        if (!countrySelect || !citySelect || !countrySelect.value) {
            return false;
        }

        const countryOption = countrySelect.options[countrySelect.selectedIndex];
        const cityOption = citySelect.options[citySelect.selectedIndex];
        const hasCitySelection = citySelect.value !== '';

        const location = {
            countryId: Number(countrySelect.value),
            countryName: countryOption?.dataset.name ?? countryOption?.textContent ?? '',
            countryCode: (countryOption?.dataset.code ?? '').toUpperCase(),
            cityId: hasCitySelection ? Number(citySelect.value) : null,
            cityName: hasCitySelection ? (cityOption?.dataset.name ?? cityOption?.textContent ?? '') : '',
            updatedAt: new Date().toISOString(),
            ...extra,
        };

        writeStored(location);
        updateLabels(location);

        if (details && details.hasAttribute('open')) {
            details.removeAttribute('open');
        }

        return true;
    };

    const reverseLookup = async (latitude, longitude) => {
        const language = (document.documentElement.lang || 'tr').split('-')[0];
        const url = new URL('https://nominatim.openstreetmap.org/reverse');
        url.searchParams.set('format', 'jsonv2');
        url.searchParams.set('lat', String(latitude));
        url.searchParams.set('lon', String(longitude));
        url.searchParams.set('accept-language', language);

        const response = await fetch(url.toString(), {
            headers: {
                'Accept': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error('reverse_lookup_failed');
        }

        const payload = await response.json();
        const address = payload.address ?? {};

        return {
            countryCode: (address.country_code ?? '').toUpperCase(),
            countryName: address.country ?? '',
            cityName: address.city ?? address.town ?? address.village ?? address.municipality ?? '',
            regionName: address.state ?? address.province ?? '',
            districtName: address.state_district ?? address.county ?? '',
        };
    };

    const geolocationPosition = () => new Promise((resolve, reject) => {
        if (!window.isSecureContext) {
            reject(new Error('secure_context_required'));
            return;
        }

        if (!('geolocation' in navigator)) {
            reject(new Error('geolocation_not_supported'));
            return;
        }

        navigator.geolocation.getCurrentPosition(resolve, reject, {
            enableHighAccuracy: true,
            timeout: 15000,
            maximumAge: 120000,
        });
    });

    updateLabels(readStored());

    widgetRoots.forEach((root) => {
        const countrySelect = root.querySelector('[data-location-country]');
        const citySelect = root.querySelector('[data-location-city]');
        const saveButton = root.querySelector('[data-location-save]');
        const detectButton = root.querySelector('[data-location-detect]');
        const statusText = root.querySelector('[data-location-status]');
        const stored = readStored();

        if (!countrySelect || !citySelect || !saveButton) {
            return;
        }

        const applyStored = async () => {
            if (stored && typeof stored === 'object') {
                const matchedStoredCountry = Array.from(countrySelect.options).find((option) => {
                    if (stored.countryId && option.value === String(stored.countryId)) {
                        return true;
                    }

                    if (stored.countryCode && option.dataset.code === String(stored.countryCode).toUpperCase()) {
                        return true;
                    }

                    if (stored.countryName) {
                        return normalize(option.dataset.name) === normalize(stored.countryName);
                    }

                    return false;
                });

                if (matchedStoredCountry) {
                    countrySelect.value = matchedStoredCountry.value;
                    await loadCities(root, matchedStoredCountry.value, stored.cityId, stored.cityName);
                    return;
                }
            }

            const defaultOption = Array.from(countrySelect.options).find((option) => option.dataset.default === '1');
            if (defaultOption) {
                countrySelect.value = defaultOption.value;
                await loadCities(root, defaultOption.value, null, null);
            }
        };

        void applyStored();

        countrySelect.addEventListener('change', async () => {
            if (statusText) {
                statusText.textContent = 'Updating cities for the selected country...';
            }
            await loadCities(root, countrySelect.value, null, null);
            if (statusText) {
                statusText.textContent = 'Select a city and apply.';
            }
        });

        saveButton.addEventListener('click', () => {
            const saved = saveFromInputs(root);

            if (saved && statusText) {
                statusText.textContent = 'Location saved.';
            }
        });

        if (detectButton) {
            detectButton.addEventListener('click', async () => {
                if (statusText) {
                    statusText.textContent = 'Getting your location...';
                }

                try {
                    const position = await geolocationPosition();
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    const guessed = await reverseLookup(latitude, longitude);

                    let matchedCountry = Array.from(countrySelect.options).find((option) => option.dataset.code === guessed.countryCode);

                    if (!matchedCountry && guessed.countryName) {
                        matchedCountry = Array.from(countrySelect.options).find((option) => normalize(option.dataset.name) === normalize(guessed.countryName));
                    }

                    if (!matchedCountry) {
                        if (statusText) {
                            statusText.textContent = 'No matching country found. Please choose it manually.';
                        }
                        return;
                    }

                    countrySelect.value = matchedCountry.value;
                    await loadCities(root, matchedCountry.value, null, null);

                    const matchedCity = findMatchingCityOption(citySelect, [
                        guessed.cityName,
                        guessed.regionName,
                        guessed.districtName,
                    ]);

                    if (matchedCity) {
                        citySelect.value = matchedCity.value;
                    }

                    if (!matchedCity && !citySelect.disabled && citySelect.options.length > 1) {
                        if (statusText) {
                            const returnedCity = guessed.cityName || guessed.regionName || guessed.districtName;
                            statusText.textContent = returnedCity
                                ? `Country was selected, but the returned city "${returnedCity}" could not be matched automatically. Please choose your city.`
                                : 'Country was selected, but the city could not be matched automatically. Please choose your city.';
                        }

                        const details = root.closest('details');
                        if (details) {
                            details.setAttribute('open', 'open');
                        }

                        return;
                    }

                    const saved = saveFromInputs(root, { latitude, longitude });

                    if (saved && statusText) {
                        statusText.textContent = 'Location selected automatically.';
                    }
                } catch (error) {
                    if (statusText) {
                        statusText.textContent = error?.message === 'secure_context_required'
                            ? 'HTTPS is required for browser location. Open the site over a secure connection.'
                            : 'Could not access location. Check your browser permissions.';
                    }
                }
            });
        }
    });
};

const initMobileMenu = () => {
    const menu = document.querySelector('[data-mobile-menu]');
    const openButtons = Array.from(document.querySelectorAll('[data-mobile-menu-open]'));
    const closeButtons = Array.from(document.querySelectorAll('[data-mobile-menu-close]'));

    if (!menu || openButtons.length === 0) {
        return;
    }

    const setOpen = (shouldOpen) => {
        menu.classList.toggle('is-open', shouldOpen);
        document.documentElement.classList.toggle('oc-menu-open', shouldOpen);
        document.body.style.overflow = shouldOpen ? 'hidden' : '';

        openButtons.forEach((button) => {
            button.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
        });

        if (shouldOpen) {
            document.querySelectorAll('[data-location-widget][open]').forEach((details) => {
                details.removeAttribute('open');
            });
        }
    };

    openButtons.forEach((button) => {
        button.addEventListener('click', () => setOpen(true));
    });

    closeButtons.forEach((button) => {
        button.addEventListener('click', () => setOpen(false));
    });

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setOpen(false));
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setOpen(false);
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            setOpen(false);
        }
    });
};

const initHeaderMenuSync = () => {
    const wrap = document.querySelector('.oc-nav-wrap');

    if (!wrap) {
        return;
    }

    const menus = Array.from(wrap.querySelectorAll('.oc-account-menu, [data-location-widget]'));

    const syncHeaderMenuState = () => {
        document.body.classList.toggle('oc-header-menu-open', menus.some((menu) => menu.open));
    };

    menus.forEach((menu) => {
        menu.addEventListener('toggle', () => {
            if (menu.open) {
                menus.forEach((other) => {
                    if (other !== menu && other.open) {
                        other.removeAttribute('open');
                    }
                });
            }

            syncHeaderMenuState();
        });
    });

    document.addEventListener('click', (event) => {
        const target = event.target;

        if (!(target instanceof Element) || wrap.contains(target)) {
            return;
        }

        menus.forEach((menu) => menu.removeAttribute('open'));
        syncHeaderMenuState();
    });
};

initLocationWidget();
initMobileMenu();
initHeaderMenuSync();
