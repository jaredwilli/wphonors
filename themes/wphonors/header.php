<!DOCTYPE html>
<html lang="en">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php wp_title('',true,''); ?></title>
<meta name="author" content="Jared Williams" />

<meta name="google-site-verification" content="6Keh3NEPxKJ_R1PmArdlrythdkzj9uM8BDOYo1QkfYw" />
<link rel="image_src" href="http://wphonors.presscdn.com/wp-content/uploads/wphonors1.gif.png"/>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/css/jqueryui.css" />
<!--<link href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" rel="stylesheet" media="print" />-->
<!--[if IE]><link href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" rel="stylesheet" media="all" /><![endif]-->

<?php if (is_page(150)) { ?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/jqtransform.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/validationEngine.jquery.css" />
<?php } ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="WPHonors Feed" href="http://feeds.feedburner.com/WPHonors" />

<?php wp_head(); ?>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17980655-2']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</head>
<body class="<?php base_body_class(); ?>">