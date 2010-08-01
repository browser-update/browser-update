<!DOCTYPE html >
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo T_('Browser-Update.org'); ?> - <?php echo T_('Inform your visitors about browser-updates'); ?></title>
	<meta name="description" content="" />
	<meta name="keywords" content="browser, webbrowser, choice, change browser, firefox, safari, opera, firefox 3, internet explorer 6, internet explorer update, ie, safari, konqueror" />
	<meta http-equiv="content-language" content="<?php echo request_lang(); ?>" />
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png"/>
    <link rel="icon" href="/img/favicon.png" type="image/png"/>

	<meta name="robots" content="index,follow" />
	<link rel="stylesheet" href="/base.css" type="text/css" />
	<!--[if lte IE 7]>
	<link rel="stylesheet" href="/drecksie.css" type="text/css" />
	<![endif]-->
	<!--[if lt IE 7]>
	<link rel="stylesheet" href="/drecksie6.css" type="text/css" />
	<![endif]-->
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png"/>
    <link rel="icon" href="/img/favicon.png" type="image/png"/>
	<script type="text/javascript" src="/base.js">	</script>
</head>
<body>

<?php
//preg_match ("#[^?]#", string subject [, array matches [, int flags]])
$parts = Explode('/', $_SERVER["REQUEST_URI"]);
$curfile = end($parts);
?>

<div id="lang">
    <a href="/en/<?echo $curfile?>">english</a>
    <a href="/de/<?echo $curfile?>">deutsch</a>
    <a href="/pl/<?echo $curfile?>">polski</a>
    <a href="/nl/<?echo $curfile?>">nederlands</a>
    <a href="/it/<?echo $curfile?>">italiano</a>
    <a href="/es/<?echo $curfile?>">español</a>
    <a href="/pt/<?echo $curfile?>">português</a>
    <a href="/ja/<?echo $curfile?>">japanese</a>
    <a href="/sl/<?echo $curfile?>">slovenščina</a>

    <a href="contact.html">translate...</a>
</div>
    
<div id="co">
<div class="header">
    <h1><a href="index.html"><?php echo T_('Browser-Update.org'); ?></a></h1>
    <div class="tagline"><?php echo T_('An initiative by webdesigners to inform users about browser-updates'); ?></div>
</div>
<ul id="tabs">
	<li><a href="index.html"><?php echo T_('Start'); ?></a></li>
	<li class="r"><a href="contact.html"><?php echo T_('Contact'); ?></a></li>
	<!--<li class="r"><a href="/help.html"><?php echo T_('Help'); ?></a></li>-->
	<!--<li class="r"><a href="/supporters.html"><?php echo T_('Supporters'); ?></a></li>-->
	<li class="r"><a href="stat.html"><?php echo T_('Statistics'); ?></a></li>
	<li class="r"><a href="/blog/"><?php echo T_('Blog'); ?></a></li>
</ul>



<div id="bookmark">
    <!-- AddThis Button BEGIN -->
    <script type="text/javascript">addthis_pub  = 'Jossele';</script>
    <a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s9.addthis.com/button1-bm.gif" alt="" /></a><script type="text/javascript" src="http://s7.addthis.com/js/152/addthis_widget.js"></script>
    <!-- AddThis Button END -->
</div>
<div id="body">