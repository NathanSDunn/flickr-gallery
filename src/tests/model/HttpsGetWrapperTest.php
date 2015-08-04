<?php namespace FlickrGallery\Model;

/**
 * Override file_get_contents() in current namespace for testing
 *
 */
function file_get_contents($path)
{
    return 'RESOURCE_FROM:' . $path;
}

use FlickrGallery\Model\HttpsGetWrapper;

class MockHttpsGetWrapper extends HttpsGetWrapper
{
    function getHost()
    {
        return $this->host;
    }

    function getResource()
    {
        return $this->resource;
    }

    function getParams()
    {
        return $this->params;
    }

}

class HttpsGetWrapperTest extends \PHPUnit_Framework_TestCase
{
    /*
     * @covers HttpsGetWrapper::setHost
     */
    public function testSetHost()
    {
        $testSubject = new MockHttpsGetWrapper();
        $testSubject->setHost('c');
        $this->assertSame('c', $testSubject->getHost());
    }

    /*
     * @covers HttpsGetWrapper::setHost
     */
    public function testSetHostChain()
    {
        $testSubject = new HttpsGetWrapper();
        $testSubject->setHost('c');
        $this->assertSame($testSubject, $testSubject->setHost(array()));
    }

    /*
     * @covers HttpsGetWrapper::setHost
     */
    public function testSetResource()
    {
        $testSubject = new MockHttpsGetWrapper();
        $testSubject->setResource('c');
        $this->assertSame('c', $testSubject->getResource());
    }

    /*
     * @covers HttpsGetWrapper::setResource
     */
    public function testSetResourceChain()
    {
        $testSubject = new HttpsGetWrapper();
        $testSubject->setResource('c');
        $this->assertSame($testSubject, $testSubject->setResource(array()));
    }

    /*
     * @covers HttpsGetWrapper::setParams
     */
    public function testSetParams()
    {
        $testSubject = new MockHttpsGetWrapper();
        $testSubject->setParams('c');
        $this->assertSame('c', $testSubject->getParams());
    }

    /*
     * @covers HttpsGetWrapper::setParams
     */
    public function testSetParamsChain()
    {
        $testSubject = new HttpsGetWrapper();
        $testSubject->setParams('c');
        $this->assertSame($testSubject, $testSubject->setParams(array()));
    }

    /*
     * @covers HttpsGetWrapper::getURI
     * @expectedException \DomainException
     * @expectedExceptionMessage HttpsGetWrapper::INVALID_HOST_PARAM
     */
    public function testGetURIInvalidHostException()
    {
        $this->setExpectedException('DomainException');
        $testSubject = new HttpsGetWrapper();
        $testSubject->getURI();
    }

    /*
     * @covers HttpsGetWrapper::getURI
     * @expectedException \DomainException
     * @expectedExceptionMessage HttpsGetWrapper::INVALID_HOST_PARAM
     */
    public function testGetURIInvalidHostExceptionMessage()
    {
        $testSubject = new HttpsGetWrapper();
        try {
            $testSubject->getURI();
        } catch (\DomainException $e) {
            $this->assertSame(
                HttpsGetWrapper::INVALID_HOST_PARAM, $e->getMessage()
            );
        }
    }

    /*
     * @covers HttpsGetWrapper::getURI
     */
    public function testGetURIValidHost()
    {
        $testSubject = new MockHttpsGetWrapper();
        $testSubject->setHost('a');
        $this->assertSame('a', $testSubject->getHost());
    }

    /*
     * @covers HttpsGetWrapper::getURI
     * @expectedException \DomainException
     * @expectedExceptionMessage HttpsGetWrapper::INVALID_RESOURCE_PARAM
     */
    public function testGetURIInvalidResourceException()
    {
        $testSubject = new HttpsGetWrapper();
        $testSubject->setHost('a');

        $this->setExpectedException('DomainException');
        $testSubject->getURI();
    }

    /*
     * @covers HttpsGetWrapper::getURI
     * @expectedException \DomainException
     * @expectedExceptionMessage HttpsGetWrapper::INVALID_RESOURCE_PARAM
     */
    public function testGetURIInvalidResourceExceptionMessage()
    {
        $testSubject = new HttpsGetWrapper();
        $testSubject->setHost('a');

        try {
            $testSubject->getURI();
        } catch (\DomainException $e) {
            $this->assertSame(
                HttpsGetWrapper::INVALID_RESOURCE_PARAM, $e->getMessage()
            );
        }
    }

    /*
     * @covers HttpsGetWrapper::getURI
     */
    public function testGetURIValidResource()
    {
        $testSubject = new HttpsGetWrapper();
        $testSubject
            ->setHost('a')
            ->setResource('b');
        $this->assertSame('https://a/b/', $testSubject->getURI());
    }

    /*
     * @covers HttpsGetWrapper::getURI
     */
    public function testGetURIEmptyParams()
    {
        $testSubject = new HttpsGetWrapper();
        $testSubject
            ->setHost('a')
            ->setResource('b');
        $this->assertSame('https://a/b/', $testSubject->getURI());
    }

    /*
     * @covers HttpsGetWrapper::getURI
     */
    public function testGetURIValidParams()
    {
        $testSubject = new HttpsGetWrapper();
        $testSubject
            ->setHost('a')
            ->setResource('b')
            ->setParams('c');
        $this->assertSame('https://a/b/?c', $testSubject->getURI());
    }

    /*
     * @covers HttpsGetWrapper::get
     */
    public function testGet()
    {
        $testSubject = new HttpsGetWrapper();
        $testSubject
            ->setHost('localhost')
            ->setResource('endpoint')
            ->setParams('test=magic');
        $this->assertSame(
            'RESOURCE_FROM:https://localhost/endpoint/?test=magic',
            $testSubject->get()
        );
    }

}
