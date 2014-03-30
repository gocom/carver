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

namespace Textpattern\Carver\Command;

use Textpattern\Carver\Textpattern\Inject;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Lists available callback events.
 */

class EventsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('txp:events')
            ->setDescription('Lists available callback events')
            ->setHelp(
<<<EOF
The <info>txp:events</info> command returns a list of triggerable
callback events that have handlers attached to them.
These events can be triggered, and the handlers invoked,
with the <info>txp:trigger</info> command.
EOF
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $plugin_callback;
        new Inject();

        $events = array();

        foreach ($plugin_callback as $event) {
            $events[] = array($event['event'], $event['step']);
        }

        $events = array_unique($events, SORT_REGULAR);

        usort($events, function ($a, $b) {

            if ($a[0] === $b[0]) {
                return strcmp($a[1], $b[1]);
            }

            return strcmp($a[0], $b[0]);
        });

        $table = $this->getHelperSet()->get('table')
            ->setHeaders(array('Event', 'Step'))
            ->setRows($events)
            ->render($output);
    }
}
