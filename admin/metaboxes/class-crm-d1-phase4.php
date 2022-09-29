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
class Crm_D1_Admin_Phase4
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
            'phase_4_info',
            __('Fase 4 - Fase Legal', 'crm-d1'),
            array( $this, 'render_phase4_info_content' ),
            'contactos',
            'advanced',
            'high'
        );
    }

    public function render_phase4_info_content($post)
    {
        ?>
<div class="custom-input-wrapper">
    <div class="custom-input-col-3">
        <?php
        $value = get_post_meta($post->ID, 'minuta_cancelacion_banco_interino_start', true);
        echo $this->loader->custom_meta_box_input('minuta_cancelacion_banco_interino_start', 'Minuta de Cancelación Banco Interino (Fecha Solicitud)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-3">
        <?php
        $value = get_post_meta($post->ID, 'minuta_cancelacion_banco_interino_end', true);
        echo $this->loader->custom_meta_box_input('minuta_cancelacion_banco_interino_end', 'Minuta de Cancelación Banco Interino (Fecha Recibido)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-3">
        <?php
        $value = get_post_meta($post->ID, 'minuta_cancelacion_banco_interino_file', true);
        echo $this->loader->custom_meta_box_input('minuta_cancelacion_banco_interino', 'Minuta de Cancelación Banco Interino (Archivo)', $value, 'file', array());
        ?>
    </div>

    <div class="custom-input-col-3">
        <?php
        $value = get_post_meta($post->ID, 'minuta_compraventa_promotora_start', true);
        echo $this->loader->custom_meta_box_input('minuta_compraventa_promotora_start', 'Minuta de Compra/Venta de Promotora (Fecha Solicitud)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-3">
        <?php
        $value = get_post_meta($post->ID, 'minuta_compraventa_promotora_end', true);
        echo $this->loader->custom_meta_box_input('minuta_compraventa_promotora_end', 'Minuta de Compra/Venta de Promotora (Fecha Recibido)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-3">
        <?php
        $value = get_post_meta($post->ID, 'minuta_compraventa_promotora_file', true);
        echo $this->loader->custom_meta_box_input('minuta_compraventa_promotora_file', 'Minuta de Compra/Venta de Promotora (Archivo)', $value, 'file', array());
        ?>
    </div>

    <div class="custom-input-col-3">
        <?php
        $value = get_post_meta($post->ID, 'minuta_prestamo_banco_start', true);
        echo $this->loader->custom_meta_box_input('minuta_prestamo_banco_start', 'Minuta de Compra/Venta de Promotora (Fecha Solicitud)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-3">
        <?php
        $value = get_post_meta($post->ID, 'minuta_prestamo_banco_end', true);
        echo $this->loader->custom_meta_box_input('minuta_prestamo_banco_end', 'Minuta de Compra/Venta de Promotora (Fecha Recibido)', $value, 'date', array());
        ?>
    </div>
    <div class="custom-input-col-3">
        <?php
        $value = get_post_meta($post->ID, 'minuta_prestamo_banco_file', true);
        echo $this->loader->custom_meta_box_input('minuta_prestamo_banco_file', 'Minuta de Compra/Venta de Promotora (Archivo)', $value, 'file', array());
        ?>
    </div>

    <?php
        $value = get_post_meta($post->ID, 'protocolo_escritura', true);
        echo $this->loader->custom_meta_box_input('protocolo_escritura', 'Protocolo de Escritura', $value, 'text', array());

        $value = get_post_meta($post->ID, 'firma_protocolo_promotora', true);
        echo $this->loader->custom_meta_box_input('firma_protocolo_promotora', 'Firma de Protocolo por Promotora', $value, 'text', array());

        $value = get_post_meta($post->ID, 'firma_protocolo_banco', true);
        echo $this->loader->custom_meta_box_input('firma_protocolo_banco', 'Firma de Protocolo por Banco Interino', $value, 'text', array());

        $value = get_post_meta($post->ID, 'firma_protocolo_cliente', true);
        echo $this->loader->custom_meta_box_input('firma_protocolo_cliente', 'Firma de Protocolo por Cliente', $value, 'text', array());

        $value = get_post_meta($post->ID, 'firma_protocolo_banco_cliente', true);
        echo $this->loader->custom_meta_box_input('firma_protocolo_banco_cliente', 'Firma de Protocolo por Banco del Cliente', $value, 'text', array());

        $value = get_post_meta($post->ID, 'pago_impuestos', true);
        echo $this->loader->custom_meta_box_input('pago_impuestos', 'Pagos de Impuestos', $value, 'text', array());

        $value = get_post_meta($post->ID, 'cierre_escritura_notaria', true);
        echo $this->loader->custom_meta_box_input('cierre_escritura_notaria', 'Cierre Escritura en Notaría', $value, 'text', array());

        $value = get_post_meta($post->ID, 'inscripcion_cierre_registro', true);
        echo $this->loader->custom_meta_box_input('inscripcion_cierre_registro', 'Inscripción de Escritura en Registro Público', $value, 'text', array());

        $value = get_post_meta($post->ID, 'desembolso_prestamo', true);
        echo $this->loader->custom_meta_box_input('desembolso_prestamo', 'Desembolso Préstamo', $value, 'text', array());

        $value = get_post_meta($post->ID, 'desembolso_prestamo', true);
        echo $this->loader->custom_meta_box_input('desembolso_prestamo', 'Desembolso del Préstamo', $value, 'text', array());

        $value = get_post_meta($post->ID, 'entrega_vivienda', true);
        echo $this->loader->custom_meta_box_input('entrega_vivienda', 'Entrega de Vivienda', $value, 'text', array());

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

        $value = sanitize_text_field($_POST['minuta_cancelacion_banco_interino']);
        update_post_meta($post_id, 'minuta_cancelacion_banco_interino', $value);

        $value = sanitize_text_field($_POST['minuta_compraventa_promotora']);
        update_post_meta($post_id, 'minuta_compraventa_promotora', $value);

        $value = sanitize_text_field($_POST['minuta_prestamo_banco']);
        update_post_meta($post_id, 'minuta_prestamo_banco', $value);

        $value = sanitize_text_field($_POST['protocolo_escritura']);
        update_post_meta($post_id, 'protocolo_escritura', $value);

        $value = sanitize_text_field($_POST['firma_protocolo_promotora']);
        update_post_meta($post_id, 'firma_protocolo_promotora', $value);

        $value = sanitize_text_field($_POST['firma_protocolo_banco']);
        update_post_meta($post_id, 'firma_protocolo_banco', $value);

        $value = sanitize_text_field($_POST['firma_protocolo_cliente']);
        update_post_meta($post_id, 'firma_protocolo_cliente', $value);

        $value = sanitize_text_field($_POST['firma_protocolo_banco_cliente']);
        update_post_meta($post_id, 'firma_protocolo_banco_cliente', $value);

        $value = sanitize_text_field($_POST['pago_impuestos']);
        update_post_meta($post_id, 'pago_impuestos', $value);

        $value = sanitize_text_field($_POST['cierre_escritura_notaria']);
        update_post_meta($post_id, 'cierre_escritura_notaria', $value);

        $value = sanitize_text_field($_POST['inscripcion_cierre_registro']);
        update_post_meta($post_id, 'inscripcion_cierre_registro', $value);

        $value = sanitize_text_field($_POST['desembolso_prestamo']);
        update_post_meta($post_id, 'desembolso_prestamo', $value);

        $value = sanitize_text_field($_POST['desembolso_prestamo']);
        update_post_meta($post_id, 'desembolso_prestamo', $value);

        $value = sanitize_text_field($_POST['entrega_vivienda']);
        update_post_meta($post_id, 'entrega_vivienda', $value);
    }
}