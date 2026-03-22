const onReady = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });

        return;
    }

    callback();
};

onReady(() => {
    const countrySelect = document.querySelector('[data-listing-country]');
    const citySelect = document.querySelector('[data-listing-city]');
    const currentLocationButton = document.querySelector('[data-use-current-location]');
    const filterDrawer = document.querySelector('[data-listing-filter-drawer]');
    const filterOpenButtons = Array.from(document.querySelectorAll('[data-listing-filter-open]'));
    const filterCloseButtons = Array.from(document.querySelectorAll('[data-listing-filter-close]'));
    const citiesTemplate = countrySelect?.dataset.citiesUrlTemplate ?? '';
    const locationStorageKey = 'oc2.header.location';
    const drawerMediaQuery = window.matchMedia('(max-width: 1023px)');

    const setDrawerExpanded = (expanded) => {
        filterOpenButtons.forEach((button) => button.setAttribute('aria-expanded', expanded ? 'true' : 'false'));
    };

    const closeFilterDrawer = () => {
        if (!filterDrawer) {
            return;
        }

        filterDrawer.classList.remove('is-open');
        filterDrawer.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('listing-filters-open');
        setDrawerExpanded(false);
    };

    const openFilterDrawer = () => {
        if (!filterDrawer || !drawerMediaQuery.matches) {
            return;
        }

        filterDrawer.classList.add('is-open');
        filterDrawer.setAttribute('aria-hidden', 'false');
        document.body.classList.add('listing-filters-open');
        setDrawerExpanded(true);
    };

    filterOpenButtons.forEach((button) => button.addEventListener('click', openFilterDrawer));
    filterCloseButtons.forEach((button) => button.addEventListener('click', closeFilterDrawer));

    window.addEventListener('resize', () => {
        if (!drawerMediaQuery.matches) {
            closeFilterDrawer();
        }
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeFilterDrawer();
        }
    });

    if (drawerMediaQuery.matches) {
        closeFilterDrawer();
    } else if (filterDrawer) {
        filterDrawer.setAttribute('aria-hidden', 'false');
        setDrawerExpanded(false);
    }

    if (!countrySelect || !citySelect || citiesTemplate === '') {
        return;
    }

    const normalize = (value) => (value ?? '')
        .toString()
        .toLocaleLowerCase('tr-TR')
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .trim();

    const setCityOptions = (cities, selectedCityName = '') => {
        citySelect.innerHTML = '<option value="">Select city</option>';
        cities.forEach((city) => {
            const option = document.createElement('option');
            option.value = String(city.id ?? '');
            option.textContent = city.name ?? '';
            option.dataset.name = city.name ?? '';
            citySelect.appendChild(option);
        });
        citySelect.disabled = false;

        if (selectedCityName) {
            const matched = Array.from(citySelect.options).find((option) => normalize(option.dataset.name) === normalize(selectedCityName));

            if (matched) {
                citySelect.value = matched.value;
            }
        }
    };

    const fetchCityOptions = async (url) => {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                Accept: 'application/json',
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

    const loadCities = async (countryId, selectedCityName = '') => {
        if (!countryId) {
            citySelect.innerHTML = '<option value="">Select country first</option>';
            citySelect.disabled = true;

            return;
        }

        citySelect.disabled = true;
        citySelect.innerHTML = '<option value="">Loading cities...</option>';

        const primaryUrl = citiesTemplate.replace('__COUNTRY__', encodeURIComponent(String(countryId)));

        try {
            let cities = [];

            try {
                cities = await fetchCityOptions(primaryUrl);
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

                cities = await fetchCityOptions(fallbackUrl);
            }

            setCityOptions(cities, selectedCityName);
        } catch (error) {
            citySelect.innerHTML = '<option value="">Cities could not be loaded</option>';
            citySelect.disabled = true;
        }
    };

    countrySelect.addEventListener('change', () => {
        citySelect.value = '';
        void loadCities(countrySelect.value);
    });

    currentLocationButton?.addEventListener('click', async () => {
        try {
            const rawLocation = localStorage.getItem(locationStorageKey);

            if (!rawLocation) {
                return;
            }

            const parsedLocation = JSON.parse(rawLocation);
            const countryName = parsedLocation?.countryName ?? '';
            const cityName = parsedLocation?.cityName ?? '';
            const countryId = parsedLocation?.countryId ? String(parsedLocation.countryId) : null;

            const matchedCountryOption = Array.from(countrySelect.options).find((option) => {
                if (countryId && option.value === countryId) {
                    return true;
                }

                return normalize(option.textContent) === normalize(countryName);
            });

            if (!matchedCountryOption) {
                return;
            }

            countrySelect.value = matchedCountryOption.value;
            await loadCities(matchedCountryOption.value, cityName);
        } catch (error) {
        }
    });
});
