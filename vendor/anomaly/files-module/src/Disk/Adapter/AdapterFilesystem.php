<?php namespace Anomaly\FilesModule\Disk\Adapter;

use Anomaly\FilesModule\Disk\Adapter\Command\DeleteFile;
use Anomaly\FilesModule\Disk\Adapter\Command\DeleteFolder;
use Anomaly\FilesModule\Disk\Adapter\Command\RenameFile;
use Anomaly\FilesModule\Disk\Adapter\Command\SyncFile;
use Anomaly\FilesModule\Disk\Adapter\Command\SyncFolder;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use InvalidArgumentException;
use League\Flysystem\AdapterInterface;
use League\Flysystem\FileExistsException;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\RootViolationException;

/**
 * Class AdapterFilesystem
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AdapterFilesystem extends Filesystem implements FilesystemInterface
{

    use DispatchesJobs;

    /**
     * The base URL.
     *
     * @var null|string
     */
    protected $baseUrl = null;

    /**
     * The disk interface.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * Create a new AdapterFilesystem instance.
     *
     * @param DiskInterface $disk
     * @param AdapterInterface $adapter
     * @param null $config
     */
    public function __construct(DiskInterface $disk, AdapterInterface $adapter, $config = null)
    {
        $this->disk = $disk;

        $this->baseUrl = array_get($config, 'base_url');

        parent::__construct($adapter, $config);
    }

    /**
     * Write a new file.
     *
     * @param string $path     The path of the new file.
     * @param string $contents The file contents.
     * @param array $config    An optional configuration array.
     *
     * @throws FileExistsException
     *
     * @return bool True on success, false on failure.
     */
    public function write($path, $contents, array $config = [])
    {
        $result = parent::write($path, $contents, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource));
        }

        return $result;
    }

    /**
     * Write a new file using a stream.
     *
     * @param string $path       The path of the new file.
     * @param resource $resource The file handle.
     * @param array $config      An optional configuration array.
     *
     * @throws InvalidArgumentException If $resource is not a file handle.
     * @throws FileExistsException
     *
     * @return bool True on success, false on failure.
     */
    public function writeStream($path, $resource, array $config = [])
    {
        $result = parent::writeStream($path, $resource, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource));
        }

        return $result;
    }

    /**
     * Update an existing file.
     *
     * @param string $path     The path of the existing file.
     * @param string $contents The file contents.
     * @param array $config    An optional configuration array.
     *
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function update($path, $contents, array $config = [])
    {
        $result = parent::update($path, $contents, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource));
        }

        return $result;
    }

    /**
     * Update an existing file using a stream.
     *
     * @param string $path       The path of the existing file.
     * @param resource $resource The file handle.
     * @param array $config      An optional configuration array.
     *
     * @throws InvalidArgumentException If $resource is not a file handle.
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function updateStream($path, $resource, array $config = [])
    {
        $result = parent::updateStream($path, $resource, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource));
        }

        return $result;
    }

    /**
     * @param  string $path     path to file
     * @param  string $contents file contents
     * @param  mixed $config
     * @throws FileExistsException
     * @return bool
     */
    public function put($path, $contents, array $config = [])
    {
        $result = parent::put($path, $contents, $config);

        $sync = array_get($config, 'sync', true);

        if ($result && $sync !== false && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource));
        }

        return $result;
    }

    /**
     * @param  string $path     path to file
     * @param  string $contents file contents
     * @param  mixed $config
     * @throws FileExistsException
     * @return bool
     */
    public function putStream($path, $resource, array $config = [])
    {
        $result = parent::putStream($path, $resource, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource));
        }

        return $result;
    }

    /**
     * Copy a file.
     *
     * @param string $path    Path to the existing file.
     * @param string $newpath The new path of the file.
     *
     * @throws FileExistsException   Thrown if $newpath exists.
     * @throws FileNotFoundException Thrown if $path does not exist.
     *
     * @return bool True on success, false on failure.
     */
    public function copy($path, $newpath)
    {
        $result = parent::copy($path, $newpath);

        if ($result && $resource = $this->get($newpath)) {
            return $this->dispatch(
                new SyncFile($resource)
            );
        }

        return $result;
    }

    /**
     * Rename a file.
     *
     * @return bool
     */
    public function rename($from, $to)
    {
        $result = parent::rename($from, $to);

        if ($result && $resource = $this->get($to)) {
            return $this->dispatch(
                new RenameFile($resource, $from)
            );
        }

        return $result;
    }

    /**
     * Delete a file.
     *
     * @param string $path
     *
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function delete($path)
    {
        $resource = $resource = $this->get($path);

        $result = parent::delete($path);

        if ($result && $resource) {
            return $this->dispatch(new DeleteFile($resource));
        }

        return $result;
    }

    /**
     * Delete a directory.
     *
     * @param string $dirname
     *
     * @throws RootViolationException Thrown if $dirname is empty.
     *
     * @return bool True on success, false on failure.
     */
    public function deleteDir($dirname)
    {
        $result = parent::deleteDir($dirname);

        if ($result && $this->has($dirname)) {
            return $this->dispatch(new DeleteFolder($this->get($dirname)));
        }

        return $result;
    }

    /**
     * Create a directory.
     *
     * @param string $dirname The name of the new directory.
     * @param array $config   An optional configuration array.
     *
     * @return bool True on success, false on failure.
     */
    public function createDir($dirname, array $config = [])
    {
        $result = parent::createDir($dirname, $config);

        if ($result && $resource = $this->get($dirname)) {
            return $this->dispatch(new SyncFolder($resource));
        }

        return $result;
    }

    /**
     * Return the real path to a file.
     *
     * @param $path
     * @return string
     */
    public function url($path)
    {
        return rtrim($this->baseUrl, '/') . '/' . $path;
    }

    /**
     * Get the base URL.
     *
     * @return mixed|null|string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set the base URL.
     *
     * @param $baseUrl
     * @return $this
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Get the disk.
     *
     * @return DiskInterface
     */
    public function getDisk()
    {
        return $this->disk;
    }
}
