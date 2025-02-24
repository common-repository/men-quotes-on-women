<?php

/*
 *
 *	Plugin Name: Men Quotes On Women
 *	Plugin URI: http://www.joeswebtools.com/wordpress-plugins/men-quotes-on-women/
 *	Description: Adds a sidebar widget that displays randomly men's quotes about women and "being woman".
 *	Version: 2.0.1
 *	Author: Joe's Web Tools
 *	Author URI: http://www.joeswebtools.com/
 *
 *	Copyright (c) 2009 Joe's Web Tools. All Rights Reserved.
 *
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation; either version 2 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 *	If you are unable to comply with the terms of this license,
 *	contact the copyright holder for a commercial license.
 *
 *	We kindly ask that you keep the link to Da Vinci's Muse as
 *	they did all the hard work gathering and sorting the quotes.
 *
 */





/*
 *
 *	men_quotes_on_women_shortcode_handler
 *
 */

function men_quotes_on_women_shortcode_handler($atts, $content = nul) {

	// Get the raw quote
	$quote_array = file(dirname(__FILE__) . '/men-quotes-on-women.dat');
	$quote_random = rand(0, sizeof($quote_array) - 5) + 4;
	$quote = explode('<separator>', $quote_array[$quote_random]);

	// Create the quote
	$content = '<table width="250" style="border-width: thin thin thin thin; border-style: solid solid solid solid;">';
	$content .= '<thead><tr><th><center><font face="arial" size="+1"><b>Men Quotes On Women</b></center></font></th></tr></thead>';
	$content .= '<tbody><tr><td>';

	$content .= '<div style="text-align: justify;">' . $quote[0] . '</div>';
	$content .= '<div style="text-align: right;"><i>' . $quote[1] . '</i></div>';

	$content .= '</td></tr></tbody>';
	$content .= '<tfoot><tr><td><div style="text-align: center;"><font face="arial" size="-3"><a href="http://www.joeswebtools.com/wordpress-plugins/men-quotes-on-women/" title="Men Quotes On Women widget plugin for WordPress">Joe\'s</a></font></div></td></tr></tfoot>';
	$content .= '</table>';

	return $content;
}





/*
 *
 *	WP_Widget_Men_Quotes_On_Women
 *
 */

class WP_Widget_Men_Quotes_On_Women extends WP_Widget {

	function WP_Widget_Men_Quotes_On_Women() {

		parent::WP_Widget(false, $name = 'Men Quotes On Women');
	}

	function widget($args, $instance) {

		extract($args);

		$option_title = apply_filters('widget_title', empty($instance['title']) ? 'Men Quotes On Women' : $instance['title']);

		echo $before_widget;
		echo $before_title . $option_title . $after_title;

		// Get the raw quote
		$quote_array = file(dirname(__FILE__) . '/men-quotes-on-women.dat');
		$quote_random = rand(0, sizeof($quote_array) - 5) + 4;
		$quote = explode('<separator>', $quote_array[$quote_random]);

		// Create the quote
		echo '<div style="text-align: justify;">' . $quote[0] . '</div>';
		echo '<div style="text-align: right;"><i>' . $quote[1] . '</i></div>';
		echo '<div style="text-align: right;"><font face="arial" size="-3"><a href="http://www.joeswebtools.com/wordpress-plugins/men-quotes-on-women/" title="Men Quotes On Women widget plugin for WordPress">Joe\'s</a></font></div>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {

		return $new_instance;
	}

	function form($instance) {

		$instance = wp_parse_args((array)$instance, array('title' => 'Men Quotes On Women'));
		$option_title = strip_tags($instance['title']);

		echo '<p>';
		echo 	'<label for="' . $this->get_field_id('title') . '">' . __('Title: ', 'moon-phases') . '</label>';
		echo 	'<input class="widefat" type="text" value="' . $option_title . '" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" />';
		echo '</p>';
	}
}





/*
 *
 *	Installation code
 *
 */

add_shortcode('men-quotes-on-women', 'men_quotes_on_women_shortcode_handler');
add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_Men_Quotes_On_Women");'));

?>