<?php
/*  Template Name: About Page Template */
get_header(); 
?>

<!-- header section end -->



<!-- ABOUT -->
<section class="about_section py-5">
<div class="container">
   <p><?php echo esc_html(get_theme_mod('ruku_about_small_title', 'About Me')); ?></p>

<h2 class="text-white mb-5">
 <span class="accent"><?php echo esc_html(get_theme_mod('ruku_about_heading', 'great web experiences')); ?></span>
</h2>

<div class="row ">

<!-- LEFT TEXT -->
<div class="col-lg-6 mb-4 mb-lg-0">
 <div class="about_content">
 <p class="">
  <?php echo nl2br(esc_html(get_theme_mod('ruku_about_description'))); ?>
</p>
<!-- CARD 1 -->
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

<!-- RIGHT CARDS -->
<div class="col-lg-6">
    <div class="about_image">
    <?php if (get_theme_mod('ruku_about_image')) : ?>
                <img src="<?php echo esc_url(get_theme_mod('ruku_about_image')); ?>"
                     class="img-fluid rounded"
                     alt="About Image">
            <?php endif; ?>
    </div>



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


<?php get_footer(); ?>

<?php wp_footer(); ?>
</body>
</html>