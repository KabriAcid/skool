// Type definitions
interface LGAData {
    [state: string]: string[];
}

interface StateSelectElement extends HTMLSelectElement {
    dataset: DOMStringMap & { state?: string };
}

interface LGASelectElement extends HTMLSelectElement {
    dataset: DOMStringMap & { state?: string };
}

document.addEventListener('DOMContentLoaded', (): void => {
    // Function to toggle visibility of elements with class 'input-location-dependant'
    const hideLoadingAnimation = (): void => {
        document
            .querySelectorAll<HTMLElement>('.input-location-dependant')
            .forEach((element) => {
                element.classList.remove('d-none');
            });
    };

    // Call the function to hide the loading animation
    hideLoadingAnimation();

    // Function to set multiple attributes at once
    const setAttributes = (
        el: HTMLElement,
        attrs: Record<string, string>,
    ): void => {
        for (const key in attrs) {
            el.setAttribute(key, attrs[key]);
        }
    };

    // LGA data structure
    const lgaList: LGAData = {
        Abia: [
            'Aba North',
            'Aba South',
            'Arochukwu',
            'Bende',
            'Ikwuano',
            'Isiala Ngwa North',
            'Isiala Ngwa South',
            'Isuikwuato',
            'Obi Ngwa',
            'Ohafia',
            'Osisioma',
            'Ugwunagbo',
            'Ukwa East',
            'Ukwa West',
            'Umuahia North',
            'muahia South',
            'Umu Nneochi',
        ],
        Adamawa: [
            'Demsa',
            'Fufure',
            'Ganye',
            'Gayuk',
            'Gombi',
            'Grie',
            'Hong',
            'Jada',
            'Larmurde',
            'Madagali',
            'Maiha',
            'Mayo Belwa',
            'Michika',
            'Mubi North',
            'Mubi South',
            'Numan',
            'Shelleng',
            'Song',
            'Toungo',
            'Yola North',
            'Yola South',
        ],
        AkwaIbom: [
            'Abak',
            'Eastern Obolo',
            'Eket',
            'Esit Eket',
            'Essien Udim',
            // ... (remaining LGAs)
        ],
        Anambra: [
            'Aguata',
            'Anambra East',
            'Anambra West',
            'Anaocha',
            'Awka North',
            'Awka South',
            // ... (remaining LGAs)
        ],
        Lagos: [
            'Agege',
            'Ajeromi-Ifelodun',
            'Alimosho',
            'Amuwo-Odofin',
            'Apapa',
            'Badagry',
            'Epe',
            'Eti Osa',
            'Ibeju-Lekki',
            'Ifako-Ijaiye',
            'Ikeja',
            'Ikorodu',
            'Kosofe',
            'Lagos Island',
            'Lagos Mainland',
            'Mushin',
            'Ojo',
            'Oshodi-Isolo',
            'Shomolu',
            'Surulere',
        ],
        Rivers: [
            'Port Harcourt',
            'Obio-Akpor',
            'Okrika',
            'Ogu–Bolo',
            'Eleme',
            'Tai',
            'Gokana',
            'Khana',
            'Oyigbo',
            'Opobo–Nkoro',
            'Andoni',
            'Bonny',
            'Degema',
            'Asari-Toru',
            'Akuku-Toru',
            'Abua–Odual',
            'Ahoada West',
            'Ahoada East',
            'Ogba–Egbema–Ndoni',
            'Emohua',
            'Ikwerre',
            'Etche',
            'Omuma',
        ],
        // ... (add other states as needed or use ellipsis for brevity)
    };

    // Function to toggle LGA options based on selected state
    const selectState = (event: Event): void => {
        const target = event.target as StateSelectElement;
        const state = target.value;
        const lgas = lgaList[state] || []; // Default to an empty array if state is not found

        const form = target.closest('form'); // Get the closest form element
        if (!form) return;

        const lgaSelect = form.querySelector<LGASelectElement>(
            `.select-lga[data-state="${target.dataset.state}"]`,
        ); // Find corresponding LGA select element

        if (!lgaSelect) return;

        // Clear the existing options
        lgaSelect.innerHTML = '';

        // Create and add "Select LGA..." option
        const defaultOption = document.createElement('option');
        defaultOption.textContent = '...Select LGA...';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        lgaSelect.appendChild(defaultOption);

        // Populate LGA select element with new options
        lgas.forEach((lga) => {
            const opt = document.createElement('option');
            opt.textContent = lga;
            opt.value = lga;
            lgaSelect.appendChild(opt);
        });
    };

    // Attach the selectState function to all state select elements
    const stateSelects =
        document.querySelectorAll<StateSelectElement>('.select-state');
    const lgaSelects =
        document.querySelectorAll<LGASelectElement>('.select-lga');

    stateSelects.forEach((selectElement, index) => {
        selectElement.addEventListener('change', selectState);
        selectElement.dataset.state = index.toString(); // Add a unique identifier to match corresponding LGA select

        if (lgaSelects[index]) {
            lgaSelects[index].dataset.state = index.toString();
        }

        // On load, if a data-selected is present on state, ensure LGA list is populated and respects its own data-selected
        const preSelectedState = selectElement.getAttribute('data-selected');
        const lgaSelect = lgaSelects[index];

        if (preSelectedState && lgaSelect) {
            // Trigger population
            selectElement.value = preSelectedState;
            const evt = new Event('change');
            selectElement.dispatchEvent(evt);

            const preSelectedLGA = lgaSelect.getAttribute('data-selected');
            if (preSelectedLGA) {
                // Try to select the matching option if present
                const opt = Array.from(lgaSelect.options).find(
                    (o) => o.value === preSelectedLGA,
                );
                if (opt) {
                    lgaSelect.value = preSelectedLGA;
                }
            }
        }
    });
});
