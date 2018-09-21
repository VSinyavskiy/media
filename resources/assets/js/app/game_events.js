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
        console.log('TODO: implement onStartPlayingClick');
    };

    ns.onGoPlayClick = function() {
        console.log('TODO: implement onGoPlayClick');
    };

    ns.onRulesClick = function() {
        console.log('TODO: implement onRulesClick');
    };

    ns.onGameEnded = function() {
        console.log('TODO: implement onGameEnded');
    };

    ns.onReplayAfterFinish = function() {
        console.log('TODO: implement onReplayAfterFinish');
    };

    ns.onShareClick = function() {
        console.log('TODO: implement onShareClick');
    };

    ns.init();
})(jQuery);

