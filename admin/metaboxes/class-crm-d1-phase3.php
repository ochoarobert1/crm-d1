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
class Crm_D1_Admin_Phase3
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
            'phase_3_info',
            __('Fase 3 - MIVIOT', 'crm-d1'),
            array( $this, 'render_phase3_info_content' ),
            'contactos',
            'advanced',
            'high'
        );
    }

    public function render_phase3_info_content($post)
    {
        ?>
<div class="custom-input-wrapper">
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'declaracion_jurada', true);
        echo $this->loader->custom_meta_box_input('declaracion_jurada', 'Declaración Jurada', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'declaracion_jurada_file', true);
        echo $this->loader->custom_meta_box_input('declaracion_jurada_file', 'Declaración Jurada (Archivo)', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'cedula_titular', true);
        echo $this->loader->custom_meta_box_input('cedula_titular', 'Cédula Titular', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'cedula_certificado', true);
        echo $this->loader->custom_meta_box_input('cedula_certificado', 'Cédula del Beneficiario / Certificado de Nacimiento', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'carta_trabajo', true);
        echo $this->loader->custom_meta_box_input('carta_trabajo', 'Carta de Trabajo', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'ficha_css', true);
        echo $this->loader->custom_meta_box_input('ficha_css', 'Ficha CSS', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'carta_aprobacion_banco', true);
        echo $this->loader->custom_meta_box_input('carta_aprobacion_banco', 'Carta Aprobación del Banco', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'cert_no_propiedad', true);
        echo $this->loader->custom_meta_box_input('cert_no_propiedad', 'Certificado de No Propiedad del Registro Público', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'contrato_compraventa_signed', true);
        echo $this->loader->custom_meta_box_input('contrato_compraventa_signed', 'Contrato de Compra/Venta firmado por ambas partes', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'contrato_compraventa_signed_file', true);
        echo $this->loader->custom_meta_box_input('contrato_compraventa_signed_file', 'Contrato de Compra/Venta firmado por ambas partes (Archivo)', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'seguimiento_fase3', true);
        echo $this->loader->custom_meta_box_input('seguimiento_fase3', 'Seguimiento', $value, 'select', array('placeholder' => __('Seleccione el estatus actual', 'crm-d1'), 'options' => array('Recibido', 'En Revisión', 'Vo. Bo.', 'Aprobado', 'Firma Y Resolución')));
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'seguimiento_fase3_file', true);
        echo $this->loader->custom_meta_box_input('seguimiento_fase3_file', 'Seguimiento (Archivo)', $value, 'file', array());
        ?>
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

        $value = sanitize_text_field($_POST['declaracion_jurada']);
        update_post_meta($post_id, 'declaracion_jurada', $value);

        $value = sanitize_text_field($_POST['cedula_titular']);
        update_post_meta($post_id, 'cedula_titular', $value);

        $value = sanitize_text_field($_POST['cedula_certificado']);
        update_post_meta($post_id, 'cedula_certificado', $value);

        $value = sanitize_text_field($_POST['carta_trabajo']);
        update_post_meta($post_id, 'carta_trabajo', $value);

        $value = sanitize_text_field($_POST['ficha_css']);
        update_post_meta($post_id, 'ficha_css', $value);

        $value = sanitize_text_field($_POST['carta_aprobacion_banco']);
        update_post_meta($post_id, 'carta_aprobacion_banco', $value);

        $value = sanitize_text_field($_POST['cert_no_propiedad']);
        update_post_meta($post_id, 'cert_no_propiedad', $value);

        $value = sanitize_text_field($_POST['contrato_compraventa']);
        update_post_meta($post_id, 'contrato_compraventa', $value);

        $value = sanitize_text_field($_POST['seguimiento_fase3']);
        update_post_meta($post_id, 'seguimiento_fase3', $value);
    }
}