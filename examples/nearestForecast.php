<?php

use Jberns88\MetOffice\Client;

require __DIR__ . '/autoload.php';

//You're API key from the MetOffice
$client = new Client(['key' => '<API KEY>']);

$locations = $client->getForecastLocations();
$location = $locations->getNearest(51.509865, -0.118092);
$forecasts = $location->getDailyForecasts();

$day = $forecasts->getByDate(new \DateTime('tomorrow'));

echo 'Location: ' . $location->getName() . PHP_EOL;
echo 'Date: ' . $day->getDate()->format('Y-m-d') . PHP_EOL;
echo 'Temp: ' . $day->getDay()->getTemperature() . PHP_EOL;
echo 'Gust: ' . $day->getDay()->getGustSpeed() . PHP_EOL;
echo 'Wind: ' . $day->getDay()->getWindSpeed() . PHP_EOL;
echo 'Weather type: ' . $day->getDay()->getWeatherType() . PHP_EOL;
echo PHP_EOL;
