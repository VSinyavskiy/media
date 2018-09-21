<div class="dialog dialog_centered" id="auth-need-game">
    <div class="dialog__container">
        <a class="dialog__close prevent-default" href="#" data-dialog-dismiss>
            <svg class="svg">
                <use xlink:href="#svg-ico-close"></use>
            </svg>
        </a>
        <div class="dialog__title">Необходима авторизация</div>
        <div class="dialog__body form">
            <p>Чтобы играть сначала нужно авторизоваться!</p>

            <div class="form__buttons">
                <a class="btn btn_default btn_block" href="{{ route('login') }}">Авторизоваться</a>
            </div>
        </div>
        </div>
    </div>
</div>