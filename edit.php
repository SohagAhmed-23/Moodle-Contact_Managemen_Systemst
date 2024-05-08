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
 * Edit or Create a record.
 *
 * @package    local_cms
 * @copyright  2024 Sohag Ahmed
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');
require_once('./locallib.php');
require_once($CFG->dirroot.'/local/cms/edit_form.php');


$id = optional_param('id', 0, PARAM_INT);
$PAGE->set_url(new moodle_url('/local/cms/edit.php', array('id' => $id)));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('createoredit', 'local_cms'));

$mform = local_cms_init_form($id);

local_cms_edit_information($mform, $id);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('createoredit', 'local_cms'));

$mform->display();

echo $OUTPUT->footer();