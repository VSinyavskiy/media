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
        $(document).on('click',  '.page-refresh',    ns.pageRefresh);

        $(document).on('click',  '.share-vk',        ns.shareVk);
        $(document).on('click',  '.share-fb',        ns.shareFb);

        $(document).on('click',  '.event-play-home',        ns.onPlayHomePageClick);
        $(document).on('click',  '.event-first-play-game',  ns.onFirstPlayGamePageClick);
        $(document).on('click',  '.event-second-play-game', ns.onSecondPlayGamePageClick);
        $(document).on('click',  '.event-auth',             ns.onAuthClick);
        $(document).on('click',  '.event-go-to-vk-home',    ns.onGoToVkHomePageClick);
        $(document).on('click',  '.event-go-to-fb-home',    ns.onGoToFbHomePageClick);
        $(document).on('click',  '.event-go-to-ig-home',    ns.onGoToIgHomePageClick);
        $(document).on('click',  '.event-go-to-vk-footer',  ns.onGoToVkFooterClick);
        $(document).on('click',  '.event-go-to-fb-footer',  ns.onGoToFbFooterClick);
        $(document).on('click',  '.event-go-to-ig-footer',  ns.onGoToIgFooterClick);

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

    ns.pageRefresh = function(e) {
        window.location.reload();
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

    ns.shareVk = function (e) {
        e.preventDefault();

        ns.onShareVkClick();

        window.open('https://vk.com/share.php?url=' + $(e.currentTarget).attr('href'),'','width=600, height=400');
    };

    ns.shareFb = function (e) {
        e.preventDefault();

        ns.onShareFbClick();

        window.open('https://www.facebook.com/sharer/sharer.php?u=' + $(e.currentTarget).attr('href'),'','width=600, height=400');
    };

    ns.phonePasteDisable = function() {
        $('[name="phone"], [name="phone_confirmation"]').on("cut copy paste", function(e) {
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

    ns.onPlayHomePageClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_play_home_page',
        });
    };

    ns.onFirstPlayGamePageClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_first_play_game_page',
        });
    };

    ns.onSecondPlayGamePageClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_second_play_game_page',
        });
    };

    ns.onAuthClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_auth',
        });
    };

    ns.onGoToVkHomePageClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_go_to_vk_home_page',
        });
    };

    ns.onGoToFbHomePageClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_go_to_fb_home_page',
        });
    };

    ns.onGoToIgHomePageClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_go_to_ig_home_page',
        });
    };

    ns.onGoToVkFooterClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_go_to_vk_footer',
        });
    };

    ns.onGoToFbFooterClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_go_to_fb_footer',
        });
    };

    ns.onGoToIgFooterClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_go_to_ig_footer',
        });
    };

    ns.onShareVkClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_share_vk',
        });
    };

    ns.onShareFbClick = function() {
        gtag('event', 'click', {
          'event_category': 'site_share_fb',
        });
    };

    ns.init();
})(jQuery);

