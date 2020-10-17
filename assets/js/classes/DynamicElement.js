export default class DynamicElement {
    /**
     * @param {HTMLElement} element The element that will be dynamically showed
     * or hidden
     * @param {HTMLElement} reference The element that will decide whether the
     * other is showed or hidden
     */
    constructor (element, reference)
    {
        this._element   = element;
        this._reference = reference;
    }

    start()
    {
        this._reference.addEventListener('change', this._onReferenceValueChange);
    }

    _hide()
    {
        this._element.classList.add('hidden');
    }

    _show()
    {
        this._element.classList.remove('hidden');
    }

    _onReferenceValueChange = (event) => {
        if (!event.target.value) {
            this._show();

            return;
        }

        this._hide();
    }
}
