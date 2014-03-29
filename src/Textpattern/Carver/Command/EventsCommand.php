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
            ->setDescription('Lists available callback events');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $plugin_callback;
        new Inject();

        $event = array();

        foreach ($plugin_callback as $callback) {
            if ($callback['step']) {
                $events[] = $callback['event'].' : '.$callback['step'];
            } else {
                $events[] = $callback['event'];
            }
        }

        $output->writeln('<info>Available events [ event : step ] :</info>');
        sort($events);
        $output->writeln(array_unique($events));
    }
}
