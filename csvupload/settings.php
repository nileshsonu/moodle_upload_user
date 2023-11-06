<?php

// This file is part of the paradisomeet plugin for Moodle - http://moodle.org/
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
 * Settings.
 *
 * @package    local_csvupload
 * @copyright  salesforce by RTCLAB Sp. z o.o.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    $settings = new admin_settingpage('local_csvupload', get_string('pluginname', 'local_csvupload'));
    $ADMIN->add('localplugins', $settings);

    $setting = new admin_setting_configcheckbox('local_csvupload/email_sending', get_string('enable_email_desc', 'local_csvupload'), get_string('enable_email_desc', 'local_csvupload'), 0);
    $settings->add($setting);
}
