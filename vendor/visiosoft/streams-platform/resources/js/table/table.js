(function (window, document) {

    let filters = Array.prototype.slice.call(
        document.querySelectorAll('#filters input')
    );

    // Focus on the first filter input.
    filters.some(function (filter) {
        if (filter.type !== 'hidden') {
            filter.focus();
            return true;
        }
    });

})(window, document);
