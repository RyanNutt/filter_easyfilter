<?php
/**
 * @license http://opensource.org/licenses/GPL-3.0 GPLv3
 */

require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

require_login();
$context = context_system::instance();
require_capability('moodle/site:config', $context);

// Save data, if submitted
$data = data_submitted();

if ($data && confirm_sesskey() && $data->easy_submit == get_string('update_settings', 'filter_easyfilter')) {
    $out = array();
    if (isset($data->ez_tag)) {
        for ($i=0; $i<count($data->ez_tag); ++$i) {
            if (!empty($data->ez_tag[$i])) {
                $out[] = array(
                    'tag' => $data->ez_tag[$i],
                    'before' => $data->ez_before[$i],
                    'after' => $data->ez_after[$i]
                );
            }
        }
    }
    set_config('filter_list', serialize($out), 'filter_easyfilter'); 
}

/* Get the tag list out of the database. Yes, we might have just saved it. But
 * that checks that we have the most current version.
 */
$tags = get_config('filter_easyfilter', 'filter_list');
if ($tags) {
    $tags = unserialize($tags);
}
 
admin_externalpage_setup('filter_easyfilter');
$PAGE->requires->js('/filter/easyfilter/js/easyfilter.js'); 
$PAGE->requires->jquery();
// Header.
echo $OUTPUT->header();
//echo $OUTPUT->heading_with_help(get_string('settings_header', 'filter_easyfilter'),
//        'easy_filter_help', 'help_text');
echo $OUTPUT->heading(get_string('settings_header', 'filter_easyfilter'), 2); //, 'helptitle', 'uniqueid');


?>
<form action='' method='POST'>
    
    <div class="ez_fields" id="easy_tags" style="<?php echo ($tags) ? '' : 'display:none;'; ?>">
        <h5><?php echo get_string('existing_tags', 'filter_easyfilter'); ?></h5>
        <div class="ez_tag">
            <?php echo get_string('tag', 'filter_easyfilter'); ?>
        </div>
        <div class="ez_before">
            <?php echo get_string('before', 'filter_easyfilter'); ?>
        </div>
        <div class="ez_after">
            <?php echo get_string('after', 'filter_easyfilter'); ?>
        </div>
        <div id="easy_tag_list">
            <?php
            if ($tags) {
                foreach ($tags as $tag) {
                    ?>
                    <div class="ez_tag">
                        <input type="text" name="ez_tag[]" value="<?php echo htmlspecialchars($tag['tag']); ?>">
                    </div>
                    <div class="ez_before">
                        <input type="text" name="ez_before[]" value="<?php echo htmlspecialchars($tag['before']); ?>">
                    </div>
                    <div class="ez_after">
                        <input type="text" name="ez_after[]" value="<?php echo htmlspecialchars($tag['after']); ?>">
                    </div>
                    <br style="clear:both;">
                <?php
                }
                
            }
            ?>
        </div>
    </div>
    <br style="clear:both;">
    <div class="ez_add ez_fields">
        <h5><?php echo get_string('add_tag', 'filter_easyfilter'); ?></h5>
        <div class="row">
            <label><?php echo get_string('tag_name', 'filter_easyfilter'); ?></label>
            <input type="text" name="easy_add_tag" id="easy_add_tag">
        </div>
        <div class="row">
            <label><?php echo get_string('before', 'filter_easyfilter'); ?></label>
            <input type="text" name="easy_add_before" id="easy_add_before">
        </div>
        <div class="row">
            <label><?php echo get_string('after', 'filter_easyfilter'); ?></label>
            <input type="text" name="easy_add_after" id="easy_add_after">
        </div>
        <div class="row">
            <label>&nbsp;</label>
            <input type="button" name="easy_add_button" id="easy_add_button" value="<?php echo get_string('add', 'filter_easyfilter'); ?>">
        </div>
    </div>

    <div class="form-buttons">
        <input type="submit" value="<?php echo get_string('update_settings', 'filter_easyfilter'); ?>" class="form-submit" name="easy_submit">
        <input type="submit" value="<?php echo get_string('cancel_settings', 'filter_easyfilter'); ?>" name="easy_submit">
    </div>
    <?php echo html_writer::input_hidden_params($PAGE->url); ?>
    <input type="hidden" name="sesskey" value="<?php echo sesskey(); ?>">
</form>
<script type="text/javascript">
    jQuery(document).ready(function() {
        easyFilter.lang.emptyTag = '<?php echo get_string('empty_tag', 'filter_easyfilter'); ?>'; 
        
        easyFilter.loadSettingsPage();
    }); 
</script>
<?php

// Footer.
echo $OUTPUT->footer();