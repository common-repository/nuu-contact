<?php
/**
 * Plugin Name: NUU Contact
 * Plugin URI: https://nguyendanghung.com/nuu-contact-plugin/
 * Description: Fixed contact on the screen.
 * Version: 1.0
 * Author: Nguyen Dang Hung
 * Author URI: https://nguyendanghung.com
 *
 * Text Domain: nuu-contact
 *
 * @package NUU Contact
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define('NUU_CONTACT_VERSION', '1.0');
define('NUU_CONTACT_FILE', __FILE__);
define('NUU_CONTACT_BASE_NAME', plugin_basename( NUU_CONTACT_FILE ));
define('NUU_CONTACT_PATH', plugin_dir_path( NUU_CONTACT_FILE ));
define('NUU_CONTACT_URL', plugin_dir_url( NUU_CONTACT_FILE ));
define('NUU_CONTACT_INCLUDE_PATH', NUU_CONTACT_PATH . 'includes/');
define('NUU_CONTACT_ASSETS_URL', NUU_CONTACT_URL . 'assets/');

if(is_admin()){
    require_once NUU_CONTACT_INCLUDE_PATH . 'admin.php';
    new NuuContact();
}

if (!is_admin()){
    require_once NUU_CONTACT_INCLUDE_PATH . 'public.php';
    new NuuViewContact();
}