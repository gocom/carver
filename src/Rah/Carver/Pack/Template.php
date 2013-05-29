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
 * Packager interface.
 */

interface Rah_Carver_Pack_Template
{
    /**
     * Constructor.
     *
     * @param Rah_Carver_Plugin_Fields $plugin The plugin
     */

    public function __construct(Rah_Carver_Plugin_Fields $plugin);

    /**
     * Returns the plugin package.
     *
     * @return string
     */

    public function __toString();
}