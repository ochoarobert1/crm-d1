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
class Crm_D1_Admin_Phase1
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
            'phase_1_info',
            __('Fase 1 - Ventas', 'crm-d1'),
            array( $this, 'render_phase1_info_content' ),
            'contactos',
            'advanced',
            'high'
        );
    }

    public function render_phase1_info_content($post)
    {
        ?>
<div class="custom-input-wrapper">
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'info_enviada', true);
        echo $this->loader->custom_meta_box_input('info_enviada', 'Información Enviada y Seguimiento', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'conf_visita', true);
        echo $this->loader->custom_meta_box_input('conf_visita', 'Confirmación de Visita', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">

        <?php
        $value = get_post_meta($post->ID, 'cot_banco', true);
        echo $this->loader->custom_meta_box_input('cot_banco', 'Cotización del Banco', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'cot_banco_file', true);
        echo $this->loader->custom_meta_box_input('cot_banco_file', 'Archivo de Cotización del Banco', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
    $value = get_post_meta($post->ID, 'pro_venta', true);
        echo $this->loader->custom_meta_box_input('pro_venta', 'Proforma de Venta', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'pro_venta_file', true);
        echo $this->loader->custom_meta_box_input('pro_venta_file', 'Archivo de Proforma de Venta', $value, 'file', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'banco_cliente', true);
        echo $this->loader->custom_meta_box_input('banco_cliente', 'Banco del Cliente', $value, 'select', array('placeholder' => __('Seleccione el banco del cliente', 'crm-d1'), 'options' => array('BNP', 'C.A.', 'Global', 'La Hipotecaria', 'Banistmo', 'Banco General', 'Otro')));
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'seguimiento_banco', true);
        echo $this->loader->custom_meta_box_input('seguimiento_banco', 'Seguimiento del Banco', $value, 'select', array('placeholder' => __('Seleccione el status actual', 'crm-d1'), 'options' => array('En Revisión', 'Comité', 'Devuelto para Corrección', 'Reingresado', 'Aprobado', 'Rechazado')));
        ?>
    </div>
    <?php
        $value = get_post_meta($post->ID, 'carta_terminos', true);
        echo $this->loader->custom_meta_box_input('carta_terminos', 'Carta de Términos y Condiciones', $value, 'date', array());
        ?>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'carta_promesa_start', true);
        echo $this->loader->custom_meta_box_input('carta_promesa_start', 'Carta Promesa (Fecha de Emisión)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'carta_promesa_end', true);
        echo $this->loader->custom_meta_box_input('carta_promesa_end', 'Carta Promesa (Fecha de Vencimiento)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'carta_cesion_start', true);
        echo $this->loader->custom_meta_box_input('carta_cesion_start', 'Carta Cesión (Fecha de Emisión)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'carta_cesion_end', true);
        echo $this->loader->custom_meta_box_input('carta_cesion_end', 'Carta Cesión (Fecha de Emisión)', $value, 'date', array());
        ?>
    </div>
    <?php
        $value = get_post_meta($post->ID, 'ficha_cliente', true);
        echo $this->loader->custom_meta_box_input('ficha_cliente', 'Expediente Completo / Ficha de Cliente', $value, 'date', array());
        ?>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'contrato_compraventa', true);
        echo $this->loader->custom_meta_box_input('contrato_compraventa', 'Contrato Compra/Venta (Fecha de Emisión)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-6">
        <?php
        $value = get_post_meta($post->ID, 'contrato_compraventa_file', true);
        echo $this->loader->custom_meta_box_input('contrato_compraventa_file', 'Archivo Contrato Compra/Venta', $value, 'file', array());
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

        $value = sanitize_text_field($_POST['info_enviada']);
        update_post_meta($post_id, 'info_enviada', $value);

        $value = sanitize_text_field($_POST['conf_visita']);
        update_post_meta($post_id, 'conf_visita', $value);

        $value = sanitize_text_field($_POST['cot_banco']);
        update_post_meta($post_id, 'cot_banco', $value);

        if (!empty($_FILES['cot_banco_file']['name'])) {
            $supported_types = array('application/pdf');

            $arr_file_type = wp_check_filetype(basename($_FILES['cot_banco_file']['name']));
            $uploaded_type = $arr_file_type['type'];

            if (in_array($uploaded_type, $supported_types)) {
                $upload = wp_upload_bits($_FILES['cot_banco_file']['name'], null, file_get_contents($_FILES['cot_banco_file']['tmp_name']));

                if (isset($upload['error']) && $upload['error'] != 0) {
                    wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                } else {
                    update_post_meta($post_id, 'cot_banco_file', $upload);
                }
            }
        }

        $value = sanitize_text_field($_POST['pro_venta']);
        update_post_meta($post_id, 'pro_venta', $value);

        if (!empty($_FILES['pro_venta_file']['name'])) {
            $supported_types = array('application/pdf');

            $arr_file_type = wp_check_filetype(basename($_FILES['pro_venta_file']['name']));
            $uploaded_type = $arr_file_type['type'];

            if (in_array($uploaded_type, $supported_types)) {
                $upload = wp_upload_bits($_FILES['pro_venta_file']['name'], null, file_get_contents($_FILES['pro_venta_file']['tmp_name']));

                if (isset($upload['error']) && $upload['error'] != 0) {
                    wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                } else {
                    update_post_meta($post_id, 'pro_venta_file', $upload);
                }
            }
        }

        $value = sanitize_text_field($_POST['banco_cliente']);
        update_post_meta($post_id, 'banco_cliente', $value);

        $value = sanitize_text_field($_POST['seguimiento_banco']);
        update_post_meta($post_id, 'seguimiento_banco', $value);

        $value = sanitize_text_field($_POST['carta_terminos']);
        update_post_meta($post_id, 'carta_terminos', $value);

        $value = sanitize_text_field($_POST['carta_promesa_start']);
        update_post_meta($post_id, 'carta_promesa_start', $value);

        $value = sanitize_text_field($_POST['carta_promesa_end']);
        update_post_meta($post_id, 'carta_promesa_end', $value);

        $value = sanitize_text_field($_POST['carta_cesion_start']);
        update_post_meta($post_id, 'carta_cesion_start', $value);

        $value = sanitize_text_field($_POST['carta_cesion_end']);
        update_post_meta($post_id, 'carta_cesion_end', $value);

        $value = sanitize_text_field($_POST['ficha_cliente']);
        update_post_meta($post_id, 'ficha_cliente', $value);

        $value = sanitize_text_field($_POST['contrato_compraventa']);
        update_post_meta($post_id, 'contrato_compraventa', $value);

        if (!empty($_FILES['contrato_compraventa_file']['name'])) {
            $supported_types = array('application/pdf');

            $arr_file_type = wp_check_filetype(basename($_FILES['contrato_compraventa_file']['name']));
            $uploaded_type = $arr_file_type['type'];

            if (in_array($uploaded_type, $supported_types)) {
                $upload = wp_upload_bits($_FILES['contrato_compraventa_file']['name'], null, file_get_contents($_FILES['contrato_compraventa_file']['tmp_name']));

                if (isset($upload['error']) && $upload['error'] != 0) {
                    wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                } else {
                    update_post_meta($post_id, 'contrato_compraventa_file', $upload);
                }
            }
        }
    }
}
