<?php get_header(); ?>
<section class="py-20 bg-gray-50">
  <div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold text-center mb-8">All Projects</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
          <div class="bg-white rounded-2xl shadow-xl p-6 hover:-translate-y-2 transition">
            <a href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <div class="mb-4 overflow-hidden rounded-lg">
                  <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
                </div>
              <?php endif; ?>
              <h3 class="text-xl font-semibold text-gray-800"><?php the_title(); ?></h3>
            </a>
          </div>
        <?php endwhile; ?>
    </div>
    <?php the_posts_pagination(); ?>
      <?php else : ?>
        <p class="text-center text-gray-500">No projects found!</p>
      <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>
