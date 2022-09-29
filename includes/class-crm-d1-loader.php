<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://robertochoaweb.com/
 * @since      1.0.0
 *
 * @package    Crm_D1
 * @subpackage Crm_D1/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Crm_D1
 * @subpackage Crm_D1/includes
 * @author     Robert Ochoa <ochoa.robert1@gmail.com>
 */
class Crm_D1_Loader
{
    /**
     * The array of actions registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
     */
    protected $actions;

    /**
     * The array of filters registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
     */
    protected $filters;

    /**
     * Initialize the collections used to maintain the actions and filters.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        $this->actions = array();
        $this->filters = array();
    }

    /**
     * Add a new action to the collection to be registered with WordPress.
     *
     * @since    1.0.0
     * @param    string               $hook             The name of the WordPress action that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the action is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
     * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
     */
    public function add_action($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * Add a new filter to the collection to be registered with WordPress.
     *
     * @since    1.0.0
     * @param    string               $hook             The name of the WordPress filter that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the filter is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
     * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
     */
    public function add_filter($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * A utility function that is used to register the actions and hooks into a single
     * collection.
     *
     * @since    1.0.0
     * @access   private
     * @param    array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
     * @param    string               $hook             The name of the WordPress filter that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the filter is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         The priority at which the function should be fired.
     * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
     * @return   array                                  The collection of actions and filters registered with WordPress.
     */
    private function add($hooks, $hook, $component, $callback, $priority, $accepted_args)
    {
        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args
        );

        return $hooks;
    }

    /**
     * Register the filters and actions with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        foreach ($this->filters as $hook) {
            add_filter($hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args']);
        }

        foreach ($this->actions as $hook) {
            add_action($hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args']);
        }
    }

    /**
     * Method custom_meta_box_input
     *
     * @param $id $id [explicite description]
     * @param $name $name [explicite description]
     * @param $value $value [explicite description]
     * @param $type $type [explicite description]
     * @param $class $class [explicite description]
     *
     * @return void
     */
    public function custom_meta_box_input($id, $name, $value, $type, $atts)
    {
        $atts = shortcode_atts(
            array(
                'placeholder' => __('Ingrese los datos', 'crm-d1'),
                'required' => false,
                'class' => '',
                'tooltip' => '',
                'options' => array()
            ),
            $atts
        );

        ob_start();
        ?>
<div class="custom-input-form-container <?php echo $atts['class']; ?>">
    <?php switch ($type) {
        case 'blocked':
            ?>
    <label for="<?php echo $id; ?>">
        <?php echo $name ?> <?php if ($atts['tooltip'] != '') { ?> <span class="dashicons dashicons-warning" tooltip="<?php echo $atts['tooltip']; ?>"></span> <?php } ?>
    </label>
    <span class="custom-form-control custom-form-control-blocked"><?php echo $value; ?></span>
    <input type="hidden" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>" class="custom-form-control" <?php echo ($atts['required'] == true) ? 'required="required"' : ''; ?> placeholder="<?php echo $atts['placeholder']; ?>" />
    <?php
            break;
        case 'textarea':
            ?>
    <label for="<?php echo $id; ?>">
        <?php echo $name ?> <?php if ($atts['tooltip'] != '') { ?> <span class="dashicons dashicons-warning" tooltip="<?php echo $atts['tooltip']; ?>"></span> <?php } ?>
    </label>
    <textarea id="<?php echo $id; ?>" name="<?php echo $id; ?>" class="custom-form-control" rows="5" <?php echo ($atts['required'] == true) ? 'required="required"' : ''; ?> placeholder="<?php echo $atts['placeholder']; ?>"><?php echo $value; ?></textarea>
    <?php
            break;
        case 'select':
            ?>
    <label for="<?php echo $id; ?>">
        <?php echo $name ?> <?php if ($atts['tooltip'] != '') { ?> <span class="dashicons dashicons-warning" tooltip="<?php echo $atts['tooltip']; ?>"></span> <?php } ?>
    </label>
    <select id="<?php echo $id; ?>" name="<?php echo $id; ?>" <?php echo ($atts['required'] == true) ? 'required="required"' : ''; ?>>
        <?php if (!empty($atts['options'])) : ?>
        <option value="" selected disabled><?php echo $atts['placeholder']; ?></option>
        <?php foreach ($atts['options'] as $item) { ?>
        <option value="<?php echo $item; ?>" <?php selected($value, $item); ?>><?php echo $item; ?></option>
        <?php } ?>
        <?php endif; ?>
    </select>
    <?php
            break;

        case 'radio':
            ?>
    <label for="<?php echo $id; ?>">
        <?php echo $name ?> <?php if ($atts['tooltip'] != '') { ?> <span class="dashicons dashicons-warning" tooltip="<?php echo $atts['tooltip']; ?>"></span> <?php } ?>
    </label>
    <input type="<?php echo $type; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>" class="custom-form-control" <?php echo ($atts['required'] == true) ? 'required="required"' : ''; ?> placeholder="<?php echo $atts['placeholder']; ?>" />
    <?php
            break;
        case 'file':
            ?>
    <label for="<?php echo $id; ?>">
        <?php echo $name ?> <?php if ($atts['tooltip'] != '') { ?> <span class="dashicons dashicons-warning" tooltip="<?php echo $atts['tooltip']; ?>"></span> <?php } ?>
    </label>
    <?php if (is_array($value)) : ?>
    <?php $url =  ($value != '') ? $value['url'] : ''; ?>
    <?php else : ?>
    <?php $url = ''; ?>
    <?php endif; ?>
    <input type="<?php echo $type; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $url; ?>" class="custom-form-control" <?php echo ($atts['required'] == true) ? 'required="required"' : ''; ?> placeholder="<?php echo $atts['placeholder']; ?>" />
    <?php
            break;

        case 'checkbox':
            ?>
    <label for="<?php echo $id; ?>">
        <?php echo $name ?> <?php if ($atts['tooltip'] != '') { ?> <span class="dashicons dashicons-warning" tooltip="<?php echo $atts['tooltip']; ?>"></span> <?php } ?>
    </label>
    <input type="<?php echo $type; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>" class="custom-form-control" <?php echo ($atts['required'] == true) ? 'required="required"' : ''; ?> placeholder="<?php echo $atts['placeholder']; ?>" />
    <?php
            break;

        default:
            ?>
    <label for="<?php echo $id; ?>">
        <?php echo $name ?> <?php if ($atts['tooltip'] != '') { ?> <span class="dashicons dashicons-warning" tooltip="<?php echo $atts['tooltip']; ?>"></span> <?php } ?>
    </label>
    <input type="<?php echo $type; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>" class="custom-form-control" <?php echo ($atts['required'] == true) ? 'required="required"' : ''; ?> placeholder="<?php echo $atts['placeholder']; ?>" />
    <?php
            break;
    }?>
</div>
<?php
        $content = ob_get_clean();
        echo $content;
    }
}