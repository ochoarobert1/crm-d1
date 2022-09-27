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
class Crm_D1_Admin
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
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Crm_D1_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Crm_D1_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/crm-d1-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Crm_D1_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Crm_D1_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/crm-d1-admin.js', array( 'jquery' ), $this->version, false);
    }

    /**
     * Method crm_custom_menu
     *
     * @return void
     */
    public function crm_custom_menu()
    {
        add_menu_page(
            __('CRM - Escritorio', 'crm-d1'),
            __('CRM', 'crm-d1'),
            'manage_options',
            $this->plugin_name,
            array($this, 'crm_dashboard'),
            '',
            121
        );

        add_submenu_page(
            $this->plugin_name,
            __('Contactos', 'crm-d1'),
            __('Contactos', 'crm-d1'),
            'manage_options',
            'edit.php?post_type=contactos',
            null,
            1
        );

        add_submenu_page(
            $this->plugin_name,
            __('Tipos de Contacto', 'crm-d1'),
            __('Tipos de Contactos', 'crm-d1'),
            'manage_options',
            'edit-tags.php?taxonomy=tipo-cliente',
            null,
            2
        );
    }

    /**
     * Method crm_dashboard
     *
     * @return void
     */
    public function crm_dashboard()
    {
        require_once('partials/crm-d1-admin-header.php');
        require_once('partials/crm-d1-admin-dashboard.php');
        require_once('partials/crm-d1-admin-footer.php');
    }

    /**
     * Method crm_custom_meta_box
     *
     * @param $post_type $post_type [explicite description]
     *
     * @return void
     */
    public function crm_custom_meta_box()
    {
        add_meta_box(
            'seller_info',
            __('Información del Vendedor', 'crm-d1'),
            array( $this, 'render_seller_info_content' ),
            'contactos',
            'side',
            'high'
        );

        add_meta_box(
            'contact_info',
            __('Información del Contacto', 'crm-d1'),
            array( $this, 'render_basic_info_content' ),
            'contactos',
            'advanced',
            'high'
        );

        add_meta_box(
            'phase_1_info',
            __('Fase 1 - Ventas', 'crm-d1'),
            array( $this, 'render_phase1_info_content' ),
            'contactos',
            'advanced',
            'high'
        );

        add_meta_box(
            'phase_2_info',
            __('Fase 2 - Datos del Inmueble', 'crm-d1'),
            array( $this, 'render_phase2_info_content' ),
            'contactos',
            'advanced',
            'high'
        );

        add_meta_box(
            'phase_3_info',
            __('Fase 3 - MIVIOT', 'crm-d1'),
            array( $this, 'render_phase3_info_content' ),
            'contactos',
            'advanced',
            'high'
        );

        add_meta_box(
            'phase_4_info',
            __('Fase 4 - Fase Legal', 'crm-d1'),
            array( $this, 'render_phase4_info_content' ),
            'contactos',
            'advanced',
            'high'
        );

        add_meta_box(
            'phase_5_info',
            __('Fase 5 - Fase Cobros', 'crm-d1'),
            array( $this, 'render_phase5_info_content' ),
            'contactos',
            'advanced',
            'high'
        );

        add_meta_box(
            'phase_6_info',
            __('Fase 6 - Fase Entregas', 'crm-d1'),
            array( $this, 'render_phase6_info_content' ),
            'contactos',
            'advanced',
            'high'
        );

        add_meta_box(
            'phase_7_info',
            __('Fase 7 - Fase Servicios', 'crm-d1'),
            array( $this, 'render_phase7_info_content' ),
            'contactos',
            'advanced',
            'high'
        );
    }


    public function render_seller_info_content($post)
    {
        wp_nonce_field('myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce');
        ?>
        <div class="custom-input-wrapper custom-input-side-wrapper">
            <?php
        $value = get_post_meta($post->ID, 'unique_id', true);
        echo $this->loader->custom_meta_box_input('unique_id', 'Identificador Único', $value, 'text', array());

        $value = get_post_meta($post->ID, 'seller', true);
        echo $this->loader->custom_meta_box_input('seller', 'Vendedor a Cargo', $value, 'text', array());
        ?>

        </div>
        <?php
    }

    public function render_basic_info_content($post)
    {
        ?>
        <div class="custom-input-wrapper">
            <?php
        $value = get_post_meta($post->ID, 'nombres', true);
        echo $this->loader->custom_meta_box_input('nombres', 'Nombres', $value, 'text', array());

        $value = get_post_meta($post->ID, 'apellidos', true);
        echo $this->loader->custom_meta_box_input('apellidos', 'Apellidos', $value, 'text', array());

        $value = get_post_meta($post->ID, 'telefono', true);
        echo $this->loader->custom_meta_box_input('telefono', 'Telefono', $value, 'tel', array());

        $value = get_post_meta($post->ID, 'email', true);
        echo $this->loader->custom_meta_box_input('email', 'Correo Electrónico', $value, 'email', array());

        $value = get_post_meta($post->ID, 'direccion', true);
        echo $this->loader->custom_meta_box_input('direccion', 'Direccion de Habitación', $value, 'textarea', array());

        $value = get_post_meta($post->ID, 'lugar_trabajo', true);
        echo $this->loader->custom_meta_box_input('lugar_trabajo', 'Lugar de Trabajo', $value, 'text', array());

        $value = get_post_meta($post->ID, 'ingreso', true);
        echo $this->loader->custom_meta_box_input('ingreso', 'Salario Actual', $value, 'text', array());

        $value = get_post_meta($post->ID, 'referencia', true);
        echo $this->loader->custom_meta_box_input('referencia', 'Contacto de Referencia', $value, 'text', array());
        ?>
        </div>
        <?php
    }

    public function render_phase1_info_content($post)
    {
        ?>
        <div class="custom-input-wrapper">
            <?php
        $value = get_post_meta($post->ID, 'info_enviada', true);
        echo $this->loader->custom_meta_box_input('info_enviada', 'Información Enviada y Seguimiento', $value, 'text', array());

        $value = get_post_meta($post->ID, 'conf_visita', true);
        echo $this->loader->custom_meta_box_input('conf_visita', 'Confirmación de Visita', $value, 'text', array());

        $value = get_post_meta($post->ID, 'cot_banco', true);
        echo $this->loader->custom_meta_box_input('cot_banco', 'Cotización del Banco', $value, 'text', array());

        $value = get_post_meta($post->ID, 'pro_venta', true);
        echo $this->loader->custom_meta_box_input('pro_venta', 'Proforma de Venta', $value, 'text', array());

        $value = get_post_meta($post->ID, 'banco_cliente', true);
        echo $this->loader->custom_meta_box_input('banco_cliente', 'Banco del Cliente', $value, 'text', array());

        $value = get_post_meta($post->ID, 'seguimiento_banco', true);
        echo $this->loader->custom_meta_box_input('seguimiento_banco', 'Seguimiento del Banco', $value, 'text', array());

        $value = get_post_meta($post->ID, 'carta_terminos', true);
        echo $this->loader->custom_meta_box_input('carta_terminos', 'Carta de Términos y Condiciones', $value, 'text', array());

        $value = get_post_meta($post->ID, 'carta_promesa', true);
        echo $this->loader->custom_meta_box_input('carta_promesa', 'Carta Promesa', $value, 'text', array());

        $value = get_post_meta($post->ID, 'carta_cesion', true);
        echo $this->loader->custom_meta_box_input('carta_cesion', 'Carta Sesión', $value, 'text', array());

        $value = get_post_meta($post->ID, 'ficha_cliente', true);
        echo $this->loader->custom_meta_box_input('ficha_cliente', 'Expediente Completo / Ficha de Cliente', $value, 'text', array());

        $value = get_post_meta($post->ID, 'contrato_compraventa', true);
        echo $this->loader->custom_meta_box_input('contrato_compraventa', 'Contrato Compra/Venta', $value, 'text', array());

        ?>
        </div>
        <?php
    }

    public function render_phase2_info_content($post)
    {
        ?>
        <div class="custom-input-wrapper">
            <?php

        $value = get_post_meta($post->ID, 'datos_inmueble', true);
        echo $this->loader->custom_meta_box_input('datos_inmueble', 'Datos del Inmueble', $value, 'text', array());

        ?>
        </div>
        <?php
    }

    public function render_phase3_info_content($post)
    {
        ?>
        <div class="custom-input-wrapper">
            <?php

        $value = get_post_meta($post->ID, 'declaracion_jurada', true);
        echo $this->loader->custom_meta_box_input('declaracion_jurada', 'Declaración Jurada', $value, 'text', array());

        $value = get_post_meta($post->ID, 'cedula_titular', true);
        echo $this->loader->custom_meta_box_input('cedula_titular', 'Cédula Titular', $value, 'text', array());

        $value = get_post_meta($post->ID, 'cedula_certificado', true);
        echo $this->loader->custom_meta_box_input('cedula_certificado', 'Cédula del Beneficiario / Certificado de Nacimiento', $value, 'text', array());

        $value = get_post_meta($post->ID, 'carta_trabajo', true);
        echo $this->loader->custom_meta_box_input('carta_trabajo', 'Carta de Trabajo', $value, 'text', array());

        $value = get_post_meta($post->ID, 'ficha_css', true);
        echo $this->loader->custom_meta_box_input('ficha_css', 'Ficha CSS', $value, 'text', array());

        $value = get_post_meta($post->ID, 'carta_aprobacion_banco', true);
        echo $this->loader->custom_meta_box_input('carta_aprobacion_banco', 'Carta Aprobación del Banco', $value, 'text', array());

        $value = get_post_meta($post->ID, 'cert_no_propiedad', true);
        echo $this->loader->custom_meta_box_input('cert_no_propiedad', 'Certificado de No Propiedad del Registro Público', $value, 'text', array());

        $value = get_post_meta($post->ID, 'contrato_compraventa', true);
        echo $this->loader->custom_meta_box_input('contrato_compraventa', 'Contrato de Compra/Venta firmado por ambas partes', $value, 'text', array());

        $value = get_post_meta($post->ID, 'seguimiento_fase3', true);
        echo $this->loader->custom_meta_box_input('seguimiento_fase3', 'Seguimiento', $value, 'text', array());

        ?>
        </div>
        <?php
    }

    public function render_phase4_info_content($post)
    {
        ?>
        <div class="custom-input-wrapper">
            <?php

        $value = get_post_meta($post->ID, 'minuta_cancelacion_banco_interino', true);
        echo $this->loader->custom_meta_box_input('minuta_cancelacion_banco_interino', 'Minuta de Cancelación Banco Interino', $value, 'text', array());

        $value = get_post_meta($post->ID, 'minuta_compraventa_promotora', true);
        echo $this->loader->custom_meta_box_input('minuta_compraventa_promotora', 'Minuta de Compra/Venta de Promotora', $value, 'text', array());

        $value = get_post_meta($post->ID, 'minuta_prestamo_banco', true);
        echo $this->loader->custom_meta_box_input('minuta_prestamo_banco', 'Minuta de Prestamo (Banco cliente)', $value, 'text', array());

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

    public function render_phase6_info_content($post)
    {
        ?>
        <div class="custom-input-wrapper">
            <?php

        $value = get_post_meta($post->ID, 'coordinacion_cliente', true);
        echo $this->loader->custom_meta_box_input('coordinacion_cliente', 'Coordinacion con el Cliente', $value, 'text', array());

        $value = get_post_meta($post->ID, 'entrega_llaves', true);
        echo $this->loader->custom_meta_box_input('entrega_llaves', 'Entrega de llaves', $value, 'text', array());

        $value = get_post_meta($post->ID, 'garantias', true);
        echo $this->loader->custom_meta_box_input('garantias', 'Garantías', $value, 'text', array());

        ?>
        </div>
        <?php
    }

    public function render_phase7_info_content($post)
    {
        ?>
        <div class="custom-input-wrapper">
            <?php

        $value = get_post_meta($post->ID, 'servicios_agua', true);
        echo $this->loader->custom_meta_box_input('servicios_agua', 'Agua', $value, 'text', array());

        $value = get_post_meta($post->ID, 'servicios_ptar', true);
        echo $this->loader->custom_meta_box_input('servicios_ptar', 'PTAR', $value, 'text', array());

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

        $value = sanitize_text_field($_POST['unique_id']);
        update_post_meta($post_id, 'unique_id', $value);

        $value = sanitize_text_field($_POST['seller']);
        update_post_meta($post_id, 'seller', $value);

        $value = sanitize_text_field($_POST['nombres']);
        update_post_meta($post_id, 'nombres', $value);

        $value = sanitize_text_field($_POST['apellidos']);
        update_post_meta($post_id, 'apellidos', $value);

        $value = sanitize_text_field($_POST['telefono']);
        update_post_meta($post_id, 'telefono', $value);

        $value = sanitize_text_field($_POST['email']);
        update_post_meta($post_id, 'email', $value);

        $value = sanitize_text_field($_POST['direccion']);
        update_post_meta($post_id, 'direccion', $value);

        $value = sanitize_text_field($_POST['lugar_trabajo']);
        update_post_meta($post_id, 'lugar_trabajo', $value);

        $value = sanitize_text_field($_POST['ingreso']);
        update_post_meta($post_id, 'ingreso', $value);

        $value = sanitize_text_field($_POST['referencia']);
        update_post_meta($post_id, 'referencia', $value);

        $value = sanitize_text_field($_POST['info_enviada']);
        update_post_meta($post_id, 'info_enviada', $value);

        $value = sanitize_text_field($_POST['conf_visita']);
        update_post_meta($post_id, 'conf_visita', $value);

        $value = sanitize_text_field($_POST['cot_banco']);
        update_post_meta($post_id, 'cot_banco', $value);

        $value = sanitize_text_field($_POST['pro_venta']);
        update_post_meta($post_id, 'pro_venta', $value);

        $value = sanitize_text_field($_POST['banco_cliente']);
        update_post_meta($post_id, 'banco_cliente', $value);

        $value = sanitize_text_field($_POST['seguimiento_banco']);
        update_post_meta($post_id, 'seguimiento_banco', $value);

        $value = sanitize_text_field($_POST['carta_terminos']);
        update_post_meta($post_id, 'carta_terminos', $value);

        $value = sanitize_text_field($_POST['carta_promesa']);
        update_post_meta($post_id, 'carta_promesa', $value);

        $value = sanitize_text_field($_POST['carta_cesion']);
        update_post_meta($post_id, 'carta_cesion', $value);

        $value = sanitize_text_field($_POST['ficha_cliente']);
        update_post_meta($post_id, 'ficha_cliente', $value);

        $value = sanitize_text_field($_POST['contrato_compraventa']);
        update_post_meta($post_id, 'contrato_compraventa', $value);

        $value = sanitize_text_field($_POST['datos_inmueble']);
        update_post_meta($post_id, 'datos_inmueble', $value);

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

        $value = sanitize_text_field($_POST['cobros_reservas']);
        update_post_meta($post_id, 'cobros_reservas', $value);

        $value = sanitize_text_field($_POST['abono_inicial']);
        update_post_meta($post_id, 'abono_inicial', $value);

        $value = sanitize_text_field($_POST['gastos_legales']);
        update_post_meta($post_id, 'gastos_legales', $value);

        $value = sanitize_text_field($_POST['gastos_extras']);
        update_post_meta($post_id, 'gastos_extras', $value);

        $value = sanitize_text_field($_POST['coordinacion_cliente']);
        update_post_meta($post_id, 'coordinacion_cliente', $value);

        $value = sanitize_text_field($_POST['entrega_llaves']);
        update_post_meta($post_id, 'entrega_llaves', $value);

        $value = sanitize_text_field($_POST['garantias']);
        update_post_meta($post_id, 'garantias', $value);

        $value = sanitize_text_field($_POST['servicios_agua']);
        update_post_meta($post_id, 'servicios_agua', $value);

        $value = sanitize_text_field($_POST['servicios_ptar']);
        update_post_meta($post_id, 'servicios_ptar', $value);
    }
}
