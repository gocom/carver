<?php

/*
 * Carver - Textpattern CMS plugin compiler
 * https://github.com/gocom/carver
 *
 * Copyright (C) 2013 Jukka Svahn
 *
 * This file is part of Carver.
 *
 * Carver is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, version 2.
 *
 * Carver is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Carver. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Builds virtual mapped file system collection.
 *
 * Reads designed files and builds a filesystem map
 * from it.
 */

class Rah_Carver_Build_Source_VirtualMap
{
    /**
     * Mapped files.
     *
     * @var DirectoryIterator
     */

    protected $files;

    /**
     * Constructor.
     *
     * @param DirectoryIterator $files
     */

    public function __construct(RecursiveDirectoryIterator $files)
    {
        $this->files = $files;
    }

    /**
     * Builds an string presentation of JSON map listing the files.
     *
     * @return string
     */

    protected function build()
    {
        $out = array();

        while ($this->files->valid())
        {
            if ($this->files->isFile() && $this->files->isReadable())
            {
                $out[$this->files->getSubPathname()] = file_get_contents($this->files->getPathname());
            }

            $this->files->next();
        }

        $map = json_encode($out);
        $md5 = md5($map);

        $source <<<EOF
/**
 * Generated plugin closure.
 */

class Rah_Carver_Autoload_Map_{$md5}
{
    /**
     * Files as in JSON representation.
     *
     * @var string
     */

    protected \$map = '{$map}';

    /**
     * Extracted files.
     *
     * @var array
     */

    protected \$files;

    /**
     * Constructor.
     */

    public function __construct()
    {
        \$this->files = json_decode(\$this->map, true);
        spl_autoload_register(array(\$this, 'autoload'));
    }

    /**
     * Autoloads a file from the stack.
     *
     * @param string \$class The class
     */

    public function autoload(\$class)
    {
        \$file = ltrim(str_replace(array('_', '\\\\'), '/', \$class), '/').'.php';

        if (isset(\$this->files[\$file]))
        {
            eval(\$this->files[\$file]);
            unset(\$this->files[\$file]);
        }
    }
}

new Rah_Carver_Autoload_Map_{$md5}();

EOF;
    }

    /**
     * Gets the plugin package.
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->build();
    }
}