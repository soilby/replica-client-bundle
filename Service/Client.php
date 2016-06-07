<?php

namespace Soil\ReplicaClientBundle\Service;
use Buzz\Client\Curl;
use Buzz\Message\Request;
use Buzz\Message\Response;
use Monolog\Logger;

/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 7.6.16
 * Time: 8.51
 */
class Client
{

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var string URI
     */
    protected $replicaBasePath;

    /**
     * @var Curl
     */
    protected $httpClient;
    
    public function __construct($httpClient, $replicaBasePath)
    {
        $this->httpClient = $httpClient;
        $this->replicaBasePath = $replicaBasePath;
    }

    public function obtainBatch($uriSet, $resolvePerEntity = false)    {
        
        $request = new Request(Request::METHOD_POST, $this->replicaBasePath);
        $request->setContent(json_encode($uriSet));
        
        $response = new Response();
        $this->httpClient->send($request, $response);
        
        echo $response->getContent();
    }

    /**
     * @return mixed
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param mixed $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
    

    
}