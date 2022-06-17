<?php

namespace LN\Botany;

defined('ABSPATH') || exit;

/**
 * All Functions for the Custom Post Type (CPT)
 */
class Cpt
{
    public function __construct($pluginFile)
    {
        $this->pluginFile = $pluginFile;
        add_action('init', [$this, 'botanical_family_custom_post_type']);
        add_action('cmb2_admin_init', [$this, 'cmb2_sample_metaboxes']);

        add_filter('single_template', [$this, 'includeSingleTemplate']);
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
    function cmb2_sample_metaboxes()
    {

        /**
         * Initiate the metabox
         */
        $cmb = new_cmb2_box(array(
            'id'            => 'botanical-family-metabox',
            'title'         => __('Taxonomy', 'botanical-taxonomy'),
            'object_types'  => array('ln_botanical_family',), // Post type
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true, // Show field names on the left
            // 'cmb_styles' => false, // false to disable the CMB stylesheet
            // 'closed'     => true, // Keep the metabox closed by default
        ));

        // Regular text field
        $cmb->add_field(array(
            'name'       => __('Scientific name', 'botanical-taxonomy'),
            'desc'       => __('field description (optional)', 'botanical-taxonomy'),
            'id'         => 'botanical-family-latin-name',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
            // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
            // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
            // 'on_front'        => false, // Optionally designate a field to wp-admin only
            // 'repeatable'      => true,
        ));

        // Regular text field
        $cmb->add_field(array(
            'name'       => __('Generic name', 'botanical-taxonomy'),
            'desc'       => __('field description (optional)', 'botanical-taxonomy'),
            'id'         => 'botanical-family-generic-name',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
            // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
            // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
            // 'on_front'        => false, // Optionally designate a field to wp-admin only
            // 'repeatable'      => true,
        ));
        
        // Add other metaboxes as needed
        $cmb->add_field( array(
            'name'    => __( 'Characteristical features', 'botanical-taxonomy' ),
            'desc'    => __('describe the typical features of this plant family with a list of bullet points', 'botanical-taxonomy'),
            'id'      => 'botanical-family-characteristical-features',
            'type'    => 'wysiwyg',
            'options' => array(),
        ) );

    }

    public function includeSingleTemplate($singleTemplate) {
        global $post;
        switch ($post->post_type) {
            case 'ln_botanical_family':
                return dirname($this->pluginFile) . '/includes/Templates/single-ln_botanical_family.php'; 
            }
        return $singleTemplate;
    }
}
