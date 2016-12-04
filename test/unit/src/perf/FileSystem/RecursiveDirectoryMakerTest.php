<?php

namespace perf\FileSystem;

/**
 *
 */
class RecursiveDirectoryMakerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var FileSystemClient|\PHPUnit_Framework_MockObject_MockObject
     */
    private $fileSystemClient;

    /**
     * @var string
     */
    private $directorySeparator = '/';

    /**
     * @var RecursiveDirectoryMaker
     */
    private $maker;

    /**
     *
     */
    protected function setUp()
    {
        $this->fileSystemClient = $this->getMockBuilder('perf\\FileSystem\\FileSystemClient')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->maker = RecursiveDirectoryMaker::create($this->fileSystemClient, $this->directorySeparator);
    }

    /**
     *
     */
    public function testMakeWithObstructedPath()
    {
        $path = 'foo';
        $mode = 0123;

        $this->fileSystemClient
            ->expects($this->once())
            ->method('fileExists')
            ->with('/foo')
            ->willReturn(true)
        ;
        $this->fileSystemClient
            ->expects($this->once())
            ->method('isDirectory')
            ->with('/foo')
            ->willReturn(false)
        ;

        $this->setExpectedException(
            '\\RuntimeException',
            "Cannot make directory: path /foo is obstructed."
        );

        $this->maker->make($path, $mode);
    }
}
