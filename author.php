<?php get_header(); ?>


<?php 

$args = array(
	'post_status' => 'publish',
	'post_type' => 'abonelik',
	'tax_query' => array(
		array(
			'taxonomy' => 'kullanici',
			'field' => 'slug',
			'terms' => 'admin'
		)
	)
);
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post );
	$abonelikgun = strip_tags( get_the_term_list( $post->post->ID, 'aboneliksure', '', ', ', '' ) );
	$ilktarih = get_the_date('Y-m-d'); 
	$simdikitarih = current_time('Y-m-d');	
endforeach; wp_reset_postdata();


?>


<?php
while ( have_posts() ) : the_post();
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
endwhile;
?>
<div class="profil">
<div class="profil-ic">
	<div class="profil-avatar">
    	<?php    echo get_avatar( $curauth->user_email, $size = '190', $default = 'http://www.egitimalem.com/wp-content/themes/egitimalem.com/img/avatar.jpg' );    ?>
    </div>
	<div class="profil-icerik">
        <h1 class="profil-title"><?php echo $curauth->user_firstname.' '.$curauth->user_lastname; ?></h1>
        
        
        <p class="profil-desc"><?php echo $curauth->description ?></p>
        
        
        
    </div>
</div>
</div>


<?php get_footer(); ?>