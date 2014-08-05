<?php
/**
 * Admin settings for the Easy Filter Filter
 *
 * @author      Ryan Nutt
 * @link        http://www.nutt.net
 * @package     filter_easyfilter
 * @copyright   Ryan Nutt
 * @license     http://opensource.org/licenses/GPL-3.0 GPLv3
 */


defined('MOODLE_INTERNAL') || die();

$settings = new admin_externalpage('filter_easyfilter',
        get_string('pluginname', 'filter_easyfilter'),
        new moodle_url('/filter/easyfilter/settings_page.php'),
        'moodle/site:config');
 
//$ADMIN->add(null, $settings);