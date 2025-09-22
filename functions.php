<?php
function theme_enqueue_styles() {
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/src/output.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function register_my_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu',  ),
        )
    );
}
add_action( 'after_setup_theme', 'register_my_menus' );

function register_my_sidebar() {
    register_sidebar( array(
        'name'        => __( 'Main Sidebar',  ),
        'id'          => 'main-sidebar',
        'description' => __( 'add widgets here to appear in the sidebar, max 3 widgets allowed!',  ),
    ) );
}
function register_projects_post_type() {
    $labels = array(
        'name'               => _x('Projects', 'post type general name', 'hello-wunder'),
        'singular_name'      => _x('Project', 'post type singular name', 'hello-wunder'),
        'menu_name'          => _x('Projects', 'admin menu', 'hello-wunder'),
        'add_new'            => _x('Add New', 'project', 'hello-wunder'),
        'add_new_item'       => __('Add New Project', 'hello-wunder'),
        'edit_item'          => __('Edit Project', 'hello-wunder'),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'projects'),
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-portfolio',
    );
    register_post_type('projects', $args);
}
add_action('init', 'register_projects_post_type');

function add_project_url_meta_box() {
    add_meta_box(
        'project_url_meta_box',
        'Project URL',
        'display_project_url_meta_box',
        'projects',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_project_url_meta_box');

function display_project_url_meta_box($post) {
    $value = get_post_meta($post->ID, '_project_url', true);
    ?>
    <label for="project_url">Enter Project URL:</label>
    <input type="url" id="project_url" name="project_url" value="<?php echo esc_url($value); ?>" style="width: 100%;">
    <?php
}

function save_project_url_meta_box($post_id) {
    if (array_key_exists('project_url', $_POST)) {
        update_post_meta(
            $post_id,
            '_project_url',
            esc_url($_POST['project_url'])
        );
    }
}
add_action('save_post', 'save_project_url_meta_box');


function mytheme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Main Sidebar', 'mytheme'),
        'id'            => 'main-sidebar',
        'description'   => __('Widgets in this area will be shown on the sidebar.', 'mytheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6 p-4 bg-white shadow rounded-xl">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-xl font-bold mb-2">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'mytheme_widgets_init');
