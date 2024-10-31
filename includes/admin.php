<?php
class NuuContact{

    private $_menuSlug = 'nuu-contact';
    private $_setting_options;

    /* Constructor */
    public function __construct(){
        $this->_setting_options = get_option('nuu-contact-options',array());
        add_action( 'plugins_loaded', array( $this, 'init_hooks' ) );
    }

    public function init_hooks() {
		add_action( 'admin_menu', array( $this, 'menu' ) );
        add_action( 'admin_init', array($this,'initMenu'));
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_filter( 'plugin_action_links_' . NUU_CONTACT_BASE_NAME, array( $this, 'add_action_links' ) );
	}    

    public function admin_enqueue_scripts(){
        wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'nuu-contact-admin-script', NUU_CONTACT_ASSETS_URL . 'js/admin-script.js', array( 'jquery', 'wp-color-picker' ), NUU_CONTACT_VERSION, true );
    }

    public function menu() {
        $title    = 'NUU Contact';
        $cap      = 'Nuu Contact Setting';
        $access   = 'manage_options';
        $func     = array( $this, 'settingViewMenu' );
        $icon     = NUU_CONTACT_ASSETS_URL.'images/nuu-logo.png';
        $pos      = 500;
        add_menu_page( $cap, $title, $access, $this->_menuSlug, $func, $icon, $pos);
	}

    public function settingViewMenu(){
        require NUU_CONTACT_INCLUDE_PATH . 'view-admin.php';
    }

    public function initMenu(){
        register_setting( 'nuu-contact-setting-options', 'nuu-contact-options',array($this, 'validateSetting'));
        //Main Section Setting
        $mainSection = 'nuu-contact-setting-main_section';
        add_settings_section( $mainSection, 'Thiết Lập Chung', array($this,'createMainSection'), $this->_menuSlug );
        add_settings_field( 'main_section_setting_phone', 'Số điện thoại', array($this,'createForm'), $this->_menuSlug, $mainSection, array('name'=>'new-title-input-phone'));
        add_settings_field( 'main_section_setting_color', 'Màu sắc', array($this,'createForm'), $this->_menuSlug, $mainSection, array('name'=>'new-title-input-color'));
    }

    public function validateSetting($data_input){
        $errors = array();
		if($this->stringMaxValidate($data_input['main_section_setting_phone'], 11) == false){
			$errors['main_section_setting_phone'] = "Số điện thoại bạn nhập quá dài, vui lòng nhập lại!";
		}

		if(count($errors)>0){
			$data_input = $this->_setting_options;
			$strErrors = '';
			foreach ($errors as $key => $val){
				$strErrors .= $val . '<br/>';
			}
			
			add_settings_error($this->_menuSlug, 'my-setting', $strErrors,'error');
		}else{
			add_settings_error($this->_menuSlug, 'my-setting', 'Cap nhat du lieu thanh cong','updated');
		}
		return $data_input;
    }

    private function stringMaxValidate($val, $max){
		$flag = false;
		$str = trim($val);
		if(strlen($str) <= $max){
			$flag = true;
		}
		return $flag;
	}

    public function createMainSection(){}

    public function add_action_links( $links ) {
		$links[] = '<a href="' . admin_url('/admin.php?page=nuu-contact').'">' . esc_html__( 'Cài đặt', $this->_menuSlug ) . '</a>';
		return array_merge( $links );
	}

    public function createForm($args){
        if($args['name']=='new-title-input-phone'){
			echo '<input type="text" name="nuu-contact-options[main_section_setting_phone]" id="main_section_setting_phone" value="'.$this->_setting_options['main_section_setting_phone'].'">';
        } elseif ($args['name']=='new-title-input-color'){
			echo '<input id="nuu-contact-options[main_section_setting_color]" name="nuu-contact-options[main_section_setting_color]" type="text" value="'.$this->_setting_options['main_section_setting_color'].'" class="nuu-color-picker" />';
        }
    }
}

