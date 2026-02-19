
<?php

// Template Name: Home Page

get_header(); ?>

<!-- header section end -->

<!-- HERO -->
<section class="hero section">
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="hero-text">
                <small class="accent fade-up delay-1">
                    <?php echo get_theme_mod('hero_small_text', 'HELLO, I\'M'); ?>
                </small>

                <h1 class="fade-up delay-2">
                    <span class="accent"><?php echo get_theme_mod('hero_name', 'Rukunujjaman'); ?></span>
                </h1>

                <p class="fade-up delay-3">
                    <?php echo get_theme_mod('hero_description', 'A full-stack web developer crafting elegant digital experiences with clean code and creative design.'); ?>
                </p>
            </div>

            <div class="mt-4">
                <a href="<?php echo get_theme_mod('hero_cv_link', '#'); ?>" class="btn btn-accent me-2">CV Download</a>
                <a href="<?php echo get_theme_mod('hero_work_link', '#'); ?>" class="btn btn-outline-light">View Work</a>
            </div>

           <div class="social-icons mt-4">
    <?php $github = get_theme_mod('social_github', '#'); ?>
    <?php $linkedin = get_theme_mod('social_linkedin', '#'); ?>
    <?php $twitter = get_theme_mod('social_twitter', '#'); ?>

    <?php if($github): ?>
        <a href="<?php echo esc_url($github); ?>" target="_blank" >
            <i class="fab fa-github"></i>
        </a>
    <?php endif; ?>

    <?php if($linkedin): ?>
        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" >
            <i class="fab fa-linkedin"></i>
        </a>
    <?php endif; ?>

    <?php if($twitter): ?>
        <a href="<?php echo esc_url($twitter); ?>" target="_blank" >
            <i class="fab fa-twitter"></i>
        </a>
    <?php endif; ?>
</div>
        </div>

        <div class="col-md-5">
            <div class="about-img">
                <img src="<?php echo get_theme_mod('hero_image', get_template_directory_uri() . '/assets/images/rukunujjaman-about.jpg'); ?>" 
                     alt="Profile Picture" class="img-fluid rounded-3 shadow">
            </div>
        </div>
    </div>
</div>
</section>

<!-- ABOUT -->
<section class="about section">
<div class="container">

<p><?php echo get_theme_mod('about_small_title', 'About Me'); ?></p>

<h2 class="text-white mb-5">
<?php echo get_theme_mod('about_heading'); ?>
</h2>

<div class="row">

<!-- LEFT TEXT -->
<div class="col-lg-6 mb-4 mb-lg-0">
    <div class="about_content">
        <p>
            <?php echo get_theme_mod('about_description'); ?>
        </p>
        <a href="<?php echo esc_url(get_theme_mod('about_button_link', '#')); ?>" class="btn btn-outline-light">
            Learn More
        </a>
    </div>
</div>

<!-- RIGHT FEATURE CARDS -->
<div class="col-lg-6">

   <?php
