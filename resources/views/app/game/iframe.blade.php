<!DOCTYPE html>
<html lang="{{ App::getlocale() }}">
<head>
    <meta charset="utf-8">

    <title>Lays Doner Ninja</title>

    <!--http://www.html5rocks.com/en/mobile/mobifying/-->
    <meta name="viewport"
          content="width=device-width,user-scalable=no,initial-scale=1, minimum-scale=1,maximum-scale=1"/>

    <!--https://developer.apple.com/library/safari/documentation/AppleApplications/Reference/SafariHTMLRef/Articles/MetaTags.html-->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">

    <!-- force webkit on 360 -->
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <!-- force edge on IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="msapplication-tap-highlight" content="no">

    <!-- force full screen on some browser -->
    <meta name="full-screen" content="yes"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="360-fullscreen" content="true"/>

    <!-- force screen orientation on some browser -->
    <meta name="screen-orientation" content="portrait"/>
    <meta name="x5-orientation" content="portrait">

    <!--fix fireball/issues/3568 -->
    <!--<meta name="browsermode" content="application">-->
    <meta name="x5-page-mode" content="app">

    <!--<link rel="apple-touch-icon" href=".png" />-->
    <!--<link rel="apple-touch-icon-precomposed" href=".png" />-->

    <link rel="stylesheet" type="text/css" href="{{ asset('game_build/style-mobile.css') }}"/>
</head>
<body>
<canvas id="GameCanvas" oncontextmenu="event.preventDefault()" tabindex="0"></canvas>
<div id="splash">
    <div class="progress-bar stripes">
        <span style="width: 0%"></span>
    </div>
</div>
<script type="text/javascript">
    window.SiteIntegration = {
        api_url: '{{ route('game.results') }}',

        eventGameAuthError: function(error) { window.parent.namespace('app.game-events').onGameAuthError(); },
        eventStartPlayingClick: function() { window.parent.namespace('app.game-events').onStartPlayingClick(); },
        eventGoPlayClick: function() { window.parent.namespace('app.game-events').onGoPlayClick(); },
        eventRulesClick: function() { window.parent.namespace('app.game-events').onRulesClick(); },
        eventGameEnded: function() { window.parent.namespace('app.game-events').onGameEnded(); },
        eventReplayAfterFinish: function() { window.parent.namespace('app.game-events').onReplayAfterFinish(); },
        eventShareClick: function() { window.parent.namespace('app.game-events').onShareClick(); }
    }
</script>
<script src="{{ asset('game_build/src/settings.js') }}" charset="utf-8"></script>
<script src="{{ asset('game_build/main.js') }}" charset="utf-8"></script>
</body>
</html>
