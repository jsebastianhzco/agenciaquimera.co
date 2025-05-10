<?php
/**
 * Plugin Name: agenciaquimera.com
 * Plugin URI: https://agenciaquimera.com
 * Description: Información técnica y de contacto para este sitio desarrollado por Agencia Quimera.
 * Version: 1.0
 * Author: Sebastian Hernandez - Agencia Quimera
 * Author URI: https://agenciaquimera.com
 */
 
// Requiere el checker moderno con namespace
require_once __DIR__ . '/update-checker/plugin-update-checker.php';

// Importar la clase usando el namespace correcto
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// Obtener el slug dinámicamente (nombre de la carpeta del plugin)
$plugin_slug = basename(dirname(__FILE__));

// Construir el checker moderno
$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/jsebastianhzco/agenciaquimera.co/',
    __FILE__,
    $plugin_slug
);


defined('ABSPATH') or die('Acceso no autorizado.');

// Ocultar botón "Desactivar"
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'quimera_ocultar_boton_desactivar');
function quimera_ocultar_boton_desactivar($actions) {
    if (isset($actions['deactivate'])) {
        unset($actions['deactivate']);
    }
    return $actions;
}

// Agregar ítem al menú de administración
add_action('admin_menu', 'quimera_agregar_menu_admin');
function quimera_agregar_menu_admin() {
    add_menu_page(
        'Información técnica del sitio',
        '⚙️ Quimera',
        'manage_options',
        'agenciaquimera-info',
        'quimera_mostrar_info_admin',
        'dashicons-shield-alt',
        2
    );
}

// Estilo personalizado para ítem de menú
add_action('admin_head', 'quimera_custom_menu_style');
function quimera_custom_menu_style() {
    echo '
    <style>
        #adminmenu .toplevel_page_agenciaquimera-info .wp-menu-name {
            color: #00d084 !important;
            font-weight: bold;
        }
        #adminmenu .toplevel_page_agenciaquimera-info:hover {
            background-color: #1e1e1e !important;
        }
        #adminmenu .toplevel_page_agenciaquimera-info .dashicons {
            color: #00d084 !important;
        }
    </style>';
}

