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
class Crm_D1_Admin_Phase6
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
            'phase_6_info',
            __('Fase 6 - Fase Entregas', 'crm-d1'),
            array( $this, 'render_phase6_info_content' ),
            'contactos',
            'advanced',
            'high'
        );
    }

    public function render_phase6_info_content($post)
    {
        ?>
<div class="custom-input-wrapper">
    <div class="group-wrapper">
        <div class="custom-input-col-12">
            <h2>Coordinacion con el Cliente</h2>
        </div>
        <div class="custom-input-col-12">
            <?php
        $value = get_post_meta($post->ID, 'coordinacion_cliente', true);
        echo $this->loader->custom_meta_box_input('coordinacion_cliente', 'Coordinacion con el Cliente', $value, 'date', array());
        ?>
        </div>
    </div>
    <div class="group-wrapper">
        <div class="custom-input-col-12">
            <h2>Entrega de llaves</h2>
        </div>
        <div class="custom-input-col-6">
            <?php
        $value = get_post_meta($post->ID, 'entrega_llaves_ammount', true);
        echo $this->loader->custom_meta_box_input('entrega_llaves_ammount', 'Fecha de Recepci??n', $value, 'text', array());
        ?>
        </div>
        <div class="custom-input-col-6">
            <?php
        $value = get_post_meta($post->ID, 'entrega_llaves_file', true);
        echo $this->loader->custom_meta_box_input('entrega_llaves_file', 'Archivo', $value, 'file', array());
        ?>
        </div>
    </div>
    <div class="group-wrapper">
        <div class="custom-input-col-12">
            <h2>Garant??as</h2>
        </div>
        <div class="custom-input-col-3">
            <?php
        $value = get_post_meta($post->ID, 'garantias_start', true);
        echo $this->loader->custom_meta_box_input('garantias_start', 'Fecha de Inicio', $value, 'date', array());
        ?>
        </div>
        <div class="custom-input-col-3">
            <?php
        $value = get_post_meta($post->ID, 'garantias_end', true);
        echo $this->loader->custom_meta_box_input('garantias_end', 'Fecha de Vencimiento', $value, 'date', array());
        ?>
        </div>
        <div class="custom-input-col-3">
            <?php
        $value = get_post_meta($post->ID, 'garantias_file', true);
        echo $this->loader->custom_meta_box_input('garantias_file', 'Archivo', $value, 'file', array());
        ?>
        </div>
    </div>
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

        $value = sanitize_text_field($_POST['coordinacion_cliente']);
        update_post_meta($post_id, 'coordinacion_cliente', $value);

        $value = sanitize_text_field($_POST['entrega_llaves']);
        update_post_meta($post_id, 'entrega_llaves', $value);

        $value = sanitize_text_field($_POST['garantias']);
        update_post_meta($post_id, 'garantias', $value);
    }
}
