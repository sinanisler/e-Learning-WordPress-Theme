<?php

remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
define('DISALLOW_FILE_EDIT', TRUE);

add_theme_support( 'menus' );
register_nav_menus( array(
	'ust_menu' => 'UstMenu',
	'footer_menu' => 'FooterMenu'
) );

if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}
register_sidebars(1, array('name'=>'Blog'));



function jquery() {
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'jquery' );



function kayityonlendir()
{
    return home_url( '/' );
}
add_filter( 'registration_redirect', 'kayityonlendir' );



function go_home(){
  wp_redirect( home_url() );
  exit();
}
add_action('wp_logout','go_home');



add_theme_support( 'post-thumbnails' );
add_image_size( 'size-270x180', 270, 180, true );
add_image_size( 'size-640x320', 640, 320, true );

the_post();
/*
 * 
 *  Abonelikler > Abonelik Süre + Başlangıç Tarih
 *  
 *  Kullanıcı   > Süresi        + Başlangıç Tarih
 * 
 *  user_id     > 30 Gün        + 10.10.2014
 * 
 */
yazitipi('Abonelik','abonelik');
taxonomy('Abonelik Süre','aboneliksure','abonelik');
taxonomy('Kullanıcı','kullanici','abonelik');
taxonomy_kat('Ödeme Durum','odemedurum','abonelik');



/*
 *  
 *  Eğitimler > Eğitim > Videolar
 *  
 */
// yazitipi('Konular','konular'); 

yazitipi('Eğitim','egitim');
//yazitipi('Video','video'); 



taxonomy_kat('Eğitimler','egitimler',array('egitim')); 
taxonomy_kat('Abonelik','abonelik',array('egitim')); 
taxonomy('Video ID','videoid',array('egitim'));
// taxonomy('Eğitim ID','egitimid',array('egitim'));
taxonomy('Süre','sure',array('egitim'));


/*
 *  
 *  Blog > Makaleler
 *  
 */
yazitipi('Blog','blog');
taxonomy('Kategori','kategori','blog'); // Blog Kategori
taxonomy('Eğitim Seviye','seviye',array('blog','egitimler')); // Blog Kategori



function taxonomy($taxonomyadi,$taxonomyslug,$baglipost){
	register_taxonomy( $taxonomyslug, $baglipost, array( 'hierarchical' => false, 'label' => $taxonomyadi, 'query_var' => true, 'rewrite' => true, 'show_in_nav_menus' => false ) );
}
function taxonomy_kat($taxonomyadi,$taxonomyslug,$baglipost){
	register_taxonomy( $taxonomyslug, $baglipost, array( 'hierarchical' => true, 'label' => $taxonomyadi, 'query_var' => true, 'rewrite' => true, 'show_in_nav_menus' => true ) );
}
function yazitipi($yazitipiadi,$yazitipislug){
	register_post_type( $yazitipislug,
	array(
			'labels' => array(
				'name' => __( $yazitipiadi ),
				'singular_name' => __( $yazitipiadi )
			),
			'public' => true,
			'has_archive' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 16,
			'supports' => array('title','editor','author','comments','thumbnail','page-attributes','revisions'),
			'has_archive' => $yazitipislug,
			'show_in_nav_menus' => false
			)
		);
}


function kullaniciadres() {
    global $wp_rewrite;
        $author_slug = 'uye'; // yeni belirleyeceğiniz adres biçimi
        $wp_rewrite->author_base = $author_slug;
}
add_action('init', 'kullaniciadres');






function caption_shortcode( $atts, $content = null ) {
   return '<p class="onemli">' . $content . '</p>';
}
add_shortcode( 'onemli', 'caption_shortcode' );

function caption_shortcode2( $atts, $content = null ) {
   return '<p class="dikkat">' . $content . '</p>';
}
add_shortcode( 'dikkat', 'caption_shortcode2' );

function caption_shortcode3( $atts, $content = null ) {
   return '<p class="duyuru">' . $content . '</p>';
}
add_shortcode( 'duyuru', 'caption_shortcode3' );


function caption_shortcode4( $atts, $content = null ) {
   return '<p class="code">' . $content . '</p>';
}
add_shortcode( 'code', 'caption_shortcode4' );





/*
	
	Üye Giriş Bir Kez Olabilir
	
*/
if( !class_exists( 'WPSingleUserLoggin' ) )
{
  	class WPSingleUserLoggin
	{
		private $session_id; 
	
		function __construct()
		{
			if ( ! session_id() )
			    session_start();
	
			$this->session_id = session_id();
	
			add_action( 'init', array( $this, 'init' ) );
			add_action( 'wp_login', array( $this, 'wp_login' ), 10, 2 );
		}
	
		function init()
		{
			if( ! is_user_logged_in() )
				return;
				
			$stored_sess_id = get_user_meta( get_current_user_id(), '_wp_single_user_hash', true );
			
			if( $stored_sess_id != $this->session_id )
			{
				wp_logout(); 
				wp_redirect( wp_login_url() );
				exit;
			}
		}
		function wp_login( $user_login, $user )
		{
			update_user_meta( $user->ID, '_wp_single_user_hash', $this->session_id );
			return;
		}
	}
	new WPSingleUserLoggin();
}









function GetDays($sStartDate, $sEndDate){
  // Firstly, format the provided dates.
  // This function works best with YYYY-MM-DD
  // but other date formats will work thanks
  // to strtotime().
  $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));
  $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));

  // Start the variable off with the start date
  $aDays[] = $sStartDate;

  // Set a 'temp' variable, sCurrentDate, with
  // the start date - before beginning the loop
  $sCurrentDate = $sStartDate;

  // While the current date is less than the end date
  while($sCurrentDate < $sEndDate){
    // Add a day to the current date
    $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));

    // Add this new day to the aDays array
    $aDays[] = $sCurrentDate;
  }

  // Once the loop has finished, return the
  // array of days.
  return $aDays;
}




?>