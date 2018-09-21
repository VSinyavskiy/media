@foreach ($points as $key => $point)
	<?php 
		$countPoints 	 = $key == 0 ? $leftTotalPoints : $countPoints - $previousePoints;
		$previousePoints = $point->points;
	?>
    <li class="doners-block__item">
        <div class="doner-dude">
            <div class="doner-dude__action"><span class="doner-dude__date">{{ $point->scoring_at->format('d.m.Y H:i:s') }}</span>{{ $point->event_name }}</div>
            <div class="doner-dude__score">{{ $countPoints }}</div>
        </div>
    </li>
@endforeach