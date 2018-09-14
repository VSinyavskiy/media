(function ($, undefined) {
    /**
     * Namespace
     * @var object
     */
    var ns = namespace('admin.common');

    var gmarkers = [];

    /**
     * Initializes namespace
     */
    ns.init = function() {      
        ns.initSelect2();
        ns.initiCheck();
    };

    ns.initSelect2 = function() {
        $('.select2').select2();
    };

    ns.initiCheck = function() {
        $('.icheck').find('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    };

    ns.init();
})(jQuery);

