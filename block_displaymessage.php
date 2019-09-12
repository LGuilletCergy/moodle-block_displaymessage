<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Initially developped for :
 * Université de Cergy-Pontoise
 * 33, boulevard du Port
 * 95011 Cergy-Pontoise cedex
 * FRANCE
 *
 * Create a block to put on front page and display a message.
 *
 * @package   block_displaymessage
 * @copyright 2019 Laurent Guillet <laurent.guillet@u-cergy.fr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * File : block_displaymessage.php
 * Main block file
 */

defined('MOODLE_INTERNAL') || die;

class block_displaymessage extends block_base {

    public function init() {

        $this->title = get_string('displaymessage', 'block_displaymessage');
    }

    public function applicable_formats() {

        return array('my' => true);
    }

    public function get_content() {

        if ($this->content !== null) {

            return $this->content;
        }

        $this->content = new stdClass;

        $this->content->text = get_config('message', 'fullmessage');

        $systemcontext = context_system::instance();

        if (is_siteadmin()) {

            $url = new moodle_url('admin/settings.php?section=blocksettingdisplaymessage');
            $this->content->text .= "<br><a href=$url>".get_string('displaymessage:editmessage', 'block_displaymessage')."</a>";
        }

        $this->content->footer = '';

        return $this->content;
    }

    function has_config() {
        return true;

    }
}