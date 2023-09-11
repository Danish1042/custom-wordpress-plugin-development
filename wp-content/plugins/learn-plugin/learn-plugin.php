<?php
/**
 * @wordpress-plugin
 * Plugin Name: First Plugin
 * Plugin URI:  rjdanish.com
 * Description: This is description of the first plugin
 * Version: 1.0.0
 * Author: RJ Danish
 * Author URI: #
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: learn-plugin
 * Domain Path: /languages
 */

//  just for security reasons someone can not directly access the files of this plugin
if(!defined('ABSPATH')){
    header('location: /');
    // die('You can not access');
}

function my_plugin_activation(){
    
    global $wpdb, $table_prefix;

    $wp_emp = $table_prefix.'emp';
    // create table
    $query = "CREATE TABLE IF NOT EXISTS `$wp_emp` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `status` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;";

    $wpdb->query($query);

    // insert data into table first traditional method
    // $query = "INSERT INTO `$wp_emp` (`name`, `email`, `status`) VALUES ('Muhammad Danish', 'danish@gmail.com', 1);";  
    // Proper wordpress way to insert the record into the database
    // $wpdb->query($query);

    // Proper way to insert the record into the database
    $data = array(
        'name' => 'Noman',
        'email' => 'noman@gmail.com',
        'status' => 1
    );

    $wpdb->insert($wp_emp, $data);

}
register_activation_hook(__FILE__, 'my_plugin_activation');

function my_plugin_deactivation(){

    global $wpdb, $table_prefix;

    $wp_emp = $table_prefix.'emp';
    
    $query = "TRUNCATE `$wp_emp`";

    $wpdb->query($query);
}
register_deactivation_hook(__FILE__, 'my_plugin_deactivation');

function my_shortcode($atts){

    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    $atts = shortcode_atts(array(
        'msg' => 'I am good'
    ), $atts);

    return 'Function call '. $atts['msg'];

    include('img_gallery.php');
}
add_shortcode('my-sc', 'my_shortcode');

function get_data(){
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';
    $query = "SELECT * FROM `$wp_emp`;";
    $results = $wpdb->get_results($query);
    // echo '<pre>';
    // print_r($results);
    // echo '</pre>';
    ob_start();
    ?>
    <table>
       <thead>
       <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
       </thead>
        <tbody>
            <?php
            foreach($results as $row): 
            ?>
            <tr>
                <td><?php echo $row->id ?></td>
                <td><?php echo $row->name ?></td>
                <td><?php echo $row->email ?></td>
                <td><?php echo $row->status ?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
    <?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('get_data', 'get_data');

function my_posts(){
    $args = array(
        'post_type' => 'post',
        // 's' => 'post 3' // for searching s for search and 2nd parameter is keyword
    );
    $query = new WP_Query($args);
    ob_start();
    if($query->have_posts()):
    ?>
    <ul>
        <?php
        while($query->have_posts()){
            $query->the_post();
            echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a> - > '.get_the_content().'</li>';
        }
        ?>
    </ul>
    <?php
    endif;
    wp_reset_postdata();
    $html = ob_get_clean();
    return $html;
}
add_shortcode('my-posts', 'my_posts');

function head_fun(){
    if(is_single()){
        global $post;
        // echo $post->ID;
        $views = get_post_meta($post->ID, 'views', true);

        if($views == ''){

            add_post_meta($post->ID, 'views', 1);
        }else{
            $views++; 
            update_post_meta($post->ID, 'views', $views);
        }
        // echo get_post_meta($post->ID, 'views', true);
    }
}
add_action('wp_head','head_fun');

function view_counts(){
    global $post;
    return get_post_meta($post->ID, 'views', true);
}
add_shortcode('view-counts', 'view_counts');

// display manues on Admin section
function my_plugin_menu_func(){
   include('admin/main-page.php');
}
function my_plugin_sab_menu_func(){
    echo 'hi';
}
function my_plugin_menu(){
    add_menu_page('My Plugin Page', 'My Plugin Page', 'manage_options', 'my-plugin-page', 'my_plugin_menu_func', '', 6);
    add_submenu_page('my-plugin-page', 'All Employees','All Employees', 'manage_options', 'my-plugin-page', 'my_plugin_menu_func');
    
    add_submenu_page('my-plugin-page', 'My Submenu Page','My Submenu Page', 'manage_options', 'my-submenu-page', 'my_plugin_sab_menu_func');
}
add_action('admin_menu', 'my_plugin_menu');

// ajax function
add_action('wp_ajax_my_search_func', 'my_search_func');

// just for those who are not logged in or normal users
add_action('wp_ajax_nopriv_my_search_func', 'my_search_func');

function my_search_func(){
    // echo 'Function running';
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';

    $search_term = $_POST['search_term'];

    if(!empty($search_term)){
        $query = "SELECT * FROM `$wp_emp` WHERE 
        `name` LIKE '%".$search_term."%'
        OR `email` LIKE '%".$search_term. "%'
        ;";
    }else{
        $query = "SELECT * FROM `$wp_emp`;";
    }
    $results = $wpdb->get_results($query);
   
    ob_start();
        foreach($results as $row): 
         ?>
            <tr>
                <td><?php echo $row->id ?></td>
                <td><?php echo $row->name ?></td>
                <td><?php echo $row->email ?></td>
                <td><?php echo $row->status ?></td>
            </tr>
            <?php
         endforeach;
    echo ob_get_clean();

    wp_die();
}

// use this entire ajax as a shortcode
function my_data(){
    include('admin/main-page.php');
}
add_shortcode('my-data', 'my_data');

function my_scripts(){
    // For Adding scripts proper way 
    $path_js = plugins_url('js/main.js', __FILE__);
    $dep = array('jquery');
    $ver = filemtime(plugin_dir_path( __FILE__).'js/main.js');
    wp_enqueue_script('my-custom-js', $path_js, $dep, $ver, true);
    
    // If we need to add a custom script
    $is_login = is_user_logged_in() ? 1 : 0;
    // wp_add_inline_script('my-custom-js', 'var is_login = '.$is_login.';', 'before');
    wp_add_inline_script('my-custom-js', 'var ajaxUrl = "'.admin_url('admin-ajax.php').'";', 'before');

    // if ypu want to add a style
    $path_style = plugins_url('css/style.css', __FILE__);
    $ver_style = filemtime(plugin_dir_path( __FILE__).'css/style.css');
    wp_enqueue_style('my-custom-style', $path_style, '', $ver_style);

    // add js or style to perticular page you can you is_page condition
    // if(is_page('slug')){

    // }
}
add_action('wp_enqueue_scripts', 'my_scripts');

// if you want to add scripts and styles into admin too 
add_action('admin_enqueue_scripts', 'my_scripts');