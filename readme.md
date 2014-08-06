# Easy Filter Moodle Plugin #
The Easy Filter plugin allows you to quickly and easily create your own simple filters from within the admin interface.

WordPress calls them shortcodes. Forum software calls it BBCode. What you're going to do is specify a tag along with what it wraps.

For example, let's say you want to create a filter that formats everything in side in the Courier New font. We'll create a new tag with the following settings.

- Tag: 		`courier`
- Before: 	`<span style="font-family: 'Courier New';">`
- After: 	`</span>`

Now, when you want to wrap some text so that it's rendered in Courier New you would enter the following.

`[courier]This is my text[/courier]`

When Moodle renders the page, it will output the following.

`<span style="font-family: 'Courier New';">This is my text</span>`

### Screenshot ###
![](https://raw.githubusercontent.com/RyanNutt/filter_easyfilter/master/screenshots/settingsMenu.PNG)

### Help & Support ###
You can find instructions on using this plugin at my [website](http://www.nutt.net/).

If you find an issue, please submit an issue at my [GitHub repository](https://github.com/RyanNutt/filter_easyfilter).

