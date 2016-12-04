<?php

namespace perf\FileSystem;

/**
 *
 *
 */
class RecursiveDirectoryMaker
{

    /**
     *
     *
     * @var FileSystemClient
     */
    private $fileSystemClient;

    /**
     * @var string
     */
    private $directorySeparator;

    /**
     * Static constructor.
     *
     * @return RecursiveDirectoryMaker
     */
    public static function createDefault()
    {
        return new self(
            FileSystemClient::createDefault(),
            DIRECTORY_SEPARATOR
        );
    }

    /**
     * Static constructor.
     *
     * @param FileSystemClient $fileSystemClient
     * @param string           $directorySeparator
     * @return RecursiveDirectoryMaker
     */
    public static function create(
        FileSystemClient $fileSystemClient,
        $directorySeparator = DIRECTORY_SEPARATOR
    ) {
        return new self($fileSystemClient, $directorySeparator);
    }

    /**
     * Constructor.
     *
     * @param FileSystemClient $fileSystemClient
     * @param string           $directorySeparator
     */
    private function __construct(
        FileSystemClient $fileSystemClient,
        $directorySeparator
    ) {
        $this->fileSystemClient   = $fileSystemClient;
        $this->directorySeparator = $directorySeparator;
    }

    /**
     *
     *
     * @param string $directoryPath
     * @param int    $mode
     * @return void
     * @throws \RuntimeException
     */
    public function make($directoryPath, $mode)
    {
        $directoryPath  = trim($directoryPath, $this->directorySeparator);
        $directoryNodes = explode($this->directorySeparator, $directoryPath);
        $currentPath    = '';

        foreach ($directoryNodes as $directoryNode) {
            $currentPath .= $this->directorySeparator . $directoryNode;

            if ($this->fileSystemClient->fileExists($currentPath)) {
                if (!$this->fileSystemClient->isDirectory($currentPath)) {
                    throw new \RuntimeException("Cannot make directory: path {$currentPath} is obstructed.");
                }
            } else {
                $this->fileSystemClient->makeDirectory($currentPath);
                $this->fileSystemClient->changeMode($currentPath, $mode);
            }
        }
    }
}
