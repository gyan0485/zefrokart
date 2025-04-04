<!-- Izimodal -->
<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/iziModal.min.css' ?>" />
<!-- Favicon -->
<?php $favicon = get_settings('web_favicon');

$path = ($is_rtl == 1) ? 'rtl/' : "";
?>
<link rel="icon" href="<?= base_url($favicon) ?>" type="image/gif" sizes="16x16">
<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/eshop-bundle.css' ?>" />

<!-- Bootstrap -->
<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/' . $path . 'bootstrap.min.css' ?>">


<!-- jssocials -->
<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/jquery.jssocials-theme-flat.css' ?>">
<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/jquery.jssocials.css' ?>">
<!-- Star rating CSS -->
<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/'. $path .'star-rating.min.css' ?>">
<!-- <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/'. $path .'theme.min.css' ?>">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/style.css' ?>">  

<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/owncss.css' ?>"> 

<!-- chat -->
<link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/components.css' ?>">

<link rel="stylesheet" href="<?= THEME_ASSETS_URL .  'css/'. $path .'products.css' ?>">

<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">-->


<link rel="stylesheet" href="<?= THEME_ASSETS_URL  .  'css/'. $path .'custom.css' ?>">


<?php if (ALLOW_MODIFICATION == 0) { ?>
    <link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/colors/orange.css' ?>" id="color-switcher">
<?php } else { ?>
    <?php
    $settings = get_settings('web_settings', true);
    $modern_theme_color = (isset($settings['modern_theme_color']) && !empty($settings['modern_theme_color'])) ? $settings['modern_theme_color'] : 'orange'; ?>
    <link rel="stylesheet" href="<?= THEME_ASSETS_URL . 'css/colors/' . $modern_theme_color . '.css' ?>">

<?php } ?>



<!-- Jquery -->
<script src="<?= THEME_ASSETS_URL . 'js/jquery.min.js' ?>"></script>
<!-- Date Range Picker -->
<script src="<?= THEME_ASSETS_URL . 'js/moment.min.js' ?>"></script>
<script src="<?= THEME_ASSETS_URL . 'js/daterangepicker.js' ?>"></script>
<script type="text/javascript">
    base_url = "<?= base_url() ?>";
    currency = "<?= isset($settings['currency'])? $settings['currency'] : '$' ?>";
    csrfName = "<?= $this->security->get_csrf_token_name() ?>";
    csrfHash = "<?= $this->security->get_csrf_hash() ?>";
    $(document).ready(function() {
    setTimeout(function() {
        // Replace '#yourElementID' with your actual element selector
        $('.front-top-swiper-slider').removeClass('hide');
    }, 2000); // 4000 milliseconds = 4 seconds
});

</script>
