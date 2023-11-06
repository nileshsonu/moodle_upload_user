<?php
defined('MOODLE_INTERNAL') || die(); 
/**
 * 
 * 
 */
function xmldb_local_csvupload_upgrade( $oldversion = 0 ){
    global $DB, $CFG;
    $dbman = $DB->get_manager();
    if ($oldversion < 2023110401) {
       upgrade_plugin_savepoint(true, 2023110401, 'local', 'csvupload');
    }

}