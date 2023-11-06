<?php
defined('MOODLE_INTERNAL') || die();

class local_csvupload_form extends moodleform {
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('filepicker', 'csvfile', 'CSV File', null, array('maxbytes' => 0, 'accepted_types' => '.csv'));
        $mform->setType('csvfile', PARAM_FILE);

        $this->add_action_buttons(false, 'Upload CSV');
    }
}
