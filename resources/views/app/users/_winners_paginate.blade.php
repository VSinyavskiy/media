@foreach ($presents as $key => $present)
    <li class="doners-block__item">
        <div class="doner-dude doner-dude_w-prize">
            <div class="doner-dude__avatar">
                <div class="doner-dude__place">{{ ($currentPage - 1) * \App\Models\Present::COUNT_WINNERS + ($key + 1) }}</div>
            </div>
            <div class="doner-dude__name">{{ $present->user->first_name }} {{ $present->user->last_name }}<span class="doner-dude__note">{{ $present->prize_name }}</span></div>
            <div class="doner-dude__prize"><img src="{{ $present->prize_image }}"></div>
        </div>
    </li>
@endforeach