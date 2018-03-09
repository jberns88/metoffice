<?php

namespace Jberns88\MetOffice;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Request;
use Jberns88\MetOffice\Collections\Location\ObservationCollection;
use Jberns88\MetOffice\Collections\Location\ForecastCollection;
use Psr\Http\Message\RequestInterface;
use RuntimeException;

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

/**
 * Main class for interacting with the DataPoint API
 *
 * @author Jay Smith
 */
class Client {

    /**
     *
     * @var array
     */
    protected $defaults = [
        'key' => null,
        'base_uri' => 'http://datapoint.metoffice.gov.uk/public/data/',
    ];

    /**
     *
     * @var array 
     */
    protected $options = [];

    /**
     *
     * @var HttpClient 
     */
    protected $httpClient;

    /**
     * pass in the API key with ['key' => <API_KEY>]
     * @param array $options
     */
    public function __construct(array $options = []) {
        $this->setOptions($options);
    }

    /**
     * 
     * @param string $key
     * @param mixed $value
     */
    public function setOption(string $key, $value): Client {
        $this->setOptions([$key => $value]);
        return $this;
    }

    /**
     * @param array $options
     */
    public function addOptions(array $options): Client {
        $this->options = array_merge($this->option, $options);
        return $this;
    }

    /**
     * 
     * @param array $options
     */
    public function setOptions(array $options): Client {
        $this->options = array_merge($this->defaults, $options);
        return $this;
    }

    /**
     * 
     * @param string $key
     * @return mixed
     * @throws RuntimeException
     */
    public function getOption(string $key) {
        if (!isset($this->options[$key])) {
            throw new RuntimeException("Key: $key not found");
        }
        return $this->options[$key];
    }

    /**
     * 
     * @return HourlyCollection
     */
    public function getForecastLocations(): ForecastCollection {
        return new ForecastCollection($this);
    }

    /**
     * 
     * @return DailyCollection
     */
    public function getObservationLocations(): ObservationCollection {
        return new ObservationCollection($this);
    }

    /**
     * 
     * @param type $endpoint
     */
    public function fetch($method = 'GET', string $endpoint, array $options = []) {  
        $params = isset($options['params']) ? $options['params'] : [];
        $params['key'] = $this->getOption('key');

        $request = new Request($method, $endpoint);

        $uri = $request->getUri()->withQuery(http_build_query($params));

        $request = $request->withUri($uri);
        return $this->sendRequest($request);
    }

    /**
     * 
     * @param RequestInterface $request
     * @return type
     */
    protected function sendRequest(RequestInterface $request) {
        $response = $this->getHttpClient()->send($request);
        $content = $response->getBody()->getContents();
        return json_decode($content, true);
    }

    /**
     * 
     * @return HttpClient
     */
    protected function getHttpClient(): HttpClient {
        if (!$this->httpClient) {
            $this->httpClient = new HttpClient([
                'base_uri' => $this->getOption('base_uri')
            ]);
        }
        return $this->httpClient;
    }

}
