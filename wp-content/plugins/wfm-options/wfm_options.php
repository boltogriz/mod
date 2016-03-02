<?php
/*
Plugin Name: Option and settings
Plugin URI: http://страница_с_описанием_плагина_и_его_обновлений
Description: Краткое описание плагина.
Version: Номер версии плагина, например: 1.0
Author: Имя автора плагина
Author URI: http://страница_автора_плагина
*/
/*1
add_action("admin_init", 'wfm_first_option');

function wfm_first_option(){
	register_setting(
		'general',//место размещения Настройки -> Общие
		'wfm_first_option'  //название опции
		);
	add_settings_field(
		'wfm_first_option',//id опции (использовать для ID поля формы)
		'первая опция',//заголовок
		'wfm_option_cb',//callback-функция, для html - кода поля формы
		'general' //место размещения Настройки -> Общие
	);
}

function wfm_option_cb(){
?>
	<input type="text" name="wfm_first_option" id="wfm_first_option" value="<?php echo esc_attr(get_option('wfm_first_option'))?>" class='regular-text'>
<?php
}
*/
add_action( 'admin_init', 'wfm_theme_options' );
add_action('wp_enqueue_scripts', 'wfm_scripts_styles');

function wfm_scripts_styles(){
	$wfm_theme_options = get_option('wfm_theme_options');
	wp_register_script('wfm-options', plugins_url('wfm-option.js', __FILE__), array('jquery'));
	
	wp_enqueue_script('wfm-options');
	wp_localize_script('wfm-options', 'wfmObj', $wfm_theme_options);
}

function wfm_theme_options(){
	register_setting( 'general', 'wfm_theme_options' );

	// $id - ID секции
	// $title - заголовок
	// $callback - callback-функция для генерации HTML-кода
	// $page - для какой страницы регистрируется секция
	add_settings_section( 'wfm_theme_section_id', 'Опции темы', 'wfm_theme_options_section_cb', 'general' );

	add_settings_field( 'wfm_theme_options_body', 'Цвет фона', 'wfm_theme_body_cb', 'general', 'wfm_theme_section_id' );
	add_settings_field( 'wfm_theme_options_header', 'Цвет header', 'wfm_theme_header_cb', 'general', 'wfm_theme_section_id' );
}

function wfm_theme_options_section_cb(){
	echo '<p>Описание секции</p>';
}

function wfm_theme_body_cb(){
	$options = get_option('wfm_theme_options');
	?>

<input type="text" name="wfm_theme_options[wfm_theme_options_body]" id="wfm_theme_options_body" value="<?php echo esc_attr($options['wfm_theme_options_body']); ?>" class="regular-text">

	<?php
}

function wfm_theme_header_cb(){
	$options = get_option('wfm_theme_options');
	?>

<input type="text" name="wfm_theme_options[wfm_theme_options_header]" id="wfm_theme_options_header" value="<?php echo esc_attr($options['wfm_theme_options_header']); ?>" class="regular-text">

	<?php
}