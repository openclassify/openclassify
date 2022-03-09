(function (window, document) {

    /**
     * Make sure it's a click command.
     */
    const match = document.location.hash.match(/^#click:(.*)$/);

    if (!(match && match.length > 1)) {
        return;
    }

    /**
     * Grab the selector and make sure we have a target.
     */
    let [, selector] = match;

    selector = decodeURIComponent(selector);

    if (!selector) {
        return;
    }

    const target = document.querySelector(selector);

    /**
     * If we do have a target go ahead and click it.
     */
    if (target) {
        target.click();
    }

})(window, document);
