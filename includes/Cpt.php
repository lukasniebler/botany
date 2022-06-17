<?php

namespace LN\Botany;

defined('ABSPATH') || exit;

/**
 * All Functions for the Custom Post Type (CPT)
 */
class Cpt
{
    public function __construct()
    {
        add_action('init', [$this, 'botanical_family_custom_post_type']);

        add_action( 'cmb2_admin_init', [$this, 'cmb2_sample_metaboxes']);
    }

    public function botanical_family_custom_post_type()
    {
        register_post_type(
            'ln_botanical_family',
            array(
                'labels'      => array(
                    'name'          => __('Families', 'botanical-taxonomy'),
                    'singular_name' => __('Family', 'botanical-taxonomy'),
                ),
                'public'      => true,
                'has_archive' => true,
                'rewrite'     => array('slug' => 'botanical-families'),
            )
        );

    }

    /**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'test_metabox',
		'title'         => __( 'Test Metabox', 'cmb2' ),
		'object_types'  => array( 'ln_botanical_family', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	// Regular text field
	$cmb->add_field( array(
		'name'       => __( 'Test Text', 'cmb2' ),
		'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => 'yourprefix_text',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	// URL text field
	$cmb->add_field( array(
		'name' => __( 'Website URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => 'yourprefix_url',
		'type' => 'text_url',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
	) );

	// Email text field
	$cmb->add_field( array(
		'name' => __( 'Test Text Email', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => 'yourprefix_email',
		'type' => 'text_email',
		// 'repeatable' => true,
	) );

	// Add other metaboxes as needed

}
}
