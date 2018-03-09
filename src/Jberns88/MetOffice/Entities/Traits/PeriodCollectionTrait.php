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

namespace Jberns88\MetOffice\Entities\Traits;

use DateTime;

/**
 * Description of PeriodCollectionTrait
 *
 * @author jay
 */
trait PeriodCollectionTrait {

    public function getPeriods() {
        return $this->periods;
    }

    public function getByTime(DateTime $date) {
        return $this->periods->getByTime($date);
    }

    public function getHighestTemperature() {
        return $this->periods->getHighestTemperature();
    }

    public function getLowestTemperature() {
        return $this->periods->getLowestTemperature();
    }

    public function getHighestGustSpeed() {
        return $this->periods->getHighestGustSpeed();
    }

    public function getLowestGustSpeed() {
        return $this->periods->getLowestGustSpeed();
    }

    public function getHighestWindSpeed() {
        return $this->periods->getHighestWindSpeed();
    }

    public function getLowestWindSpeed() {
        return $this->periods->getLowestWindSpeed();
    }

}
