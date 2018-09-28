{{ Form::open([
	'method' => 'get',
	'route'  => 'winners',
	'class'  => 'winners-top-block form',
]) }}
	<div class="winners-top-block__label">{{ __('app.pages.winners.search') }}</div>

	{{ Form::text('phone', $request->phone, ['class' => 'form__control winners-top-block__control mask mask_tel', 'placeholder' => '+7 ____ __ __ __']) }}

	<button class="winners-top-block__btn btn btn_default" type="submit">{{ __('app.pages.winners.button') }}</button>
{{ Form::close() }}
        
