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
 * Reads an processes the specified manifest file.
 */

class Rah_Carver_Project_Manifest
{
    /**
     * The project directory.
     *
     * @var string
     */

    protected $directory;

    /**
     * Manifest file.
     *
     * @var stdClass
     */

    protected $manifest;

    /**
     * Constructor.
     *
     * @param string $directory The project directory
     */

    public function __construct($directory)
    {
        if (!file_exists($directory) || !is_readable($directory) || !is_dir($directory))
        {
            throw new Exception('Invalid project directory: '.$directory);
        }

        if (($cwd = getcwd()) === false || chdir($directory) === false)
        {
            throw new Exception('Unable to change directory to: '.$directory)
        }

        $this->directory = $directory;
        chdir($cwd);
    }

    /**
     * Converts JSON manifest to plugin object.
     *
     * @param  string $json JSON representation as a string
     * @return Rah_Carver_Plugin_Fields
     */

    public function manifestToPlugin($json)
    {
        $plugin = new Rah_Carver_Plugin_Fields();

        if ($this->manifest)
        {
            foreach ($this->manifest as $key => $value)
            {
                if (isset($plugin->$key))
                {
                    $plugin->$key = $value;
                }
            }
        }

        return $plugin;
    }

    /**
     * Gets the manifest file contents.
     *
     * @return Rah_Carver_Plugin_Fields
     */

    public function getManifest()
    {
        if (!file_exists('manifest.json') || !is_file('manifest.json') || !is_readable('manifest.json'))
        {
            throw new Exception('Manifest.json can not be read.');
        }

        if ($json = file_get_contents('manifest.json'))
        {
            $this->manifest = @json_decode($json);
            $plugin = $this->manifestToPlugin($json);
            $validator = new Rah_Carver_Plugin_Validate_Fields($plugin);
            $validator->isValidName();
            $validator->isValidVersion();
            $validator->isValidType();
            $validator->isValidOrder();
            $validator->isValidFlags();
            return $plugin;
        }

        throw new Exception('Unable to get the plugin project.');
    }

    /**
     * Plugin code template.
     *
     * Generates PHP source code that either imports
     * the first .php file in the directory or the files
     * specified with the 'file' property of 'code'.
     *
     * @return string
     */

    protected function code()
    {
        $files = $out = array();

        if (isset($this->manifest->code->file))
        {
            foreach ((array) $this->manifest->code->file as $path)
            {
            }
        }
        else
        {
            $files = (array) glob('*.php');
        }

        foreach ($files as $path)
        {
            if (file_exists($path) && is_file($path) && is_readable($path) && $contents = file_get_contents($path))
            {
                $out[] = trim(preg_replace('/^<\?(php)?|\?>$/', '', $contents), "\r\n");
            }
        }

        return implode("\n", $out);
    }

    /**
     * Gets Textpacks.
     *
     * @return string
     */

    protected function textpack()
    {
        if (!file_exists('textpacks') || !is_dir('textpacks') || !is_readable('textpacks'))
        {
            return '';
        }

        $out = array();

        foreach ((array) glob('textpacks/*.textpack', GLOB_NOSORT) as $file)
        {
            if (!is_file($file) || !is_readable($file))
            {
                continue;
            }

            $file = file_get_contents($file);

            if (!preg_match('/^#@language|\n#@language\s/', $file))
            {
                array_unshift($out, $file);
                continue;
            }

            $out[] =  $file;
        }

        return implode("\n", $out);
    }

    /**
     * Gets help files.
     *
     * @return string
     */

    protected function help()
    {
        $out = array();

        if (isset($this->manifest->help->file))
        {
            foreach ((array) $this->manifest->help->file as $path)
            {
                if (file_exists($path) && is_file($path) && is_readable($path))
                {
                    $out[] = file_get_contents($path);
                }
            }
        }
        else if (isset($this->manifest->help))
        {
            $out[] = (string) $this->manifest->help;
        }

        return implode("\n\n", $out);
    }
}