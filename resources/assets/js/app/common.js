(function ($, undefined) {
    /**
     * Namespace
     * @var object
     */
    var ns = namespace('app.common');

    /**
     * Initializes namespace
     */
    ns.init = function() {
        $(document).on('click',  '.show-no-text',    ns.clickShowNoText);
        
        ns.initModalOpen();
    };

    ns.clickShowNoText = function(e) {
        e.preventDefault();

        $('.age-gate__btns').addClass('hidden');
        $('.age-gate__response').removeClass('hidden');
    };

    ns.initModalOpen = function() {
        var hash   = window.location.hash.substring(1);
        var prefix = 'open-';

        if(prefix == hash.substring(0, prefix.length)) {
            var modalId = hash.substring(prefix.length);

            $('#' + modalId).addClass('dialog_isOpen');

            ns.clearUrlHash();
        }
    };

    ns.clearUrlHash = function() {
        window.location.hash = "";
    };

    ns.init();
})(jQuery);

