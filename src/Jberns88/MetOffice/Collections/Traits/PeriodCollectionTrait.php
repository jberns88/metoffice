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

namespace Jberns88\MetOffice\Collections\Traits;

use Jberns88\MetOffice\Collection;

trait PeriodCollectionTrait {

    public function getHighestTemperature() {
        return $this->max($this->getTemperatures());
    }

    public function getLowestTemperature() {
        return $this->min($this->getTemperatures());
    }

    private function getTemperatures() {
        $periods = iterator_to_array($this);
        return array_map(function($period) {
            return $period->getTemperature();
        }, $periods);
    }

    public function getHighestGustSpeed() {
        return $this->max($this->getGustSpeeds());
    }

    public function getLowestGustSpeed() {
        return $this->min($this->getGustSpeeds());
    }

    private function getGustSpeeds() {
        $periods = iterator_to_array($this);
        $gusts = array_map(function($period) {
            return $period->getGustSpeed();
        }, $periods);
        return array_filter($gusts);
    }

    public function getHighestWindSpeed() {
        return $this->max($this->getWindSpeeds());
    }

    public function getLowestWindSpeed() {
        return $this->min($this->getWindSpeeds());
    }

    private function getWindSpeeds() {
        $periods = iterator_to_array($this);
        $winds = array_map(function($period) {
            return $period->getWindSpeed();
        }, $periods);
        return array_filter($winds);
    }

    public function getHighestPressure() {
        return $this->max($this->getPressures());
    }

    public function getLowestPressure() {
        return $this->min($this->getPressures());
    }

    private function getPressures() {
        $periods = iterator_to_array($this);
        $pressures = array_map(function($period) {
            return $period->getPressure();
        }, $periods);
        return array_filter($pressures);
    }

    public function getHighestVisibility() {
        return $this->max($this->getVisibilities());
    }

    public function getLowestVisibility() {
        return $this->min($this->getVisibilities());
    }

    private function getVisibilities() {
        $periods = iterator_to_array($this);
        $visibilities = array_map(function($period) {
            return $period->getVisibility();
        }, $periods);
        return array_filter($visibilities);
    }

    private function max($array) {
        return count($array) > 0 ? max($array) : null;
    }

    private function min($array) {
        return count($array) > 0 ? min($array) : null;
    }

}
