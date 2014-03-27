<?php

/*
 * Carver - Textpattern CMS CLI
 * https://github.com/gocom/carver
 *
 * Copyright (C) 2014 Jukka Svahn
 *
 * This file is part of Carver.
 *
 * Carver is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, version 2.
 *
 * Carver is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Carver. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Textpattern\Carver;

use Symfony\Component\Console\Application;

require __DIR__ . '/../../../vendor/autoload.php';

$console = new Application('Carver', '0.0.0');
$console->add(new Command\EventsCommand());
$console->add(new Command\TriggerCommand());
$console->run();
