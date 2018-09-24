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
        $(document).on('submit', '.ajax-form',       ns.submitForm);
        $(document).on('click',  '.ajax-more',       ns.getMoreInfo);
        $(document).on('click',  '.prevent-default', ns.preventDefault);

        ns.phonePasteDisable();
        ns.initModalOpen();
    };

    ns.clickShowNoText = function(e) {
        e.preventDefault();

        $('.age-gate__btns').addClass('hidden');
        $('.age-gate__response').removeClass('hidden');
    };

    ns.submitForm = function(e) {
        e.preventDefault();

        var $form    = $(e.currentTarget),
            $btn     = $form.find(':submit'),
            url      = $form.attr('action');

        $form.find('.help-block').text(null);
        $form.find('.form-group').removeClass('has-error');
        $form.find('.form-group-line').removeClass('has-error');
        $btn.attr('disabled', 'disabled');

        $form.find('.success-submit').addClass('hidden');

        $.ajax({
            type: 'POST',
            url:  url,
            data: ns.setFormData($form),
            processData: false,
            contentType: false,
            success: function(data) {
                $form.get(0).reset(); 

                if ($form.hasClass('reset-password')) {
                    $form.parents('.dialog').removeClass('dialog_isOpen');
                    $('#reset-password-success').addClass('dialog_isOpen');
                }

                if ($form.hasClass('reset-password-second-step')) {
                    $form.parents('.dialog').removeClass('dialog_isOpen');
                    $('#reset-password-second-step-success').addClass('dialog_isOpen');

                    setTimeout(function() {}, 4500);
                }

                if ($form.hasClass('redirect-after-success-submit')) {
                    document.location.href = data;
                }

                $btn.removeAttr('disabled');
            },
            error: function(data) {
                for(var field in data.responseJSON['errors']) {
                    var field_id = field.replace(/\./g,"_");
                    $form.find('#' + field_id).parents('.form__item').addClass('form__item_error');
                    $form.find('#' + field_id).parents('.form__item_line').addClass('form__item_error');
                    $form.find('#' + field_id).parent().find('.help-block').text(data.responseJSON['errors'][field][0]);
                }

                $btn.removeAttr('disabled');
            }
        });
    };

    ns.getMoreInfo = function(e) {
        e.preventDefault();

        var $btn     = $(e.currentTarget),
            page     = $btn.attr('href').split('page=')[1],
            lastPage = $btn.data('last-page');

        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
            success: function(data) {
                if (data.result) {
                    $('.doners-block__list').append(data.result);
                }

                if (data.currentPage == lastPage) {
                    $btn.remove();
                } else {
                    var link = $btn.attr('href').split('page=')[0];

                    $btn.attr('href', link + 'page=' + (parseInt(page) + 1));
                }
            }
        });
    };

    ns.preventDefault = function(e) {
        e.preventDefault();
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

    ns.phonePasteDisable = function() {
        $('[name="phone"], [name="phone_confirmation"]').bind("cut copy paste", function(e) {
            e.preventDefault();
        });
    };

    ns.setFormData = function($form) {
        var $inputs = $('input[type="file"]:not([disabled])', $form);
        $inputs.each(function() {
            var files = $(this).prop('files');
            if ( files != undefined && files.length <= 0 ) {
                $(this).prop('disabled', true);             
            }
        });
        var data = new FormData($form[0]);
        $inputs.prop('disabled', false);

        return data;
    };

    ns.clearUrlHash = function() {
        window.location.hash = "";
    };

    ns.init();
})(jQuery);