// Contenido de la página del admin
function quimera_mostrar_info_admin() {
    global $wpdb;

    $site_name = get_bloginfo('name');
    $site_url = get_site_url();
    $wp_version = get_bloginfo('version');
    $php_version = phpversion();
    $theme = wp_get_theme();
    $theme_name = $theme->get('Name');
    $is_child_theme = is_child_theme() ? 'Sí' : 'No';
    $ssl_status = is_ssl() ? 'Activo' : 'Inactivo';
    $debug_mode = (defined('WP_DEBUG') && WP_DEBUG) ? 'Activo' : 'Inactivo';
    $elementor_version = (defined('ELEMENTOR_VERSION')) ? ELEMENTOR_VERSION : 'No instalado';

    $fecha_primera_pagina = $wpdb->get_var("
        SELECT post_date 
        FROM $wpdb->posts 
        WHERE post_type = 'page' AND post_status = 'publish' 
        ORDER BY post_date ASC 
        LIMIT 1
    ");
    $fecha_formateada = $fecha_primera_pagina 
        ? date_i18n('F Y', strtotime($fecha_primera_pagina)) 
        : 'No disponible';

    $contact_email = 'soporte@agenciaquimera.com';
    $whatsapp = '+1 (514) 416-2085';
    $whatsapp_link = 'https://wa.me/15144162085';

    echo '<div class="wrap" style="font-family: Jost, sans-serif;">';
    echo '<h1 style="color:#2d2d2d;">Información técnica y de desarrollo</h1>';
    echo '<table style="width:100%; max-width:800px; border-spacing:0 8px;">';
    echo '<tr><td><strong>Nombre del sitio:</strong></td><td>' . esc_html($site_name) . '</td></tr>';
    echo '<tr><td><strong>URL del sitio:</strong></td><td><a href="' . esc_url($site_url) . '" target="_blank">' . esc_html($site_url) . '</a></td></tr>';
    echo '<tr><td><strong>Fecha de desarrollo:</strong></td><td>' . esc_html($fecha_formateada) . '</td></tr>';
    echo '<tr><td><strong>Versión de WordPress:</strong></td><td>' . esc_html($wp_version) . '</td></tr>';
    echo '<tr><td><strong>Versión de PHP:</strong></td><td>' . esc_html($php_version) . '</td></tr>';
    echo '<tr><td><strong>Theme activo:</strong></td><td>' . esc_html($theme_name) . '</td></tr>';
    echo '<tr><td><strong>¿Es child theme?:</strong></td><td>' . esc_html($is_child_theme) . '</td></tr>';
    echo '<tr><td><strong>SSL:</strong></td><td>' . esc_html($ssl_status) . '</td></tr>';
    echo '<tr><td><strong>Modo depuración (WP_DEBUG):</strong></td><td>' . esc_html($debug_mode) . '</td></tr>';
    echo '<tr><td><strong>Elementor:</strong></td><td>' . esc_html($elementor_version) . '</td></tr>';
    echo '</table>';
    echo '<hr style="margin: 30px 0;">';
    echo '<h2 style="margin-bottom:10px;">Soporte y contacto</h2>';
    echo '<p><strong>Email:</strong> <a href="mailto:' . esc_attr($contact_email) . '">' . esc_html($contact_email) . '</a></p>';
    echo '<p><strong>WhatsApp:</strong> <a href="' . esc_url($whatsapp_link) . '" target="_blank">' . esc_html($whatsapp) . '</a></p>';
    echo '<p><strong>Web:</strong> <a href="https://agenciaquimera.co" target="_blank">https://agenciaquimera.co</a></p>';
    echo '<hr style="margin-top:30px;">';
    echo '<p><em>Este sitio fue desarrollado por Agencia Quimera. Creamos experiencias digitales con código, café y creatividad.</em></p>';
    echo '</div>';
}

// Inyectar la fuente Jost desde Google Fonts en frontend
add_action('wp_enqueue_scripts', 'quimera_cargar_fuente_jost');
function quimera_cargar_fuente_jost() {
    wp_enqueue_style('jost-font', 'https://fonts.googleapis.com/css2?family=Jost:wght@400;500;700&display=swap', false);
}

// Footer con branding y estilo
add_action('wp_footer', 'quimera_mostrar_footer_en_front');
function quimera_mostrar_footer_en_front() {
    if (!is_admin()) {
        $year = date("Y");
        $site_name = get_bloginfo('name');

        echo '
        <style>
            .quimera-footer {
                background-color: #000;
                color: #fff;
                padding: 10px 10px;
                font-family: "Jost", sans-serif;
                font-size: 13px;
                line-height: 1.3;
            }
            .quimera-footer-container {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
            }
            .quimera-footer-col {
                flex: 1;
                min-width: 250px;
            }
            .quimera-footer-col.right {
                text-align: right;
            }
            @media (max-width: 768px) {
                .quimera-footer-container {
                    flex-direction: column;
                    text-align: center;
                    gap: 10px;
                }
                .quimera-footer-col.right {
                    text-align: center;
                }
            }
        </style>
        <div class="quimera-footer">
            <div class="quimera-footer-container">
                <div class="quimera-footer-col">
                    <p style="margin: 0;">
                        &copy; ' . $year . ' ' . esc_html($site_name) . '. Todos los derechos reservados. <br>
                        Prohibida su reproducción total o parcial, así como su uso no autorizado en cualquier forma.
                    </p>
                </div>
                <div class="quimera-footer-col right">
                    <span style="margin-right: 10px;">Desarrollado por Agencia Quimera</span>
                    <a href="https://agenciaquimera.co" target="_blank" style="display: inline-block;">
                        <img src="http://agenciaquimera.co/wp-content/uploads/2024/02/logonav.jpg" alt="Agencia Quimera" style="height: 30px; vertical-align: middle;">
                    </a>
                </div>
            </div>
        </div>';
    }
}

