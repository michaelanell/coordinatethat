<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Defines constants to help enqueue scripts and styles.
define( 'CHILD_THEME_HANDLE', sanitize_title_with_dashes( wp_get_theme()->get( 'Name' ) ) );
define( 'CHILD_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function genesis_sample_localization_setup() {

	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style(
		'genesis-sample-fonts',
		'//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700',
		array(),
		CHILD_THEME_VERSION
	);

	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'genesis-sample-responsive-menu',
		get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

	wp_enqueue_script(
		'genesis-sample',
		get_stylesheet_directory_uri() . '/js/genesis-sample.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

}

/**
 * Defines responsive menu settings.
 *
 * @since 2.3.0
 */
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Adds support for HTML5 markup structure.
add_theme_support( 'html5', genesis_get_config( 'html5' ) );

// Adds support for accessibility.
add_theme_support( 'genesis-accessibility', genesis_get_config( 'accessibility' ) );

// Adds viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Adds custom logo in Customizer > Site Identity.
add_theme_support( 'custom-logo', genesis_get_config( 'custom-logo' ) );

add_filter( 'genesis_seo_title', 'genesis_sample_header_title', 10, 3 );
/**
 * Removes the link from the hidden site title if a custom logo is in use.
 *
 * Without this filter, the site title is hidden with CSS when a custom logo
 * is in use, but the link it contains is still accessible by keyboard.
 *
 * @since 1.2.0
 *
 * @param string $title  The full title.
 * @param string $inside The content inside the title element.
 * @param string $wrap   The wrapping element name, such as h1.
 * @return string The site title with anchor removed if a custom logo is active.
 */
function genesis_sample_header_title( $title, $inside, $wrap ) {

	if ( has_custom_logo() ) {
		$inside = get_bloginfo( 'name' );
	}

	return sprintf( '<%1$s class="site-title">%2$s</%1$s>', $wrap, $inside );

}

// Renames primary and secondary navigation menus.
add_theme_support( 'genesis-menus', genesis_get_config( 'menus' ) );

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

add_action( 'genesis_theme_settings_metaboxes', 'genesis_sample_remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 2.6.0
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function genesis_sample_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

add_filter( 'genesis_customizer_theme_settings_config', 'genesis_sample_remove_customizer_settings' );
/**
 * Removes output of header and front page breadcrumb settings in the Customizer.
 *
 * @since 2.6.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function genesis_sample_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	unset( $config['genesis']['sections']['genesis_breadcrumbs']['controls']['breadcrumb_front_page'] );
	return $config;

}

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}

/**
* Gravity Wiz // Use List Field as Choices for Gravity Forms
*
* Adds support for populating choice-based fields (i.e. checkboxes, selects, radio buttons) with values entered in a 
* List field. This functionality requires that the form has multiple pages and that the List field must be placed on 
* a page prior to the choice-based field that it will populate.
*
* @author    David Smith <david@gravitywiz.com>
* @license   GPL-2.0+
* @link      http://gravitywiz.com/use-list-field-choices-gravity-forms/
* @note      Updated by Skylar to add is_user_ids to convert IDs to display names
*/
class GW_List_Field_As_Choices {

    function __construct( $args ) {

        $this->_args = wp_parse_args( $args, array(
            'form_id'           => false,
            'list_field_id'     => false,
            'choice_field_ids'  => false,
            'label_template'    => '{0}',
            'sort'              => false,
            'is_user_ids'       => false,
        ) );

        if( ! is_array( $this->_args['choice_field_ids'] ) )
            $this->_args['choice_field_ids'] = array( $this->_args['choice_field_ids'] );

        extract( $this->_args ); // gives us $form_id, $list_field_id, $choices_field_id

        add_filter( 'gform_pre_render', array( $this, 'populate_choice_fields' ), 9 );
        add_filter( 'gform_pre_validation', array( $this, 'populate_choice_fields' ), 9 );
        add_filter( 'gform_pre_submission_filter_' . $form_id, array( $this, 'populate_choice_fields' ) );

    }

    function populate_choice_fields( $form ) {
        
        if( $form['id'] != $this->_args['form_id'] )
            return $form;
            
        $list_field = GFFormsModel::get_field( $form, $this->_args['list_field_id'] );
        $values = GFFormsModel::get_field_value( $list_field );

        // if list field doesn't have any values, let's ditch this party
        if( ! is_array( $values ) )
            return $form;

        $choices = $this->get_list_choices( $values );

        foreach( $form['fields'] as &$field ) {

            if( ! $this->is_applicable_field( $field ) )
                continue;

            // set 'choices' for choice fields
            $field['choices'] = $choices;

            // only set inputs for 'checkbox' choice fields
            if( GFFormsModel::get_input_type( $field ) == 'checkbox' ) {
                $inputs = array();
                foreach( $choices as $index => $choice ) {
                    $inputs[] = array(
                        'label' => $choice['text'],
                        'id'    => $field['id'] . '.' . ( $index + 1 )
                    );
                }
                $field['inputs'] = $inputs;
            }
            
        }

        return $form;
    }
    
    function get_list_choices( $values ) {
        
        $choices = array();
        
        foreach( $values as $row ) {
            
            if ($this->_args['is_user_ids'] && ctype_digit($row) && false !== ($user = get_user_by('ID', (int) $row))) {
                $label = $user->display_name;
                $value = $user->ID;
            }
            else {
                $label = $this->replace_template( $this->_args['label_template'], $row );
                $value = isset( $this->_args['value_template'] ) ? $this->replace_template( $this->_args['value_template'], $row ) : $label;
            }

            $choices[] = array(
                'text' => $label,
                'value' => $value
            );
            
        }

        if( $this->_args['sort'] == true )
            usort( $choices, create_function( '$a, $b', 'return strnatcasecmp( $a["text"], $b["text"] );' ) );

        return $choices;
    }
    
    function replace_template( $template, $row ) {
        
        // combine our templates so we can find all matches at once
        preg_match_all( '/{(\w+)}/', $template, $matches, PREG_SET_ORDER );
        
        if( is_array( $row ) ) {

            $mega_row = array_merge( $row, array_values( $row ) );

            foreach( $matches as $match ) {
                $template = str_replace( $match[0], rgar( $mega_row, $match[1] ), $template );
            }
            
        } else {

            foreach( $matches as $match ) {
                $template = str_replace( $match[0], $row, $template );
            }
            
        }
        
        return $template;
    }
    
    function is_applicable_field( $field ) {
        
        $is_choice_field = is_array( rgar( $field, 'choices' ) );
        $is_registered_field = in_array( $field['id'], $this->_args['choice_field_ids'] );
        
        return $is_choice_field && $is_registered_field;
    }
    
}

/**
* Uncomment the code below by removing the pound symbols (#) in front of each line. See @link in the comment section 
* at the top for additional usage instructions.
*/
/* https://gravitywiz.com/use-list-field-choices-gravity-forms/ 
 * 
 * BASIC USE
 * new GW_List_Field_As_Choices( array(
 *   'form_id' => 1,
 *  'list_field_id' => 2,
 * 'choice_field_ids' => 3
 * ) );
 *
 * ENABLE ALPHANUMERIC SORTING FOR CHOICES
 * new GW_List_Field_As_Choices( array(
 *  'form_id' => 1,
 *  'list_field_id' => 2,
 *  'choice_field_ids' => 3,
 *  'sort' => true
 * ) );
 *
 * PUPULATE MULTIPLE FIELDS
 * new GW_List_Field_As_Choices( array(
 *   'form_id' => 384,
 *   'list_field_id' => 3,
 *   'choice_field_ids' => array( 6, 7 )
 * ) );
 *
 * CUSTOMIZE CHOICE LABEL AND VALUE
 * new GW_List_Field_As_Choices( array(
 *   'form_id' => 384,
 *   'list_field_id' => 2,
 *   'choice_field_ids' => array( 4, 5 ),
 *   'label_template' => '{Name} <span style="color:#999;font-style:italic;">({Age})</span>',
 *   'value_template' => '{Name}'
 * ) );
 *
*/

/**
 * Add initializations here
 */

new GW_List_Field_As_Choices( array(
    'form_id' => 27,
    'list_field_id' => 9,
    'choice_field_ids' => array(18,24,27,30,33,34,35,36,37,38,39,40,41,42,43,46,49,52 ), 
    'is_user_ids' => true,
    'sort' => false,
) );

new GW_List_Field_As_Choices( array(
    'form_id' => 45,
    'list_field_id' => 9,
    'choice_field_ids' => array(18,24,27,30,33,34,35,36,37,38,39,40,41,42,43,46,49,52 ), 
    'is_user_ids' => true,
    'sort' => false,
) );

//* Sticky Footer Functions
add_action( 'genesis_before_header', 'stickyfoot_wrap_begin');
function stickyfoot_wrap_begin() {
	echo '<div class="page-wrap">';
}
 
add_action( 'genesis_before_footer', 'stickyfoot_wrap_end');
function stickyfoot_wrap_end() {
	echo '</div><!-- page-wrap -->';
}

//* Remove the footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
