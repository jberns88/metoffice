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

namespace Jberns88\MetOffice\Collections\Location\Observation\Hourly;

use DateTime;
use Jberns88\MetOffice\Collection as BaseCollection;
use Jberns88\MetOffice\Entities\Location\HourlyObservation\Period;
use Jberns88\MetOffice\Collections\Traits\PeriodCollectionTrait;
use RuntimeException;

/**
 * Description of Collection
 *
 * @author jay
 */
class Collection extends BaseCollection {

    use PeriodCollectionTrait;

    /**
     *
     * @var type 
     */
    protected $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * 
     * @return array
     */
    public function loadData(): array {
        return $this->data;
    }

    public function createEntity(array $data) {
        return new Period($data);
    }

    public function getByTime(DateTime $date) {
        foreach ($this as $period) {
            if ($period->isTimeWithinPeriod($date)) {
                return $period;
            }
        }
        throw new RuntimeException('Could not find time for period, is the time in the future?');
    }

}
