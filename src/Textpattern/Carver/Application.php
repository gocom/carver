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

use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * The console application.
 *
 * This class creates a new Carver CLI
 * application.
 *
 * <code>
 * $application = new Textpattern\Carver\Application();
 * $application->run();
 * </code>
 */

class Application extends ConsoleApplication
{
    /**
     * {@inheritdoc}
     */

    public function __construct($name = 'Carver', $version = '0.0.0')
    {
        parent::__construct($name, $version);
    }

    /**
     * {@inheritdoc}
     */

    public function getDefaultCommands()
    {
        return array_merge(parent::getDefaultCommands(), array(
            new Command\EventsCommand(),
            new Command\PrefCommand(),
            new Command\TextpackInstallCommand(),
            new Command\TriggerCommand(),
        ));
    }
}
