(function ($, undefined) {
    /**
     * Namespace
     * @var object
     */
    var ns = namespace('app.game-events');

    /**
     * Initializes namespace
     */
    ns.init = function() {
    };

    ns.onGameAuthError = function() {
        namespace('app.markup').game.closeGame();
        $('#auth-need-game').addClass('dialog_isOpen');
    };

    ns.onStartPlayingClick = function() {
        gtag('event', 'click', {
          'event_category': 'game_start_play',
        });
    };

    ns.onGoPlayClick = function() {
        gtag('event', 'click', {
          'event_category': 'game_go_play',
        });
    };

    ns.onRulesClick = function() {
        gtag('event', 'click', {
          'event_category': 'game_rules',
        });
    };

    ns.onGameEnded = function() {
        gtag('event', 'click', {
          'event_category': 'game_ended',
        });
    };

    ns.onReplayAfterFinish = function() {
        gtag('event', 'click', {
          'event_category': 'game_replay_after_finish',
        });
    };

    ns.onShareClick = function() {
        gtag('event', 'click', {
          'event_category': 'game_share',
        });

        window.open('https://www.facebook.com/sharer/sharer.php?u=' + $('iframe').data('share-url'),'','width=600, height=400');
    };

    ns.init();
})(jQuery);

