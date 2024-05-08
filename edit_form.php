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
 * Edit form class.
 *
 * @package    local_footballscore
 * @copyright  2021 Shadman Ahmed
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class edit_form extends moodleform {

    protected $data;

    /**
     * Constructor.
     */
    public function __construct($actionurl, $data = null) {
        $this->data = $data;
        parent::__construct($actionurl);
    }

    //Add elements to form
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('hidden', 'id', get_string('id', 'local_cms'));
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $this->data->id ?? "");

        $mform->addElement('text', 'name', get_string('name', 'local_cms'));
        $mform->setType('name', PARAM_TEXT);
        $mform->setDefault('name', $this->data->name ?? "");

        $mform->addElement('text', 'email', get_string('email', 'local_cms'));
        $mform->setType('email', PARAM_TEXT);
        $mform->setDefault('email', $this->data->email ?? "");

        $mform->addElement('text', 'phone', get_string('phone', 'local_cms'));
        $mform->setType('phone', PARAM_TEXT);
        $mform->setDefault('phone', $this->data->phone ?? "");

        $mform->addElement('text', 'sex', get_string('sex', 'local_cms'));
        $mform->setType('sex', PARAM_TEXT);
        $mform->setDefault('sex', $this->data->sex ?? "");

        $this->add_action_buttons();
    }
}