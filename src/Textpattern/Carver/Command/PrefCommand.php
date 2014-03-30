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
 * Sets or gets a preference string.
 */

class PrefCommand extends Command
{
    protected function configure()
    {
        //class_exists('\Textpattern\Carver\Command\Command');

        $this
            ->setName('txp:pref')
            ->setDescription('Sets or gets a preference value')
            ->addArgument('name', InputArgument::REQUIRED, 'The name')
            ->addArgument('value', InputArgument::OPTIONAL, 'The value')
            ->setHelp(
<<<EOF
The <info>txp:pref</info> command accesses Textpattern preference
strings stored in the database. It can be used to read strings:

<info>carver txp:pref sitename</info>

And to update:

<info>carver txp:pref sitename "My site"
EOF
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        new Inject();

        if ($input->getArgument('value') === null) {
            $output->writeln(get_pref($input->getArgument('name')));
        } else {
            if (safe_update(
                'txp_prefs',
                "val = '".doSlash($input->getArgument('value'))."'",
                "name = '".doSlash($input->getArgument('name'))."' and user_name = ''"
            ) !== false) {
                $output->writeln('Preference <info>'.$input->getArgument('name').'</info> updated.');
            }
        }
    }
}
