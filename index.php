<?php get_header(); ?>
<?php
$slider_posts = new WP_Query(array('posts_per_page' => 3));
if ($slider_posts->have_posts()) : ?>
    <div class="hero-slider relative w-full h-64 sm:h-96 overflow-hidden mb-12">
        <?php $slide_index = 0;
        while ($slider_posts->have_posts()) : $slider_posts->the_post();
            $image_url = get_the_post_thumbnail_url() ?: ''; ?>
            <div class="hero-slide absolute w-full <?php echo $slide_index === 0 ? 'block' : 'hidden'; ?>" style="background-image: url('<?php echo esc_url($image_url); ?>');">
                <div class="hero-content bg-black/50 p-4 text-center text-white">
                    <h1 class="text-xl"><a href="<?php the_permalink(); ?>" class="text-white no-underline"><?php the_title(); ?></a></h1>
                    <a href="<?php the_permalink(); ?>" class="mt-2 inline-block bg-white text-black px-4 py-2 rounded">Read More</a>
                </div>
            </div>
        <?php $slide_index++; endwhile; ?>
        <button class="hero-prev absolute left-2 top-1/2 -translate-y-1/2 bg-gray/40 text-black p-1 rounded-full">&lt;</button>
        <button class="hero-next absolute right-2 top-1/2 -translate-y-1/2 bg-gray/40 text-black p-1 rounded-full">&gt;</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.hero-slide');
            const prevBtn = document.querySelector('.hero-prev');
            const nextBtn = document.querySelector('.hero-next');
            let current = 0;

            function showSlide(idx) {
                slides.forEach((slide, i) => slide.style.display = i === idx ? 'block' : 'none');
            }

            prevBtn.addEventListener('click', () => {
                current = (current - 1 + slides.length) % slides.length;
                showSlide(current);
            });
            nextBtn.addEventListener('click', () => {
                current = (current + 1) % slides.length;
                showSlide(current);
            });
            setInterval(() => {
                current = (current + 1) % slides.length;
                showSlide(current);
            }, 5000);
        });

</script>

<section class="banner-section my-12">
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="banner rounded-xl overflow-hidden shadow-lg transform hover:scale-105 transition duration-300">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/image copy.png" class="w-full h-64 object-cover">
      <div class="p-4 bg-black text-center">
      </div>
    </div>
    <div class="banner rounded-xl overflow-hidden shadow-lg transform hover:scale-105 transition duration-300">
      <img src="<?php echo get_template_directory_uri(); ?>/image.png" class="w-full h-64 object-cover">
      <div class="p-4 bg-black text-center">
      </div>
    </div>
  </div>
</section>


<?php wp_reset_postdata(); endif; ?>
<section class="bg-gradient-to-br from-green-200 via-green-50 to-teal-100 py-20 animate-fade-in">
  <div class="max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 tracking-tight">About the Site</h2>
    <p class="text-lg text-gray-700 mb-8 max-w-2xl mx-auto leading-relaxed">A vibrant site blending a variety of features to discover what shines brightest!</p>
    <div class="text-left inline-block mx-auto bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
      <span class="font-semibold text-gray-800 text-lg">Things to do better:</span>
      <ul class="list-disc list-inside text-gray-600 mt-2 space-y-2 text-base sm:text-lg">
        <li>Improve the hero slider</li>
        <li>Theme styling using tailwind css</li>
        <li>dinamic widgets</li>

      </ul>
    </div>
  </div>
</section>

<section class="bg-gradient-to-br from-teal-50 to-green-100 py-20 animate-slide-up">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8 text-center tracking-tight">Recent Projects</h2>
    <div class="projects-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      $recent_projects = new WP_Query(array(
        'post_type'      => 'projects',
        'posts_per_page' => 3,
      ));

      if ($recent_projects->have_posts()) :
        while ($recent_projects->have_posts()) : $recent_projects->the_post(); ?>
          <div class="project-card bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center transform hover:-translate-y-2 hover:shadow-2xl transition-all duration-300">
            <a href="<?php the_permalink(); ?>" class="w-full flex flex-col items-center group">
              <?php if (has_post_thumbnail()) : ?>
                <div class="mb-4 w-full flex justify-center overflow-hidden rounded-lg">
                  <?php the_post_thumbnail('medium', ['class' => 'rounded-lg w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300']); ?>
                </div>
              <?php endif; ?>
              <h3 class="text-xl font-semibold text-gray-800 text-center group-hover:text-teal-600 transition-colors duration-200"><?php the_title(); ?></h3>
            </a>
          </div>
        <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p class="text-center text-gray-500 text-lg font-medium col-span-full">No projects found!</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<div class="text-center py-8">
  <a href="<?php echo esc_url( get_post_type_archive_link('projects') ); ?>" 
     class="bg-red-600 text-black text-2xl px-10 py-5 rounded-xl hover:bg-teal-700 transition">
    View All Projects
  </a>
</div>


<div id="content" class="px-4 max-w-4xl mx-auto py-16">
  <?php
  if (have_posts()) :
    while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('mb-10 bg-white rounded-2xl shadow-xl p-8 transform hover:-translate-y-1 transition-all duration-300'); ?>>
        <h2 class="text-2xl font-bold mb-4"><a href="<?php the_permalink(); ?>" class="text-teal-700 hover:text-teal-500 transition-colors duration-200"><?php the_title(); ?></a></h2>
        <div class="prose prose-lg text-gray-700 max-w-none"><?php the_content(); ?></div>
      </article>
    <?php endwhile;
  else : ?>
    <p class="text-center text-gray-500 text-lg font-medium">No posts found!</p>
  <?php endif; ?>
</div>

<section class="bg-gradient-to-br from-teal-50 to-green-100 py-20 animate-slide-up">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8 text-center tracking-tight">All Posts</h2>
    <div class="posts-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      $all_posts = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => -1, 
      ));

      if ($all_posts->have_posts()) :
        while ($all_posts->have_posts()) : $all_posts->the_post(); ?>
          <div class="post-card bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center transform hover:-translate-y-2 hover:shadow-2xl transition-all duration-300">
            <a href="<?php the_permalink(); ?>" class="w-full flex flex-col items-center group">
              <?php if (has_post_thumbnail()) : ?>
                <div class="mb-4 w-full flex justify-center overflow-hidden rounded-lg">
                  <?php the_post_thumbnail('medium', ['class' => 'rounded-lg w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300']); ?>
                </div>
              <?php endif; ?>
              <h3 class="text-xl font-semibold text-gray-800 text-center group-hover:text-teal-600 transition-colors duration-200"><?php the_title(); ?></h3>
            </a>
          </div>
        <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p class="text-center text-gray-500 text-lg font-medium col-span-full">No posts found!</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>