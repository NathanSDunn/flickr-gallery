<?php namespace FlickrGallery\Model;

use FlickrGallery\Controller\Gallery;

class PermissiveGallery extends Gallery
{
    public function getSearch()
    {
        return $this->search;
    }

}

class GalleryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $search = new PhotoSearch(
            new HttpsGetWrapper(), new PhotoFormatter
        );
        $testSubject = new PermissiveGallery($search);
        $this->assertSame(
            $search, $testSubject->getSearch()
        );
    }

}
