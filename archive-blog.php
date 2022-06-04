<?php get_header(); ?>


<div class="blog">
<div class="blog-ic">
    
    <div class="blog-content">
        
        <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
        <div class="blog-single">
            <div class="blog-image">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('size-640x320'); ?></a>
                <div class="blog-time">
                    <?php the_time('M'); ?><br>
                    <span class="time1"><?php the_time('d'); ?></span>
                </div>
            </div>
            <a href="<?php the_permalink(); ?>" class="blog-title">
                
                <?php echo wp_html_excerpt( get_the_title(), 84  ); ?>
            
            </a>
            <div class="blog-desc">
                <?php echo wp_html_excerpt( get_the_excerpt(), 120 ); ?>... 
                <a href="<?php the_permalink(); ?>" class="devami">devamı »</a>
            </div>
        </div>
        <?php  endwhile; endif; ?>
        
        <?php
        global $wp_query;
        $big = 999999999; // need an unlikely integer
        echo '<div class="pagination">';
        echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages
        ) );
        echo '</div>';
        ?>
        
    </div>
    <div class="blog-sidebar">
        <?php dynamic_sidebar('Blog') ?>
        
        
    </div>
</div>
</div>



<?php get_footer(); ?>