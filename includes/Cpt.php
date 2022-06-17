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
}
