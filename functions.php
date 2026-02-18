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
        'name'                  => _x('Experiences', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Experience', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Experiences', 'text_domain'),
        'name_admin_bar'        => __('Experience', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'add_new_item'          => __('Add New Experience', 'text_domain'),
        'edit_item'             => __('Edit Experience', 'text_domain'),
        'new_item'              => __('New Experience', 'text_domain'),
        'view_item'             => __('View Experience', 'text_domain'),
        'all_items'             => __('All Experiences', 'text_domain'),
        'search_items'          => __('Search Experiences', 'text_domain'),
        'not_found'             => __('No experiences found', 'text_domain'),
        'not_found_in_trash'    => __('No experiences found in Trash', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Experience', 'text_domain'),
        'description'           => __('Work experience entries', 'text_domain'),
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
        'name'          => __('Education', 'text_domain'),
        'singular_name' => __('Education', 'text_domain'),
        'menu_name'     => __('Education', 'text_domain'),
        'add_new'       => __('Add New', 'text_domain'),
        'add_new_item'  => __('Add New Education', 'text_domain'),
        'edit_item'     => __('Edit Education', 'text_domain'),
        'new_item'      => __('New Education', 'text_domain'),
        'view_item'     => __('View Education', 'text_domain'),
        'search_items'  => __('Search Education', 'text_domain'),
        'not_found'     => __('No education found', 'text_domain'),
        'not_found_in_trash' => __('No education found in Trash', 'text_domain'),
         
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
        'name'          => __('Projects', 'text_domain'),
        'singular_name' => __('Project', 'text_domain'),
        'menu_name'     => __('Projects', 'text_domain'),
        'add_new'       => __('Add New', 'text_domain'),
        'add_new_item'  => __('Add New Project', 'text_domain'),
        'edit_item'     => __('Edit Project', 'text_domain'),
        'new_item'      => __('New Project', 'text_domain'),
        'view_item'     => __('View Project', 'text_domain'),
        'search_items'  => __('Search Projects', 'text_domain'),
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
        'name'          => __('Skills', 'text_domain'),
        'singular_name' => __('Skill', 'text_domain'),
        'menu_name'     => __('Skills', 'text_domain'),
        'add_new'       => __('Add New', 'text_domain'),
        'add_new_item'  => __('Add New Skill', 'text_domain'),
        'edit_item'     => __('Edit Skill', 'text_domain'),
        'new_item'      => __('New Skill', 'text_domain'),
        'view_item'     => __('View Skill', 'text_domain'),
        'search_items'  => __('Search Skills', 'text_domain'),
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
        'title' => __('Hero Section', 'text_domain'),
        'priority' => 30,
    ));

    // Small text
    $wp_customize->add_setting('hero_small_text', array(
        'default' => 'HELLO, I\'M',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_small_text', array(
        'label' => __('Small Text', 'text_domain'),
        'section' => 'hero_section',
        'type' => 'text',
    ));

    // Name
    $wp_customize->add_setting('hero_name', array(
        'default' => 'Rukunujjaman',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_name', array(
        'label' => __('Name', 'text_domain'),
        'section' => 'hero_section',
        'type' => 'text',
    ));

    // Description
    $wp_customize->add_setting('hero_description', array(
        'default' => 'A full-stack web developer crafting elegant digital experiences with clean code and creative design.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('hero_description', array(
        'label' => __('Description', 'text_domain'),
        'section' => 'hero_section',
        'type' => 'textarea',
    ));

    // CV Link
    $wp_customize->add_setting('hero_cv_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_cv_link', array(
        'label' => __('CV Download Link', 'text_domain'),
        'section' => 'hero_section',
        'type' => 'url',
    ));

    // Work Link
    $wp_customize->add_setting('hero_work_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_work_link', array(
        'label' => __('View Work Link', 'text_domain'),
        'section' => 'hero_section',
        'type' => 'url',
    ));

    // Profile Image
    $wp_customize->add_setting('hero_image', array(
        'default' => get_template_directory_uri() . '/assets/images/rukunujjaman-about.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label' => __('Profile Image', 'text_domain'),
        'section' => 'hero_section',
        'settings' => 'hero_image',
    )));
}
add_action('customize_register', 'ruku_customize_register');
// social media links and other customizable content can be added similarly using the Customizer API.

function ruku_customize_social_links($wp_customize) {
    $wp_customize->add_section('social_links_section', array(
        'title' => __('Social Links', 'text_domain'),
        'priority' => 35,
    ));

    // GitHub
    $wp_customize->add_setting('social_github', array(
        'default' => 'https://github.com/rukunujjaman',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('social_github', array(
        'label' => __('GitHub URL', 'text_domain'),
        'section' => 'social_links_section',
        'type' => 'url',
    ));

    // LinkedIn
    $wp_customize->add_setting('social_linkedin', array(
        'default' => 'https://www.linkedin.com/in/rukunujjaman/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('social_linkedin', array(
        'label' => __('LinkedIn URL', 'text_domain'),
        'section' => 'social_links_section',
        'type' => 'url',
    ));

    // Twitter
    $wp_customize->add_setting('social_twitter', array(
        'default' => 'https://twitter.com/rukunujjaman',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('social_twitter', array(
        'label' => __('Twitter URL', 'text_domain'),
        'section' => 'social_links_section',
        'type' => 'url',
    ));
}
add_action('customize_register', 'ruku_customize_social_links');

?>