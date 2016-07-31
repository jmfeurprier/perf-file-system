<?php

namespace perf\FileSystem;

/**
 *
 */
class RecursiveDirectoryRemoverTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    protected function setUp()
    {
        $this->fileSystemWrapper = $this->getMock('perf\\FileSystem\\FileSystemWrapper');

        $this->remover = RecursiveDirectoryRemover::create($this->fileSystemWrapper);
    }

    /**
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid path provided: expected directory path.
     */
    public function testRemoveWithNonDirectory()
    {
        $path = 'foo';
        
        $this->fileSystemWrapper
            ->expects($this->once())
            ->method('isDirectory')
            ->with($path)
            ->willReturn(false)
        ;

        $this->remover->remove($path);
    }
}
