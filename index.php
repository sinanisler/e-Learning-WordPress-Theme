<?php get_header(); ?>

<div class="slider">
<div class="slider2">
<div class="slider-ic">
        <div class="slider-yazi">
        Her yerde <span class="r1">öğrenebilirsin</span>
        </div>
	
	<div class="slider-resim">
	    <img src="<?php bloginfo('stylesheet_directory'); ?>/img/pc1.png" width="500" alt="" class="simg1">
            <div class="slider-ekran">

                
                <iframe src="//player.vimeo.com/video/93818815?title=0&amp;byline=0&amp;portrait=0" width="473" height="280" style="border:none"></iframe>

            </div>
	</div>
</div>
</div>
</div>

<div class="bildirim">
<div class="bildirim-ic">
    
    Yeni Eğitimlerden ve Makalelerden haberdar olmak için buradan kayıt yapınız.
    
    <a href="https://docs.google.com/forms/d/1NI_pY0p2ywK1qPA_l4pZ4O4Z4IZ1h7JMsP22HG7tS08/viewform" class="bildirim-kay" 
       target="_blank">Duyuru Kayıt</a>
</div>
</div>


<div class="hizmetler-dis">
<div class="hizmetler">
    
    <div class="hizmet">
        <div class="hizmet-img">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/1.png" width="128" alt="">
        </div>
        Bilişim Teknolojilerini ve Araçlarını<br>
        Video eğitimlerle öğretiyoruz.
    </div>
    
    <div class="hizmet">
        <div class="hizmet-img">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/2.png" width="128" alt="">
        </div>
        Eğitimlere her yerden<br>
 		istediğiniz anda erişebilirsiniz.
    </div>
    
    <div class="hizmet2">
        <div class="hizmet-img">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/3.png" width="128" alt="">
        </div>
        Eğitim Alem ucuzdur çünkü tüm <br>
        eğitimler için bir abonelik yeterlidir.
    </div>
    
    <div class="hizmet">
        <div class="hizmet-img">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/4.png" width="128" alt="">
        </div>
        Video eğitimler kolayca erişilebilir<br>
		olduğu için zamandan kazanırsınız.
    </div>
    
    <div class="hizmet">
        <div class="hizmet-img">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/5.png" width="128" alt="">
        </div>
        Mobil olarak eğitimleri izleyebilirsiniz.<br>
		Tabletleri destekliyoruz.
    </div>
    
    <div class="hizmet2">
        <div class="hizmet-img">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/6.png" width="128" alt="">
        </div>
        Site sürekli günceldir. Her hafta yeni <br>
		videolar ve eğitim setleri yayınlanır.
    </div>
    
    
</div>
</div>




<div class="egitimler-dis">
<div class="egitimler">
    
    <div class="egitimler-bilgi" style="font-size:22px; text-align:center; font-weight:400">
        Son Eklenen Eğitimler
    </div>
    
    <?php query_posts( 'posts_per_page=6&post_type=egitim&post_parent=0');  $a=1; if (have_posts()) :  while (have_posts()) : the_post(); ?>
    <div class="egitim e<?php echo $a; $a++; ?>">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php the_post_thumbnail( 'size-270x180' ); ?>
        </a>
        <h2><?php the_title(); ?></h2>
        <?php $str = get_the_excerpt(); echo wp_html_excerpt( $str, 100 ); ?>
    </div>
    <?php  endwhile; endif;  wp_reset_query(); ?>
    
    
    
</div>
</div>




<?php get_footer(); ?>