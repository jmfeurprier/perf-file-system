<?php

namespace perf\FileSystem;

/**
 * Low-level wrapper for file-system functions.
 *
 */
class FileSystemWrapper
{

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function fileExists($path)
    {
        return file_exists($path);
    }

    /**
     *
     *
     * @param string $path
     * @return int|bool
     */
    public function fileSize($path)
    {
        return filesize($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isDirectory($path)
    {
        return is_dir($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isFile($path)
    {
        return is_file($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isLink($path)
    {
        return is_link($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isReadable($path)
    {
        return is_readable($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isWritable($path)
    {
        return is_writable($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function makeDirectory($path)
    {
        return mkdir($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function removeDirectory($path)
    {
        return rmdir($path);
    }

    /**
     *
     *
     * @param string $path
     * @param int $mode
     * @return bool
     */
    public function changeMode($path, $mode)
    {
        return chmod($path, $mode);
    }

    /**
     *
     *
     * @param string $path
     * @param string $content
     * @param int $flags
     * @return bool
     */
    public function putContent($path, $content, $flags = 0)
    {
        return file_put_contents($path, $content, $flags);
    }

    /**
     *
     *
     * @param string $path
     * @param int $flags
     * @return bool|string
     */
    public function getContent($path, $flags = 0)
    {
        return file_get_contents($path, $flags);
    }

    /**
     *
     *
     * @param string $pathOld
     * @param string $pathNew
     * @return bool
     */
    public function rename($pathOld, $pathNew)
    {
        return rename($pathOld, $pathNew);
    }

    /**
     *
     *
     * @param string $pathSource
     * @param string $pathDestination
     * @return bool
     */
    public function copy($pathSource, $pathDestination)
    {
        return copy($pathSource, $pathDestination);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function delete($path)
    {
        return unlink($path);
    }

    /**
     *
     *
     * @param string $path
     * @return bool
     */
    public function isUploadedFile($path)
    {
        return is_uploaded_file($path);
    }

    /**
     *
     *
     * @param string $sourcePath
     * @param string $destinationPath
     * @return bool
     */
    public function moveUploadedFile($sourcePath, $destinationPath)
    {
        return move_uploaded_file($sourcePath, $destinationPath);
    }
}
