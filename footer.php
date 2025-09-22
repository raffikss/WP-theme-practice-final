<?php
// Assume this is within a WordPress template file (e.g., footer.php or a full template)
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/output.css" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body class="bg-gray-100 font-sans">
    <div id="content" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
        ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white shadow-md rounded-lg p-6 mb-6'); ?>>
                    <h2 class="text-2xl sm:text-3xl font-bold mb-4">
                        <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:text-blue-800 no-underline"><?php the_title(); ?></a>
                    </h2>
                    <div class="prose prose-sm sm:prose-base max-w-none"><?php the_content(); ?></div>
                </article>
        <?php
            endwhile;
        else :
        ?>
            <p class="text-center text-gray-600 text-lg">No posts found!</p>
        <?php
        endif;
        ?>
        
    </div>
    <div class="footer-widget-area bg-blue-800 text-white py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <?php dynamic_sidebar( 'footer-3' ); ?>
            <?php else : ?>
                <h4 class="text-xl font-semibold mb-4 text-center sm:text-left">Follow Us</h4>
                <ul class="social-links flex justify-center sm:justify-start space-x-4">
                    <li><a href="#" target="_blank" class="text-gray-300 hover:text-white no-underline transition-colors">Facebook</a></li>
                    <li><a href="#" target="_blank" class="text-gray-300 hover:text-white no-underline transition-colors">Twitter</a></li>
                    <li><a href="#" target="_blank" class="text-gray-300 hover:text-white no-underline transition-colors">Instagram</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="w-full flex justify-center bg-gray-900">
        <div class="site-copyright text-center w-full py-4 text-gray-400 text-sm">
            <p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>