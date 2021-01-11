<?php

namespace WPFile;

use Error;

class PluginFile extends AbstractFile
{

    private static string $basePath;
    private static string $baseURL;

    public function __construct(string $relative_path)
    {
        if (!self::$baseURL || !self::$basePath) {
            throw new Error('PluginFile Root not defined');
        }
        parent::__construct($relative_path);
    }

    /**
     * Set the file URL
     *
     * @return  self
     */
    protected function setURL(): self
    {
        $this->URL = \plugins_url($this->relative_path, self::$baseURL);

        return $this;
    }

    /**
     * Set the file absolute path
     *
     * @return  self
     */
    protected function setPath(): self
    {
        $this->path = self::$basePath . $this->relative_path;

        return $this;
    }

    /**
     * Set the root path used for all subsequent instances
     *
     * @return  self
     */
    public static function setRoot($root)
    {
        self::$baseURL = $root;
        self::$basePath = dirname($root) . \DIRECTORY_SEPARATOR;
    }
}
