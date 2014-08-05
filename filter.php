<?php
/**
 * Filter script for the Easy Filter Moodle plugin
 * 
 * @license http://opensource.org/licenses/GPL-3.0 GPLv3
 */

class filter_easyfilter extends moodle_text_filter {
    
    /**
     * Contains the tags that may need to be parsed by
     * the filter. 
     * 
     * @var mixed
     */
    private static $tags = false; 
    
    public function __construct() {
        /* Already been loaded into the static, don't do it again */
        if (false !== self::$tags) {
            return; 
        }
        
        $tags = get_config('filter_easyfilter', 'filter_list');
        if ($tags) {
            self::$tags = unserialize($tags);
        }
        else {
            self::$tags = array(); 
        } 
    }
    
    public function filter($text, array $options = array()) {
        
        // No tags defined, don't bother going any farther 
        if (empty(self::$tags)) {
            return $text; 
        }
        
        // Not using any tags, don't need to do anything except kick it back out 
        if (!preg_match('/' . $this->regexSearchString() . '/', $text)) {
            return $text; 
        }
        
        // Need to filter
        foreach (self::$tags as $tag) {
            $text = preg_replace(
                    '/\[' . $tag['tag'] . '\](.*?)\[\/' . $tag['tag'] . '\]/', 
                    $tag['before'] . '$1' . $tag['after'], 
                    $text
                    );
        }
        return $text; 
    }
    
    
    /**
     * Returns a string usable for regex searching to find opening
     * shortcodes that match any of the user tags. 
     * 
     * @return String
     */
    private function regexSearchString() {
        $out = false; 
        if (false !== self::$tags) {
            $ray = array();
            foreach (self::$tags as $tag) {
                $ray[] = $tag['tag'];
            }
            if (!empty($ray)) {
                $out = '[' . implode('|', $ray) . ']'; 
            }
        }
        return $out; 
    }
    
    
    
}
