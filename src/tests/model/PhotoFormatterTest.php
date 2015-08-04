<?php
use FlickrGallery\Model\PhotoFormatter;

class PhotoFormatterStubGetUrl extends PhotoFormatter
{
    public function getUrl(Array $photo)
    {
        return 'MockUrl';
    }

}

class PhotoFormatterTest extends PHPUnit_Framework_TestCase
{
    public function testGetUrl()
    {
        $testSubject = new PhotoFormatter;
        $photo = array(
            'farm' => 1,
            'id' => "20269516635",
            'server' => '471',
            'secret' => '7a34fb789c',
        );

        $this->assertSame(
            'https://farm1.staticflickr.com/471/20269516635_7a34fb789c',
            $testSubject->getUrl($photo)
        );
    }

    public function testFormat()
    {
        $testSubject = new PhotoFormatterStubGetUrl;
        $photos = array(array(1));
        $expected = array(
            array(
                'thumbnail' => 'MockUrl_t.jpg',
                'big_url' => 'MockUrl.jpg',
            )
        );
        $this->assertSame(
            $expected, $testSubject->format($photos)
        );
    }

}
