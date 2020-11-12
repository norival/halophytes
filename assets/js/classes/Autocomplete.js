export default class Autocomplete {
    /**
     * @param {Element} searchBox
     * @param {Element} searchResults
     * @param {Element} valueField
     * @param {string}  endpoint The url for the api endpint
     *
     * @returns {undefined}
     */
    constructor (searchBox, searchResults, valueField, endpoint) {
        this.searchBox     = searchBox;
        this.searchResults = searchResults;
        this.valueField    = valueField;
        this.endpoint      = endpoint;

        this.searchBox.addEventListener('input', this._onInputSearchBox);
        this.searchBox.addEventListener('blur', this._onBlurSearchBox);
        this.searchResults.addEventListener('click', this._onClickSearchResults);
        this.searchBox.addEventListener('keydown', this._onKeydownSearchBox);
    }

    /**
     * Hide search results
     *
     * @returns {undefined}
     */
    _hide = () => {
        this.searchResults.classList.add('hidden');
    }

    /**
     * Show search results
     *
     * @returns {undefined}
     */
    _show = () => {
        this.searchResults.classList.remove('hidden');
    }

    /**
     * Hide search results on focus loss
     * 
     * @param {Event} event
     * @returns {undefined}
     */
    _onBlurSearchBox = (event) => {
        window.setTimeout(() => this._hide(), 250);
    }

    /**
     * Select the corrected entry on click
     * 
     * @param {Event} event
     * @returns {undefined}
     */
    _onClickSearchResults = (event) => {
        if (event.target.tagName === 'A') {
            event.preventDefault();

            this.searchBox.value  = event.target.innerText;
            this.valueField.querySelector(`[value="${event.target.dataset.resultId}"]`).selected = true;

            this._hide();
        }
    }

    /**
     * Fetch data from server on input
     * 
     * @param {Event} event
     * @returns {undefined}
     */
    _onInputSearchBox = (event) => {
        const url = this.endpoint  + '?' + new URLSearchParams({ q: event.target.value });

        const response = fetch(url)
            .then(response => response.json())
            .then(data => this._onSearchDataReceived(data.results));
    }

    /**
     * Manage arrows navigation on search results
     * 
     * @param {Event} event
     * @returns {undefined}
     */
    _onKeydownSearchBox = (event) => {
        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault();
                this._selectNextEntry();
                break;
            case 'ArrowUp':
                event.preventDefault();
                this._selectPreviousEntry();
                break;
            case 'Enter':
                event.preventDefault();
                this._chooseEntry();
                break;
            default:
                break;
        }
    }

    /**
     * Update the search results when data has been received
     * 
     * @param {{id: integer, name: string}} results
     * @returns {undefined}
     */
    _onSearchDataReceived = (results) => {
        this.searchResults.textContent = '';

        for (const { id, name } of results) {
            const li = document.createElement('li');
            li.innerHTML = `<a href="#" data-result-id="${id}">${name}</a>`;

            this.searchResults.appendChild(li);
        }

        this._show();
    }

   /**
    * Choose the correct entry from the search results
    *
    * @returns {undefined}
    */
   _chooseEntry = () => {
        let currentEntry = this.searchResults.querySelector('.selectedEntry a');

        if (currentEntry) {
            const event = new CustomEvent('click', { bubbles: true });
            currentEntry.dispatchEvent(event);

            return ;
        }

        const allEntries = this.searchResults.querySelectorAll('li a');

        if (allEntries.length === 1) {
            const event = new CustomEvent('click', { bubbles: true });
            allEntries[0].dispatchEvent(event);

            return ;
        }
    }

    /**
     * Hoghtlight the next entry in search results
     *
     * @returns {undefined}
     */
    _selectNextEntry = () => {
        let currentEntry = this.searchResults.querySelector('.selectedEntry');
        let nextEntry;

        if (!currentEntry) {
            nextEntry = this.searchResults.querySelector('li:first-of-type');
            currentEntry = nextEntry;
        } else {
            nextEntry = currentEntry.nextSibling;
        }

        if (!nextEntry) {
            currentEntry.classList.remove('selectedEntry');
            this.searchResults.querySelector('li:first-of-type').classList.add('selectedEntry');

            return;
        }

        currentEntry.classList.remove('selectedEntry');
        nextEntry.classList.add('selectedEntry');
    }

    /**
     * Hoghtlight the previous entry in search results
     *
     * @returns {undefined}
     */
    _selectPreviousEntry = () => {
        let currentEntry = this.searchResults.querySelector('.selectedEntry');
        let previousEntry;

        if (!currentEntry) {
            previousEntry = this.searchResults.querySelector('li:last-of-type');
            currentEntry = previousEntry;
        } else {
            previousEntry = currentEntry.previousSibling;
        }

        if (!previousEntry) {
            currentEntry.classList.remove('selectedEntry');
            this.searchResults.querySelector('li:last-of-type').classList.add('selectedEntry');

            return;
        }

        currentEntry.classList.remove('selectedEntry');
        previousEntry.classList.add('selectedEntry');
    }
}
