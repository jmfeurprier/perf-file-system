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
     * @var FileSystemClient
     */
    private $fileSystemClient;

    /**
     * Static constructor.
     *
     * @return RecursiveDirectoryRemover
     */
    public static function createDefault()
    {
        return new self(FileSystemClient::createDefault());
    }

    /**
     * Static constructor.
     *
     * @param FileSystemClient $fileSystemClient
     * @return RecursiveDirectoryRemover
     */
    public static function create(FileSystemClient $fileSystemClient)
    {
        return new self($fileSystemClient);
    }

    /**
     * Constructor.
     *
     * @param FileSystemClient $fileSystemClient
     */
    private function __construct(FileSystemClient $fileSystemClient)
    {
        $this->fileSystemClient = $fileSystemClient;
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

        if (!$this->fileSystemClient->fileExists($path)) {
            throw new \RuntimeException("Cannot remove directory: path {$path} does not exist.");
        }

        if (!$this->fileSystemClient->isDirectory($path)) {
            throw new \RuntimeException("Cannot remove directory: path {$path} is not a directory.");
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

            if ($this->fileSystemClient->isDirectory($itemPath)) {
                $this->removeDirectory($itemPath);
            } elseif ($this->fileSystemClient->isFile($itemPath) || $this->fileSystemClient->isLink($itemPath)) {
                $this->fileSystemClient->delete($path);
            } else {
                throw new \RuntimeException("Unexpected item type at {$itemPath}.");
            }
        }

        $this->fileSystemClient->removeDirectory($path);
    }
}
