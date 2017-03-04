<?php
/**
 * Created by PhpStorm.
 * User: kalim_000
 * Date: 3/3/2017
 * Time: 5:26 PM
 */

namespace app\components;


use GuzzleHttp\Client;

class Request
{
    /**
     * Performs http queries
     * @var mixed
     */
    private $client;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * API method
     * @var string
     */
    private $method;

    /**
     * Query Http method
     * @var
     */
    private $httpMethod;

    /**
     * Query options
     * @var array
     */
    private $options;

    /**
     * Query resulting response
     * @var object
     */
    private $response;

    /**
     * Request constructor.
     * @param $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        $this->client = $this->resolveClient();

        $this->options = [
            'query' => [],
            'form_params' => []
        ];
    }

    /**
     * @param $paramName string
     * @param $value int|string|bool
     */
    protected function withQueryParam($paramName, $value)
    {
        $this->options['query'][$paramName] = $value;
    }

    /**
     * @param $paramName string
     * @param $value int|string|bool
     */
    protected function withFormParams($paramName, $value)
    {
        $this->options['form_params'][$paramName] = $value;
    }

    /**
     * @param $httpMethod
     */
    protected function useHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * @param $method
     */
    protected function useMethod($method)
    {
        $this->method = '/' . trim(trim($method), '/');
    }

    /**
     * Performs call via $this->client class
     * @return object
     */
    protected function query()
    {
        $this->response = $this->client->request(
            $this->httpMethod,
            $this->method,
            $this->options
        );

        return $this->response->getBody()->getContents();;
    }

    /**
     * Resolves HTTP client dependency
     * @return mixed
     */
    private function resolveClient()
    {
        return new Client(['base_uri' => $this->baseUrl]);
    }
}