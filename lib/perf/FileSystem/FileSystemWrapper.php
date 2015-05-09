<?php

namespace perf\FileSystem;

/**
 *
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
     * @param string $path
     * @return bool
     */
    public function delete($path)
    {
        return unlink($path);
    }
}
