<?php get_header(); ?>


<div class="single">
<div class="single-ic">
    
    <h1 class="single-title">
    <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
    
    <?php the_title(); ?> 
    
    <?php  endwhile; endif; ?>
    </h1>
    
    
    <div class="page">
    <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
    
    <?php the_content(); ?> 
    
    <?php  endwhile; endif; ?>
    </div>
    
    
</div>
</div>



<?php get_footer(); ?>