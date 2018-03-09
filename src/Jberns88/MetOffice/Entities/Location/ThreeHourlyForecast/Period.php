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

namespace Jberns88\MetOffice\Entities\Location\ThreeHourlyForecast;

use Jberns88\MetOffice\Entities\Period as BasePeriod;

class Period extends BasePeriod {

    protected $minutes;

    public function __construct(array $data) {
        $this->minutes = (int) $data['$'];
        parent::__construct($data);
    }

    public function getMinutes() {
        return $this->minutes;
    }

    public function isTimeWithinPeriod(\DateTime $date) {
        $midnight = clone $date;
        $midnight->setTime(0, 0, 0);

        $seconds = $date->getTimestamp() - $midnight->getTimestamp();
        $minutes = $seconds / 60;
        $minutes = round($minutes);

        if ($this->getMinutes() <= $minutes && ($this->getMinutes() + 180) > $minutes) {
            return true;
        }
        return false;
    }

}
