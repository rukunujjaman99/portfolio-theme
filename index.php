<?php 

/*
Template Name: Blog
*/  
get_header();
?>


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











<?php get_footer(); ?>


<?php wp_footer(); ?>