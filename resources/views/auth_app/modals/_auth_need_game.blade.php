<div class="dialog dialog_centered" id="auth-need-game">
    <div class="dialog__container">
        <a class="dialog__close prevent-default" href="#" data-dialog-dismiss>
            <svg class="svg">
                <use xlink:href="#svg-ico-close"></use>
            </svg>
        </a>
        <div class="dialog__title">{{ __('app.modals.auth_need_game.title') }}</div>
        <div class="dialog__body form">
            <p>{{ __('app.modals.auth_need_game.description') }}</p>

            <div class="form__buttons">
                <a class="btn btn_default btn_block" href="{{ route('login', $_SERVER['QUERY_STRING']) }}">
                    {{ __('app.modals.auth_need_game.button') }}
                </a>
            </div>
        </div>
        </div>
    </div>
</div>