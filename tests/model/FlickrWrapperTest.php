<?php

use FlickrGallery\FlickrWrapper;

/**
 * Description of FlickrWrapperTest
 *
 */
class FlickrWrapperTest extends PHPUnit_Framework_TestCase
{

    public function testFlickrWrapper()
    {
        $FlickrWrapper = new FlickrWrapper;
        $this->assertTrue($FlickrWrapper->hasBool());
    }
}
