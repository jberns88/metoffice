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

namespace Jberns88\MetOffice\Collections\Location;

use Jberns88\MetOffice\Client;
use Jberns88\MetOffice\Collection as BaseCollection;
use Jberns88\MetOffice\Entities\Location;
use RuntimeException;

/**
 * Description of Collection
 *
 * @author jay
 */
abstract class Collection extends BaseCollection {

    /**
     *
     * @var Client
     */
    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     *
     * @var API endpoint for this collection 
     */
    protected $endpoint;

    public function loadData(): array {
        $data = $this->client->fetch('GET', $this->endpoint);
        return isset($data['Locations']['Location']) ? $data['Locations']['Location'] : [];
    }

    public function createEntity(array $data) {
        return new Location($this->client, $data);
    }

    /**
     * 
     * @param float $lat
     * @param float $lon
     * @return Location
     */
    function getNearest(float $lat, float $lon): Location {
        $locations = iterator_to_array($this);

        usort($locations, function($a, $b) use($lat, $lon) {
            $aDistance = $a->getDistance($lat, $lon);
            $bDistance = $b->getDistance($lat, $lon);
            return $aDistance <=> $bDistance;
        });

        return reset($locations);
    }

}
