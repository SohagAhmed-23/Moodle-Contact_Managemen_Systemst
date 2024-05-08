<?php


require_once(__DIR__.'/../../config.php');
require_once('./locallib.php');


$id = optional_param('id', 0, PARAM_INT);



    global $DB;
    try {
        $DB->delete_records('local_cms', array('id' => $id));
        redirect(new moodle_url('/local/cms/manage.php'), get_string('deletemessage', 'local_cms'));

    } catch (Exception $exception) {
        throw new moodle_exception($exception);
    }

