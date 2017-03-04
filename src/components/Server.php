<?php
/**
 * Created by PhpStorm.
 * User: kalim_000
 * Date: 3/3/2017
 * Time: 11:12 PM
 */

namespace app\components;

/**
 * Class Server
 * @package app\components
 */
class Server extends Request
{
    /**
     * Server constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        parent::__construct($params['backendUrl']);
    }

    /**
     * @param $method string
     * @param $queryParams array
     * @return mixed
     */
    public function get($method, array $queryParams = [])
    {
        $this->useHttpMethod('GET');
        $this->useMethod($method);
        foreach ($queryParams as $paramName => $value) {
            $this->withQueryParam($paramName, $value);
        }

        $response = $this->query();

        return json_decode($response);
    }

    /**
     * @param $method string
     * @param $formParams array
     * @return mixed
     */
    public function post($method, array $formParams = [])
    {
        $this->useHttpMethod('POST');
        $this->useMethod($method);
        foreach ($formParams as $paramName => $value) {
            $this->withFormParams($paramName, $value);
        }

        $response = $this->query();

        return json_decode($response);
    }

}