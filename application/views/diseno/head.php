<head>
	<meta charset="utf-8">
	<title><?php print isset($titulo) ? $titulo . ' | ': null; ?> <?php $nombre_sistema = app_nombre_sistema(); print $nombre_sistema; ?></title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="google-site-verification" content="1snByTYon0YxaAsI3JujmNmRWqQUxaijr3434sm-ygM" />

	<meta content="<?php print str_replace('"',"'",app_strip_etiquetas(isset($description)?$description:$nombre_sistema)); ?>" name="description">
	<meta content="<?php print isset($keywords)?$keywords:$nombre_sistema; ?>" name="keywords">

	<meta property="og:site_name" content="<?php $nombre_sistema = app_nombre_sistema(); print $nombre_sistema; ?>">
	<meta property="og:title" content="<?php print isset($titulo) ? $titulo . ' | ': null; ?> <?php $nombre_sistema = app_nombre_sistema(); print $nombre_sistema; ?>">
	<meta property="og:description" content="<?php print str_replace('"',"'",app_strip_etiquetas(isset($description)?$description:$nombre_sistema)); ?>">
	<meta property="og:type" content="website">
	<base href="<?php print base_url(); ?>"/>

	<link rel="shortcut icon" href="favicon.png">
	<!-- Fonts START -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Pathway+Gothic+One|PT+Sans+Narrow:400+700|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
	<!-- Fonts END -->
	<!-- Global styles BEGIN -->
	<link href="web/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="web/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="web/assets/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">
	<!-- Global styles END -->
	<!-- Page level plugin styles BEGIN -->
	<link href="web/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
	<!-- Page level plugin styles END -->
	<!-- Theme styles BEGIN -->
	<link href="web/assets/global/css/components.css" rel="stylesheet">
	<link href="web/assets/frontend/onepage/css/style.css" rel="stylesheet">
	<link href="web/assets/frontend/onepage/css/style-responsive.css" rel="stylesheet">
	<link href="web/assets/frontend/onepage/css/themes/red.css" rel="stylesheet" id="style-color">
	<link href="web/assets/frontend/onepage/css/custom.css" rel="stylesheet">
	<!-- Theme styles END -->
</head>