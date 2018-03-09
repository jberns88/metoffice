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

namespace Jberns88\MetOffice\Collections\Location\Forecast;

use DateTime;
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
     * @var type 
     */
    protected $interval;

    /**
     *
     * @var API endpoint for this collection 
     */
    protected $endpoint = 'val/wxfcs/all/json/';

    /**
     *
     * @var Client
     */
    protected $client;

    /**
     *
     * @var Location 
     */
    protected $location;

    public function __construct(Location $location, Client $client) {
        $this->client = $client;
        $this->location = $location;
    }

    /**
     * 
     * @return array
     * @throws RuntimeException
     */
    public function loadData(): array {
        $data = $this->client->fetch('GET', $this->endpoint . $this->location->getId(), [
            'params' => ['res' => $this->interval],
        ]);
        if (!isset($data['SiteRep']['DV']['Location']['Period'])) {
            throw new \RuntimeException('Missing Forecast data');
        }

        return $data['SiteRep']['DV']['Location']['Period'];
    }

    /**
     * 
     * @param DateTime $date
     * @return type
     * @throws RuntimeException
     */
    public function getByDate(DateTime $date) {
        $formattedDate = $date->format('Y-m-d');

        foreach ($this as $daily) {
            if ($daily->getDate()->format('Y-m-d') === $formattedDate) {
                return $daily;
            }
        }
        throw new RuntimeException('Date not found');
    }

}
