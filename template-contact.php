<?php 
/*
Template Name: Contact Page
*/
get_header();

?>

<section class="contact-section">
  <div class="container">
    <div class="row align-items-center g-5">

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