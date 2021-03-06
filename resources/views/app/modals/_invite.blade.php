<div class="dialog dialog_centered" id="copy-link">
    <div class="dialog__container">
        <a class="dialog__close prevent-default" href="#" data-dialog-dismiss>
            <svg class="svg">
                <use xlink:href="#svg-ico-close"></use>
            </svg>
        </a>
        <div class="dialog__title">{{ __('app.modals.invite.title') }}</div>
        <div class="dialog__body form">
            <p>{{ __('app.modals.invite.first_description') }}<br>{{ str_replace('%s', \App\Models\UserPointsLog::COUNT_POINT_FOR_FRIEND_INVITE, __('app.modals.invite.second_description')) }}</p>
            <div class="form__item form__item_w-icon"><input class="form__control form__control_focused form__control_bold" type="text" name="copy-to-clipboard" value="{{ route('invite', $user) }}" readonly="readonly">
                <a class="form__control-icon copy-icon" href="#" data-copy-to-clipboard="{{ route('invite', $user) }}" data-copy-to-clipboard-success="{{ __('app.modals.invite.link') }}">
                    <div class="copy-icon__default">
                        <svg class="svg">
                            <use xlink:href="#svg-ico-copy"></use>
                        </svg>
                    </div>
                    <div class="copy-icon__success">
                        <svg class="svg">
                            <use xlink:href="#svg-ico-check"></use>
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>