$args = array(
    'post_type'      => 'feature',
    'posts_per_page' => -1,
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

        $icon     = get_post_meta(get_the_ID(), '_feature_icon', true);
        $subtitle = get_post_meta(get_the_ID(), '_feature_subtitle', true);
?>
        <div class="feature-card mb-4">
            <div class="icon-box">
                <?php if (!empty($icon)) : ?>
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                <?php endif; ?>
            </div>
            <div>
                <h5><?php the_title(); ?></h5>
                <?php if (!empty($subtitle)) : ?>
                    <p><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>

<?php
    endwhile;
    wp_reset_postdata();
endif;
?>

</div>
</div>
</div>
</section>

<!-- EXPERIENCE -->
<section class="experience-section">
  <div class="container">
    <p class="font-heading text-sm tracking-widest uppercase mb-2">Experience</p>
    <h2 class="text-white mb-5">My <span class="accent">Experience</span></h2>

    <div class="timeline">
      <?php
$args = array(
    'post_type' => 'experience',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'meta_key' => '_experience_date',
    'order' => 'DESC'
);
$experience_query = new WP_Query($args);

if($experience_query->have_posts()) :
    while($experience_query->have_posts()) : $experience_query->the_post();
        $role = get_post_meta(get_the_ID(), '_experience_role', true);
        $company = get_post_meta(get_the_ID(), '_experience_company', true);
        $date = get_post_meta(get_the_ID(), '_experience_date', true);
        $description = get_post_meta(get_the_ID(), '_experience_description', true);
?>

      <!-- Item 1 -->
     <div class="timeline-item">
        <div class="timeline-icon">
            <i class="bi bi-briefcase"></i>
        </div>
        <div class="timeline-content">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h4><?php echo esc_html($role); ?></h4>
                    <span class="company"><?php echo esc_html($company); ?></span>
                </div>
                <span class="date"><?php echo esc_html($date); ?></span>
            </div>
            <p><?php echo esc_html($description); ?></p>
        </div>
    </div>
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>
     

    </div>

  </div>
</section>
<!-- Education -->
<section class="education-section">
  <div class="container">
    <p class="font-heading text-sm tracking-widest uppercase mb-2">Education</p>
    <h2 class="text-white mb-5">Academic <span class="accent">Background</span></h2>
     <div class="row">
<?php
$args = array(
    'post_type' => 'education',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'meta_key' => '_education_date',
    'order' => 'DESC'
);
$education_query = new WP_Query($args);

if($education_query->have_posts()) :
    while($education_query->have_posts()) : $education_query->the_post();
        $degree = get_post_meta(get_the_ID(), '_education_degree', true);
        $school = get_post_meta(get_the_ID(), '_education_school', true);
        $date = get_post_meta(get_the_ID(), '_education_date', true);
        $description = get_post_meta(get_the_ID(), '_education_description', true);
?>
    <div class="col-lg-6">
        <div class="edu-card">
            <div class="edu-top">
                <div class="edu-icon">
                    <i class="bi bi-mortarboard"></i>
                </div>
                <span class="edu-date"><?php echo esc_html($date); ?></span>
            </div>
            <h4><?php echo esc_html($degree); ?></h4>
            <span class="edu-school"><?php echo esc_html($school); ?></span>
            <p><?php echo esc_html($description); ?></p>
        </div>
    </div>
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>
</div>   

  </div>
</section>

<!-- SKILLS -->
 <section class="skill_section">
    <div class="container py-5">
<p class="font-heading text-sm tracking-widest uppercase mb-2">Skills</p>
    <h2 class="text-white mb-5">Technical <span class="accent">Proficiencies</span></h2>
   <div class="row g-4">
    <?php
$args = array(
    'post_type' => 'skill',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'ASC'
);
$skill_query = new WP_Query($args);

if($skill_query->have_posts()) :
    while($skill_query->have_posts()) : $skill_query->the_post();
        $items = get_post_meta(get_the_ID(), '_skill_items', true);
?>

    <!-- Frontend -->
      <div class="col-lg-4">
        <div class="skill-card">
            <div class="skill-title"><?php the_title(); ?></div>
            <?php if($items && is_array($items)) : 
                foreach($items as $item): ?>
                <div class="skill">
                    <div class="skill-top">
                        <span><?php echo esc_html($item['name']); ?></span>
                        <span><?php echo esc_html($item['percentage']); ?>%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width:<?php echo esc_attr($item['percentage']); ?>%"></div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>



  </div>
</div>

 </section>

<!-- PORTFOLIO -->
 <section class="project-section">
    <div class="container py-5">
<p class=" font-heading text-sm tracking-widest uppercase mb-2">Portfolio</p>  
  <h2 class="text-white mb-5">Featured <span class="accent">Projects</span></h2>

  <div class="row g-4">
<?php
$args = array(
    'post_type' => 'project',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC'
);
$project_query = new WP_Query($args);

if($project_query->have_posts()) :
    while($project_query->have_posts()) : $project_query->the_post();
        $tech = get_post_meta(get_the_ID(), '_project_tech', true);
        $live_link = get_post_meta(get_the_ID(), '_project_live', true);
        $repo_link = get_post_meta(get_the_ID(), '_project_repo', true);
        $tech_tags = explode(',', $tech); // split comma-separated string
?>
    <div class="col-md-4">
        <div class="project-card">
            <div class="card-top">
                <?php if(has_post_thumbnail()) {
                    the_post_thumbnail('full', ['class' => 'img-fluid']);
                } ?>
            </div>
            <div class="card-body">
                <div class="project-title"><?php the_title(); ?></div>
                <div class="project-desc"><?php the_content(); ?></div>
                <div>
                    <?php foreach($tech_tags as $tag): ?>
                        <span class="tag"><?php echo esc_html(trim($tag)); ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer-icons">
                    <?php if($repo_link): ?>
                        <a href="<?php echo esc_url($repo_link); ?>" target="_blank" class="icon-btn">⌁</a>
                    <?php endif; ?>
                    <?php if($live_link): ?>
                        <a href="<?php echo esc_url($live_link); ?>" target="_blank" class="icon-btn">↗</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>
</div>

</div>

 </section>


<!-- BLOG -->
<section class="blog_section">
  
<div class="container py-5">
<p class="font-heading text-sm tracking-widest uppercase mb-2">Blog</p>
  <h2 class="text-white mb-5">Latest <span class="accent">Articles</span></h2>
  <div class="row g-4">

    <!-- Card 1 -->
    <?php
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
);
$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
?>
               <div class="col-lg-4">
    <div class="blog-card">

        <div class="blog_image">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid rounded-2 py-2 w-100']); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/global.png"
                         class="img-fluid rounded-3 py-2"
                         alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
            </a>
        </div>

        <!-- Category -->
        <div class="badge-cat py-2">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) {
                echo esc_html($categories[0]->name);
            }
            ?>
        </div>

        <!-- Title -->
        <div class="blog-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </div>

        <!-- Description (Excerpt) -->
        <div class="blog-desc">
            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
        </div>

        <!-- Date -->
        <div class="blog-date">
            <span class="calendar-icon"></span>
            <?php echo get_the_date('M d, Y'); ?>
        </div>

    </div>
