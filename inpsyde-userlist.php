<?php
/*
 * Plugin Name: Inpsyde Userlist API Plugin
 * Plugin URI: https://red-beret.com/inpsyde-userlist
 * Description: List of users and it's details on a custom URL, fetched by WordPress API from remote URL. This plugin is made for Inpsyde test skill suppose.
 * version: 1.0.0
 * Author: Adi Glibanovic
 * Author URI: https://rberet.com
 * License: GPLv2 or later
 * Text Domain: inpsyde-userlist
 * Domain Path: /languages
 */

class InpsydeUserlist
{
    public function __construct()
    {
        register_activation_hook(__FILE__, array($this, 'inpsydeactivation'));
        add_action('init', array($this, 'addslug'));
        add_action('query_vars', array($this, 'setvariable'));
        add_action('template_include', array($this, 'userlist'));
    }

    public function inpsydeactivation()
    {
        update_option('flush_rules', 1);
    }

    public function addslug()
    {
        add_rewrite_rule('^my-lovely-users-table$', 'index.php?my-lovely-users-table=1', 'top');
        if (get_option('flush_rules')) {
            flush_rewrite_rules();
            delete_option('flush_rules');
        }
    }

    public function setvariable($vars)
    {
        $vars[] = 'my-lovely-users-table';
        return $vars;
    }

    public function userlist($template)
    {
        if (get_query_var('my-lovely-users-table', false)) {

            // INCLUDE SCRIPT AND STYLE FOR PAGE
            add_action('wp_footer', array($this, 'userlist_cogs'));

            // return template path if found in active theme's inpsyde folder
            $themeTemplate = locate_template(array('inpsyde/template.php'));
            if ($themeTemplate) {
                return $themeTemplate;
            }

            // return template from plugin's templates
            $inpsydeTemplate = __DIR__ . '/templates/template.php';
            if (file_exists($inpsydeTemplate)) {
                return $inpsydeTemplate;
            }
        }
        return $template;
    }

    public function userlist_cogs()
    {
        wp_enqueue_style('cogs_style', plugin_dir_url(__FILE__) . 'assets/css/style.css', '', '1.0');
        wp_enqueue_script('cogs_script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), '1.0', true);
    }
}
new InpsydeUserlist;