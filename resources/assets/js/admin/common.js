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
        $(document).on('click',  '.block-dynamic-remove',    ns.clickBlockDynamicRemove);
        $(document).on('click',  '.add-block',               ns.clickBlockDynamicAdd);
        $(document).on('submit', '.ajax-form',               ns.submitForm);

        $(document).on('click',  '.delete-present',          ns.deletePresent);
        $(document).on('click',  '.show-winners-tab',        ns.showPresentTab);

        ns.initSelect2();
        ns.initiCheck();
        ns.initMask();
    };

    ns.clickBlockDynamicRemove = function(e) {
        e.preventDefault();

        var $btn   = $(e.currentTarget),
            $block = $btn.parents('.box');

        $block.remove();
    };

    ns.clickBlockDynamicAdd = function(e) {
        e.preventDefault();

        var $btn           = $(e.currentTarget);

        $.ajax({
            type: 'GET',
            url:  $btn.attr('href'),
            data: {
                userId: $btn.data('user-id'),
            },
            success: function(data) {
                if (data.html != false) {
                    $('#' + $btn.data('append-block-id')).append(data.html);
                }

                ns.initSelect2();
            },
            error: function(data) {
            }
        });
    };

    ns.submitForm = function(e) {
        e.preventDefault();

        var $form    = $(e.currentTarget),
            $btn     = $form.find(':submit'),
            url      = $form.attr('action');

        $btn.attr('disabled', 'disabled');

        $.ajax({
            type: 'POST',
            url:  url,
            data: new FormData($form.get(0)),
            processData: false,
            contentType: false,
            success: function(data) {
                $('#presents_block').append(data.html);

                $btn.parents('.box').remove();
            },
            error: function(data) {
                $btn.removeAttr('disabled');
            }
        });
    };

    ns.showPresentTab = function(e) {
        e.preventDefault();

        $('.nav.nav-tabs').find('li').removeClass('active');
        $('.winners_tab').addClass('active');
    };

    ns.deletePresent = function(e) {
        e.preventDefault();

        var $btn  = $(e.currentTarget),
            $form = $btn.find('form');

        $.ajax({
            type: 'POST',
            url:  $form.attr('action'),
            data: new FormData($form.get(0)),
            processData: false,
            contentType: false,
            success: function(data) {
                $block = $btn.parents('tr').remove();
            },
            error: function(data) {
                $btn.removeAttr('disabled');
            }
        });
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

    ns.initMask = function() {
        $('.mask').inputmask();
    };

    ns.init();
})(jQuery);

