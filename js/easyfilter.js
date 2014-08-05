var easyFilter = {
    loadSettingsPage: function() {
        jQuery('#easy_add_button').click(function() {
            if (jQuery('#easy_add_tag').val().trim() == '') {
                alert(easyFilter.lang.emptyTag); 
                jQuery('#easy_add_tag').focus(); 
                return; 
            }
            var html = '<div class="ez_tag">';
            html += '<input type="text" name="ez_tag[]" value="' + easyFilter.escapeHTML(jQuery('#easy_add_tag').val().trim()) + '"></div>';
            html += '<div class="ez_before"><input type="text" name="ez_before[]" value="' + easyFilter.escapeHTML(jQuery('#easy_add_before').val().trim()) + '"></div>';
            html += '<div class="ez_after"><input type="text" name="ez_after[]" value="' + easyFilter.escapeHTML(jQuery('#easy_add_after').val().trim()) + '"></div>'; 
            html += '<br style="clear:both;"></div>';
            jQuery('#easy_tag_list').append(html);
            jQuery('#easy_tags').show();
            
            jQuery('#easy_add_tag').val('');
            jQuery('#easy_add_after').val('');
            jQuery('#easy_add_before').val(''); 
            
        });
    }, 
    
    lang: {},
    
    entityMap: {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': '&quot;',
        "'": '&#39;',
        "/": '&#x2F;'
    },
    escapeHTML: function(string) {
        return String(string).replace(/[&<>"'\/]/g, function (s) {
          return easyFilter.entityMap[s];
    });
  }
}