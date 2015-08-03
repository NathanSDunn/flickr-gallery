<?php namespace FlickrGallery\TestOverride;

/**
 * Override file_get_contents() in current namespace for testing
 *
 */
function file_get_contents($path)
{
    return $path;
}

use FlickrGallery\Model\RPC\HttpsGetWrapper;

class HttpsGetWrapperDouble extends HttpsGetWrapper
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

    const TEST_CLASS = '\FlickrGallery\Model\RPC\HttpsGetWrapper';

    protected static function getMethod($name)
    {
        $class = new \ReflectionClass(self::TEST_CLASS);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    /*
     * @covers HttpsGetWrapper::__construct
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage HttpsGetWrapper::INVALID_HOST_PARAM
     */
    public function testConstructInvalidHostException()
    {
        $this->setExpectedException('InvalidArgumentException');
        new HttpsGetWrapper(1, 'a');
    }

    /*
     * @covers HttpsGetWrapper::__construct
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage HttpsGetWrapper::INVALID_HOST_PARAM
     */
    public function testConstructInvalidHostExceptionMessage()
    {
        try {
            new HttpsGetWrapper(1, 'a');
        } catch (\InvalidArgumentException $e) {
            $this->assertSame(
                HttpsGetWrapper::INVALID_HOST_PARAM, $e->getMessage()
            );
        }
    }

    /*
     * @covers HttpsGetWrapper::__construct
     */
    public function testConstructValidHost()
    {
        $testSubject = new HttpsGetWrapperDouble('a', 'b');
        $this->assertSame('a', $testSubject->getHost());
    }

    /*
     * @covers HttpsGetWrapper::__construct
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage HttpsGetWrapper::INVALID_HOST_PARAM
     */
    public function testConstructInvalidResourceException()
    {
        $this->setExpectedException('InvalidArgumentException');
        new HttpsGetWrapper('a', 1);
    }

    /*
     * @covers HttpsGetWrapper::__construct
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage HttpsGetWrapper::INVALID_HOST_PARAM
     */
    public function testConstructInvalidResourceExceptionMessage()
    {
        try {
            new HttpsGetWrapper('a', 1);
        } catch (\InvalidArgumentException $e) {
            $this->assertSame(
                HttpsGetWrapper::INVALID_RESOURCE_PARAM, $e->getMessage()
            );
        }
    }

    /*
     * @covers HttpsGetWrapper::__construct
     */
    public function testConstructValidResource()
    {
        $testSubject = new HttpsGetWrapperDouble('a', 'b');
        $this->assertSame('b', $testSubject->getResource());
    }

    /*
     * @covers HttpsGetWrapper::__construct
     */
    public function testConstructValidParams()
    {
        $testSubject = new HttpsGetWrapperDouble('a', 'b');
        $this->assertSame(array(), $testSubject->getParams());
    }

    /*
     * @covers HttpsGetWrapper::setParams
     */
    public function testSetParams()
    {
        $testSubject = new HttpsGetWrapperDouble('a', 'b');
        $testSubject->setParams(array('c'));
        $this->assertSame(array('c'), $testSubject->getParams());
    }

    /*
     * @covers HttpsGetWrapper::setParams
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage HttpsGetWrapper::INVALID_HOST_PARAM
     */
    public function testSetParamsChain()
    {
        $testSubject = new HttpsGetWrapperDouble('a', 'b');
        $testSubject->setParams(array('c'));
        $this->assertSame($testSubject, $testSubject->setParams(array()));
    }

    /*
     * @covers HttpsGetWrapper::getQuery
     */
    public function testGetQueryEmpty()
    {
        $testSubject = new HttpsGetWrapper('a', 'b');
        $testMethod = self::getMethod('getQuery');
        $this->assertSame(
            '', $testMethod->invokeArgs($testSubject, array())
        );
    }

    /*
     * @covers HttpsGetWrapper::getQuery
     */
    public function testGetQueryHasParams()
    {
        $testSubject = new HttpsGetWrapper('a', 'b');
        $testSubject->setParams(array('d', 'e'));
        $testMethod = self::getMethod('getQuery');
        $this->assertSame(
            '?d&e', $testMethod->invokeArgs($testSubject, array())
        );
    }

    /*
     * @covers HttpsGetWrapper::get
     */
    public function testGet()
    {
        $testSubject = new HttpsGetWrapper('a', 'b');
        $testSubject->setParams(array('mocky', 'mockmock'));
        $this->assertSame(
            'https://a/b?mocky&mockmock', $testSubject->getURI()
        );
    }

}
