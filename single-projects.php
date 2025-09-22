<?php get_header(); ?>
<div class="container mx-auto px-4 py-16">
  <?php while (have_posts()) : the_post(); ?>
    <h1 class="text-3xl font-bold mb-6"><?php the_title(); ?></h1>
    <?php if (has_post_thumbnail()) : ?>
      <div class="mb-6"><?php the_post_thumbnail('large', ['class' => 'rounded-lg shadow']); ?></div>
    <?php endif; ?>
    <div class="prose max-w-none mb-8"><?php the_content(); ?></div>

    <?php
    $project_url = get_post_meta(get_the_ID(), '_project_url', true);
    if ($project_url) : ?>
      <a href="<?php echo esc_url($project_url); ?>" 
         target="_blank" 
         class="inline-block bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">
      </a>
    <?php endif; ?>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
