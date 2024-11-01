<?php
/*
Plugin Name: Stats Website
Plugin URI: http://stats.logonike.com
Description: This plugin allows you to implement the advanced system of statistics of logonike.com. It will help you understand the development of your website. It gives you information you will not find in other similar services. It will help in the positioning of your website. A simple code that collects information and processes it for positive purposes. Get the id of your website and of user and start enjoying the benefits of having your system statistics on a remote server.
Version: 1.0
Author: Webmasters LogoNike.Com
Author URI: http://stats.logonike.com/
License: GPL2
*/

if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');
	  
function activate_statistics(){
	add_option('ID_website', 'ID_website');
	add_option('ID_user', 'ID_user');
}
function deactive_statistics(){}

function admin_init_statistics_websites(){
	register_setting('statistics', 'ID_website');
	register_setting('statistics', 'ID_user');
}
function admin_menu_statistics_websites(){
	add_options_page('Statistics Website', 'Statistics Website', '8', 'statistics', 'option_page_statistics_websites');
}
function option_page_statistics_websites(){
	include(WP_PLUGIN_DIR.'/stats-website/options.php');
}

function statistics_websites(){
$IDurl = get_option('ID_website');
$IDusu = get_option('ID_user');
?>
<!-- stats.logonike.com -->
<script type="text/javascript">
document.write('<img style="display:none" src="http://stats.logonike.com/bd/stats.php?idweb=<?php echo $IDurl; ?>&idusu=<?php echo $IDusu; ?>&ref=' + escape(document.referrer) + '&name=' + escape(document.domain) + '&url=' + escape(document.location) + '">')
</script>
<!-- END stats.logonike.com -->
<?php
}
register_activation_hook(__FILE__, 'activate_statistics');
register_deactivation_hook(__FILE__, 'deactive_statistics');

if (is_admin()) {
  add_action('admin_init', 'admin_init_statistics_websites');
  add_action('admin_menu', 'admin_menu_statistics_websites');
}
if (!is_admin()) {
	add_filter('wp_footer', 'statistics_websites');
}
?>
