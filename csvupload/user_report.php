<?php
require(__DIR__ . '/../../config.php');
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/csvupload/user_report.php');
$title = get_string('report_title', 'local_csvupload');
$PAGE->set_heading($title);
$PAGE->set_pagelayout('standard');
echo $OUTPUT->header();
global $CFG, $DB, $PAGE, $USER;
if(!is_siteadmin()){
      print_error('You do not have permission to access this page.');
}
$sql1 = $DB->get_records_sql("select * from {csvupload}");
$results_per_page = 10;
$number_of_result = count($sql1);
$number_of_page = ceil($number_of_result / $results_per_page);
if (!isset($_GET['page'])) {
  $page = 0;
} else {
  $page = $_GET['page'];
}
$page_first_result = $page * $results_per_page;
$sql2 = $DB->get_records_sql("select * from {csvupload} LIMIT $page_first_result,$results_per_page");

echo "<div class='' style='overflow-x:auto;'><center><h5 class='textbold'>Email Report</h5></center>";
$formoutput .= html_writer::start_tag('div', array("class" => "row"));
echo html_writer::end_tag('div');
echo html_writer::table(get_table($sql2));
echo "</div>";
echo $OUTPUT->paging_bar($number_of_result, $page, $results_per_page, $PAGE->url);
function get_table($sql1) {
  $table = new html_table();
  $head = array('First Name', 'Last Name', 'Email', 'Date');
  $table->head = $head;
  foreach ($sql1 as $s) {
    $date = date('Y-m-d', $s->email_sent_date);
    $data = array($s->firstname, $s->lastname, $s->email, $date);
    $table->data[] = $data;
  }
  return $table;
}
echo $OUTPUT->footer();
