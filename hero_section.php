<?php

$slider_posts = new WP_Query(array(
    'posts_per_page' => 3,
));
if ($slider_posts->have_posts()) :
?>
<div class="hero-slider">
    <?php
    $slide_index = 0;
    while ($slider_posts->have_posts()) : $slider_posts->the_post();
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if (!$image_url) {
            $image_url = 'https://via.placeholder.com/1200x400?text=No+Image';
        }
    ?>
    <div class="hero-slide<?php if ($slide_index === 0) echo ' active'; ?>" style="background-image: url('<?php echo esc_url($image_url); ?>');">
        <div class="hero-content">
            <h1><a href="<?php the_permalink(); ?>" style="color:white; text-decoration:none;"><?php the_title(); ?></a></h1>
            <p><?php echo wp_trim_words(get_the_content(), 20); ?></p>
            <a href="<?php the_permalink(); ?>" class="hero-button">Read More</a>
        </div>
    </div>
    <?php $slide_index++; endwhile; ?>
    <button class="hero-prev">&#10094;</button>
    <button class="hero-next">&#10095;</button>
</div>

<style>
.hero-slider {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
}
.hero-slide {
    width: 100%;
    height: 400px;
    background-size: cover;
    background-position: center;
    display: none;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 0; left: 0;
    transition: opacity 0.5s;
}
.hero-slide.active {
    display: flex;
    opacity: 1;
    z-index: 1;
}
.hero-content {
    background: rgba(0,0,0,0.5);
    padding: 20px 40px;
    border-radius: 10px;
    text-align: center;
    color: #fff;
    margin: auto;
}
.hero-button {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background: #fff;
    color: #000;
    text-decoration: none;
    border-radius: 5px;
}
.hero-prev, .hero-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.4);
    color: #fff;
    border: none;
    font-size: 2em;
    padding: 0 15px;
    cursor: pointer;
    z-index: 2;
    border-radius: 50%;
}
.hero-prev { left: 20px; }
.hero-next { right: 20px; }

@media (max-width: 600px) {
    .hero-slider, .hero-slide {
        height: 200px;
    }
    .hero-content {
        padding: 10px 10px;
    }
    .hero-content h1 {
        font-size: 1.2em;
    }
    .hero-button {
        padding: 8px 16px;
        font-size: 0.9em;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-slide');
    const prevBtn = document.querySelector('.hero-prev');
    const nextBtn = document.querySelector('.hero-next');
    let current = 0;

    function showSlide(idx) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === idx);
        });
    }

    prevBtn.addEventListener('click', function() {
        current = (current - 1 + slides.length) % slides.length;
        showSlide(current);
    });

    nextBtn.addEventListener('click', function() {
        current = (current + 1) % slides.length;
        showSlide(current);
    });

    setInterval(function() {
        current = (current + 1) % slides.length;
        showSlide(current);
    }, 10000);
});
</script>
<?php
wp_reset_postdata();
endif;
?>