<?php
/*
Plugin Name: Minecraft Workbench Item Tooltips
Plugin URI: http://wordpress.org/#
Description: Turns links to MinecraftWB item pages into info tooltips. 
Author: Jaco Gerber
Version: 0.1.1
Author URI: http://www.minecraftwb.com/
*/

function mcwbscripts() {
	wp_register_style('mcwbcss', WP_PLUGIN_URL . "/minecraft-workbench-tooltips/css/mcwbtooltips.css");
	wp_enqueue_style('mcwbcss');
	wp_register_script('jquery', WP_PLUGIN_URL . "/minecraft-workbench-tooltips/js/jquery.min.js");
	wp_enqueue_script('jquery');
	wp_register_script('jquerysimpletip', WP_PLUGIN_URL . "/minecraft-workbench-tooltips/js/jquery.simpletip.min.js", null, null, true);
	wp_enqueue_script('jquerysimpletip');
	wp_register_script('mcwbtooltips', WP_PLUGIN_URL . "/minecraft-workbench-tooltips/js/mcwbtooltips.js", null, null, true);
	wp_enqueue_script('mcwbtooltips');
}
add_action('wp_print_styles','mcwbscripts');

?>