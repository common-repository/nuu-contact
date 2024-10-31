<?php
class NuuViewContact{
    private $_setting_options;

    /* Constructor */
    public function __construct(){
        $this->_setting_options = get_option('nuu-contact-options',array());
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_head', array( $this, 'frontend_custom_style' ) );
		add_action( 'wp_footer', array( $this, 'frontend' ) );
    }

    public function enqueue_scripts(){
        wp_enqueue_style( 'nuu-contact-style-phone', NUU_CONTACT_ASSETS_URL . 'css/nuu-contact-phone-style.css', array(), NUU_CONTACT_VERSION);
    }
    // a:2:{s:26:"main_section_setting_phone";s:10:"0378900656";s:26:"main_section_setting_color";s:7:"#3a1faf";}
    public function frontend_custom_style(){
        $color = '#00ff00';
		if ( !empty( $this->_setting_options['main_section_setting_color'] ) ) {
			$color = $this->_setting_options['main_section_setting_color'];
		}?>
         
		<style>
			.hotline-phone-ring-circle {
				border-color: <?php echo $color ?>;
			}
			.hotline-phone-ring-circle-fill, .hotline-phone-ring-img-circle, .hotline-bar {
				background-color: <?php echo $color ?>;
			}
		</style>

		<?php
			$hex = $color;
			( strlen( $hex ) === 4 ) ? list( $r, $g, $b ) = sscanf( $hex, '#%1x%1x%1x' ) : list( $r, $g, $b ) = sscanf( $hex, '#%2x%2x%2x' );
			$hotlinebar_bg = "rgb( $r, $g, $b, .7 )";
		?>

		<style>
			.hotline-bar {
				background: <?php echo $hotlinebar_bg; ?>;
			}
		</style>

		<?php
    }

    public function frontend(){
		$hotline = '09000000';
		if ( ! empty( $this->_setting_options['main_section_setting_phone'] ) ) {
			$hotline = $this->_setting_options['main_section_setting_phone'];
		}?>

		<div class="hotline-phone-ring-wrap">
			<div class="hotline-phone-ring">
				<div class="hotline-phone-ring-circle"></div>
				<div class="hotline-phone-ring-circle-fill"></div>
				<div class="hotline-phone-ring-img-circle">
					<a href="tel:<?php echo preg_replace( '/\D/', '', $hotline ); ?>" class="pps-btn-img">
                    <img src="<?php echo NUU_CONTACT_ASSETS_URL.'images/call.png'; ?>" alt="<?php esc_html_e( 'Hotline', 'hotline-phone-ring' ); ?>" width="50" />
					</a>
				</div>
			</div>
			<div class="hotline-bar">
				<a href="tel:<?php echo preg_replace( '/\D/', '', $hotline ); ?>">
					<span class="text-hotline"><?php echo esc_html( $hotline ); ?></span>
				</a>
			</div>
		</div><?php
    }

}