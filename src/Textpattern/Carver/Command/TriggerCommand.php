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
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Triggers a callback event.
 */

class TriggerCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('txp:trigger')
            ->setDescription('Triggers public-facing callback event')
            ->addArgument('event', InputArgument::REQUIRED, 'The callback event')
            ->addArgument('step', InputArgument::OPTIONAL, 'The callback step');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        new Inject();
        $results = callback_event($input->getArgument('event'), $input->getArgument('step'));
        $output->writeln($results);
    }
}
