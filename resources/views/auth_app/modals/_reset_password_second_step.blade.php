<div class="dialog dialog_centered" id="reset-password-second-step">
    <div class="dialog__container">
        <a class="dialog__close prevent-default" href="#" data-dialog-dismiss>
            <svg class="svg">
                <use xlink:href="#svg-ico-close"></use>
            </svg>
        </a>
        <div class="dialog__title">{{ __('app.modals.reset_password_second_step.title') }}</div>
        <div class="dialog__body form">
            <p>{{ __('app.modals.reset_password_second_step.description') }}</p>

            {{ Form::open([
                'route' => 'password.reset.post',
                'class' => 'ajax-form reset-password-second-step redirect-after-success-submit',
            ]) }}

                {{ Form::hidden('token', session('token')) }}
                {{ Form::hidden('email', session('email')) }}

                <label class="form__label">{{ __('app.modals.reset_password_second_step.fields.password') }}</label>
                <div class="form__item form__item_required">
                    {{ Form::password('password', ['class' => 'form__control', 'id' => 'password']) }}
                    <span class="help-block error">{{ $errors->first('password') }}</span>
                </div>

                <label class="form__label">{{ __('app.modals.reset_password_second_step.fields.password_confirmation') }}</label>
                <div class="form__item form__item_required">
                    {{ Form::password('password_confirmation', ['class' => 'form__control', 'id' => 'password_confirmation']) }}
                    <span class="help-block error">{{ $errors->first('password_confirmation') }}</span>
                </div>

                <div class="form__buttons">
                    <button class="btn btn_default btn_block" type="submit">
                        {{ __('app.modals.reset_password_second_step.button') }}
                    </button>
                </div>

            {{ Form::close() }}

        </div>
    </div>
</div>