<?php

namespace WPFile;

abstract class AbstractFile
{

    protected string $relative_path;

    public string $path;
    public ?string $URL = null;
    public ?string $version = null;

    public function __construct(string $relative_path)
    {
        $this->relative_path =  ltrim($relative_path, '/\\');
        $this->setPath();
        $this->setURL();
    }


    /**
     * Get the file URL
     *
     * @return string $url
     */
    public function getURL()
    {
        return $this->URL;
    }

    abstract protected function setURL(): self;
    abstract protected function setPath(): self;
    

        /**
     * Get the version
     */
    public function getVersion()
    {
        if (!$this->version) {
            $this->setVersion();
        }
        return $this->version;
    }

        /**
     * Set the file version
     *
     * @param string $version if null, automatically set based on file modification
     *
     * @return  self
     */
    public function setVersion(string $version = null)
    {
        $this->version = $version ?? \filemtime($this->path);

        return $this;
    }

        /**
     * Get the file absolute path
     */
    public function getPath()
    {
        return $this->path;
    }


    /**
     * Create and return new instance
     *
     * @param string $relative_path relative path of the file
     *
     * @return self
     */
    public static function newFile(string $relative_path): self
    {
        return new static($relative_path);
    }
}
