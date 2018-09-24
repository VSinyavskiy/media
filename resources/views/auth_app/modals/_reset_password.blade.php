<div class="dialog dialog_centered" id="reset-password">
    <div class="dialog__container">
        <a class="dialog__close prevent-default" href="#" data-dialog-dismiss>
            <svg class="svg">
                <use xlink:href="#svg-ico-close"></use>
            </svg>
        </a>
        <div class="dialog__title">Восстановление пароля</div>
        <div class="dialog__body form">
            <p>Введите Ваш Email для восстановления пароля.</p>

            {{ Form::open([
                'route' => 'password.email',
                'class' => 'ajax-form reset-password',
            ]) }}

                <label class="form__label">Email</label>
                <div class="form__item form__item_required">
                    {{ Form::text('email', null, ['class' => 'form__control', 'id' => 'email']) }}
                    <span class="help-block error">{{ $errors->first('email') }}</span>
                </div>

                <div class="form__buttons">
                    <button class="btn btn_default btn_block" type="submit">Отправить</button>
                </div>

            {{ Form::close() }}

        </div>
    </div>
</div>