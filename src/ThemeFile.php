<?php

namespace WPFile;

class ThemeFile
{

    private string $relative_path;
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

    /**
     * Set the file URL
     *
     * @return  self
     */
    private function setURL()
    {
        $this->URL = \get_theme_file_uri($this->relative_path);

        return $this;
    }

    /**
     * Get the version
     */
    public function getVersion()
    {
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
     * Set the file absolute path
     *
     * @return  self
     */
    private function setPath()
    {
        $this->path = \get_theme_file_path($this->relative_path);

        return $this;
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
        return new self($relative_path);
    }
}
