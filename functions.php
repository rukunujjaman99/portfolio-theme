<?php

function ruku_theme_setup() {
    // Add support for dynamic title tags
    add_theme_support('title-tag');
    // Add support for post thumbnails (featured images)
    add_theme_support('post-thumbnails');
    // Add support for HTML5 markup for search forms, comment forms, and comment lists
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 300,
        'flex-height' => true,
        'flex-width' => true,
    ));


    register_nav_menus(array(
        'primary' => __('Primary Menu', 'rukunujjaman.com'),

    ));


}
add_action('after_setup_theme', 'ruku_theme_setup');



function ruku_theme_enquee() {

    /* ===== CSS ===== */

    // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        array(),
        '5.3.2'
    );

    // Font Awesome
    wp_enqueue_style(
        'fontawesome-css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        array(),
        '6.5.0'
    );

    // Bootstrap Icons
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css',
        array(),
        '1.11.1'
    );

    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Poppins:wght@400;600;700&display=swap',
        array(),
        null
    );

    // Main Theme Style
    wp_enqueue_style(
        'main-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        '1.0.0'
    );


    /* ===== JS ===== */

    // Bootstrap JS
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.2',
        true
    );

    // Main Script
    wp_enqueue_script(
        'main-script',
        get_template_directory_uri() . '/js/main.js',
        array(),
        '1.0.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'ruku_theme_enquee');


function ruku_register_experience_cpt() {

    $labels = array(
        'name'                  => _x('Experiences', 'Post Type General Name', 'rukunujjaman.com'),
        'singular_name'         => _x('Experience', 'Post Type Singular Name', 'rukunujjaman.com'),
        'menu_name'             => __('Experiences', 'rukunujjaman.com'),
        'name_admin_bar'        => __('Experience', 'rukunujjaman.com'),
        'add_new'               => __('Add New', 'rukunujjaman.com'),
        'add_new_item'          => __('Add New Experience', 'rukunujjaman.com'),
        'edit_item'             => __('Edit Experience', 'rukunujjaman.com'),
        'new_item'              => __('New Experience', 'rukunujjaman.com'),
        'view_item'             => __('View Experience', 'rukunujjaman.com'),
        'all_items'             => __('All Experiences', 'rukunujjaman.com'),
        'search_items'          => __('Search Experiences', 'rukunujjaman.com'),
        'not_found'             => __('No experiences found', 'rukunujjaman.com'),
        'not_found_in_trash'    => __('No experiences found in Trash', 'rukunujjaman.com'),
    );

    $args = array(
        'label'                 => __('Experience', 'rukunujjaman.com'),
        'description'           => __('Work experience entries', 'rukunujjaman.com'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-businessman', // Icon in admin
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'rewrite'               => array('slug' => 'experience'),
    );

    register_post_type('experience', $args);
}

add_action('init', 'ruku_register_experience_cpt', 0);


function ruku_experience_meta_boxes() {
    add_meta_box('experience_details', 'Experience Details', 'ruku_experience_callback', 'experience', 'normal', 'high');
}
add_action('add_meta_boxes', 'ruku_experience_meta_boxes');

function ruku_experience_callback($post) {
    $role = get_post_meta($post->ID, '_experience_role', true);
    $company = get_post_meta($post->ID, '_experience_company', true);
    $date = get_post_meta($post->ID, '_experience_date', true);
    ?>
    <p>
        <label>Role:</label>
        <input type="text" name="experience_role" value="<?php echo esc_attr($role); ?>" style="width:100%;">
    </p>
    <p>
        <label>Company:</label>
        <input type="text" name="experience_company" value="<?php echo esc_attr($company); ?>" style="width:100%;">
    </p>
    <p>
        <label>Date:</label>
        <input type="text" name="experience_date" value="<?php echo esc_attr($date); ?>" style="width:100%;">
    </p>
    <p>
        <label>Description:</label>
        <textarea name="experience_description" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_experience_description', true)); ?></textarea>
    </p>
    <?php
}

// Save Meta Box Data
add_action('save_post', function($post_id) {
    if(isset($_POST['experience_role'])) {
        update_post_meta($post_id, '_experience_role', sanitize_text_field($_POST['experience_role']));
    }
    if(isset($_POST['experience_company'])) {
        update_post_meta($post_id, '_experience_company', sanitize_text_field($_POST['experience_company']));
    }
    if(isset($_POST['experience_date'])) {
        update_post_meta($post_id, '_experience_date', sanitize_text_field($_POST['experience_date']));
    }
    if(isset($_POST['experience_description'])) {
        update_post_meta($post_id, '_experience_description', sanitize_textarea_field($_POST['experience_description']));
    }
});

// education CPT and meta boxes would be similar to experience, just with different labels and meta fields.

function ruku_register_education_cpt() {
    $labels = array(
        'name'          => __('Education', 'rukunujjaman.com'),
        'singular_name' => __('Education', 'rukunujjaman.com'),
        'menu_name'     => __('Education', 'rukunujjaman.com'),
        'add_new'       => __('Add New', 'rukunujjaman.com'),
        'add_new_item'  => __('Add New Education', 'rukunujjaman.com'),
        'edit_item'     => __('Edit Education', 'rukunujjaman.com'),
        'new_item'      => __('New Education', 'rukunujjaman.com'),
        'view_item'     => __('View Education', 'rukunujjaman.com'),
        'search_items'  => __('Search Education', 'rukunujjaman.com'),
        'not_found'     => __('No education found', 'rukunujjaman.com'),
        'not_found_in_trash' => __('No education found in Trash', 'rukunujjaman.com'),
         
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-welcome-learn-more',
        'supports'     => array('title', 'editor'),
        'menu_position'         => 6,
    );

    register_post_type('education', $args);
}
add_action('init', 'ruku_register_education_cpt');

// Add meta boxes for Education
function ruku_education_meta_boxes() {
    add_meta_box('education_details', 'Education Details', 'ruku_education_callback', 'education', 'normal', 'high');
}
add_action('add_meta_boxes', 'ruku_education_meta_boxes');

function ruku_education_callback($post) {
    $degree = get_post_meta($post->ID, '_education_degree', true);
    $school = get_post_meta($post->ID, '_education_school', true);
    $date = get_post_meta($post->ID, '_education_date', true);
    $description = get_post_meta($post->ID, '_education_description', true);
    ?>
    <p>
        <label>Degree:</label>
        <input type="text" name="education_degree" value="<?php echo esc_attr($degree); ?>" style="width:100%;">
    </p>
    <p>
        <label>School / University:</label>
        <input type="text" name="education_school" value="<?php echo esc_attr($school); ?>" style="width:100%;">
    </p>
    <p>
        <label>Date:</label>
        <input type="text" name="education_date" value="<?php echo esc_attr($date); ?>" style="width:100%;">
    </p>
    <p>
        <label>Description:</label>
        <textarea name="education_description" style="width:100%;"><?php echo esc_textarea($description); ?></textarea>
    </p>
    <?php
}

// Save meta box data
add_action('save_post', function($post_id) {
    if(isset($_POST['education_degree'])) {
        update_post_meta($post_id, '_education_degree', sanitize_text_field($_POST['education_degree']));
    }
    if(isset($_POST['education_school'])) {
        update_post_meta($post_id, '_education_school', sanitize_text_field($_POST['education_school']));
    }
    if(isset($_POST['education_date'])) {
        update_post_meta($post_id, '_education_date', sanitize_text_field($_POST['education_date']));
    }
    if(isset($_POST['education_description'])) {
        update_post_meta($post_id, '_education_description', sanitize_textarea_field($_POST['education_description']));
    }
});


// project CPT and meta boxes would be similar to experience and education, just with different labels and meta fields.
// Register CPT: Project
function ruku_register_projects_cpt() {
    $labels = array(
        'name'          => __('Projects', 'rukunujjaman.com'),
        'singular_name' => __('Project', 'rukunujjaman.com'),
        'menu_name'     => __('Projects', 'rukunujjaman.com'),
        'add_new'       => __('Add New', 'rukunujjaman.com'),
        'add_new_item'  => __('Add New Project', 'rukunujjaman.com'),
        'edit_item'     => __('Edit Project', 'rukunujjaman.com'),
        'new_item'      => __('New Project', 'rukunujjaman.com'),
        'view_item'     => __('View Project', 'rukunujjaman.com'),
        'search_items'  => __('Search Projects', 'rukunujjaman.com'),
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => array('title', 'editor', 'thumbnail'),
        'menu_position'         => 7,
        'rewrite'       => array('slug' => 'projects'),
    );

    register_post_type('project', $args);
}
add_action('init', 'ruku_register_projects_cpt');

// Add meta boxes for Projects
function ruku_project_meta_boxes() {
    add_meta_box('project_details', 'Project Details', 'ruku_project_callback', 'project', 'normal', 'high');
}
add_action('add_meta_boxes', 'ruku_project_meta_boxes');

function ruku_project_callback($post) {
    $tech = get_post_meta($post->ID, '_project_tech', true); // comma-separated tags
    $live_link = get_post_meta($post->ID, '_project_live', true);
    $repo_link = get_post_meta($post->ID, '_project_repo', true);
    ?>
    <p>
        <label>Technology Stack (comma separated):</label>
        <input type="text" name="project_tech" value="<?php echo esc_attr($tech); ?>" style="width:100%;">
    </p>
    <p>
        <label>Live Project Link:</label>
        <input type="url" name="project_live" value="<?php echo esc_url($live_link); ?>" style="width:100%;">
    </p>
    <p>
        <label>Repository Link:</label>
        <input type="url" name="project_repo" value="<?php echo esc_url($repo_link); ?>" style="width:100%;">
    </p>
    <?php
}

// Save meta box data
add_action('save_post', function($post_id) {
    if(isset($_POST['project_tech'])) {
        update_post_meta($post_id, '_project_tech', sanitize_text_field($_POST['project_tech']));
    }
    if(isset($_POST['project_live'])) {
        update_post_meta($post_id, '_project_live', esc_url_raw($_POST['project_live']));
    }
    if(isset($_POST['project_repo'])) {
        update_post_meta($post_id, '_project_repo', esc_url_raw($_POST['project_repo']));
    }
});


// skills CPT and meta boxes would be similar to experience, education, and projects, just with different labels and meta fields.
// Register CPT: Skills
function ruku_register_skills_cpt() {
    $labels = array(
        'name'          => __('Skills', 'rukunujjaman.com'),
        'singular_name' => __('Skill', 'rukunujjaman.com'),
        'menu_name'     => __('Skills', 'rukunujjaman.com'),
        'add_new'       => __('Add New', 'rukunujjaman.com'),
        'add_new_item'  => __('Add New Skill', 'rukunujjaman.com'),
        'edit_item'     => __('Edit Skill', 'rukunujjaman.com'),
        'new_item'      => __('New Skill', 'rukunujjaman.com'),
        'view_item'     => __('View Skill', 'rukunujjaman.com'),
        'search_items'  => __('Search Skills', 'rukunujjaman.com'),
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => false,
        'menu_icon'    => 'dashicons-awards',
        'supports'     => array('title'), // title will be the skill category, e.g., Frontend
         'menu_position'         => 8,
         'rewrite'       => array('slug' => 'skills'),
    );

    register_post_type('skill', $args);
}
add_action('init', 'ruku_register_skills_cpt');


// Add meta box for skills
function ruku_skills_meta_boxes() {
    add_meta_box('skill_details', 'Skill Details', 'ruku_skill_callback', 'skill', 'normal', 'high');
}
add_action('add_meta_boxes', 'ruku_skills_meta_boxes');

function ruku_skill_callback($post) {
    $items = get_post_meta($post->ID, '_skill_items', true); // array of skill => percentage
    ?>
    <p>
        <small>Enter skills as Name|Percentage per line (e.g., React|95)</small>
        <textarea name="skill_items" style="width:100%;height:150px;"><?php 
            if($items && is_array($items)){
                foreach($items as $item){
                    echo esc_html($item['name'].'|'.$item['percentage'])."\n";
                }
            }
        ?></textarea>
    </p>
    <?php
}

// Save skill meta
add_action('save_post', function($post_id) {
    if(isset($_POST['skill_items'])){
        $lines = explode("\n", $_POST['skill_items']);
        $items = array();
        foreach($lines as $line){
            $line = trim($line);
            if(empty($line)) continue;
            list($name, $percentage) = array_map('trim', explode('|', $line));
            $items[] = array(
                'name' => sanitize_text_field($name),
                'percentage' => intval($percentage)
            );
        }
        update_post_meta($post_id, '_skill_items', $items);
    }
});



// hero section and other static content can be added via widgets or hardcoded in the template files as needed.

function ruku_customize_register($wp_customize) {
    // Hero Section Settings
    $wp_customize->add_section('hero_section', array(
        'title' => __('Hero Section', 'rukunujjaman.com'),
        'priority' => 30,
    ));

    // Small text
    $wp_customize->add_setting('hero_small_text', array(
        'default' => 'HELLO, I\'M',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_small_text', array(
        'label' => __('Small Text', 'rukunujjaman.com'),
        'section' => 'hero_section',
        'type' => 'text',
    ));

    // Name
    $wp_customize->add_setting('hero_name', array(
        'default' => 'Rukunujjaman',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_name', array(
        'label' => __('Name', 'rukunujjaman.com'),
        'section' => 'hero_section',
        'type' => 'text',
    ));

    // Description
    $wp_customize->add_setting('hero_description', array(
        'default' => 'A full-stack web developer crafting elegant digital experiences with clean code and creative design.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('hero_description', array(
        'label' => __('Description', 'rukunujjaman.com'),
        'section' => 'hero_section',
        'type' => 'textarea',
    ));

    // CV Link
    $wp_customize->add_setting('hero_cv_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_cv_link', array(
        'label' => __('CV Download Link', 'rukunujjaman.com'),
        'section' => 'hero_section',
        'type' => 'url',
    ));

    // Work Link
    $wp_customize->add_setting('hero_work_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_work_link', array(
        'label' => __('View Work Link', 'rukunujjaman.com'),
        'section' => 'hero_section',
        'type' => 'url',
    ));

    // Profile Image
    $wp_customize->add_setting('hero_image', array(
        'default' => get_template_directory_uri() . '/assets/images/rukunujjaman-about.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label' => __('Profile Image', 'rukunujjaman.com'),
        'section' => 'hero_section',
        'settings' => 'hero_image',
    )));
}
add_action('customize_register', 'ruku_customize_register');
// social media links and other customizable content can be added similarly using the Customizer API.

function ruku_customize_social_links($wp_customize) {
    $wp_customize->add_section('social_links_section', array(
        'title' => __('Social Links', 'rukunujjaman.com'),
        'priority' => 35,
    ));

    // GitHub
    $wp_customize->add_setting('social_github', array(
        'default' => 'https://github.com/rukunujjaman',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('social_github', array(
        'label' => __('GitHub URL', 'rukunujjaman.com'),
        'section' => 'social_links_section',
        'type' => 'url',
    ));

    // LinkedIn
    $wp_customize->add_setting('social_linkedin', array(
        'default' => 'https://www.linkedin.com/in/rukunujjaman/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('social_linkedin', array(
        'label' => __('LinkedIn URL', 'rukunujjaman.com'),
        'section' => 'social_links_section',
        'type' => 'url',
    ));

    // Twitter
    $wp_customize->add_setting('social_twitter', array(
        'default' => 'https://twitter.com/rukunujjaman',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('social_twitter', array(
        'label' => __('Twitter URL', 'rukunujjaman.com'),
        'section' => 'social_links_section',
        'type' => 'url',
    ));
}
add_action('customize_register', 'ruku_customize_social_links');

// about section content can also be added via the Customizer or hardcoded in the template files as needed.
function ruku_customize_about_section($wp_customize) {

    $wp_customize->add_section('about_section', array(
        'title' => __('About Section', 'rukunujjaman.com'),
        'priority' => 40,
    ));

    // Small Title
    $wp_customize->add_setting('about_small_title', array(
        'default' => 'About Me',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('about_small_title', array(
        'label' => __('Small Title', 'rukunujjaman.com'),
        'section' => 'about_section',
        'type' => 'text',
    ));

    // Heading
    $wp_customize->add_setting('about_heading', array(
        'default' => 'Passionate about building great web experiences',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('about_heading', array(
        'label' => __('Main Heading', 'rukunujjaman.com'),
        'section' => 'about_section',
        'type' => 'text',
    ));

    // Description
    $wp_customize->add_setting('about_description', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('about_description', array(
        'label' => __('Description', 'rukunujjaman.com'),
        'section' => 'about_section',
        'type' => 'textarea',
    ));

    // Button Link
    $wp_customize->add_setting('about_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('about_button_link', array(
        'label' => __('Button Link', 'rukunujjaman.com'),
        'section' => 'about_section',
        'type' => 'url',
    ));

}
add_action('customize_register', 'ruku_customize_about_section');


// Register Feature CPT
// Register Feature CPT
function ruku_register_feature_cpt() {

    register_post_type('feature', array(
        'labels' => array(
            'name' => 'Features',
            'singular_name' => 'Feature',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Feature',
            'edit_item' => 'Edit Feature',
            'new_item' => 'New Feature',
            'view_item' => 'View Feature',
            'search_items' => 'Search Features',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-star-filled',
        'supports' => array('title'), // editor not needed if using subtitle
        'menu_position' => 9,
        'rewrite' => array('slug' => 'features'),
    ));

}
add_action('init', 'ruku_register_feature_cpt');

// Add Meta Box
function ruku_add_feature_meta_box() {
    add_meta_box(
        'ruku_feature_details',
        'Feature Details',
        'ruku_feature_icon_callback',
        'feature',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ruku_add_feature_meta_box');


function ruku_feature_icon_callback($post) {

    // Security nonce
    wp_nonce_field('ruku_feature_nonce_action', 'ruku_feature_nonce');

    $icon     = get_post_meta($post->ID, '_feature_icon', true);
    $subtitle = get_post_meta($post->ID, '_feature_subtitle', true);
    ?>

    <p>
        <label><strong>Feature Icon (FontAwesome Class)</strong></label>
        <input type="text"
               name="feature_icon"
               value="<?php echo esc_attr($icon); ?>"
               style="width:100%;"
               placeholder="fas fa-code">
        <small>Example: fas fa-code</small>
    </p>

    <p>
        <label><strong>Subtitle</strong></label>
        <input type="text"
               name="feature_subtitle"
               value="<?php echo esc_attr($subtitle); ?>"
               style="width:100%;"
               placeholder="Writing maintainable, scalable solutions">
    </p>

    <?php
}


function ruku_save_feature_meta($post_id) {

    // Check nonce
    if (!isset($_POST['ruku_feature_nonce']) ||
        !wp_verify_nonce($_POST['ruku_feature_nonce'], 'ruku_feature_nonce_action')) {
        return;
    }

    // Prevent autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check post type
    if (get_post_type($post_id) !== 'feature') {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save icon
    if (isset($_POST['feature_icon'])) {
        update_post_meta(
            $post_id,
            '_feature_icon',
            sanitize_text_field($_POST['feature_icon'])
        );
    }

    // Save subtitle
    if (isset($_POST['feature_subtitle'])) {
        update_post_meta(
            $post_id,
            '_feature_subtitle',
            sanitize_text_field($_POST['feature_subtitle'])
        );
    }
}
add_action('save_post', 'ruku_save_feature_meta');

// about page section
function ruku_customize_about_page_section($wp_customize) {

    // Add Section
    $wp_customize->add_section('ruku_about_page_section', array(
        'title'       => 'About Page Section',
        'priority'    => 30,
        'description' => 'Manage About Page content here.',
    ));

    // Small Title
    $wp_customize->add_setting('ruku_about_small_title', array(
        'default'           => 'About Me',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ruku_about_small_title', array(
        'label'   => 'Small Title',
        'section' => 'ruku_about_page_section',
        'type'    => 'text',
    ));

    // Main Heading
    $wp_customize->add_setting('ruku_about_heading', array(
        'default'           => 'Passionate about building great web experiences',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ruku_about_heading', array(
        'label'   => 'Main Heading',
        'section' => 'ruku_about_page_section',
        'type'    => 'text',
    ));

    // Description
    $wp_customize->add_setting('ruku_about_description', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('ruku_about_description', array(
        'label'   => 'Description',
        'section' => 'ruku_about_page_section',
        'type'    => 'textarea',
    ));

    // Image
    $wp_customize->add_setting('ruku_about_image');

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'ruku_about_image',
        array(
            'label'   => 'About Image',
            'section' => 'ruku_about_page_section',
        )
    ));
}

add_action('customize_register', 'ruku_customize_about_page_section');


// contact page section

function ruku_customize_contact_section($wp_customize) {

    // Add Section
    $wp_customize->add_section('ruku_contact_section', array(
        'title'       => 'Contact Section',
        'priority'    => 35,
        'description' => 'Manage Contact Section content.',
    ));

    // Label (CONTACT)
    $wp_customize->add_setting('ruku_contact_label', array(
        'default'           => 'CONTACT',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ruku_contact_label', array(
        'label'   => 'Section Label',
        'section' => 'ruku_contact_section',
        'type'    => 'text',
    ));

    // Title
    $wp_customize->add_setting('ruku_contact_title', array(
        'default'           => "Let's connect",
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ruku_contact_title', array(
        'label'   => 'Section Title',
        'section' => 'ruku_contact_section',
        'type'    => 'text',
    ));

    // Description
    $wp_customize->add_setting('ruku_contact_description', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('ruku_contact_description', array(
        'label'   => 'Description',
        'section' => 'ruku_contact_section',
        'type'    => 'textarea',
    ));

    // Email
    $wp_customize->add_setting('ruku_contact_email', array(
        'default'           => 'alex@example.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('ruku_contact_email', array(
        'label'   => 'Email',
        'section' => 'ruku_contact_section',
        'type'    => 'email',
    ));

    // Phone
    $wp_customize->add_setting('ruku_contact_phone', array(
        'default'           => '+1 (555) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ruku_contact_phone', array(
        'label'   => 'Phone',
        'section' => 'ruku_contact_section',
        'type'    => 'text',
    ));

    // Address
    $wp_customize->add_setting('ruku_contact_address', array(
        'default'           => 'San Francisco, CA',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ruku_contact_address', array(
        'label'   => 'Address',
        'section' => 'ruku_contact_section',
        'type'    => 'text',
    ));
}

add_action('customize_register', 'ruku_customize_contact_section');

// contact form
function ruku_register_contact_cpt() {
    $labels = array(
        'name'               => 'Contact Messages',
        'singular_name'      => 'Contact Message',
        'menu_name'          => 'Contact Messages',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Message',
        'edit_item'          => 'Edit Message',
        'new_item'           => 'New Message',
        'view_item'          => 'View Message',
        'all_items'          => 'All Messages',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => false, // hide default CPT UI
        'capability_type'=> 'post',
        'supports'      => array('title'),
        'menu_icon'     => 'dashicons-email',
    );

    register_post_type('contact_message', $args);
}
add_action('init', 'ruku_register_contact_cpt');

add_action('admin_menu', 'ruku_contact_admin_menu');

function ruku_contact_admin_menu() {
    add_menu_page(
        'Contact Messages',
        'Contact Messages',
        'manage_options',
        'ruku-contact-messages',
        'ruku_contact_messages_page',
        'dashicons-email',
        6
    );
}

function ruku_contact_messages_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'posts'; // contact_message stored as post
    $messages = get_posts(array(
        'post_type' => 'contact_message',
        'numberposts' => -1,
        'post_status' => 'publish',
    ));
    ?>
      <div class="wrap">
    <h1>Contact Messages</h1>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Sr.</th> <!-- Serial Number -->
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $messages = get_posts(array(
                'post_type' => 'contact_message',
                'numberposts' => -1,
                'post_status' => 'publish',
            ));
            
            $serial = 1; // start serial
            foreach($messages as $msg): 
                $name = get_post_meta($msg->ID, '_contact_name', true);
                $email = get_post_meta($msg->ID, '_contact_email', true);
                $phone = get_post_meta($msg->ID, '_contact_phone', true);
                $message = get_post_meta($msg->ID, '_contact_message', true);
            ?>
            <tr>
                <td><?php echo $serial++; ?></td> <!-- Serial number -->
                <td><?php echo esc_html($name); ?></td>
                <td><?php echo esc_html($email); ?></td>
                <td><?php echo esc_html($phone); ?></td>
                <td><?php echo esc_html($msg->post_title); ?></td>
                <td><?php echo esc_html($message); ?></td>
                <td><?php echo get_the_date('', $msg->ID); ?></td>
                <td>
                    <a href="<?php echo admin_url('admin.php?page=ruku-contact-messages&action=edit&id=' . $msg->ID); ?>">Edit</a> | 
                    <a href="<?php echo admin_url('admin.php?page=ruku-contact-messages&action=delete&id=' . $msg->ID); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    <?php
}
// Delete
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    wp_delete_post($id, true);
    echo '<div class="updated notice"><p>Message deleted successfully.</p></div>';
}

// Edit
if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $name = get_post_meta($id, '_contact_name', true);
    $email = get_post_meta($id, '_contact_email', true);
    $phone = get_post_meta($id, '_contact_phone', true);
    $subject = get_post_meta($id, '_contact_subject', true);
    $message = get_post_meta($id, '_contact_message', true);

    if(isset($_POST['update_contact_message'])) {
        update_post_meta($id, '_contact_name', sanitize_text_field($_POST['contact_name']));
        update_post_meta($id, '_contact_email', sanitize_email($_POST['contact_email']));
        update_post_meta($id, '_contact_phone', sanitize_text_field($_POST['contact_phone']));
        update_post_meta($id, '_contact_message', sanitize_textarea_field($_POST['contact_message']));
        wp_update_post(array('ID'=>$id, 'post_title'=>sanitize_text_field($_POST['contact_subject'])));
        echo '<div class="updated notice"><p>Message updated successfully.</p></div>';
    }

    ?>
    <form method="post" style="margin-top:20px;">
        <table class="form-table">
            <tr>
                <th>Name</th>
                <td><input type="text" name="contact_name" value="<?php echo esc_attr($name); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="email" name="contact_email" value="<?php echo esc_attr($email); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><input type="text" name="contact_phone" value="<?php echo esc_attr($phone); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th>Subject</th>
                <td><input type="text" name="contact_subject" value="<?php echo esc_attr($subject); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th>Message</th>
                <td><textarea name="contact_message" rows="5" class="large-text"><?php echo esc_textarea($message); ?></textarea></td>
            </tr>
        </table>
        <p><input type="submit" name="update_contact_message" class="button button-primary" value="Update Message"></p>
    </form>
    <hr>
    <?php
}


// service CPT and meta boxes would be similar to experience, education, projects, and skills, just with different labels and meta fields.
function ruku_register_service_cpt() {
    $labels = array(
        'name'               => 'Services',
        'singular_name'      => 'Service',
        'menu_name'          => 'Services',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Service',
        'edit_item'          => 'Edit Service',
        'new_item'           => 'New Service',
        'view_item'          => 'View Service',
        'all_items'          => 'All Services',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'show_ui'       => true,
        'has_archive'   => false,
        'supports'      => array('title', 'editor', 'thumbnail'),
        'menu_icon'     => 'dashicons-hammer',
        'menu_position' => 10,
         'rewrite'       => array('slug' => 'services'),
    );

    register_post_type('service', $args);
}
add_action('init', 'ruku_register_service_cpt');


function ruku_add_service_meta_box() {
    add_meta_box(
        'ruku_service_icon',
        'Service Icon (Bootstrap Icon Class)',
        'ruku_service_icon_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ruku_add_service_meta_box');

function ruku_service_icon_callback($post) {
    wp_nonce_field('ruku_service_nonce_action', 'ruku_service_nonce');
    $icon = get_post_meta($post->ID, '_service_icon', true);
    ?>
    <p>
        <label>Icon Class (Bootstrap Icon)</label>
        <input type="text" name="service_icon" value="<?php echo esc_attr($icon); ?>" style="width:100%;" placeholder="bi bi-code-slash">
        <small>Example: bi bi-code-slash</small>
    </p>
    <?php
}

add_action('save_post', function($post_id) {
    if (!isset($_POST['ruku_service_nonce']) || !wp_verify_nonce($_POST['ruku_service_nonce'], 'ruku_service_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['service_icon'])) {
        update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
    }
});



?>