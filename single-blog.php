<?php get_header(); ?>


<div class="blog">
<div class="blog-ic">
    
    <div class="blog-content">
        
        <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
        <div class="blog-single">
            <div class="blog-image">
                <?php the_post_thumbnail('size-640x320'); ?>
                <div class="blog-time">
                    <?php the_time('M'); ?><br>
                    <span class="time1"><?php the_time('d'); ?></span>
                </div>
            </div>
            <div class="blog-title-ic">
                <?php the_title(); ?>
            </div>
            <div class="blog-desc-ic">
                <?php the_content(); ?>
            </div>
        </div>
        <?php  endwhile; endif; ?>
        
        <div class="comments"><?php comments_template(); ?></div>
        
    </div>
    <div class="blog-sidebar">
        <?php dynamic_sidebar('Blog') ?>
        
        
    </div>
</div>
</div>



<?php get_footer(); ?>