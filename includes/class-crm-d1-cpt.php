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
class Crm_D1_CPT
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
    }

    /**
     * Method crm_d1_contactos
     *
     * @return void
     */
    public function crm_d1_contactos()
    {
        $labels = array(
            'name'                  => _x('Contactos', 'Post Type General Name', 'crm-d1'),
            'singular_name'         => _x('Contacto', 'Post Type Singular Name', 'crm-d1'),
            'menu_name'             => __('Contactos', 'crm-d1'),
            'name_admin_bar'        => __('Contactos', 'crm-d1'),
            'archives'              => __('Archivo de Contactos', 'crm-d1'),
            'attributes'            => __('Atributos de Contacto', 'crm-d1'),
            'parent_item_colon'     => __('Contacto Padre:', 'crm-d1'),
            'all_items'             => __('Todos los Contactos', 'crm-d1'),
            'add_new_item'          => __('Agregar Nuevo Contacto', 'crm-d1'),
            'add_new'               => __('Agregar Nuevo', 'crm-d1'),
            'new_item'              => __('Nuevo Contacto', 'crm-d1'),
            'edit_item'             => __('Editar Contacto', 'crm-d1'),
            'update_item'           => __('Actualizar Contacto', 'crm-d1'),
            'view_item'             => __('Ver Contacto', 'crm-d1'),
            'view_items'            => __('Ver Contactos', 'crm-d1'),
            'search_items'          => __('Buscar Contacto', 'crm-d1'),
            'not_found'             => __('No hay resultados', 'crm-d1'),
            'not_found_in_trash'    => __('No hay resultados en la Papelera', 'crm-d1'),
            'featured_image'        => __('Imagen del Contacto', 'crm-d1'),
            'set_featured_image'    => __('Colocar Imagen del Contacto', 'crm-d1'),
            'remove_featured_image' => __('Remover Imagen del Contacto', 'crm-d1'),
            'use_featured_image'    => __('Usar como Imagen del Contacto', 'crm-d1'),
            'insert_into_item'      => __('Insertar en Contacto', 'crm-d1'),
            'uploaded_to_this_item' => __('Cargado a este Contacto', 'crm-d1'),
            'items_list'            => __('Listado de Contactos', 'crm-d1'),
            'items_list_navigation' => __('Navegación del Listado de Contactos', 'crm-d1'),
            'filter_items_list'     => __('Filtro del Listado de Contactos', 'crm-d1'),
        );
        $args = array(
            'label'                 => __('Contacto', 'crm-d1'),
            'description'           => __('Contactos del CRM', 'crm-d1'),
            'labels'                => $labels,
            'supports'              => array( 'title' ),
            'taxonomies'            => array( 'tipo-cliente' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );

        register_post_type('contactos', $args);

        $labels_tax = array(
            'name'                       => _x('Tipos de Cliente', 'Taxonomy General Name', 'crm-d1'),
            'singular_name'              => _x('Tipo de Cliente', 'Taxonomy Singular Name', 'crm-d1'),
            'menu_name'                  => __('Tipos de Cliente', 'crm-d1'),
            'all_items'                  => __('Todos los Tipos', 'crm-d1'),
            'parent_item'                => __('Tipo Padre', 'crm-d1'),
            'parent_item_colon'          => __('Tipo Padre:', 'crm-d1'),
            'new_item_name'              => __('Nuevo Tipo de Cliente', 'crm-d1'),
            'add_new_item'               => __('Agregar Nuevo Tipo', 'crm-d1'),
            'edit_item'                  => __('Editar Tipo', 'crm-d1'),
            'update_item'                => __('Actualizar Tipo', 'crm-d1'),
            'view_item'                  => __('Ver Tipo', 'crm-d1'),
            'separate_items_with_commas' => __('Separar tipos por comas', 'crm-d1'),
            'add_or_remove_items'        => __('Agregar o remover tipos', 'crm-d1'),
            'choose_from_most_used'      => __('Escoger de los más usados', 'crm-d1'),
            'popular_items'              => __('Tipos Populares', 'crm-d1'),
            'search_items'               => __('Buscar Tipos', 'crm-d1'),
            'not_found'                  => __('No hay Resultados', 'crm-d1'),
            'no_terms'                   => __('No hay Tipos', 'crm-d1'),
            'items_list'                 => __('Listado de Tipos de Cliente', 'crm-d1'),
            'items_list_navigation'      => __('Navegación del Listado de Tipos de Cliente', 'crm-d1'),
        );
        $args_tax = array(
            'labels'                     => $labels_tax,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => false,
            'show_in_nav_menus'          => false,
            'show_tagcloud'              => true,
            'show_in_rest'               => true,
        );

        register_taxonomy('tipo-cliente', array( 'contacto' ), $args_tax);
    }
}
