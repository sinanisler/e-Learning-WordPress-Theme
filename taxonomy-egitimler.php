<?php get_header(); ?>


<div class="egitimler-dis">
<div class="egitimler">
    
    <div class="egitimler-bilgi">
        <h1><?php single_term_title(); ?> </h1>
        <?php echo term_description(); ?>
    </div>
    
    <?php $a=1; if (have_posts()) :  while (have_posts()) : the_post(); ?>
    <div class="egitim e<?php echo $a; $a++; ?>">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php the_post_thumbnail( 'size-270x180' ); ?>
        </a>
        <h2><?php the_title(); ?></h2>
        <?php $str = get_the_excerpt(); echo wp_html_excerpt( $str, 100 ); ?>
    </div>
    <?php  endwhile;    endif; ?>
    
    
    
</div>
</div>


<?php get_footer(); ?>