
<?php get_header(); ?>

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
    'post_type' => 'feature',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);

if($query->have_posts()):
    while($query->have_posts()): $query->the_post();
        $icon = get_post_meta(get_the_ID(), '_feature_icon', true);
?>

 <?php
$args = array(
    'post_type' => 'feature',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);

if($query->have_posts()):
    while($query->have_posts()): $query->the_post();

        $icon     = get_post_meta(get_the_ID(), '_feature_icon', true);
        $subtitle = get_post_meta(get_the_ID(), '_feature_subtitle', true);
?>

<div class="feature-card mb-4">
    <div class="icon-box">
        <i class="<?php echo esc_attr($icon); ?>"></i>
    </div>
    <div>
        <h5><?php the_title(); ?></h5>
        <p><?php echo esc_html($subtitle); ?></p>
    </div>
</div>

<?php
    endwhile;
    wp_reset_postdata();
endif;
?>

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
    <div class="col-lg-4">
      <div class="blog-card">
        <div class="badge-cat">React</div>
        <div class="blog-title">Building Scalable React Applications in 2025</div>
        <div class="blog-desc">
          A deep dive into modern patterns for building large-scale React apps with TypeScript and state management.
        </div>
        <div class="blog-date">
          <span class="calendar-icon"></span>
          Jan 15, 2025
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-lg-4">
      <div class="blog-card">
        <div class="badge-cat">Best Practices</div>
        <div class="blog-title">The Art of Clean Code: Principles Every Dev Should Know</div>
        <div class="blog-desc">
          Exploring SOLID principles and how to write code that your future self will thank you for.
        </div>
        <div class="blog-date">
          <span class="calendar-icon"></span>
          Dec 8, 2024
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-lg-4">
      <div class="blog-card">
        <div class="badge-cat">CSS</div>
        <div class="blog-title">Mastering CSS Grid and Flexbox in Modern Layouts</div>
        <div class="blog-desc">
          Practical guide to creating complex, responsive layouts with CSS Grid and Flexbox.
        </div>
        <div class="blog-date">
          <span class="calendar-icon"></span>
          Nov 22, 2024
        </div>
      </div>
    </div>

  </div>
</div>
</section>

<!-- CONTACT -->
<section class="contact-section">
  <div class="container">
    <div class="row align-items-center g-5">

      <!-- LEFT -->
      <div class="col-lg-6">
        <div class="contact-label">CONTACT</div>
        <div class="contact-title">Let's <span>connect</span></div>

        <div class="contact-desc">
          I'm always open to discussing new projects, creative ideas, or opportunities to be part of your vision. Feel free to reach out!
        </div>

        <div class="contact-item">
          <div class="icon-box">✉</div>
          <div>alex@example.com</div>
        </div>

        <div class="contact-item">
          <div class="icon-box">☎</div>
          <div>+1 (555) 123-4567</div>
        </div>

        <div class="contact-item">
          <div class="icon-box">📍</div>
          <div>San Francisco, CA</div>
        </div>
      </div>

      <!-- RIGHT FORM -->
      <div class="col-lg-6">
        <form>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Your Name">
          </div>

          <div class="mb-3">
            <input type="email" class="form-control" placeholder="Your Email">
          </div>

          <div class="mb-3">
            <textarea class="form-control" placeholder="Your Message"></textarea>
          </div>

          <button class="btn-send">
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