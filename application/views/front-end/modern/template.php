<!DOCTYPE html>
<html lang="en">

<?php

$settings = get_settings('web_settings', true);
$system_settings = get_settings('system_settings', true);
$primary_colour = (isset($settings['primary_color']) && !empty($settings['primary_color'])) ?  $settings['primary_color'] : '#f78b77';
$secondary_colour = (isset($settings['secondary_color']) && !empty($settings['secondary_color'])) ?  $settings['secondary_color'] : '#f78b77';
$font_color = (isset($settings['font_color']) && !empty($settings['font_color'])) ?  $settings['font_color'] : '#FFF';

?>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= 'Online Shopping Site for Fashion Jewellery, Necklace Set, Earrings More | Zefrokart' ?></title>
    <meta name="keywords" content='<?= "zefrokart,artificial jewellery,necklace set,bridal set" ?>'>
    <meta name="description" content='<?="Zefrokart Online Shopping site in India - Buy &amp; Sell best quality Fashion Jewellery, Necklace Set,Artificial Jewellery products at lowest prices. ✔ Free Delivery ✔ Easy Returns ✔ Earn Money Online "?>'>

    <!-- for image in link -->
 <!--   <meta name="product_image" property="og:image" content='<?= isset($product_image) ? $product_image : '' ?>'>
    <meta property="og:image:type" content="image/jpg,png,jpeg,gif,bmp,eps">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">-->
    
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P6PMKJFH');</script>
<!-- End Google Tag Manager -->
    
     <!-- Facebook Pixel Code -->
    <script>
        !function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1249128282343288'); // Replace with your actual pixel ID
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1249128282343288&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->


    <?php
    if(defined('ALLOW_MODIFICATION') && ALLOW_MODIFICATION == 0){
    $daynamic_lang = '';
    }else{
    $daynamic_lang = $this->config->item('language');
        
    }
    // print_r(defined('ALLOW_MODIFICATION') && ALLOW_MODIFICATION == 0);
    // print_r($daynamic_lang);
    $cookie_lang = $this->input->cookie('language', TRUE);
    $path = $is_rtl = "";
    if (!empty($daynamic_lang)) {
        $language = get_languages(0, $daynamic_lang, 0, 1);
        // print_r($language);
        if (!empty($language)) {
            $path = ($language[0]['is_rtl'] == 1) ? 'rtl/' : "";
            $is_rtl =  ($language[0]['is_rtl'] == 1) ? true : false;
        }
    } else if (!empty($cookie_lang)) {
        $language = get_languages(0, $cookie_lang, 0, 1);
        if (!empty($language)) {
            $path = ($language[0]['is_rtl'] == 1) ? 'rtl/' : "";
            $is_rtl =  ($language[0]['is_rtl'] == 1) ? true : false;
        }
    } else {
        /* read the default language */
        $lang = $this->config->item('language');
        $language = get_languages(0, $lang, 0, 1);
        if (!empty($language)) {
            $path = ($language[0]['is_rtl'] == 1) ? 'rtl/' : "";
            $is_rtl =  ($language[0]['is_rtl'] == 1) ? true : false;
        }
    }
    $data['is_rtl'] = $is_rtl;
    // print_r($is_rtl);
    
    ?>
    <?php $this->load->view('front-end/' . THEME . '/include-css', $data); ?>
    <style>
        * {
            --primary-color: <?= $primary_colour ?>;
            --secondary-color: <?= $secondary_colour ?>;
            --font-color: <?= $font_color ?>;
        }
    </style>
</head>

<body id="body" data-is-rtl='<?= $is_rtl ?>'>

    <?php $this->load->view('front-end/' . THEME . '/header', $system_settings); ?>
    <?php $this->load->view('front-end/' . THEME . '/pages/' . $main_page); ?>
    <?php $this->load->view('front-end/' . THEME . '/footer', $system_settings); ?>
    <?php $this->load->view('front-end/' . THEME . '/include-script'); ?>

</body>


</html>