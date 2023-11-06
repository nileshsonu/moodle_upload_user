<?php
require_once(dirname(__FILE__) . '/../../config.php');
require_login();
global $USER,$DB, $SESSION;
$context = context_system::instance();

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');

$title = get_string('title', 'local_csvupload');
$PAGE->set_title($title);
$PAGE->set_heading($title);

echo $OUTPUT->header();

$checkboxsetting = get_config('local_csvupload', 'email_sending');

if(!is_siteadmin()){
    if (!has_capability('local/csvupload:uploadcsv', context_system::instance())) {
        print_error('You do not have permission to upload CSV files.');
    }
}

$form = new local_csvupload_form(null, ['param1' => $value1, 'param2' => $value2]);

if ($form->is_cancelled()) {
    
} else if ($data = $form->get_data()) {
        $file = $form->get_file_content('csvfile');
        if ($file) {
            $lines = explode("\n", $file);
            $flag = true;
            $users = array();
            foreach ($lines as $line) {
                if($flag) { $flag = false; continue; } // code added to skip header
                $csv_fields = str_getcsv($line);

                $datanew1 = new stdClass();
                $datanew1->firstname = $csv_fields[1];
                $datanew1->lastname = $csv_fields[2];
                $datanew1->email = $csv_fields[3];

                // send test email to user
                $email = $csv_fields[3];
                $from_email = $CFG->noreplyaddress;
                $subject= get_string('email_subject', 'local_csvupload');
                $message = get_string('email_message', 'local_csvupload');
                //if(email_to_user($email, $from_email, $subject, $message, text_to_html($message))){
                    $datanew = new stdClass();
                    $datanew->firstname = $csv_fields[1];
                    $datanew->lastname = $csv_fields[2];
                    $datanew->email = $csv_fields[3];
                    $datanew->email_sent_date = time();
                    $DB->insert_record('csvupload', $datanew);
                //}
                $users['userdata'][]=$datanew1;
            }

            echo $OUTPUT->render_from_template('local_csvupload/userinfo', $users);
        } else {
            // else condition here
        }
} else {
    $form->display();
}

echo $OUTPUT->footer();
