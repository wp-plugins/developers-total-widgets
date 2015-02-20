<?php
/**
 * Plugin Name: Developers Total Widgets
 * Plugin URI: http://nakshighor.com/
 * Description: This is the best plugin forever for Developers.Developers are able to use any kind of widgets by using this plugin. Developers are always work hard for creating custom widgets for their own sites. But,after publishing this plugin nor more work hard. Just enjoy and create widgets easily. So, more and more.
 * Version:  1.0
 * Author: Theme Road
 * Author URI: http://nakshighor.com/
 * License:  GPL2
 *Text Domain: tmrd
 *  Copyright 2015 GIN_AUTHOR_NAME  (email : BestThemeRoad@gmail.com)
 *
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License, version 2, as
 *	published by the Free Software Foundation.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

if(!defined('ABSPATH')) exit;      // Prevent Direct Browsing


class tmrd_total_widgets extends  WP_Widget{



	// Controller
	function __construct() {
		$widget_ops = array('classname' => 'my_widget_class', 'description' => __('Theme Road Widgets description', 'tmrd'));
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false, $name = __('Theme Road Widget', 'tmrd'), $widget_ops, $control_ops );
	}

// widget form creation
	function form($instance) {

// Check values
		if( $instance) {
			$tmrd_title = esc_attr($instance['tmrd_title']);
			$tmrd_text = esc_attr($instance['tmrd_text']);
			$tmrd_textarea= esc_textarea($instance['tmrd_textarea']);
			$tmrd_checkbox= esc_attr($instance['tmrd_checkbox']);
			$tmrd_select= esc_attr($instance['tmrd_select']);
		} else {
			$tmrd_title = '';
			$tmrd_text = '';
			$tmrd_textarea = '';
			$tmrd_checkbox = '';
			$tmrd_select ='';

		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id('tmrd_title'); ?>"><?php _e('Widget Title', 'tmrd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('tmrd_text'); ?>" name="<?php echo $this->get_field_name('tmrd_title'); ?>" type="text" value="<?php echo $tmrd_title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('tmrd_text'); ?>"><?php _e('Text:', 'tmrd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('tmrd_text'); ?>" name="<?php echo $this->get_field_name('tmrd_text'); ?>" type="text" value="<?php echo $tmrd_text; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('tmrd_textarea'); ?>"><?php _e('Textarea:', 'tmrd'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('tmrd_textarea'); ?>" name="<?php echo $this->get_field_name('tmrd_textarea'); ?>"><?php echo $tmrd_textarea; ?></textarea>
		</p>


		<p>
			<input id="<?php echo $this->get_field_id('tmrd_checkbox'); ?>" name="<?php echo $this->get_field_name('tmrd_checkbox'); ?>" type="checkbox" value="1" <?php checked( '1', $tmrd_checkbox ); ?> />
			<label for="<?php echo $this->get_field_id('tmrd_checkbox'); ?>"><?php _e('Checkbox', 'tmrd'); ?></label>
		</p>


		<p>
			<label for="<?php echo $this->get_field_id('tmrd_select'); ?>"><?php _e('Select', 'tmrd'); ?></label>
			<select name="<?php echo $this->get_field_name('tmrd_select'); ?>" id="<?php echo $this->get_field_id('tmrd_select'); ?>" class="widefat">
				<?php
				$options = array('Bangladesh', 'India', 'Srilanka','Australia');
				foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $tmrd_select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				?>
			</select>
		</p>

	<?php
	}

// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['tmrd_title'] = strip_tags($new_instance['tmrd_title']);
		$instance['tmrd_text'] = strip_tags($new_instance['tmrd_text']);
		if ( current_user_can('unfiltered_html') )
			$instance['tmrd_textarea'] =  $new_instance['tmrd_textarea'];
		else
			$instance['tmrd_textarea'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['tmrd_textarea']) ) );
		$instance['tmrd_checkbox'] = strip_tags($new_instance['tmrd_checkbox']);
		$instance['tmrd_select'] = strip_tags($new_instance['tmrd_select']);
		return $instance;
	}




	// display widget
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$tmrd_title = apply_filters('widget_title', $instance['tmrd_title']);
		$tmrd_text = $instance['tmrd_text'];
		$tmrd_textarea = apply_filters( 'widget_textarea', empty( $instance['$tmrd_textarea'] ) ? '' : $instance['$tmrd_textarea'], $instance );
		echo $before_widget;
		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';

		// Check if title is set
		if ( $tmrd_title ) {
			echo $before_title . $tmrd_title . $after_title;
		}

		// Check if text is set
		if( $tmrd_text ) {
			echo '<p class="wp_widget_plugin_text">'.$tmrd_text.'</p>';
		}
		// Check if textarea is set
		if( $tmrd_textarea ) { echo wpautop($tmrd_textarea); }

		// Check if checkbox is checked
		if( $tmrd_checkbox AND $tmrd_checkbox == '1' ) {
			echo '<p>'.__('Checkbox is checked', 'tmrd').'</p>';
		}

		// Get $select value
		if ( $tmrd_select == 'lorem' ) {
			echo 'Lorem option is Selected';
		} else if ( $tmrd_select == 'ipsum' ) {
			echo 'ipsum option is Selected';
		} else {
			echo 'dolorem option is Selected';
		}

		echo '</div>';
		echo $after_widget;
	}




}



// register widget
add_action('widgets_init', create_function('', 'return register_widget("tmrd_total_widgets");'));










