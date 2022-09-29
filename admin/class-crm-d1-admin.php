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
     * Method update_edit_form
     *
     * @return void
     */
    public function update_edit_form() {
        echo ' enctype="multipart/form-data"';
    } // end update_edit_form


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
            'normal',
            'high'
        );

        add_meta_box(
            'contact_info',
            __('Información Básica del Contacto', 'crm-d1'),
            array( $this, 'render_basic_info_content' ),
            'contactos',
            'advanced',
            'high'
        );
    }


    public function render_seller_info_content($post)
    {
        wp_nonce_field('myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce');
        ?>
        <div class="custom-input-wrapper custom-input-seller-wrapper">
            <?php
        $value = get_post_meta($post->ID, 'unique_id', true);
        $code = ($value == '') ? uniqid('crm_') : $value;
        echo $this->loader->custom_meta_box_input('unique_id', 'Identificador Único', $code, 'blocked', array());

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
        echo $this->loader->custom_meta_box_input('nombres', 'Nombres', $value, 'text', array('placeholder' => __('Ingrese los nombres del contacto', 'crm-d1'), 'required' => true));

        $value = get_post_meta($post->ID, 'apellidos', true);
        echo $this->loader->custom_meta_box_input('apellidos', 'Apellidos', $value, 'text', array('placeholder' => __('Ingrese los apellidos del contacto', 'crm-d1'), 'required' => true));

        $value = get_post_meta($post->ID, 'telefono', true);
        echo $this->loader->custom_meta_box_input('telefono', 'Telefono', $value, 'tel', array('placeholder' => __('Ingrese el número telefónico del contacto', 'crm-d1'), 'required' => true, 'tooltip' => __('Ingrese el número telefónico con código de área', 'crm-d1')));

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
    }
}
