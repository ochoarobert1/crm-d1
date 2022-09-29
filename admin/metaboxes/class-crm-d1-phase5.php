<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://robertochoaweb.com/
 * @since      1.0.0
 *
 * @package    Crm_D1
 * @subpackage Crm_D1/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Crm_D1
 * @subpackage Crm_D1/admin
 * @author     Robert Ochoa <ochoa.robert1@gmail.com>
 */
class Crm_D1_Admin_Phase5
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $this->loader = new Crm_D1_Loader();
    }

    /**
     * Method crm_custom_meta_box
     *
     * @return void
     */
    public function crm_custom_meta_box()
    {
        add_meta_box(
            'phase_5_info',
            __('Fase 5 - Fase Cobros', 'crm-d1'),
            array( $this, 'render_phase5_info_content' ),
            'contactos',
            'advanced',
            'high'
        );
    }

    public function render_phase5_info_content($post)
    {
        ?>
        <div class="custom-input-wrapper">
            <?php

        $value = get_post_meta($post->ID, 'cobros_reservas', true);
        echo $this->loader->custom_meta_box_input('cobros_reservas', 'Reservas', $value, 'text', array());

        $value = get_post_meta($post->ID, 'abono_inicial', true);
        echo $this->loader->custom_meta_box_input('abono_inicial', 'Abono Inicial', $value, 'text', array());

        $value = get_post_meta($post->ID, 'gastos_legales', true);
        echo $this->loader->custom_meta_box_input('gastos_legales', 'Gastos Legales', $value, 'text', array());

        $value = get_post_meta($post->ID, 'gastos_extras', true);
        echo $this->loader->custom_meta_box_input('gastos_extras', 'Extras', $value, 'text', array());

        ?>
        </div>
        <?php
    }

    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox($post_id, $post)
    {
        // Add nonce for security and authentication.
        /*
        $nonce_name   = isset($_POST['myplugin_inner_custom_box']) ? $_POST['myplugin_inner_custom_box'] : '';
        $nonce_action = 'myplugin_inner_custom_box_nonce';

        // Check if nonce is valid.
        if (! wp_verify_nonce($nonce_name, $nonce_action)) {
            return;
        }
         */

        // Check if not an autosave.
        if (wp_is_post_autosave($post_id)) {
            return;
        }

        $value = sanitize_text_field($_POST['cobros_reservas']);
        update_post_meta($post_id, 'cobros_reservas', $value);

        $value = sanitize_text_field($_POST['abono_inicial']);
        update_post_meta($post_id, 'abono_inicial', $value);

        $value = sanitize_text_field($_POST['gastos_legales']);
        update_post_meta($post_id, 'gastos_legales', $value);

        $value = sanitize_text_field($_POST['gastos_extras']);
        update_post_meta($post_id, 'gastos_extras', $value);
    }
}
