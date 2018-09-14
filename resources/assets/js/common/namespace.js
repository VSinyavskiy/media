(function (undefined) {

    /**
     * Namespaces
     * @var object
     */
    window.namespaces = window.namespaces || {};

    /**
     * Returns namespace
     *
     * @param string name
     *
     * @return object
     */
    window.namespace = function (name) {
        window.namespaces[name] = window.namespaces[name] || {};

        return window.namespaces[name];
    };

})();
