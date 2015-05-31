<?php

namespace perf\FileSystem;

/**
 *
 *
 */
class RecursiveDirectoryRemover
{

    /**
     *
     *
     * @var FileSystemWrapper
     */
    private $fileSystemWrapper;

    /**
     * Static constructor.
     *
     * @return RecursiveDirectoryRemover
     */
    public static function createDefault()
    {
        return new self(new FileSystemWrapper());
    }

    /**
     * Static constructor.
     *
     * @param FileSystemWrapper $wrapper
     * @return RecursiveDirectoryRemover
     */
    public static function create(FileSystemWrapper $wrapper)
    {
        return new self($wrapper);
    }

    /**
     * Constructor.
     *
     * @param FileSystemWrapper $fileSystemWrapper
     * @return void
     */
    private function __construct(FileSystemWrapper $fileSystemWrapper)
    {
        $this->fileSystemWrapper = $fileSystemWrapper;
    }

    /**
     *
     *
     * @param string $path
     * @return void
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function remove($path)
    {
        $path = rtrim($path, '\\/');

        if (!$this->fileSystemWrapper->isDirectory($path)) {
            throw new \InvalidArgumentException('Invalid path provided: expected directory path.');
        }

        $this->removeDirectory($path);
    }

    /**
     *
     *
     * @param string $path
     * @return void
     * @throws \RuntimeException
     */
    private function removeDirectory($path)
    {
        static $excludedItems = array(
            '.',
            '..',
        );

        foreach (scandir($path) as $item) {
            if (in_array($item, $excludedItems, true)) {
                continue;
            }

            $itemPath = "{$path}/{$item}";

            if ($this->fileSystemWrapper->isDirectory($itemPath)) {
                $this->removeDirectory($itemPath);
            } elseif ($this->fileSystemWrapper->isFile($itemPath) || $this->fileSystemWrapper->isLink($itemPath)) {
                $this->deleteFile($itemPath);
            } else {
                throw new \RuntimeException("Unexpected item type at {$itemPath}.");
            }
        }

        if (!$this->fileSystemWrapper->removeDirectory($path)) {
            throw new \RuntimeException("Failed to remove directory at {$path}.");
        }
    }

    /**
     *
     *
     * @param string $path
     * @return void
     * @throws \RuntimeException
     */
    private function deleteFile($path)
    {
        if (!$this->fileSystemWrapper->delete($path)) {
            throw new \RuntimeException("Failed to delete file at {$path}.");
        }
    }
}
