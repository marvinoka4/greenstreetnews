<?php
/**
 * Template Name: Contact Page
 * @package helium-fdn
 */
?>
<section class="contact-form">
    <h1>Contact Us</h1>
    <?php the_content(); ?>
    <form>
        <label>
            <input type="text" placeholder="Name">
        </label>
        <label>
            <input type="email" placeholder="Email">
        </label>
        <label>
            <textarea placeholder="Message"></textarea>
        </label>
        <button>Send</button>
    </form>
</section>
