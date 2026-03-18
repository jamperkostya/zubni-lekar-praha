<?php
/**
 * Theme Functions - Art-IT / Promag-Dental
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Promag-Dental
 * @since 3.0
 */

/* ==================================================
 * 1. Подключение стилей и скриптов
 * ================================================== */
if ( ! function_exists( 'artit_enqueue_assets' ) ) {
    function artit_enqueue_assets() {
        // Пути к CSS и JS
        $theme_dir  = get_template_directory();
        $theme_uri  = get_template_directory_uri();

        // ------------------------------
        // Стили
        // ------------------------------
        $styles = [
            'bootstrap-grid' => '/assets/css/bootstrap.min.css',
            'tinyselect-style' => '/assets/css/tinyselect.css',
            'main-style'     => '/assets/css/style.css',
        ];
        
        if(is_front_page() || is_singular('service'))
        {
            $file_path = $theme_dir . '/assets/css/glider.min.css';
            wp_enqueue_style('glider', $theme_uri . '/assets/css/glider.min.css', [], file_exists($file_path) ? filemtime($file_path) : wp_get_theme()->get('Version'));
            
            wp_enqueue_script('glider', $theme_uri . '/assets/js/glider.min.js', ['jquery'], '1.7.4', true);
        }

        foreach ( $styles as $handle => $path ) {
            $file_path = $theme_dir . $path;
            wp_enqueue_style(
                $handle,
                $theme_uri . $path,
                [],
                file_exists($file_path) ? filemtime($file_path) : wp_get_theme()->get('Version')
            );
        }

        // ------------------------------
        // Скрипты
        // ------------------------------
        $scripts = [
            'bootstrap' => [
                'path' => '/assets/js/bootstrap.min.js',
                'deps' => ['jquery'],
                'ver'  => '3.4.1', // версия Bootstrap
            ],
            'tinyselect' => [
                'path' => '/assets/js/tinyselect.js',
                'deps' => ['jquery'],
                'ver'  => '1.0.4',
            ],
            // 'lightbox' => [
            //     'path' => '/vendor/frontpack/lightbox2/js/lightbox.min.js',
            //     'deps' => ['jquery'],
            //     'ver'  => '2.11.3', // версия Lightbox
            // ],
            'theme-scripts' => [
                'path' => '/assets/js/scripts.js',
                'deps' => ['jquery'],
                'ver'  => file_exists($theme_dir . '/assets/js/scripts.js') ? filemtime($theme_dir . '/assets/js/scripts.js') : wp_get_theme()->get('Version'),
            ],
        ];
        
        foreach ( $scripts as $handle => $data ) {
            wp_enqueue_script(
                $handle,
                $theme_uri . $data['path'],
                $data['deps'],
                $data['ver'],
                true
            );
        }

        // ------------------------------
        // Передача данных в JS
        // ------------------------------
        if ( wp_script_is('theme-scripts', 'enqueued') ) {
            wp_localize_script(
                'theme-scripts',
                'theme_ajax',
                [
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce'   => wp_create_nonce('theme_nonce'),
                ]
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'artit_enqueue_assets');

/* ==================================================
 * 2. Поддержка возможностей темы
 * ================================================== */
if ( ! function_exists('artit_setup_theme') ) {
    function artit_setup_theme() {
        // Title
        add_theme_support('title-tag');

        // Миниатюры
        add_theme_support('post-thumbnails');

        // HTML5
        add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);

        // Кастомное лого
        add_theme_support('custom-logo', [
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
        ]);

        // Меню
        register_nav_menus([
            'header_menu' => __('Header Menu', 'promagdental'),
            'footer_menu' => __('Footer Menu', 'promagdental'),
        ]);

        // Кастомные размеры изображений
        add_image_size('product-medium', 350, 220);

        // Удаление лишних размеров
        remove_image_size('1536x1536');
        remove_image_size('2048x2048');
        remove_image_size('150x150');

        // Убираем лишние стили на фронтенде
        if ( ! is_admin() ) {
            add_action('wp_print_styles', 'artit_deregister_styles', 100);
        }
    }
}
add_action('after_setup_theme', 'artit_setup_theme');

function artit_deregister_styles() {
    wp_deregister_style('dashicons');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('classic-theme-styles');
}

/* ==================================================
 * 3. Удаление лишнего из <head>
 * ================================================== */
if ( ! function_exists('artit_leanup_head') ) {
    function artit_cleanup_head() {
        if ( is_admin() ) return;

        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'rest_output_link_wp_head');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    }
}
add_action('init', 'artit_cleanup_head');

/* ==================================================
 * 4. Alt и Title для изображений (SEO)
 * ================================================== */
function artit_add_img_title( $attr, $attachment = null ) {
    if ( ! is_admin() && $attachment ) {
        $title = trim(strip_tags($attachment->post_title));
        if ( empty($attr['title']) ) $attr['title'] = $title;
        if ( empty($attr['alt']) )   $attr['alt']   = $title;
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'artit_add_img_title', 10, 2);

/* ==================================================
 * 5. Lightbox для картинок в контенте
 * ================================================== */
function artit_add_lightbox($content) {
    if ( is_singular() ) {
        $pattern = '/<a(.*?)href=("|\')(.*?\.(bmp|gif|jpeg|jpg|png))("|\')(.*?)>/i';
        $replacement = '<a$1href=$2$3$5 data-lightbox="image-set"$6>';
        $content = preg_replace($pattern, $replacement, $content);
    }
    return $content;
}
add_filter('the_content', 'artit_add_lightbox');

/* ==================================================
 * 6. TinyMCE: кнопка таблицы
 * ================================================== */
if ( get_user_option('rich_editing') === 'true' ) {
    function artit_add_table_button($buttons) {
        array_push($buttons, 'separator', 'table');
        return $buttons;
    }
    function artit_add_table_plugin($plugins) {
        $plugins['table'] = get_template_directory_uri() . '/assets/js/tiny_mce_table.js';
        return $plugins;
    }
    add_filter('mce_buttons', 'artit_add_table_button');
    add_filter('mce_external_plugins', 'artit_add_table_plugin');
}

/* ==================================================
 * 7. Carbon Fields + кастомные типы
 * ================================================== */
function artit_load_carbon_fields() {
    $vendor_autoload = get_template_directory() . '/vendor/autoload.php';
    if ( file_exists($vendor_autoload) ) {
        require_once $vendor_autoload;
        \Carbon_Fields\Carbon_Fields::boot();
        require_once get_template_directory() . '/inc/custom-fields.php';
    }

    $custom_types = get_parent_theme_file_path('/inc/custom-types.php');
    if ( file_exists($custom_types) ) {
        require_once $custom_types;
    }
    
    $custom_functions = get_parent_theme_file_path('/inc/custom-functions.php');
    if ( file_exists($custom_functions) ) {
        require_once $custom_functions;
    }
    
    $translates = get_parent_theme_file_path('/inc/translates.php');
    if ( file_exists($translates) ) {
        require_once $translates;
    }
}
add_action('after_setup_theme', 'artit_load_carbon_fields');

/* ==================================================
 * 8. Defer для скриптов (кроме jQuery)
 * ================================================== */
function artit_defer_scripts($tag, $handle, $src) {
    // $exclude = ['jquery', 'jquery-core', 'jquery-migrate', 'contact-form-7', 'wpcf7-recaptcha'];
    // if ( is_admin() || in_array($handle, $exclude, true) ) {
    //     return $tag;
    // }
    return $tag;
    // return '<script src="' . esc_url($src) . '" defer></script>' . "\n";
}
add_filter('script_loader_tag', 'artit_defer_scripts', 10, 3);

/* ==================================================
 * 9. Кастомное лого
 * ================================================== */
function custom_logo($html=null) {
    $custom_logo_id = get_theme_mod('custom_logo');
    if (!$custom_logo_id) return $html;
    
    // Получаем MIME-тип вложения
    $mime_type = get_post_mime_type($custom_logo_id);
    if($mime_type === 'image/svg+xml')
    {
        // Для SVG выводим только оригинал
        $logo_url  = wp_get_attachment_url($custom_logo_id);
        $logo_img = sprintf(
            '<img src="%s" class="custom-logo" alt="%s" />',
            esc_url($logo_url),
            esc_attr(get_bloginfo('name'))
        );
        $logo_link = sprintf(
            '<a href="%s" class="custom-logo-link" rel="home">%s</a>',
            esc_url(home_url('/')),
            $logo_img
        );
    }
    else
    {
        // Для остальных — стандартный вывод с ресайзами
        $logo_link = wp_get_attachment_image($custom_logo_id, 'full', false, ['class' => 'custom-logo']);
    }

    return $logo_link;
}
add_filter('get_custom_logo', 'custom_logo');

/* ==================================================
 * 10. Breadcrumbs (Yoast fallback)
 * ================================================== */
function custom_breadcrumbs() {
    if ( function_exists('yoast_breadcrumb') ) {
        return yoast_breadcrumb('<p id="breadcrumbs">','</p>');
    }
    else
    {
        $home_link   = home_url('/');
        $home_text   = 'Home';
        $delimiter   = ''; // Можно поставить ' › ' для наглядности
        $position    = 1; // Счётчик Schema.org
        
        $link = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'
              . '<a itemprop="item" href="%1$s"><span itemprop="name">%2$s</span></a>'
              . '<meta itemprop="position" content="%3$d" /></li>';
        
        $current = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'
                 . '<span itemprop="name">%1$s</span>'
                 . '<meta itemprop="position" content="%2$d" /></li>';
        
        $breadcrumb_trail = '';
        $page_addon       = '';
        
        global $wp_the_query;
        $queried_object = $wp_the_query->get_queried_object();
        
        // Singular
        if ( is_singular() && $queried_object instanceof WP_Post ) {
            $post_object = sanitize_post( $queried_object );
            $title       = apply_filters( 'the_title', $post_object->post_title );
            $parent      = $post_object->post_parent;
            $post_type   = $post_object->post_type;
            $post_id     = $post_object->ID;
            $parent_str  = '';
            $type_link   = '';
            $cat_links   = '';
        
            // категории
            if ( in_array( $post_type, ['post','game'] ) ) {
                $categories = get_the_category( $post_id );
                if ( $categories ) {
                    $category = $categories[0];
                    $parents  = get_ancestors( $category->term_id, 'category' );
                    $parents  = array_reverse( $parents );
                    foreach ( $parents as $cat_id ) {
                        $position++;
                        $breadcrumb_trail .= sprintf( 
                            $link,
                            esc_url( get_category_link($cat_id) ),
                            esc_html( get_cat_name($cat_id) ),
                            $position
                        );
                    }
                    $position++;
                    $breadcrumb_trail .= sprintf(
                        $link,
                        esc_url( get_category_link($category->term_id) ),
                        esc_html( $category->name ),
                        $position
                    );
                }
            }
        
            // custom post type
            if ( !in_array( $post_type, ['post','page','attachment','blog'] ) ) {
                $obj = get_post_type_object( $post_type );
                if ( $obj && $obj->has_archive ) {
                    $position++;
                    $breadcrumb_trail .= sprintf(
                        $link,
                        esc_url( get_post_type_archive_link( $post_type ) ),
                        esc_html( $obj->labels->singular_name ),
                        $position
                    );
                }
            }
        
            // родители поста
            if ( $parent ) {
                $parents = [];
                while ( $parent ) {
                    $post_parent = get_post( $parent );
                    $parents[]   = $post_parent;
                    $parent      = $post_parent->post_parent;
                }
                $parents = array_reverse( $parents );
                foreach ( $parents as $p ) {
                    $position++;
                    $breadcrumb_trail .= sprintf(
                        $link,
                        esc_url( get_permalink( $p->ID ) ),
                        esc_html( get_the_title( $p->ID ) ),
                        $position
                    );
                }
            }
        
            // текущий пост
            $position++;
            $breadcrumb_trail .= sprintf( $current, esc_html( $title ), $position );
        }
        
        // Archive
        elseif ( is_archive() ) {
            if ( is_category() || is_tag() || is_tax() ) {
                $term = $queried_object;
                if ( $term && isset($term->term_id) ) {
                    if ( $term->parent ) {
                        $parents = get_ancestors( $term->term_id, $term->taxonomy );
                        $parents = array_reverse( $parents );
                        foreach ( $parents as $term_id ) {
                            $t = get_term( $term_id, $term->taxonomy );
                            $position++;
                            $breadcrumb_trail .= sprintf(
                                $link,
                                esc_url( get_term_link($t) ),
                                esc_html( $t->name ),
                                $position
                            );
                        }
                    }
                    $position++;
                    $breadcrumb_trail .= sprintf( $current, esc_html( $term->name ), $position );
                }
            }
            elseif ( is_author() ) {
                $position++;
                $breadcrumb_trail = sprintf( $current, sprintf(__('Author: %s'), esc_html($queried_object->data->display_name) ), $position );
            }
            elseif ( is_date() ) {
                if ( is_year() ) {
                    $position++;
                    $breadcrumb_trail = sprintf( $current, get_query_var('year'), $position );
                } elseif ( is_month() ) {
                    $position++;
                    $breadcrumb_trail = sprintf(
                        $link,
                        esc_url( get_year_link( get_query_var('year') ) ),
                        get_query_var('year'),
                        $position
                    );
                    $position++;
                    $breadcrumb_trail .= sprintf( $current, date_i18n( 'F', mktime(0,0,0,get_query_var('monthnum')) ), $position );
                } elseif ( is_day() ) {
                    $year  = get_query_var('year');
                    $month = get_query_var('monthnum');
                    $position++;
                    $breadcrumb_trail = sprintf( $link, esc_url( get_year_link($year) ), $year, $position );
                    $position++;
                    $breadcrumb_trail .= sprintf( $link, esc_url( get_month_link($year, $month) ), date_i18n('F', mktime(0,0,0,$month)), $position );
                    $position++;
                    $breadcrumb_trail .= sprintf( $current, get_query_var('day'), $position );
                }
            }
            elseif ( is_post_type_archive() ) {
                $obj = get_post_type_object( get_query_var('post_type') );
                $position++;
                $breadcrumb_trail = sprintf( $current, $obj->labels->singular_name, $position );
            }
        }
        
        // Search
        elseif ( is_search() ) {
            $position++;
            $breadcrumb_trail = sprintf( $current, sprintf(__('Search: %s'), get_search_query()), $position );
        }
        
        // 404
        elseif ( is_404() ) {
            $position++;
            $breadcrumb_trail = sprintf( $current, __('Error 404'), $position );
        }
        
        // Страницы пагинации
        if ( is_paged() ) {
            $current_page = max( get_query_var('paged'), get_query_var('page') );
            $position++;
            $breadcrumb_trail .= sprintf( $current, sprintf(__('Page %s'), $current_page), $position );
        }
        
        // Output
        $out  = '<ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumbs p-b-30"">';
        if ( !is_home() && !is_front_page() ) {
            $out .= sprintf(
                $link,
                $home_link,
                $home_text,
                $position
            );
            $out .= $delimiter . $breadcrumb_trail;
        }
        $out .= '</ul>';
        
        return $out;
    }
    return ''; // можно добавить кастомную логику, если Yoast не активен
}
add_shortcode('custom_breadcrumbs', 'custom_breadcrumbs');


/* ==================================================
 * 11. CF7 & другие фильтры
 * ================================================== */
add_filter('show_admin_bar', '__return_false');
add_filter('auto_update_theme', '__return_false');
add_filter('auto_update_plugin', '__return_false');
add_filter('wpcf7_form_elements', function($content) {
    // $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    return $content;
});
// Для CF7: можно раскомментировать, если нужно
// add_filter('wpcf7_autop_or_not', '__return_false');

// check if content is empty
// function empty_content($str) {
//     return trim(str_replace('&nbsp;','',strip_tags($str,'<img>'))) == '';
// }
// // Регистрируем действие для AJAX
// function load_more_posts() {
//     $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
//     $taxonomy = isset($_GET['taxonomy']) ? htmlspecialchars($_GET['taxonomy']) : 'cat';
//     $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//     $post_type = isset($_GET['post_type']) ? htmlspecialchars($_GET['post_type']) : 'post';
//     
//     $args = array(
//         'post_type'      => $post_type,
//         'posts_per_page' => get_option('posts_per_page'),
//         'paged'          => $page,
//         'tax_query'      => array(
//             array(
//                 'taxonomy' => $taxonomy,
//                 'field'    => 'term_id',
//                 'terms'    => $category_id
//             )
//         )
//     );
//     // Запрос к базе данных
//     $query = new WP_Query($args);
// 
//     // Если есть посты
//     if ($query->have_posts()) {
//         $posts = '';
//     
//         while ($query->have_posts()) {
//             $query->the_post();
//             ob_start();
//             get_template_part( 'templates/content-part/content', $post_type );
//             $posts .= ob_get_clean();
//         }
//     
//         // Проверка, есть ли еще посты для подгрузки
//         $has_more_posts = $query->max_num_pages > $page;
//     
//         // Ответ
//         wp_send_json([
//             'posts' => $posts,
//             'has_more_posts' => $has_more_posts
//         ]);
//     } else {
//         // Если постов нет
//         wp_send_json([
//             'posts' => '',
//             'has_more_posts' => false
//         ]);
//     }
//     
//     // Завершаем выполнение запроса
//     wp_die();
// }
// 
// // Хук для регистрации обработчика AJAX
// add_action('wp_ajax_load_posts', 'load_more_posts'); // Для авторизованных пользователей
// add_action('wp_ajax_nopriv_load_posts', 'load_more_posts'); // Для неавторизованных пользователей
// 
// function ajax_search_handler() {
//     if (!isset($_GET['search']) || empty($_GET['search'])) {
//         wp_send_json(
//             [
//                 'status' => 'error',
//                 'message' => 'Введите минимум 3 символа'
//             ]
//         );
//     }
// 
//     $query = sanitize_text_field($_GET['search']);
// 
//     $args = array(
//         'posts_per_page' => 5,
//         's'             => $query,
//         'post_status' => 'publish',
//     );
// 
//     $search_query = new WP_Query($args);
// 
//     if ($search_query->have_posts()) :
//         $response['status'] = 'success';
//         while ($search_query->have_posts()) : $search_query->the_post();
//             $response['results'][] = [
//                 'title' => get_the_title(),
//                 'link' => get_permalink(),
//             ];
//         endwhile;
//         $response['message'] = 'Found '.$search_query->post_count.' games by query: '.$query;
//     else :
//         $response['status'] = 'error';
//         $response['message'] = 'Nothing found';
//     endif;
//     wp_send_json($response);
//     wp_die();
// }
// 
// add_action('wp_ajax_ajax_search', 'ajax_search_handler');
// add_action('wp_ajax_nopriv_ajax_search', 'ajax_search_handler');
// 
// function custom_excerpt_more($more) {
//     return '... <span class="read-more-text">Read More</span>';
// }
// add_filter('excerpt_more', 'custom_excerpt_more');

// Удаление /category/ из URL категории
// add_filter('category_rewrite_rules', function ($category_rewrite) {
//     $category_rewrite = [];
//     $categories = get_categories(['hide_empty' => false]);
// 
//     foreach ($categories as $category) {
//         $slug = $category->slug;
//         if ($category->parent == 0) {
//             $category_rewrite["{$slug}/?$"] = "index.php?category_name={$slug}";
//             $category_rewrite["{$slug}/page/?([0-9]{1,})/?$"] = "index.php?category_name={$slug}&paged=\$matches[1]";
//         } else {
//             $parents = get_category_parents($category->term_id, false, '/', true);
//             $parents = str_replace('/', '', $parents);
//             $category_rewrite["{$parents}/?$"] = "index.php?category_name={$parents}";
//             $category_rewrite["{$parents}/page/?([0-9]{1,})/?$"] = "index.php?category_name={$parents}&paged=\$matches[1]";
//         }
//     }
// 
//     return $category_rewrite;
// });
// // Удаление base 'category' из URL
// add_filter('request', function ($query_vars) {
//     if (isset($query_vars['category_name']) && strpos($query_vars['category_name'], 'category/') === 0) {
//         $query_vars['category_name'] = str_replace('category/', '', $query_vars['category_name']);
//     }
//     return $query_vars;
// });
// 
// // Обновляем правила при активации темы
// add_action('init', function () {
//     global $wp_rewrite;
//     $wp_rewrite->extra_permastructs['category']['struct'] = '%category%';
// });
// 
// // добавляем дату изменения категории (term)
// add_action('edited_category', 'save_category_last_modified', 10, 2);
// add_action('created_category', 'save_category_last_modified', 10, 2);
// function save_category_last_modified($term_id, $tt_id) {
//     update_term_meta($term_id, 'last_modified', current_time('mysql'));
// }
// 
// // выводим посты по алфавиту
// add_action('pre_get_posts', 'sort_posts_alphabetically');
// function sort_posts_alphabetically($query) {
//     if (!is_admin() ) {
//         $query->set('orderby', 'title');
//         $query->set('order', 'ASC');
//     }
// }
// add_filter('wp_dropdown_users_args', function($query_args, $r) {
//     // Исключаем администраторов из выпадающего списка выбора автора
//     $query_args['role__not_in'] = ['Administrator'];
//     return $query_args;
// }, 10, 2);
// 
// // Количество элементов в текущем посте
// function yoast_var_post_count() {
//     if ( ! function_exists('carbon_get_post_meta') ) {
//         return 0;
//     }
//     $crb_coloring = carbon_get_post_meta( get_the_ID(), 'crb_coloring' );
//     return is_array( $crb_coloring ) ? count( $crb_coloring ) : 0;
// }
// 
// // Общее количество элементов по всем постам
// function yoast_var_total_count() {
//     if ( ! function_exists('carbon_get_post_meta') ) {
//         return 0;
//     }
// 
//     // Кэшируем результат (чтобы не грузить базу каждый раз)
//     $cache_key = 'yoast_total_coloring_count';
//     $cached    = wp_cache_get( $cache_key, 'yoast' );
//     if ( false !== $cached ) {
//         return $cached;
//     }
// 
//     $args = [
//         'post_type'      => 'post', // замени на свой кастомный тип, если нужно
//         'post_status'    => 'publish',
//         'fields'         => 'ids',
//         'nopaging'       => true,
//     ];
// 
//     $post_ids = get_posts( $args );
// 
//     $total = 0;
//     foreach ( $post_ids as $post_id ) {
//         $crb_coloring = carbon_get_post_meta( $post_id, 'crb_coloring' );
//         if ( is_array( $crb_coloring ) ) {
//             $total += count( $crb_coloring );
//         }
//     }
// 
//     // Кэшируем на 10 минут
//     wp_cache_set( $cache_key, $total, 'yoast', 600 );
// 
//     return $total;
// }

// Регистрируем переменные для Yoast SEO
// add_action( 'wpseo_register_extra_replacements', function () {
//     wpseo_register_var_replacement(
//         '%%post_count%%',
//         'yoast_var_post_count',
//         'advanced',
//         'Количество элементов в текущем посте'
//     );
// 
//     wpseo_register_var_replacement(
//         '%%total_count%%',
//         'yoast_var_total_count',
//         'advanced',
//         'Общее количество элементов по всем постам'
//     );
// });

// Добавляем placeholder в поля формы комментариев
// function my_custom_comment_placeholders($fields) {
//     
//     // Placeholder для имени
//     if(isset($fields['author'])) {
//         $fields['author'] = str_replace(
//             '<input', 
//             '<input placeholder="Name *"', 
//             $fields['author']
//         );
//     }
// 
//     // Placeholder для email
//     if(isset($fields['email'])) {
//         $fields['email'] = str_replace(
//             '<input', 
//             '<input placeholder="Your e-mail *"', 
//             $fields['email']
//         );
//     }
// 
//     // Placeholder для сайта (если есть)
//     if(isset($fields['url'])) {
//         $fields['url'] = str_replace(
//             '<input', 
//             '<input placeholder="Ваш сайт (необязательно)"', 
//             $fields['url']
//         );
//     }
// 
//     return $fields;
// }
// add_filter('comment_form_default_fields', 'my_custom_comment_placeholders');
// 
// 
// // Добавляем placeholder для самого комментария
// function my_custom_comment_textarea_placeholder($args) {
//     $args['comment_field'] = str_replace(
//         '<textarea', 
//         '<textarea placeholder="Comment"', 
//         $args['comment_field']
//     );
//     return $args;
// }
// add_filter('comment_form_defaults', 'my_custom_comment_textarea_placeholder');
// 
// add_action( 'template_redirect', function() {
//     if ( user_can( get_the_author_meta('ID'), 'administrator') ) {
//         // 404:
//         global $wp_query;
//         $wp_query->set_404();
//         status_header( 404 );
//         nocache_headers();
//         include( get_404_template() );
//         exit;
//     }
// });

// Убираем стандартное поле "Biographical Info"
// remove_filter( 'user_description', 'wp_filter_kses' );
// remove_filter( 'pre_user_description', 'wp_filter_kses' );
// Скрываем стандартное поле "Biographical Info" через CSS
// function hide_default_bio_field() {
//     echo '<style>
//         #description { display: none; }
//     </style>';
// }
// add_action( 'admin_head-user-edit.php', 'hide_default_bio_field' );
// add_action( 'admin_head-profile.php', 'hide_default_bio_field' );
// Добавляем свой визуальный редактор для Biographical Info
function my_custom_user_bio_editor( $user ) {
    ?>
    <h3><?php _e("Biographical Info", "textdomain"); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="description_editor"><?php _e("Biographical Info", "textdomain"); ?></label></th>
            <td>
                <?php
                $content   = get_the_author_meta( 'description', $user->ID );
                $editor_id = 'description_editor';
                $settings  = array(
                    'textarea_name' => 'description', // важно для сохранения
                    'media_buttons' => false,
                    'textarea_rows' => 10,
                    'teeny'         => true,
                );
                wp_editor( $content, $editor_id, $settings );
                ?>
            </td>
        </tr>
    </table>
    <?php
}
// add_action( 'show_user_profile', 'my_custom_user_bio_editor' );
// add_action( 'edit_user_profile', 'my_custom_user_bio_editor' );

// Сохраняем данные
// function my_save_custom_user_bio_editor( $user_id ) {
//     if ( current_user_can( 'edit_user', $user_id ) && isset($_POST['description']) ) {
//         update_user_meta( $user_id, 'description', wp_kses_post($_POST['description']) );
//     }
// }
// add_action( 'personal_options_update', 'my_save_custom_user_bio_editor' );
// add_action( 'edit_user_profile_update', 'my_save_custom_user_bio_editor' );

add_filter( 'tablepress_use_default_css', '__return_false' ); //disable plugin's table press styles