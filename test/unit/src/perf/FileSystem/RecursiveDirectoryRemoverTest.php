<?php

namespace perf\FileSystem;

/**
 *
 */
class RecursiveDirectoryRemoverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var FileSystemClient|\PHPUnit_Framework_MockObject_MockObject
     */
    private $fileSystemClient;

    /**
     * @var RecursiveDirectoryRemover
     */
    private $remover;

    /**
     *
     */
    protected function setUp()
    {
        $this->fileSystemClient = $this->getMockBuilder('perf\\FileSystem\\FileSystemClient')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->remover = RecursiveDirectoryRemover::create($this->fileSystemClient);
    }

    /**
     *
     */
    public function testRemoveWithNonExistingPath()
    {
        $path = '/foo';
        
        $this->fileSystemClient
            ->expects($this->once())
            ->method('fileExists')
            ->with('/foo')
            ->willReturn(false)
        ;

        $this->setExpectedException(
            '\\RuntimeException',
            "Cannot remove directory: path /foo does not exist."
        );

        $this->remover->remove($path);
    }

    /**
     *
     */
    public function testRemoveWithNonDirectory()
    {
        $path = '/foo';

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
            "Cannot remove directory: path /foo is not a directory."
        );

        $this->remover->remove($path);
    }
}
