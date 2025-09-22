<nav class="bg-gray-800 p-4">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_class' => 'flex space-x-4 text-white',
        'container' => false,
        'link_before' => '<span class="hover:text-gray-300">',
        'link_after' => '</span>',
    ) );
    ?>
</nav>