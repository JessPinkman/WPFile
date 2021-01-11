<?php

namespace WPFile;

class ThemeFile extends AbstractFile
{
    /**
     * Set the file URL
     *
     * @return  self
     */
    protected function setURL(): self
    {
        $this->URL = \get_theme_file_uri($this->relative_path);

        return $this;
    }

    /**
     * Set the file absolute path
     *
     * @return  self
     */
    protected function setPath(): self
    {
        $this->path = \get_theme_file_path($this->relative_path);

        return $this;
    }
}
