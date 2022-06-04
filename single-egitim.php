<?php get_header(); ?>


<div class="single">
<div class="single-ic">
    
    <h1 class="single-title">
    <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
    
    <?php if($post->post_parent == 0){ }else{ 
		$postid = $post->post_parent; 
		$postlink = get_the_permalink($postid);
		?>
		<a href="<?php echo $postlink ?>"><?php echo get_the_title($postid) ?> » </a>
	<?php } ?>
    
    <?php the_title(); ?> 
    
    <?php 
	$egitim_abonelik_durum = strip_tags( get_the_term_list( $wp_query->post->ID, 'abonelik', '', ', ', '' ) ); 
	$videoid = strip_tags( get_the_term_list( $wp_query->post->ID, 'videoid', '', ', ', '' ) );
	?>
    
    <?php  endwhile; endif; ?>
    </h1>
    
	<?php 
    query_posts( 'post_status=publish&post_type=abonelik&kullanici='.$giris_yapan_kullanici->user_login ); 
    if (have_posts()) :  while (have_posts()) : the_post(); ?>
        <?php 
		
		$odemedurum = strip_tags( get_the_term_list( $wp_query->post->ID, 'odemedurum', '', ', ', '' ) );
		if($odemedurum=='Bekliyor'){
			 $aboneliksure = 0;
		}else{
		$aboneliksure = strip_tags( get_the_term_list( $wp_query->post->ID, 'aboneliksure', '', ', ', '' ) ); 
		}
		
        $str = get_the_time('d.m.Y');
        $str = strtotime(date("d.M.Y")) - (strtotime($str));
        $ilkGunSonGunFarki = floor($str/3600/24);
    endwhile; 
	else:
        $aboneliksure = 1;
        $ilkGunSonGunFarki = 2;
	endif; 
	wp_reset_query(); 
	?>
    
    <div class="single-player">
	<?php if ( is_user_logged_in() ){ ?>
    
    	<?php if($egitim_abonelik_durum=="Ücretli"){  ?>
            
            <?php if($aboneliksure > $ilkGunSonGunFarki or $aboneliksure == $ilkGunSonGunFarki){ ?>
                <iframe src="//player.vimeo.com/video/<?php echo $videoid ?>?title=0&amp;byline=0&amp;portrait=0&hd=1" 
                width="960" height="535" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			<?php }else{ ?>
                <div class="single-player-abonelik">
                    Bu Eğitimi izleyebilmek için EgitimAlem.com abone olmalısınız.<br>
                    <span class="r2">Uzmanların hazırladığı <?php  $es = wp_count_posts('egitim');  echo $es->publish;  ?>+ eğitime her yerden ve her zaman erişebilirsiniz.</span><br>
                    <a href="<?php bloginfo('url'); ?>/abone" class="single-player-abonelik-button">Abone Ol</a>
                </div>
			<?php } ?>
                    
        <?php } else{  ?>
        	
            <iframe src="//player.vimeo.com/video/<?php echo $videoid ?>?title=0&amp;byline=0&amp;portrait=0&hd=1" 
            width="960" height="535" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            
    	<?php } ?>
    
    <?php } else{  ?>
    
    	<?php if($egitim_abonelik_durum=="Ücretli"){  ?>
            <div class="single-player-abonelik">
                Bu Eğitimi izleyebilmek için EgitimAlem.com abone olmalısınız.<br>
                <span class="r2">Uzmanların hazırladığı <?php  $es = wp_count_posts('egitim');  echo $es->publish;  ?>+ eğitime her yerden ve her zaman erişebilirsiniz.</span><br>
                <a href="<?php bloginfo('url'); ?>/abone" class="single-player-abonelik-button">Abone Ol</a>
            </div>
        <?php } else{  ?>
            <iframe src="//player.vimeo.com/video/<?php echo $videoid ?>?title=0&amp;byline=0&amp;portrait=0&hd=1" 
            width="960" height="535" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    	<?php } ?>
    
    <?php } ?>
    	
        
    </div>
    
    <div class="single-list-desc">
    	<style type="text/css"> .id<?php the_ID(); ?>{ background: #F4F4F4; !important; border:solid 1px #E4E4E4 !important;}</style>
        
        <div class="single-list">
        <ul>
        <?php 
		if($post->post_parent == 0){ $postid = $post->ID; }else{ $postid = $post->post_parent; }
		
		query_posts( 'posts_per_page=30&order=ASC&orderby=menu_order&post_type=egitim&post_parent='.$postid ); 
		if (have_posts()) :  while (have_posts()) : the_post(); 
		$egitim_abonelik_durum = strip_tags( get_the_term_list( $wp_query->post->ID, 'abonelik', '', ', ', '' ) ); 
		?>
        <li>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="id<?php the_ID(); ?>">
            <?php if($egitim_abonelik_durum=="Ücretli"){echo '<img src="'.get_bloginfo('stylesheet_directory').'/img/lock.png'.'" >';} ?>
            <?php if($egitim_abonelik_durum=="Ücretsiz"){echo '<img src="'.get_bloginfo('stylesheet_directory').'/img/play3.png'.'" >';} ?>
            <?php the_title(); ?>
            <span class="sure "><?php $t = strip_tags( get_the_term_list( $wp_query->post->ID, 'sure', '', ', ', '' ) ); echo gmdate("i:s", $t); ?></span>
            <!-- <?php echo $t ?> -->
            </a>
        </li>
        <?php  endwhile; endif; wp_reset_query(); ?>
        </ul>
        </div>
        
        
        <div class="single-desc">
            
        <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
        
        <?php the_content(); ?>
        <br>
        <?php echo $sure_count; ?>
        <?php /* <p>Eğitmen: <a href="<?php bloginfo('url'); ?>/uye/<?php echo get_the_author_meta('nickname'); ?>" class="egitmen"><?php the_author(); ?></a></p> */ ?>
        
        <?php  endwhile; endif; ?>
            
        </div>
    </div>
    
    
</div>
</div>



<?php get_footer(); ?>