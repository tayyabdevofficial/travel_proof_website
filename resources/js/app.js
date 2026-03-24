import Chart from 'chart.js/auto';

window.Chart = Chart;

document.addEventListener('DOMContentLoaded', () => {
    const nav = document.getElementById('site-nav');
    const tabTriggers = Array.from(
        document.querySelectorAll('[data-tab-trigger]')
    );
    const tabInput = document.querySelector('[data-tab-input]');
    const tabPanels = Array.from(
        document.querySelectorAll('[data-tab-panel]')
    );
    const flightDetails = document.getElementById('flight-details');
    const hotelDetails = document.getElementById('hotel-details');
    const tripTriggers = Array.from(
        document.querySelectorAll('[data-trip-trigger]')
    );
    const returnDateGroup = document.getElementById('return-date-group');
    const returnDateInput = returnDateGroup
        ? returnDateGroup.querySelector('input')
        : null;
    const tripTypeInput = document.querySelector('[data-trip-input]');
    const airportInputs = Array.from(
        document.querySelectorAll('[data-airport-input]')
    );
    const airportErrors = {
        from: document.querySelector('[data-airport-error="from"]'),
        to: document.querySelector('[data-airport-error="to"]'),
    };
    const passengerCountSelect = document.getElementById('passengers-count');
    const passengerList = document.querySelector('[data-passenger-list]');
    const guestsSelect = document.querySelector('select[name="guests_count"]');
    const totalAmountEl = document.querySelector('[data-total-amount]');
    const totalFinalEl = totalAmountEl
        ? totalAmountEl.querySelector('[data-total-final]')
        : null;
    const totalBaseEl = totalAmountEl
        ? totalAmountEl.querySelector('[data-total-base]')
        : null;
    const totalButtonEl = document.querySelector('[data-total-button]');
    const guestList = document.querySelector('[data-guest-list]');
    const navToggle = document.querySelector('[data-nav-toggle]');
    const navMenu = document.querySelector('[data-nav-menu]');
    const navIcon = document.querySelector('[data-nav-icon]');
    const navIconOpen = navIcon?.getAttribute('data-icon-open');
    const navIconClosed = navIcon?.getAttribute('data-icon-closed');
    const receiveTiming = document.querySelector('[data-receive-timing]');
    const receiveDateWrap = document.querySelector('[data-receive-date]');
    const receiveDateInput = receiveDateWrap
        ? receiveDateWrap.querySelector('input[name=\"receive_date\"]')
        : null;

    const updateDynamicRequired = () => {
        const type = tabInput?.value || 'flight';
        const passengerRequired = type === 'flight' || type === 'combo';
        const guestRequired = type === 'hotel' || type === 'combo';

        if (passengerList) {
            passengerList.querySelectorAll('input, select').forEach((field) => {
                field.required = passengerRequired;
            });
        }

        if (guestList) {
            guestList.querySelectorAll('input, select').forEach((field) => {
                field.required = guestRequired;
            });
        }

        const contactFlight = document.querySelectorAll(
            '[data-contact-input=\"flight\"]'
        );
        const contactHotel = document.querySelectorAll(
            '[data-contact-input=\"hotel\"]'
        );
        const requireHotel = type === 'hotel';
        contactFlight.forEach((field) => {
            field.required = !requireHotel;
            field.disabled = requireHotel;
        });
        contactHotel.forEach((field) => {
            field.required = requireHotel;
            field.disabled = !requireHotel;
        });
    };

    const tabActiveClasses = [
        'text-blue-600',
        'border-b-2',
        'border-blue-600',
        'bg-blue-50',
    ];
    const tabInactiveClasses = [
        'text-gray-600',
        'hover:text-gray-900',
        'hover:bg-gray-50',
        'border-b',
        'border-gray-200',
    ];

    const setTab = (tabId) => {
        if (!tabId) return;

        tabTriggers.forEach((trigger) => {
            const isActive = trigger.dataset.tabTrigger === tabId;
            trigger.classList.remove(...tabActiveClasses, ...tabInactiveClasses);
            if (isActive) {
                trigger.classList.add(...tabActiveClasses);
            } else {
                trigger.classList.add(...tabInactiveClasses);
            }
        });

        if (tabInput) {
            tabInput.value = tabId;
        }

        updateTotalAmount();

        if (tabTriggers.length && tabPanels.length) {
            const hasPanel = tabPanels.some(
                (panel) => panel.dataset.tabPanel === tabId
            );
            if (hasPanel) {
                tabPanels.forEach((panel) => {
                    const isActive = panel.dataset.tabPanel === tabId;
                    panel.classList.toggle('hidden', !isActive);
                });
            }
        }

        if (flightDetails && hotelDetails) {
            if (tabId === 'flight') {
                flightDetails.classList.remove('hidden');
                hotelDetails.classList.add('hidden');
            } else if (tabId === 'hotel') {
                flightDetails.classList.add('hidden');
                hotelDetails.classList.remove('hidden');
            } else if (tabId === 'combo') {
                flightDetails.classList.remove('hidden');
                hotelDetails.classList.remove('hidden');
            }
        }

        const toggleRequired = (group, enabled) => {
            const section = document.querySelector(
                `[data-required-group="${group}"]`
            );
            if (!section) return;
            section
                .querySelectorAll('input, select, textarea')
                .forEach((field) => {
                    if (enabled) {
                        if (field.dataset.wasRequired === 'true') {
                            field.required = true;
                        }
                    } else {
                        if (field.required) {
                            field.dataset.wasRequired = 'true';
                        }
                        field.required = false;
                    }
                });
        };

        if (tabId === 'flight') {
            toggleRequired('flight', true);
            toggleRequired('hotel', false);
        } else if (tabId === 'hotel') {
            toggleRequired('flight', false);
            toggleRequired('hotel', true);
        } else {
            toggleRequired('flight', true);
            toggleRequired('hotel', true);
        }

        updateDynamicRequired();

        if (tabId === 'flight' || tabId === 'combo') {
            if (passengerList && passengerList.children.length === 0) {
                renderPassengerRows(passengerCountSelect?.value || '1');
            }
        }
        if (tabId === 'hotel' || tabId === 'combo') {
            if (guestList && guestList.children.length === 0) {
                renderGuestRows(guestsSelect?.value || '1');
            }
        }
    };

    const scrollToTarget = (targetId) => {
        const target = document.querySelector(targetId);
        if (!target) return;

        const navOffset = nav ? nav.offsetHeight + 8 : 0;
        const top = target.getBoundingClientRect().top + window.scrollY - navOffset;
        window.scrollTo({ top, behavior: 'smooth' });
    };

    tabTriggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            setTab(trigger.dataset.tabTrigger);
        });
    });

    const setTripType = (type) => {
        if (!type) return;
        tripTriggers.forEach((trigger) => {
            const isActive = trigger.dataset.tripTrigger === type;
            trigger.classList.toggle('bg-white', isActive);
            trigger.classList.toggle('text-blue-600', isActive);
            trigger.classList.toggle('shadow-sm', isActive);
            trigger.classList.toggle('text-gray-700', !isActive);
        });
        if (!returnDateGroup || !returnDateInput) return;
        const isRoundTrip = type === 'roundtrip';
        returnDateGroup.classList.toggle('hidden', !isRoundTrip);
        returnDateInput.required = isRoundTrip;
        if (tripTypeInput) tripTypeInput.value = type;
        updateTotalAmount();
    };

    tripTriggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            setTripType(trigger.dataset.tripTrigger);
        });
    });

    document.querySelectorAll('[data-scroll-target]').forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault();
            const tabId = btn.dataset.tabTarget;
            const targetId = btn.dataset.scrollTarget;
            if (tabId) setTab(tabId);
            if (targetId) scrollToTarget(targetId);
        });
    });

    document.querySelectorAll('[data-tab-target]').forEach((link) => {
        link.addEventListener('click', (event) => {
            const tabId = link.dataset.tabTarget;
            const href = link.getAttribute('href');
            if (tabId) setTab(tabId);
            if (href) {
                const url = new URL(href, window.location.href);
                if (url.origin === window.location.origin && url.pathname === window.location.pathname && url.hash) {
                    event.preventDefault();
                    scrollToTarget(url.hash);
                }
            }
            if (navMenu) {
                navMenu.classList.add('hidden');
            }
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    const initialTab = urlParams.get('tab');
    const defaultTab = document.body.dataset.defaultTab;
    if (initialTab) {
        setTab(initialTab);
    } else if (defaultTab) {
        setTab(defaultTab);
    }

    const onScroll = () => {
        if (!nav) return;
        const isScrolled = window.scrollY > 0;
        nav.classList.toggle('bg-white', isScrolled);
        nav.classList.toggle('shadow-md', isScrolled);
    };

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    const faqItems = Array.from(document.querySelectorAll('[data-faq-trigger]'));
    const faqCloseAll = () => {
        faqItems.forEach((btn) => {
            const container = btn.closest('.bg-white');
            if (!container) return;
            const content = container.querySelector('[data-faq-content]');
            const icon = container.querySelector('[data-faq-icon]');
            if (content) content.classList.add('hidden');
            if (icon) icon.classList.remove('rotate-180');
            if (content) {
                content.style.maxHeight = null;
                content.style.opacity = null;
            }
        });
    };

    faqItems.forEach((button, index) => {
        const container = button.closest('.bg-white');
        const content = container ? container.querySelector('[data-faq-content]') : null;
        const icon = container ? container.querySelector('[data-faq-icon]') : null;
        if (content) {
            content.style.overflow = 'hidden';
            content.style.transition = 'max-height 0.3s ease, opacity 0.3s ease';
            if (!content.classList.contains('hidden')) {
                content.style.maxHeight = `${content.scrollHeight}px`;
                content.style.opacity = '1';
                if (icon) icon.classList.add('rotate-180');
            } else {
                content.style.maxHeight = '0px';
                content.style.opacity = '0';
            }
        }

        button.addEventListener('click', () => {
            if (!content) return;
            const isOpen = !content.classList.contains('hidden');
            faqCloseAll();
            if (!isOpen) {
                content.classList.remove('hidden');
                content.style.maxHeight = `${content.scrollHeight}px`;
                content.style.opacity = '1';
                if (icon) icon.classList.add('rotate-180');
            }
        });

        if (index === 0 && content && content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            content.style.maxHeight = `${content.scrollHeight}px`;
            content.style.opacity = '1';
            if (icon) icon.classList.add('rotate-180');
        }
    });

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('opacity-0');
            navMenu.classList.toggle('-translate-y-4');
            navMenu.classList.toggle('pointer-events-none');
            if (navIcon && navIconOpen && navIconClosed) {
                const isOpen = !navMenu.classList.contains('opacity-0');
                navIcon.src = isOpen ? navIconOpen : navIconClosed;
            }
        });
    }

    const closeNavMenu = () => {
        if (!navMenu) return;
        navMenu.classList.add('opacity-0', '-translate-y-4', 'pointer-events-none');
        if (navIcon && navIconClosed) {
            navIcon.src = navIconClosed;
        }
    };

    if (navMenu) {
        window.addEventListener('scroll', closeNavMenu, { passive: true });
        document.addEventListener('click', (event) => {
            if (
                event.target.closest('[data-nav-toggle]') ||
                event.target.closest('[data-nav-menu]')
            ) {
                return;
            }
            closeNavMenu();
        });
    }

    function formatCurrency(value) {
        try {
            return new Intl.NumberFormat('en-NG', {
                style: 'currency',
                currency: 'NGN',
                maximumFractionDigits: 0,
            }).format(value);
        } catch (error) {
            return `NGN ${Math.round(value).toLocaleString()}`;
        }
    }

    function updateTotalAmount() {
        if (!totalAmountEl) return;
        const flightPrice = Number.parseFloat(
            totalAmountEl.dataset.priceFlight || '0'
        );
        const hotelPrice = Number.parseFloat(
            totalAmountEl.dataset.priceHotel || '0'
        );
        const discountPercent = Number.parseFloat(
            totalAmountEl.dataset.discount || '0'
        );
        const passengers = Number.parseInt(
            passengerCountSelect?.value || '1',
            10
        );
        const guests = Number.parseInt(guestsSelect?.value || '1', 10);
        const type = tabInput?.value || 'flight';
        const tripType = tripTypeInput?.value || 'oneway';
        const tripMultiplier = tripType === 'roundtrip' ? 1.5 : 1;

        let total = 0;
        if (type === 'flight') {
            total = flightPrice * passengers * tripMultiplier;
        } else if (type === 'hotel') {
            total = hotelPrice * guests;
        } else {
            const base =
                flightPrice * passengers * tripMultiplier +
                hotelPrice * guests;
            total = base * (1 - discountPercent / 100);
        }

        if (totalFinalEl) {
            totalFinalEl.textContent = formatCurrency(total);
        } else {
            totalAmountEl.textContent = formatCurrency(total);
        }
        if (totalButtonEl) {
            const label = totalButtonEl.querySelector('[data-total-label]');
            if (label) {
                label.textContent = `Continue to Payment - ${formatCurrency(total)}`;
            } else {
                totalButtonEl.textContent = `Continue to Payment - ${formatCurrency(total)}`;
            }
        }

        if (totalBaseEl) {
            if (type === 'combo') {
                const base =
                    flightPrice * passengers * tripMultiplier +
                    hotelPrice * guests;
                totalBaseEl.textContent = formatCurrency(base);
                totalBaseEl.classList.remove('hidden');
            } else {
                totalBaseEl.classList.add('hidden');
            }
        }
    }

    const setDateMins = () => {
        const departure = document.querySelector('input[name="departureDate"]');
        const returnDate = document.querySelector('input[name="returnDate"]');
        if (!departure || !returnDate) return;
        const today = new Date();
        today.setDate(today.getDate() + 1);
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const minDepart = `${yyyy}-${mm}-${dd}`;
        departure.min = minDepart;
        if (departure.value) {
            const departDate = new Date(departure.value);
            departDate.setDate(departDate.getDate() + 1);
            const ryyyy = departDate.getFullYear();
            const rmm = String(departDate.getMonth() + 1).padStart(2, '0');
            const rdd = String(departDate.getDate()).padStart(2, '0');
            returnDate.min = `${ryyyy}-${rmm}-${rdd}`;
        } else {
            returnDate.min = minDepart;
        }
        if (returnDate.value && returnDate.value < returnDate.min) {
            returnDate.value = '';
        }
    };

    const setHotelDateMins = () => {
        const checkIn = document.querySelector('input[name="hotelCheckIn"]');
        const checkOut = document.querySelector('input[name="hotelCheckOut"]');
        if (!checkIn || !checkOut) return;

        const today = new Date();
        today.setDate(today.getDate() + 1);
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const minDate = `${yyyy}-${mm}-${dd}`;

        checkIn.min = minDate;
        checkOut.min = minDate;

        if (checkIn.value) {
            const inDate = new Date(checkIn.value);
            inDate.setDate(inDate.getDate() + 1);
            const oyyyy = inDate.getFullYear();
            const omm = String(inDate.getMonth() + 1).padStart(2, '0');
            const odd = String(inDate.getDate()).padStart(2, '0');
            checkOut.min = `${oyyyy}-${omm}-${odd}`;
        }

        if (checkOut.value && checkOut.value < checkOut.min) {
            checkOut.value = '';
        }
    };

    const airportState = {
        list: [],
        ready: false,
    };

    const destinationState = {
        list: [],
        ready: false,
    };

    const loadAirports = async () => {
        try {
            const res = await fetch('/data/airports.json');
            if (!res.ok) return;
            airportState.list = await res.json();
            airportState.ready = true;
        } catch (error) {
            console.error('Failed to load airports.json', error);
        }
    };

    const loadDestinations = async () => {
        try {
            const res = await fetch('/data/countries.json');
            if (!res.ok) return;
            const data = await res.json();
            const list = [];
            Object.keys(data || {}).forEach((country) => {
                const cities = data[country] || [];
                cities.forEach((city) => {
                    list.push(`${city} - ${country}`);
                });
            });
            destinationState.list = list;
            destinationState.ready = true;
        } catch (error) {
            console.error('Failed to load countries.json', error);
        }
    };

    const getIataFromLabel = (label) => {
        const match = /\(([^()]+)\)\s*$/.exec(label || '');
        if (!match) return '';
        return match[1].replace(/[^A-Z]/gi, '').toUpperCase();
    };

    const filterAirports = (query, key) => {
        const otherKey = key === 'from' ? 'to' : 'from';
        const otherInput = document.querySelector(
            `[data-airport-input="${otherKey}"]`
        );
        const otherHidden = document.querySelector(
            `[data-airport-code="${otherKey}"]`
        );
        const otherLabel = (otherInput?.value || '').trim().toLowerCase();
        const otherIata = (otherHidden?.value || '').trim().toUpperCase();

        const base = query
            ? airportState.list.filter((item) =>
                  item.toLowerCase().includes(query.toLowerCase())
              )
            : airportState.list;

        if (!otherLabel && !otherIata) return base;

        return base.filter((item) => {
            const labelLower = item.toLowerCase();
            if (otherLabel && labelLower === otherLabel) return false;
            if (otherIata && getIataFromLabel(item) === otherIata) return false;
            return true;
        });
    };

    const closeAllAirportDropdowns = () => {
        document
            .querySelectorAll('[data-airport-dropdown]')
            .forEach((dropdown) => dropdown.classList.add('hidden'));
    };

    const closeDestinationDropdown = () => {
        const dropdown = document.querySelector('[data-destination-dropdown]');
        if (dropdown) dropdown.classList.add('hidden');
    };

    const escapeHtml = (value) =>
        value
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    const highlightMatch = (label, query) => {
        if (!query) return escapeHtml(label);
        const escaped = escapeHtml(label);
        const safeQuery = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const regex = new RegExp(safeQuery, 'ig');
        return escaped.replace(
            regex,
            (match) =>
                `<mark class="bg-blue-100 text-blue-700 rounded px-0.5">${match}</mark>`
        );
    };

    const renderAirportDropdown = (
        key,
        items,
        isLoading = false,
        query = ''
    ) => {
        const dropdown = document.querySelector(
            `[data-airport-dropdown="${key}"]`
        );
        if (!dropdown) return;
        dropdown.innerHTML = '';
        if (isLoading) {
            const loading = document.createElement('div');
            loading.className = 'px-4 py-3 text-gray-500';
            loading.textContent = 'Loading airports...';
            dropdown.appendChild(loading);
            dropdown.classList.remove('hidden');
            dropdown.dataset.activeIndex = '-1';
            return;
        }
        if (!items.length) {
            dropdown.classList.add('hidden');
            dropdown.dataset.activeIndex = '-1';
            return;
        }

        dropdown.dataset.activeIndex = '0';

        const setAirportValue = (key, label) => {
            const input = document.querySelector(
                `[data-airport-input="${key}"]`
            );
            const hidden = document.querySelector(
                `[data-airport-code="${key}"]`
            );
            const otherKey = key === 'from' ? 'to' : 'from';
            const otherInput = document.querySelector(
                `[data-airport-input="${otherKey}"]`
            );
            const otherHidden = document.querySelector(
                `[data-airport-code="${otherKey}"]`
            );
            const iata = getIataFromLabel(label);
            const otherLabel = (otherInput?.value || '').trim();
            const otherIata = (otherHidden?.value || '').trim().toUpperCase();

            const isSameLabel =
                otherLabel && otherLabel.toLowerCase() === label.toLowerCase();
            const isSameIata = iata && otherIata && iata === otherIata;

            if (isSameLabel || isSameIata) {
                if (airportErrors.from) airportErrors.from.classList.remove('hidden');
                if (airportErrors.to) airportErrors.to.classList.remove('hidden');
                return false;
            }

            if (airportErrors.from) airportErrors.from.classList.add('hidden');
            if (airportErrors.to) airportErrors.to.classList.add('hidden');

            if (input) input.value = label;
            if (hidden) hidden.value = iata;

            const otherDropdown = document.querySelector(
                `[data-airport-dropdown="${otherKey}"]`
            );
            if (otherDropdown && !otherDropdown.classList.contains('hidden')) {
                const otherInputValue = otherInput?.value || '';
                const items = filterAirports(otherInputValue, otherKey);
                renderAirportDropdown(otherKey, items, false, otherInputValue);
            }
            return true;
        };

        items.forEach((item, index) => {
            const option = document.createElement('button');
            option.type = 'button';
            option.className =
                'w-full text-left px-4 py-2 hover:bg-blue-50 transition-colors';
            option.innerHTML = highlightMatch(item, query);
            option.addEventListener('click', () => {
                const ok = setAirportValue(key, item);
                if (ok) dropdown.classList.add('hidden');
            });
            option.dataset.airportOption = `${index}`;
            option.addEventListener('mouseenter', () => {
                dropdown.dataset.activeIndex = `${index}`;
                Array.from(
                    dropdown.querySelectorAll('[data-airport-option]')
                ).forEach((opt, idx) => {
                    opt.classList.toggle('bg-blue-50', idx === index);
                });
            });
            dropdown.appendChild(option);
        });

        const first = dropdown.querySelector('[data-airport-option="0"]');
        if (first) first.classList.add('bg-blue-50');
        dropdown.classList.remove('hidden');
    };

    if (airportInputs.length) {

        const moveActive = (dropdown, direction) => {
            const options = Array.from(
                dropdown.querySelectorAll('[data-airport-option]')
            );
            if (!options.length) return;
            const current = parseInt(dropdown.dataset.activeIndex || '0', 10);
            const next =
                (current + direction + options.length) % options.length;
            dropdown.dataset.activeIndex = `${next}`;
            options.forEach((opt, index) => {
                opt.classList.toggle('bg-blue-50', index === next);
            });
            options[next].scrollIntoView({ block: 'nearest' });
        };

        const selectActive = (key) => {
            const dropdown = document.querySelector(
                `[data-airport-dropdown="${key}"]`
            );
            if (!dropdown) return;
            const index = parseInt(dropdown.dataset.activeIndex || '0', 10);
            const option = dropdown.querySelector(
                `[data-airport-option="${index}"]`
            );
            if (option) option.click();
        };

        airportInputs.forEach((input) => {
            const key = input.dataset.airportInput;
            const dropdown = document.querySelector(
                `[data-airport-dropdown="${key}"]`
            );
            input.addEventListener('input', () => {
                if (airportErrors[key]) airportErrors[key].classList.add('hidden');
                const hidden = document.querySelector(
                    `[data-airport-code="${key}"]`
                );
                if (hidden) hidden.value = '';
                closeAllAirportDropdowns();
                if (!airportState.ready) {
                    renderAirportDropdown(key, [], true);
                    return;
                }
                const items = filterAirports(input.value, key);
                renderAirportDropdown(key, items, false, input.value);

                const otherKey = key === 'from' ? 'to' : 'from';
                const otherDropdown = document.querySelector(
                    `[data-airport-dropdown="${otherKey}"]`
                );
                if (otherDropdown && !otherDropdown.classList.contains('hidden')) {
                    const otherInput = document.querySelector(
                        `[data-airport-input="${otherKey}"]`
                    );
                    const otherValue = otherInput?.value || '';
                    const otherItems = filterAirports(otherValue, otherKey);
                    renderAirportDropdown(otherKey, otherItems, false, otherValue);
                }
            });
            input.addEventListener('focus', () => {
                if (airportErrors[key]) airportErrors[key].classList.add('hidden');
                closeAllAirportDropdowns();
                if (!airportState.ready) {
                    renderAirportDropdown(key, [], true);
                    return;
                }
                const items = filterAirports(input.value, key);
                renderAirportDropdown(key, items, false, input.value);
            });
            input.addEventListener('keydown', (event) => {
                if (!dropdown) return;
                if (!airportState.ready) return;
                if (dropdown.classList.contains('hidden')) {
                    const items = filterAirports(input.value, key);
                    renderAirportDropdown(key, items, false, input.value);
                }
                if (event.key === 'ArrowDown') {
                    event.preventDefault();
                    moveActive(dropdown, 1);
                } else if (event.key === 'ArrowUp') {
                    event.preventDefault();
                    moveActive(dropdown, -1);
                } else if (event.key === 'Enter') {
                    event.preventDefault();
                    selectActive(key);
                } else if (event.key === 'Escape') {
                    dropdown.classList.add('hidden');
                }
            });
        });

        document.addEventListener('click', (event) => {
            if (
                event.target.closest('[data-airport-input]') ||
                event.target.closest('[data-airport-dropdown]')
            ) {
                return;
            }
            closeAllAirportDropdowns();
        });
    }

    const destinationInput = document.querySelector('[data-destination-input]');
    const destinationDropdown = document.querySelector(
        '[data-destination-dropdown]'
    );

    const DESTINATION_INITIAL_LIMIT = 80;
    const DESTINATION_RESULTS_LIMIT = 150;

    const renderDestinationDropdown = (
        items,
        isLoading = false,
        query = '',
        totalCount = 0,
        limit = DESTINATION_RESULTS_LIMIT
    ) => {
        if (!destinationDropdown) return;
        destinationDropdown.innerHTML = '';
        if (isLoading) {
            const loading = document.createElement('div');
            loading.className = 'px-4 py-3 text-gray-500';
            loading.textContent = 'Loading destinations...';
            destinationDropdown.appendChild(loading);
            destinationDropdown.classList.remove('hidden');
            destinationDropdown.dataset.activeIndex = '-1';
            return;
        }
        if (!items.length) {
            destinationDropdown.classList.add('hidden');
            destinationDropdown.dataset.activeIndex = '-1';
            return;
        }
        destinationDropdown.dataset.activeIndex = '0';
        const fragment = document.createDocumentFragment();
        items.forEach((item, index) => {
            const option = document.createElement('button');
            option.type = 'button';
            option.className =
                'w-full text-left px-4 py-2 hover:bg-blue-50 transition-colors';
            option.innerHTML = highlightMatch(item, query);
            option.dataset.destinationOption = `${index}`;
            option.addEventListener('click', () => {
                if (destinationInput) destinationInput.value = item;
                destinationDropdown.classList.add('hidden');
            });
            option.addEventListener('mouseenter', () => {
                destinationDropdown.dataset.activeIndex = `${index}`;
                Array.from(
                    destinationDropdown.querySelectorAll(
                        '[data-destination-option]'
                    )
                ).forEach((opt, idx) => {
                    opt.classList.toggle('bg-blue-50', idx === index);
                });
            });
            fragment.appendChild(option);
        });
        if (totalCount > items.length) {
            const hint = document.createElement('div');
            hint.className = 'px-4 py-2 text-xs text-gray-500';
            hint.textContent = `Showing ${items.length} of ${totalCount}. Type to narrow results.`;
            fragment.appendChild(hint);
        }
        destinationDropdown.appendChild(fragment);
        const first = destinationDropdown.querySelector(
            '[data-destination-option="0"]'
        );
        if (first) first.classList.add('bg-blue-50');
        destinationDropdown.classList.remove('hidden');
    };

    const filterDestinations = (query) => {
        const list = destinationState.list;
        const trimmed = query.trim();
        let filtered = list;
        if (trimmed) {
            const needle = trimmed.toLowerCase();
            filtered = list.filter((item) =>
                item.toLowerCase().includes(needle)
            );
        }
        const limit = trimmed
            ? DESTINATION_RESULTS_LIMIT
            : DESTINATION_INITIAL_LIMIT;
        return {
            items: filtered.slice(0, limit),
            total: filtered.length,
            limit,
            query: trimmed,
        };
    };

    if (destinationInput && destinationDropdown) {
        destinationInput.addEventListener('focus', () => {
            closeAllAirportDropdowns();
            if (!destinationState.ready) {
                renderDestinationDropdown([], true);
                return;
            }
            const result = filterDestinations(destinationInput.value);
            renderDestinationDropdown(
                result.items,
                false,
                result.query,
                result.total,
                result.limit
            );
        });
        destinationInput.addEventListener('input', () => {
            if (!destinationState.ready) {
                renderDestinationDropdown([], true);
                return;
            }
            const result = filterDestinations(destinationInput.value);
            renderDestinationDropdown(
                result.items,
                false,
                result.query,
                result.total,
                result.limit
            );
        });
        destinationInput.addEventListener('keydown', (event) => {
            if (destinationDropdown.classList.contains('hidden')) {
                const result = filterDestinations(destinationInput.value);
                renderDestinationDropdown(
                    result.items,
                    false,
                    result.query,
                    result.total,
                    result.limit
                );
            }
            if (event.key === 'ArrowDown') {
                event.preventDefault();
                const options = Array.from(
                    destinationDropdown.querySelectorAll(
                        '[data-destination-option]'
                    )
                );
                if (!options.length) return;
                const current = parseInt(
                    destinationDropdown.dataset.activeIndex || '0',
                    10
                );
                const next = (current + 1) % options.length;
                destinationDropdown.dataset.activeIndex = `${next}`;
                options.forEach((opt, idx) => {
                    opt.classList.toggle('bg-blue-50', idx === next);
                });
                options[next].scrollIntoView({ block: 'nearest' });
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                const options = Array.from(
                    destinationDropdown.querySelectorAll(
                        '[data-destination-option]'
                    )
                );
                if (!options.length) return;
                const current = parseInt(
                    destinationDropdown.dataset.activeIndex || '0',
                    10
                );
                const next = (current - 1 + options.length) % options.length;
                destinationDropdown.dataset.activeIndex = `${next}`;
                options.forEach((opt, idx) => {
                    opt.classList.toggle('bg-blue-50', idx === next);
                });
                options[next].scrollIntoView({ block: 'nearest' });
            } else if (event.key === 'Enter') {
                event.preventDefault();
                const index = parseInt(
                    destinationDropdown.dataset.activeIndex || '0',
                    10
                );
                const option = destinationDropdown.querySelector(
                    `[data-destination-option="${index}"]`
                );
                if (option) option.click();
            } else if (event.key === 'Escape') {
                destinationDropdown.classList.add('hidden');
            }
        });

        document.addEventListener('click', (event) => {
            if (
                event.target.closest('[data-destination-input]') ||
                event.target.closest('[data-destination-dropdown]')
            ) {
                return;
            }
            closeDestinationDropdown();
        });
    }

    loadAirports();
    loadDestinations();

    if (!initialTab && !defaultTab) {
        setTab('flight');
    }
    setTripType('oneway');

    function renderPassengerRows(count) {
        if (!passengerList) return;
        const existingValues = new Map();
        passengerList.querySelectorAll('input, select').forEach((field) => {
            existingValues.set(field.name, field.value);
        });
        passengerList.innerHTML = '';
        const total = Number.parseInt(count, 10) || 1;
        for (let i = 1; i <= total; i += 1) {
            const row = document.createElement('div');
            row.className =
                'grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 rounded-lg p-4';
            row.innerHTML = `
                <div class="md:col-span-3 text-sm font-semibold text-gray-700">
                    Passenger ${i}
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                    <select
                        name="passengers[${i}][title]"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm cursor-pointer"
                    >
                        <option value="">Title</option>
                        <option value="Mr">Mr</option>
                        <option value="Ms">Ms</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Mstr (2-11 years)">Mstr (2-11 years)</option>
                        <option value="Miss (2-11 years)">Miss (2-11 years)</option>
                        <option value="Mstr (under 2 years)">Mstr (under 2 years)</option>
                        <option value="Miss (under 2 years)">Miss (under 2 years)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        name="passengers[${i}][first_name]"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        placeholder="First name"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        name="passengers[${i}][last_name]"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        placeholder="Last name"
                    />
                </div>
            `;
            passengerList.appendChild(row);
            row.querySelectorAll('input, select').forEach((field) => {
                if (existingValues.has(field.name)) {
                    field.value = existingValues.get(field.name);
                }
            });
        }
        updateDynamicRequired();
    }

    function renderGuestRows(count) {
        if (!guestList) return;
        const existingValues = new Map();
        guestList.querySelectorAll('input, select').forEach((field) => {
            existingValues.set(field.name, field.value);
        });
        guestList.innerHTML = '';
        const total = Number.parseInt(count, 10) || 1;
        for (let i = 1; i <= total; i += 1) {
            const row = document.createElement('div');
            row.className =
                'grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 rounded-lg p-4';
            row.innerHTML = `
                <div class="md:col-span-3 text-sm font-semibold text-gray-700">
                    Guest ${i}
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                    <select
                        name="guests[${i}][title]"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm cursor-pointer"
                    >
                        <option value="">Title</option>
                        <option value="Mr">Mr</option>
                        <option value="Ms">Ms</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Mstr (2-11 years)">Mstr (2-11 years)</option>
                        <option value="Miss (2-11 years)">Miss (2-11 years)</option>
                        <option value="Mstr (under 2 years)">Mstr (under 2 years)</option>
                        <option value="Miss (under 2 years)">Miss (under 2 years)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        name="guests[${i}][first_name]"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        placeholder="First name"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        name="guests[${i}][last_name]"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        placeholder="Last name"
                    />
                </div>
            `;
            guestList.appendChild(row);
            row.querySelectorAll('input, select').forEach((field) => {
                if (existingValues.has(field.name)) {
                    field.value = existingValues.get(field.name);
                }
            });
        }
        updateDynamicRequired();
    }


    if (passengerCountSelect && passengerList) {
        renderPassengerRows(passengerCountSelect.value || '1');
        passengerCountSelect.addEventListener('change', (event) => {
            renderPassengerRows(event.target.value);
            updateTotalAmount();
        });
    }

    if (guestsSelect) {
        if (guestList) {
            renderGuestRows(guestsSelect.value || '1');
        }
        guestsSelect.addEventListener('change', (event) => {
            if (guestList) renderGuestRows(event.target.value);
            updateTotalAmount();
        });
    }

    if (receiveTiming && receiveDateWrap && receiveDateInput) {
        const toggleReceiveDate = () => {
            const isLater = receiveTiming.value === 'later';
            receiveDateWrap.classList.toggle('hidden', !isLater);
            receiveDateInput.required = isLater;
        };
        receiveTiming.addEventListener('change', toggleReceiveDate);
        toggleReceiveDate();
    }

    const departureInput = document.querySelector('input[name="departureDate"]');
    if (departureInput) {
        departureInput.addEventListener('change', setDateMins);
        setDateMins();
    }

    const hotelCheckInInput = document.querySelector(
        'input[name="hotelCheckIn"]'
    );
    const hotelCheckOutInput = document.querySelector(
        'input[name="hotelCheckOut"]'
    );
    if (hotelCheckInInput) {
        hotelCheckInInput.addEventListener('change', setHotelDateMins);
    }
    if (hotelCheckOutInput) {
        hotelCheckOutInput.addEventListener('change', setHotelDateMins);
    }
    setHotelDateMins();

    updateTotalAmount();
});
