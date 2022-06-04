<!DOCTYPE HTML>
<html><head>
<meta charset="utf-8">
<title><?php bloginfo('name'); ?><?php wp_title('|',true); ?></title>
<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css?v1">
<?php wp_head(); 
global $giris_yapan_kullanici;
$giris_yapan_kullanici = wp_get_current_user();
?>

</head><body>
<div class="header">
    <div class="header-ust">
    <div class="header-ust-ic">
        <a href="<?php bloginfo('url'); ?>" class="header-ust-logo">
        <span class="a1">Eğitim</span>Alem.com
        </a>
        <span class="header-beta">beta</span>
            <?php if (is_user_logged_in()){ ?>
                <a href="<?php bloginfo('url'); ?>/uye/<?php echo $giris_yapan_kullanici->user_login ?>" class="header-profil">
                <?php    echo get_avatar( $giris_yapan_kullanici->user_email, $size = '40', $default = 'http://www.egitimalem.com/wp-content/themes/egitimalem.com/img/avatar.jpg' );    ?>
                <?php echo $giris_yapan_kullanici->user_firstname.' '.$giris_yapan_kullanici->user_lastname;  ?>
                </a>
            <?php } else { ?>
                    
            <?php }?>
    </div>
    </div>
    <div class="header-menu">
    <div class="header-menu-ic">
        <?php wp_nav_menu( array( 'theme_location' => 'ust_menu' ) ); ?>
        
            <?php if (is_user_logged_in()){ ?>
            
            <?php } else { ?>
                    <div class="header-profil">
                    <a href="http://www.egitimalem.com/wp-login.php?action=register" class="p1">Kayıt</a> 
                     
                    <a href="<?php echo wp_login_url( home_url() ); ?>" class="p2">Giriş</a>
                    </div>
            <?php }?>
    </div>
    </div>
</div>
