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

namespace Textpattern\Carver\Textpattern;

/**
 * Events bridge.
 */

class Events
{
    /**
     * Event name validator pattern.
     *
     * This regular expression is responsible
     * for filtering events from those that are
     * triggable.
     *
     * @var string
     */

    protected $eventNamePattern = '/^[a-z][a-z0-9]{2}_[a-z0-9_\-]+\.[a-z0-9]+$/i';

    /**
     * Gets applicabable events.
     */

    public function getEvents()
    {
        $events = array();

        foreach ($this->getRawEvents() as $event) {
            if ($this->isValidEventArray($event)) {
                $events[$event['event']] = $event['event'];
            } else {
                unset($events[$event['event']]);
            }
        }

        $events = array_unique($events);
        sort($events);
        return $events;
    }

    /**
     * Whether the event name is valid.
     *
     * @return bool TRUE if valid, FALSE otherwise
     */

    public function isValidEvent($event)
    {
        return (bool) preg_match($this->eventNamePattern, (string) $event);
    }

    /**
     * Whether the event is valid.
     *
     * @param  array $event Event array
     * @return bool TRUE if valid, FALSE otherwise
     */

    private function isValidEventArray(array $event)
    {
        return empty($event['step']) && $this->isValidEvent($event['event']);
    }

    /**
     * Gets raw list of events.
     *
     * @return array
     */

    private function getRawEvents()
    {
        new Inject();
        global $plugin_callback;
        return (array) $plugin_callback;
    }
}
