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
 * Plugin's library functions.
 *
  * @package    local_cms
  * @copyright  2024 Sohag Ahmed
  * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This function prints all the score from the db table.
 *
 * @return void
 * @throws dml_exception
 */
function local_cms_display_information() {
    global $DB, $OUTPUT;
    $user_information = $DB->get_records('local_cms');
    

    // Data to be passed in the manage template.
    $templatecontext = (object) [
        'texttodisplay' => array_values($user_information),
        'editurl' => new moodle_url('/local/cms/edit.php'),
        'deleteurl' => new moodle_url('/local/cms/delete.php'),
    ];

    echo $OUTPUT->render_from_template('local_cms/manage', $templatecontext);
}

/**
 * This function init the edit_form class and return the object.
 *
 * @param int|null $id
 * @return edit_form
 * @throws dml_exception
 */

function local_cms_init_form(int $id = null): edit_form {
    global $DB;

    $actionurl = new moodle_url('/local/cms/edit.php');

    if ($id) {
        $score = $DB->get_record('local_cms', array('id' => $id));
        $mform = new edit_form($actionurl, $score);
    } else {
        $mform = new edit_form($actionurl);
    }
    return $mform;
}
/**
 * This function create or edit a single record.
 *
 * @param int|null $id
 * @param edit_form $mform
 * @return void
 * @throws moodle_exception
 */

function local_cms_edit_information(edit_form $mform, int $id = null) {
    global $DB;
   

    if ($mform->is_cancelled()) {
     
        redirect(new moodle_url('/local/cms/manage.php'));
    } else if ($fromform = $mform->get_data()) {
        // Handing the form data.
        
        $recordstoinsert = new stdClass();

        $recordstoinsert->name = $fromform->name;
        $recordstoinsert->email = $fromform->email;
        $recordstoinsert->phone = $fromform->phone;
        $recordstoinsert->sex = $fromform->sex;
     

        if ($fromform->id) {
            // Update the record.
            $recordstoinsert->id = $fromform->id;
           
            $DB->update_record('local_cms', $recordstoinsert);
            // Go back to manage page.
            redirect(new moodle_url('/local/cms/manage.php'), get_string('updatethanks', 'local_cms'));

        } else {
            // Insert the record.
            $DB->insert_record('local_cms', $recordstoinsert);
            // Go back to manage page.
            redirect(new moodle_url('/local/cms/manage.php'), get_string('insertthanks', 'local_cms'));
        }
    }
}



/**
 * This function delete a single record.
 *
 * @param int|null $id
 * @return void
 * @throws moodle_exception
 */

 

