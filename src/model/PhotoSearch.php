<?php namespace FlickrGallery\Model;

/**
 * Description of FlickrWrapper
 *
 */
class PhotoSearch
{

    const INVALID_KEYWORD = 'keyword must be a string';

    //configuration
    protected $host = 'api.flickr.com';
    protected $resource = 'services/rest';
    protected $method = 'flickr.photos.search';
    protected $format = 'json&nojsoncallback=1';
    protected $api_key = '4e05c2f06e1ad6b5b9e7ba2ace02a679';
    protected $per_page = '5';
    //dependencies
    protected $http_wrapper;
    protected $photo_formatter;
    //data
    protected $pages;
    protected $photos;

    public function __construct(
    HttpsGetWrapper $http_wrapper, PhotoFormatter $photo_formatter)
    {
        $this->http_wrapper = $http_wrapper;
        $this->photo_formatter = $photo_formatter;
    }

    public function getParams($keyword, $page)
    {
        return
            'method=' . $this->method . '&' .
            'format=' . $this->format . '&' .
            'api_key=' . $this->api_key . '&' .
            'per_page=' . $this->per_page . '&' .
            'page=' . $page . '&' .
            'text=' . $keyword;
    }

    public function search($keyword, $page = 1)
    {

        $response = $this->http_wrapper
            ->setHost($this->host)
            ->setResource($this->resource)
            ->setParams($this->getParams($keyword, $page))
            ->get();

        $data = json_decode($response, true);

        $this->pages = $data['photos']['pages'];
        $this->photos = $data['photos']['photo'];

        return $this;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function getPhotos()
    {
        return $this->photo_formatter->format($this->photos);
    }

}
