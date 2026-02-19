<?php
/*
Template Name: Portfolio
*/
get_header();
?>

<!-- header section end -->



<!-- PORTFOLIO -->
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




<?php get_footer(); ?>


<?php wp_footer(); ?>
</body>
</html>