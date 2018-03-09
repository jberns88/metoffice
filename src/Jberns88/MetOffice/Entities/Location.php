<?php

/*
 * The MIT License
 *
 * Copyright 2018 jay.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Jberns88\MetOffice\Entities;

use Jberns88\MetOffice\Client;
use Jberns88\MetOffice\Collections\Location\Forecast\DailyCollection;
use Jberns88\MetOffice\Collections\Location\Forecast\ThreeHourlyCollection;
use Jberns88\MetOffice\Collections\Location\Observation\HourlyCollection;

/**
 * Description of Location
 *
 * @author jay
 */
class Location {

    const DISTANCE_MILES = 'M';
    const DISTANCE_KILOMETERS = 'K';
    const DISTANCE_NAUTICAL_MILES = 'N';

    /**
     *
     * @var type 
     */
    protected $dailyForecastEndpoint = 'val/wxfcs/all/json/';

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var float 
     */
    protected $elevation;

    /**
     *
     * @var float 
     */
    protected $latitude;

    /**
     *
     * @var float 
     */
    protected $longitude;

    /**
     *
     * @var string 
     */
    protected $name;

    /**
     *
     * @var string 
     */
    protected $region;

    /**
     *
     * @var string 
     */
    protected $unitaryAuthArea;

    /**
     *
     * @var Client
     */
    protected $client;

    /**
     * 
     * @param Client $client
     * @param array $data
     */
    public function __construct(Client $client, array $data) {
        $this->client = $client;

        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->elevation = isset($data['elevation']) ? (float) $data['elevation'] : 0.0;
        $this->latitude = isset($data['latitude']) ? (float) $data['latitude'] : 0;
        $this->longitude = isset($data['longitude']) ? (float) $data['longitude'] : 0;
        $this->name = isset($data['name']) ? (string) $data['name'] : '';
        $this->region = isset($data['region']) ? (string) $data['region'] : '';
        $this->unitaryAuthArea = isset($data['unitaryAuthArea']) ? (string) $data['unitaryAuthArea'] : '';
    }

    /**
     * 
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * 
     * @return float
     */
    public function getElevation(): float {
        return $this->elevation;
    }

    /**
     * 
     * @return float
     */
    public function getLongitude(): float {
        return $this->longitude;
    }

    /**
     * 
     * @return float
     */
    public function getLatitude(): float {
        return $this->latitude;
    }

    /**
     * 
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * 
     * @return string
     */
    public function getRegion(): string {
        return $this->region;
    }

    /**
     * 
     * @return string
     */
    public function getUnitaryAuthArea() {
        return $this->unitaryAuthArea;
    }

    /**
     * 
     * @return DailyCollection
     */
    public function getDailyForecasts() {
        return new DailyCollection($this, $this->client);
    }

    /**
     * 
     * @return ThreeHourlyCollection
     */
    public function getThreeHourlyForecasts() {
        return new ThreeHourlyCollection($this, $this->client);
    }

    /**
     * 
     * @return HourlyCollection
     */
    public function getHourlyObservations() {
        return new HourlyCollection($this, $this->client);
    }

    /**
     * 
     * @param float $lat1
     * @param float $lon1
     * @param string $unit
     * @return float
     */
    public function getDistance(float $lat1, float $lon1, $unit = self::DISTANCE_MILES): float {
        $lat2 = $this->getLatitude();
        $lon2 = $this->getLongitude();

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) *
                cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        switch ($unit) {
            default:
            case self::DISTANCE_MILES:
                return $miles;
            case self::DISTANCE_KILOMETERS:
                return $miles * 1.609344;
            case self::DISTANCE_NAUTICAL_MILES:
                return $miles * 0.8684;
        }
    }

}
