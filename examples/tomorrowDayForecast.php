<?php

use Jberns88\MetOffice\Client;

require __DIR__ . '/autoload.php';

//You're API key from the MetOffice
$client = new Client(['key' => '<API KEY>']);

$locations = $client->getForecastLocations();

foreach ($locations as $location) {
    try {
        $forecasts = $location->getDailyForecasts();

        $day = $forecasts->getByDate(new \DateTime('tomorrow'));

        echo 'Location: ' . $location->getName() . PHP_EOL;
        echo 'Temp: ' . $day->getDay()->getTemperature() . PHP_EOL;
        echo 'Gust: ' . $day->getDay()->getGustSpeed() . PHP_EOL;
        echo 'Wind: ' . $day->getDay()->getWindSpeed() . PHP_EOL;
        echo 'Weather type: ' . $day->getDay()->getWeatherType() . PHP_EOL;
        echo PHP_EOL;
    } catch (Exception $e) {
        echo 'SOMETHING WENT WRONG WITH: ' . $location->getName() . ': ' . $e->getMessage() . PHP_EOL . PHP_EOL;
    }
}