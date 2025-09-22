<aside class="sidebar w-full md:w-1/4 p-4">
    <?php if (is_active_sidebar('main-sidebar')) : ?>
        <?php dynamic_sidebar('main-sidebar'); ?>
    <?php else : ?>
        <p class="text-gray-500">Please add widgets to the sidebar via Appearance > Widgets in the WordPress admin.</p>
    <?php endif; ?>
</aside>

