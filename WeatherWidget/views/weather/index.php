<?php
use app\widgets\WeatherWidget\models\Weather;
?>

<style>
.weather-widget {
	position: fixed;
	width: 183px;
	border-radius: 10px;
	height: 164px;
	width: 183px;
}

.weather-icon {
	display: block;
	margin: 0 auto;
}

#location {
	text-align: center;
	font-size: 16px;
	color: skyblue;
	padding: 20px;
}

#temperature {
	font-weight: bold;
	font-size: 25px;
	text-align: center;
	color: skyblue;
	cursor: pointer;
}

#summary {
	text-align: center;
	/*color: skyblue;*/
	font-size: 20px;
}

.profile-copyright {
	text-align: center;
	margin-top: 30px;
	font-size: 12px;
	color: #222;
}

.profile-heart {
	height: 13px;
	width: 13px;
}
</style>

<?php

$weather = (new Weather())->getWeatherReport();
if (! empty($weather)) {

    $temp = ! empty($weather->main) && ! empty($weather->main->temp) ? (int) ($weather->main->temp - Weather::CELCIUS_VAL) : '';
    $city = ! empty($weather->name) ? $weather->name : '';
    $desc = ! empty($weather->weather[0]) && ! empty($weather->weather[0]->description) ? $weather->weather[0]->description : '';

    ?>
<div class="weather-widget"
	style="background: rgba(252, 188, 154, 0.2) none repeat scroll 0% 0%;">
	<div class="content">
		<div id="location"><?= $city ?></div>

		<div id="temperature" data-units="us"><?= $temp ?>°C</div>
		<div id="summary"><?= $desc ?></div>

	</div>
</div>
<?php } ?>