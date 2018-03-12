# metoffice
PHP SDK for the UK MetOffice DataPoint API

### Install
``` CLI
composer require jberns88/metoffice
```

### Examples
#### Forecasts

``` PHP
//You're API key from the MetOffice
$client = new \Jberns88\MetOffice\Client(['key' => '<API KEY>']);
// Grab all the locations where forecast data is available.
$locations = $client->getForecastLocations();
// Find the nearest location from some geo coordinates
$location = $locations->getNearest(51.509865, -0.118092);
// Get the daily forecasts for this location
$forecasts = $location->getDailyForecasts();
// Get the forecast day
$day = $forecasts->getByDate(new \DateTime('tomorrow'));

// Echo out the location name
echo 'Location: ' . $location->getName() . PHP_EOL;
// Echo out the forecast date
echo 'Date: ' . $day->getDate()->format('Y-m-d') . PHP_EOL;
// Echo our the day temperature. Also caontains $day->getNight()->temperature()
echo 'Temp: ' . $day->getDay()->getTemperature() . PHP_EOL;
// Gust Speed
echo 'Gust: ' . $day->getDay()->getGustSpeed() . PHP_EOL;
// Wind speed
echo 'Wind: ' . $day->getDay()->getWindSpeed() . PHP_EOL;
// Weather type based on the meta offices API (https://www.metoffice.gov.uk/datapoint/support/documentation/code-definitions)
echo 'Weather type: ' . $day->getDay()->getWeatherType() . PHP_EOL;
echo PHP_EOL;
```

#### Observerations
``` PHP 
//You're API key from the MetOffice
$client = new \Jberns88\MetOffice\Client(['key' => '<API KEY>']);
// Grab all the locations where observation data is available.
$locations = $client->getObservationLocations();
// Find the nearest location from some geo coordinates
$location = $locations->getNearest(51.509865, -0.118092);
// Get the observations
$observations = $location->getHourlyObservations();
// get the observation day
$day = $observations->getByDate(new \DateTime('yesterday'));

echo 'Location: ' . $location->getName() . PHP_EOL;
// Grab the highest and lowest temperatures from the day
echo 'Temp: ' . $day->getLowestTemperature() . '-' . $day->getHighestTemperature() . PHP_EOL;
// Grab the highest and lowest gust speeds for the day
echo 'Gust: ' . $day->getHighestGustSpeed() . '-' . $day->getLowestGustSpeed() . PHP_EOL;
// Grab the highest and lowest wind speeds for the day
echo 'Wind: ' . $day->getHighestWindSpeed() . '-' . $day->getLowestWindSpeed() . PHP_EOL;

//Get the observation time peroid. It will find the nearest one if an exact hour isn't given. THe met office don't hold the data for long so I've set the time quite late for this example
$period = $day->getByTime(new \DateTime('11pm'));
// Weather type based on the meta offices API (https://www.metoffice.gov.uk/datapoint/support/documentation/code-definitions)
echo 'Weather type: ' . $period->getWeatherType() . PHP_EOL;


```
