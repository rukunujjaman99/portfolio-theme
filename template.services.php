<?php 
/*
Template Name: Services Page
*/  
get_header();

?>




<!-- SERVICES -->

<section class="services-section py-5">
  <div class="container">
    <p class="font-heading text-sm tracking-widest uppercase mb-2">Services</p>
    <h2 class="text-white mb-5">My <span class="accent">Services</span></h2>
    <div class="row g-4">
        <?php
$args = array(
    'post_type' => 'service',
    'posts_per_page' => -1,
);
$service_query = new WP_Query($args);

if($service_query->have_posts()):
    while($service_query->have_posts()): $service_query->the_post();
        $icon = get_post_meta(get_the_ID(), '_service_icon', true);
        $desc = get_the_content();
?>

      <!-- Card 1 -->
           <div class="col-md-4 mb-5">
        <div class="service-card text-center p-3 border rounded">
            <div class="service-top">
                <div class="service-icon mb-3">
                    <?php if($icon): ?>
                        <i class="<?php echo esc_attr($icon); ?>"></i>
                    <?php endif; ?>
                </div>
            </div>
            <h4 class="py-1 mt-2"><?php the_title(); ?></h4>
            <p class="py-1"><?php echo esc_html($desc); ?></p>
        </div>
    </div>
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>

      <!-- Card 2 -->
    

    </div>
  </div>
</section>








<?php get_footer(); ?>


<?php wp_footer(); ?>