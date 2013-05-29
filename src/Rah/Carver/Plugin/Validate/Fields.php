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
 * Validates plugin fields.
 */

class Rah_Carver_Plugin_Validate_Fields
{
    /**
     * The plugin.
     *
     * @var Rah_Carver_Plugin_Fields
     */

    protected $plugin;

    /**
     * Constructor.
     *
     * @param Rah_Carver_Plugin_Fields $plugin The plugin
     */

    public function __construct(Rah_Carver_Plugin_Fields $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Validates the plugin name.
     *
     * @return bool
     * @throws Rah_Carver_Plugin_Validate_Exception
     */

    public function isValidName()
    {
        if (preg_match('/^[a-z0-9]{3}_[a-z0-9\_]{0,64}$/i', (string) $this->plugin->name))
        {
            return true;
        }

        throw new Rah_Carver_Plugin_Validate_Exception('Invalid plugin name.');
    }

    /**
     * Validates the version number.
     *
     * @return bool
     * @throws Rah_Carver_Plugin_Validate_Exception
     */

    public function isValidVersion()
    {
        if (preg_match('/^[0-9]+\.[0-9]+\.[0-9]+$/', (string) $this->plugin->version))
        {
            return true;
        }

        throw new Rah_Carver_Plugin_Validate_Exception('Invalid plugin version.');
    }

    /**
     * Validates the plugin type.
     *
     * @return bool
     * @throws Rah_Carver_Plugin_Validate_Exception
     */

    public function isValidType()
    {
        if (in_array($this->plugin->type, range(1, 5, 1), true))
        {
            return true;
        }

        throw new Rah_Carver_Plugin_Validate_Exception('Invalid plugin type.');
    }

    /**
     * Validates the plugin load order.
     *
     * @return bool
     * @throws Rah_Carver_Plugin_Validate_Exception
     */

    public function isValidOrder()
    {
        if (in_array($this->plugin->order, range(1, 9, 1), true))
        {
            return true;
        }

        throw new Rah_Carver_Plugin_Validate_Exception('Invalid plugin order.');
    }

    /**
     * Validates the plugin code.
     *
     * @return bool
     * @throws Rah_Carver_Plugin_Validate_Exception
     */

    public function isValidCode()
    {
        if (trim($this->plugin->code) === '')
        {
            throw new Rah_Carver_Plugin_Validate_Exception('Plugin code can not be empty.');
        }

        return true;
    }

    /**
     * Validates the MD5 checksum.
     *
     * @return bool
     * @throws Rah_Carver_Plugin_Validate_Exception
     */

    public function isValidChecksum()
    {
        if (md5($this->plugin->code) !== $this->plugin->md5)
        {
            throw new Rah_Carver_Plugin_Validate_Exception('The plugin checksum does not validate.');
        }

        return true;
    }

    /**
     * Validates the plugin flags.
     *
     * @return bool
     * @throws Rah_Carver_Plugin_Validate_Exception
     */

    public function isValidFlags()
    {
        if (!is_int($this->plugin->flags))
        {
            throw new Rah_Carver_Plugin_Validate_Exception('The plugin flags needs to be an integer.');
        }

        return true;
    }

    /**
     * Undefined validators.
     *
     * @return bool
     */

    public function __call()
    {
        return true;
    }
}