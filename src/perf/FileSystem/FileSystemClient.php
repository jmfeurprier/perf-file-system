<?php

namespace perf\FileSystem;

/**
 *
 *
 */
class FileSystemClient
{

    /**
     *
     *
     * @var FileSystemWrapper
     */
    private $wrapper;

    /**
     * Static constructor.
     *
     * @return FileSystemClient
     */
    public static function createDefault()
    {
        return new self(new FileSystemWrapper());
    }

    /**
     * Constructor.
     *
     * @param FileSystemWrapper $wrapper
     */
    public function __construct(FileSystemWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function fileExists($path)
    {
        return $this->wrapper->fileExists($path);
    }

    /**
     *
     *
     * @param string $path
     * @return int
     * @throws \RuntimeException
     */
    public function fileSize($path)
    {
        $size = $this->wrapper->fileSize($path);

        if (false === $size) {
            throw new \RuntimeException("Failed to get size of file at '{$path}'.");
        }

        return $size;
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isDirectory($path)
    {
        return $this->wrapper->isDirectory($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isFile($path)
    {
        return $this->wrapper->isFile($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isLink($path)
    {
        return $this->wrapper->isLink($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isReadable($path)
    {
        return $this->wrapper->isReadable($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isWritable($path)
    {
        return $this->wrapper->isWritable($path);
    }

    /**
     *
     *
     * @param string $path
     * @return void
     * @throws \RuntimeException
     */
    public function makeDirectory($path)
    {
        if (!$this->wrapper->makeDirectory($path)) {
            throw new \RuntimeException("Failed to make directory '{$path}'.");
        }
    }

    /**
     *
     *
     * @param string $path
     * @return void
     * @throws \RuntimeException
     */
    public function removeDirectory($path)
    {
        if (!$this->wrapper->removeDirectory($path)) {
            throw new \RuntimeException("Failed to remove directory '{$path}'.");
        }
    }

    /**
     *
     *
     * @param string $path
     * @param int    $mode
     * @return void
     * @throws \RuntimeException
     */
    public function changeMode($path, $mode)
    {
        if (!$this->wrapper->changeMode($path, $mode)) {
            throw new \RuntimeException("Failed to change mode of '{$path}' to '{$mode}'.");
        }
    }

    /**
     *
     *
     * @param string $path
     * @param string $content
     * @param int    $flags
     * @throws \RuntimeException
     */
    public function putContent($path, $content, $flags = 0)
    {
        if (!$this->wrapper->putContent($path, $content, $flags)) {
            throw new \RuntimeException("Failed to put file content at '{$path}'.");
        }
    }

    /**
     *
     *
     * @param string $path
     * @param int    $flags
     * @return string
     * @throws \RuntimeException
     */
    public function getContent($path, $flags = 0)
    {
        $content = $this->wrapper->getContent($path, $flags);

        if (false === $content) {
            throw new \RuntimeException("Failed to get file content at '{$path}'.");
        }

        return $content;
    }

    /**
     *
     *
     * @param string $oldPath
     * @param string $newPath
     * @return void
     * @throws \RuntimeException
     */
    public function rename($oldPath, $newPath)
    {
        if (!$this->wrapper->rename($oldPath, $newPath)) {
            throw new \RuntimeException("Failed to rename file from '{$oldPath}' to '{$newPath}'.");
        }
    }

    /**
     *
     *
     * @param string $sourcePath
     * @param string $destinationPath
     * @return void
     * @throws \RuntimeException
     */
    public function copy($sourcePath, $destinationPath)
    {
        if (!$this->wrapper->copy($sourcePath, $destinationPath)) {
            throw new \RuntimeException("Failed to copy file from '{$sourcePath}' to '{$destinationPath}'.");
        }
    }

    /**
     *
     *
     * @param string $path
     * @return void
     * @throws \RuntimeException
     */
    public function delete($path)
    {
        if (!$this->wrapper->delete($path)) {
            throw new \RuntimeException("Failed to delete file '{$path}'.");
        }
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isUploadedFile($path)
    {
        return $this->wrapper->isUploadedFile($path);
    }

    /**
     *
     *
     * @param string $sourcePath
     * @param string $destinationPath
     * @return void
     * @throws \RuntimeException
     */
    public function moveUploadedFile($sourcePath, $destinationPath)
    {
        if (!$this->wrapper->moveUploadedFile($sourcePath, $destinationPath)) {
            throw new \RuntimeException("Failed to move uploaded file from '{$sourcePath}' to '{$destinationPath}'.");
        }
    }
}
