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
 * Available plugin fields.
 *
 * All fields and plugin source should be
 * encoded in UTF-8, no BOM.
 */

class Rah_Carver_Plugin_Fields
{
    /**
     * The plugin name.
     *
     * A valid plugin name follows the pattern {pfx}_{pluginName}.
     *
     * The name should start with your reserved three-letter plugin
     * author prefix, followed by an underscore and up to 64
     * lowercase ASCII letters, numbers and underscores.
     *
     * @var string
     */

    public $name;

    /**
     * The version number.
     *
     * The specified version number should
     * follow semantic version formatting.
     *
     * @var  string
     * @link http://semver.org
     */

    public $version = '0.1.0';

    /**
     * The author name.
     *
     * Comma-separated list of authors. Up to
     * 128 characters.
     *
     * @var string
     */

    public $author;

    /**
     * The author or project homepage.
     *
     * A valid URL, up to 128 characters long.
     *
     * @var string
     */

    public $author_uri;

    /**
     * Description.
     *
     * A short single line description about the
     * plugin. Try to keep it precise and short.
     * Less than 80 characters recommended.
     *
     * @var string
     */

    public $description;

    /**
     * The plugin type.
     *
     * Specifies where and how the plugin
     * is initialized.
     *
     * @var int
     */

    public $type = 0;

    /**
     * The plugin load order.
     *
     * An integer from 1 to 9. Unless you have
     * specific reason to change this, keep it
     * at the default five.
     *
     * @var int
     */

    public $order = 5;

    /**
     * The plugin help.
     *
     * Bundled documentation that comes with the
     * plugin. Uses Textile formatting. Up to 64k
     * characters.
     *
     * @var string
     */

    public $help_raw = '';

    /**
     * The plugin source code.
     *
     * Up to 16 MB in size.
     *
     * @var string
     */

    public $code = '';

    /**
     * MD5 checksum for the plugin source code.
     *
     * Calculated from the source code, and
     * is used to verify whether the plugin
     * code is modified, and if it was installed
     * properly.
     *
     * @var string
     */

    public $md5;

    /**
     * The plugin flags.
     *
     * Is used to register the plugin
     * to plugin-lifecycle events and
     * other callbacks without evaluating
     * the plugin.
     *
     * @var int
     */

    public $flags = 0;

    /**
     * Localization strings.
     *
     * @var string
     */

    public $textpack = '';

    /**
     * Legacy raw help documentation.
     *
     * Use Textile formatting instead.
     *
     * @var string
     * @deprecated
     */

    public $help = '';

    /**
     * Enables legacy raw help documentation.
     *
     * Use Textile formatting instead.
     *
     * @var bool
     * @deprecated
     */

    public $allow_html_help = false;
}