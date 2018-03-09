<?php

use Jberns88\MetOffice\Client;

require __DIR__ . '/autoload.php';

//You're API key from the MetOffice
$client = new Client(['key' => '<API KEY>']);

$locations = $client->getForecastLocations();

foreach ($locations as $location) {
    try {
        $forecasts = $location->getThreeHourlyForecasts();
        $day = $forecasts->getByDate(new \DateTime('tomorrow'));
        $period = $day->getByTime(new \DateTime('noon'));

        echo 'Location: ' . $location->getName() . PHP_EOL;
        echo 'Temp: ' . $period->getTemperature() . PHP_EOL;
        echo 'Gust: ' . $period->getGustSpeed() . PHP_EOL;
        echo 'Wind: ' . $period->getWindSpeed() . PHP_EOL;
        echo 'Weather type: ' . $period->getWeatherType() . PHP_EOL;
        echo PHP_EOL;
    } catch (Exception $e) {
        echo 'SOMETHING WENT WRONG WITH: ' . $location->getName() . ': ' . $e->getMessage() . PHP_EOL . PHP_EOL;
    }
}