</div>

<?php
    endwhile;
    wp_reset_postdata();
endif;
?>   

  </div>
</div>
</section>

<!-- CONTACT -->
<section class="contact-section">
  <div class="container">
    <div class="row align-items-center ">
           

      <!-- LEFT -->
      <div class="col-lg-6">
         <div class="contact-label">
        <?php echo esc_html(get_theme_mod('ruku_contact_label', 'CONTACT')); ?>
    </div>

    <div class="contact-title">
        <?php echo esc_html(get_theme_mod('ruku_contact_title', "Let's connect")); ?>
    </div>


    <div class="contact-desc">
        <?php echo nl2br(esc_html(get_theme_mod('ruku_contact_description'))); ?>
    </div>

    <!-- Email -->
    <?php if (get_theme_mod('ruku_contact_email')) : ?>
    <div class="contact-item">
        <div class="icon-box">✉</div>
        <div>
            <a href="mailto:<?php echo esc_attr(get_theme_mod('ruku_contact_email')); ?>">
                <?php echo esc_html(get_theme_mod('ruku_contact_email')); ?>
            </a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Phone -->
    <?php if (get_theme_mod('ruku_contact_phone')) : ?>
    <div class="contact-item">
        <div class="icon-box">☎</div>
        <div>
            <a href="tel:<?php echo esc_attr(get_theme_mod('ruku_contact_phone')); ?>">
                <?php echo esc_html(get_theme_mod('ruku_contact_phone')); ?>
            </a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Address -->
    <?php if (get_theme_mod('ruku_contact_address')) : ?>
    <div class="contact-item">
        <div class="icon-box">📍</div>
        <div>
            <?php echo esc_html(get_theme_mod('ruku_contact_address')); ?>
        </div>
    </div>
    <?php endif; ?>

</div>

      <!-- RIGHT FORM -->
       <div class="col-lg-6">
    <?php
    // Handle form submission
    if (isset($_POST['ruku_contact_nonce']) && wp_verify_nonce($_POST['ruku_contact_nonce'], 'ruku_contact_action')) {

        $name    = sanitize_text_field($_POST['contact_name']);
        $email   = sanitize_email($_POST['contact_email']);
        $phone   = sanitize_text_field($_POST['contact_phone']);
        $subject = sanitize_text_field($_POST['contact_subject']);
        $message = sanitize_textarea_field($_POST['contact_message']);

        // Insert CPT
        $post_id = wp_insert_post(array(
            'post_type'   => 'contact_message',
            'post_title'  => $subject ?: 'No Subject',
            'post_status' => 'publish',
        ));

        if ($post_id) {
            update_post_meta($post_id, '_contact_name', $name);
            update_post_meta($post_id, '_contact_email', $email);
            update_post_meta($post_id, '_contact_phone', $phone);
            update_post_meta($post_id, '_contact_message', $message);
            echo '<div class="alert alert-success">Message sent successfully!</div>';
        }
    }
    ?>

    <form method="post" class="ruku-contact-form">
        <?php wp_nonce_field('ruku_contact_action', 'ruku_contact_nonce'); ?>

        <div class="mb-3">
            <input type="text" name="contact_name" class="form-control" placeholder="Your Name" required>
        </div>

        <div class="mb-3">
            <input type="email" name="contact_email" class="form-control" placeholder="Your Email" required>
        </div>

        <div class="mb-3">
            <input type="tel" name="contact_phone" class="form-control" placeholder="Your Phone Number">
        </div>

        <div class="mb-3">
            <input type="text" name="contact_subject" class="form-control" placeholder="Subject">
        </div>

        <div class="mb-3">
            <textarea name="contact_message" class="form-control" placeholder="Your Message" required></textarea>
        </div>

        <button type="submit" class="btn-send">
            ✈ Send Message
        </button>
    </form>
</div>

    </div>
  </div>
</section>

<?php get_footer(); ?>

<?php wp_footer(); ?>
</body>
</html>