<?php namespace FlickrGallery\Model\RPC;

/**
 * A simple wrapper around HTTP GET requests
 *
 */
class HttpsGetWrapper
{

    const INVALID_HOST_PARAM = '$host must be a string';
    const INVALID_RESOURCE_PARAM = '$domain must be a string';
    const INVALID_PARAMS_PARAM = '$params must be an array';

    protected $host;
    protected $resource;
    protected $params;

    public function __construct($host, $resource)
    {
        if (!is_string($host)) {
            throw new \InvalidArgumentException(HttpsGetWrapper::INVALID_HOST_PARAM);
        }

        if (!is_string($resource)) {
            throw new \InvalidArgumentException(HttpsGetWrapper::INVALID_RESOURCE_PARAM);
        }

        $this->host = $host;
        $this->resource = $resource;
        $this->params = array();
    }

    public function setParams(Array $params)
    {
        $this->params = $params;
        return $this;
    }

    private function getQuery()
    {
        $params = $this->params;
        if (!array_key_exists(0, $params)) {
            return '';
        } else {
            return '?' . implode('&', $params);
        }
    }

    public function getURI()
    {
        return 'https://' . //prevents unsanitised user input exploits
            $this->host . '/' .
            $this->resource .
            $this->getQuery();
    }

    public function get()
    {
        return file_get_contents($this->getURI());
    }

}
