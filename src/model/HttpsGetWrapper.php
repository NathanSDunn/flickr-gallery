<?php namespace FlickrGallery\Model;

/**
 * A simple wrapper around HTTP GET requests
 *
 */
class HttpsGetWrapper
{

    const INVALID_HOST_PARAM = '->setHost(string) is not correctly set';
    const INVALID_RESOURCE_PARAM = '->setResource(string) is not correctly set';

    protected $host;
    protected $resource;
    protected $params;

    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    public function getURI()
    {
        if (!is_string($this->host)) {
            throw new \DomainException(HttpsGetWrapper::INVALID_HOST_PARAM);
        }
        $uri = 'https://' . $this->host . '/';
        //prevents unsanitised user input exploits in file_get_contents

        if (!is_string($this->resource)) {
            throw new \DomainException(HttpsGetWrapper::INVALID_RESOURCE_PARAM);
        }

        $uri .= $this->resource . '/';

        if (is_string($this->params)) {
            $uri .= '?' . $this->params;
        }

        return $uri;
    }

    public function get()
    {
        return file_get_contents($this->getURI());
    }

}
