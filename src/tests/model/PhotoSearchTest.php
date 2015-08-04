<?php
use FlickrGallery\Model\PhotoSearch;
use FlickrGallery\Model\PhotoFormatter;
use FlickrGallery\Model\HttpsGetWrapper;

class PermissivePhotoSearch extends PhotoSearch
{
    public function getHttpWrapper()
    {
        return $this->http_wrapper;
    }

    public function getPhotoFormatter()
    {
        return $this->photo_formatter;
    }

    public function getPagesVar()
    {
        return $this->pages;
    }

    public function getPhotosVar()
    {
        return $this->photos;
    }

}

class PhotoSearchTest extends PHPUnit_Framework_TestCase
{
    public function testConstructHttpWrapper()
    {
        $http_wrapper = new HttpsGetWrapper();
        $photo_formatter = new PhotoFormatter();
        $testSubject = new PermissivePhotoSearch($http_wrapper, $photo_formatter);
        $this->assertSame(
            $http_wrapper, $testSubject->getHttpWrapper()
        );
    }

    public function testConstructPhotoFormatter()
    {
        $http_wrapper = new HttpsGetWrapper();
        $photo_formatter = new PhotoFormatter();
        $testSubject = new PermissivePhotoSearch($http_wrapper, $photo_formatter);
        $this->assertSame(
            $photo_formatter, $testSubject->getPhotoFormatter()
        );
    }

    public function testGetParams()
    {
        $http_wrapper = new HttpsGetWrapper();
        $photo_formatter = new PhotoFormatter();
        $testSubject = new PhotoSearch($http_wrapper, $photo_formatter);
        $this->assertSame(
            'method=flickr.photos.search&format=json&nojsoncallback=1&' .
            'api_key=4e05c2f06e1ad6b5b9e7ba2ace02a679&per_page=5&page=b' .
            '&text=a', $testSubject->getParams('a', 'b')
        );
    }

}
