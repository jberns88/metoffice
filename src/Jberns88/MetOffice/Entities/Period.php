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

abstract class Period {

    const VISIBILITY = "V";
    const WIND_DIRECTION = "D";
    const WIND_SPEED = "S";
    const WEATHER_TYPE = "W";
    const FEELS_LIKE_TEMP = "F";
    const TEMP = "T";
    const WIND_GUST = "G";
    const SCREEN_REL_HUMIDITY = "H";
    const PRECIPITATION_PROBABILITY = "Pp";
    const PRESSURE = "P";

    protected $visibility;
    protected $windDirection;
    protected $windSpeed;
    protected $weatherType;
    protected $feelsLike;
    protected $temp;
    protected $gustSpeed;
    protected $humidity;
    protected $precipitationPropability;

    public function __construct(array $data) {
        $this->visibility = isset($data[$this::VISIBILITY]) ? $data[$this::VISIBILITY] : null;
        $this->windDirection = isset($data[$this::WIND_DIRECTION]) ? $data[$this::WIND_DIRECTION] : null;
        $this->windSpeed = (int) isset($data[$this::WIND_SPEED]) ? $data[$this::WIND_SPEED] : 0;
        $this->weatherType = (int) isset($data[$this::WEATHER_TYPE]) ? $data[$this::WEATHER_TYPE] : 0;
        $this->feelsLike = isset($data[$this::FEELS_LIKE_TEMP]) ? (int) $data[$this::FEELS_LIKE_TEMP] : 0;
        $this->temp = isset($data[$this::TEMP]) ? (float) $data[$this::TEMP] : 0;
        $this->gustSpeed = isset($data[$this::WIND_GUST]) ? (int) $data[$this::WIND_GUST] : 0;
        $this->humidity = isset($data[$this::SCREEN_REL_HUMIDITY]) ? (int) $data[$this::SCREEN_REL_HUMIDITY] : 0;
        $this->precipitationPropability = isset($data[$this::PRECIPITATION_PROBABILITY]) ? (int) $data[$this::PRECIPITATION_PROBABILITY] : 0;
        $this->pressure = isset($data[$this::PRESSURE]) ? (int) $data[$this::PRESSURE] : 0;
    }

    public function getVisibility() {
        return $this->visibility;
    }

    public function getWindDirection() {
        return $this->windDirection;
    }

    public function getWindSpeed() {
        return $this->windSpeed;
    }

    public function getWeatherType() {
        return $this->weatherType;
    }

    public function getFeelsLike() {
        return $this->feelsLike;
    }

    public function getTemperature() {
        return $this->temp;
    }

    public function getGustSpeed() {
        return $this->gustSpeed;
    }

    public function getHumidity() {
        return $this->humidity;
    }

    public function getPrecipitationPropability() {
        return $this->precipitationPropability;
    }

    public function getPressure() {
        return $this->pressure;
    }

}
