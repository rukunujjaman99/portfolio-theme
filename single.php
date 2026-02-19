<?php 
/*
Template Name: Blog Details
*/
get_header();

?>
    

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <!-- Blog Header -->
  <section class="blog-header">

    <h1><?php the_title(); ?></h1>
  </section>

  <!-- Blog Content -->
  <section class="container blog-content">
    <div class="row">

      <div class="col-lg-8">
        <div class="post-image">
            <?php if (has_post_thumbnail()) : ?>
    <?php the_post_thumbnail('full', [
        'class' => 'img-fluid w-100',
        'alt'   => get_the_title()
    ]); ?>
<?php endif; ?>
        </div>

        <!-- Main Content -->
         <p class="py-2"><?php the_content(); ?></p>
      

        <!-- Tags -->
        <?php if (has_tag()) : ?>
          <div class="blog-tags">
            <?php
            $tags = get_the_tags();
            if ($tags) :
              foreach ($tags as $tag) : ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo esc_html($tag->name); ?></a>
              <?php endforeach;
            endif; ?>
          </div>
        <?php endif; ?>

        <!-- Author Info -->
     

        <!-- Comments Section -->
   

      </div>

      <!-- Sidebar -->
      <div class="col-lg-4 sidebar">

        <!-- Recent Posts -->
        <div class="p-4 mb-4 bg-dark rounded">
          <h5>Recent Posts</h5>
          <ul class="list-unstyled">
            <?php
            $recent_posts = wp_get_recent_posts(array(
              'numberposts' => 5,
              'post_status' => 'publish'
            ));
            foreach ($recent_posts as $post) : ?>
              <li><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo esc_html($post['post_title']); ?></a></li>
            <?php endforeach; wp_reset_query(); ?>
          </ul>
        </div>

        <!-- Categories -->
        <div class="p-4 bg-dark rounded">
          <h5>Categories</h5>
          <ul class="list-unstyled">
            <?php
            $categories = get_categories();
            foreach ($categories as $category) : ?>
              <li><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo esc_html($category->name); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

      </div>

    </div>
  </section>

<?php endwhile; endif; ?>








<?php get_footer(); ?>


<?php wp_footer(); ?>