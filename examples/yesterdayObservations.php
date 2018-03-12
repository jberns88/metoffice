<?php

use Jberns88\MetOffice\Client;

require __DIR__ . '/autoload.php';

//You're API key from the MetOffice
$client = new Client(['key' => '<API KEY>']);

$locations = $client->getObservationLocations();

foreach ($locations as $location) {
    try {
        $observations = $location->getHourlyObservations();

        $day = $observations->getByDate(new \DateTime('yesterday'));
        $period = $day->getByTime(new \DateTime('11pm'));

        echo 'Location: ' . $location->getName() . PHP_EOL;
        echo 'Temp: ' . $day->getLowestTemperature() . '-' . $day->getHighestTemperature() . PHP_EOL;
        echo 'Gust: ' . $day->getHighestGustSpeed() . '-' . $day->getLowestGustSpeed() . PHP_EOL;
        echo 'Wind: ' . $day->getHighestWindSpeed() . '-' . $day->getLowestWindSpeed() . PHP_EOL;
        echo 'Pressure: ' . $day->getHighestPressure() . '-' . $day->getLowestPressure() . PHP_EOL;
        echo 'Visibility: ' . $day->getHighestVisibility() . '-' . $day->getLowestVisibility() . PHP_EOL;
        echo 'Weather type: ' . $period->getWeatherType() . PHP_EOL;
        echo PHP_EOL;
    } catch (Exception $e) {
        echo 'SOMETHING WENT WRONG WITH: ' . $location->getName() . ': ' . $e->getMessage() . PHP_EOL . PHP_EOL;
    }
}
