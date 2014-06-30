<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Browser-Update.org - <?php echo T_('Update your Browser'); ?></title>
    <meta name="description" content="" />
    <meta name="keywords" content="browser, webbrowser, choice, change browser, firefox, safari, opera, firefox 3, internet explorer 6, internet explorer update, ie, safari, konqueror" />
    <meta http-equiv="content-language" content="<?php echo request_lang(); ?>" />
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png"/>
    <link rel="icon" href="/img/favicon.png" type="image/png"/>

    <meta name="robots" content="index,follow" />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300&subset=latin,latin-ext,cyrillic,greek' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="/base.css" type="text/css" />
    <!--[if lte IE 7]>
    <link rel="stylesheet" href="/drecksie.css" type="text/css" />
    <![endif]-->
    <!--[if lte IE 6]>
    <link rel="stylesheet" href="/drecksie6.css" type="text/css" />
    <![endif]-->    
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png"/>
    <link rel="icon" href="/img/favicon.png" type="image/png"/>
    <script type="text/javascript" src="/base.js">	</script>
</head>
<body><div class="header">
    <div class="innerhead">
        <h1><a href="./">Browser-Update.org</a></h1>
        <div class="tagline"><?php echo T_('An initiative by web designers to inform users about browser-updates'); ?></div>
        <div class="men">
        <div><a href="./"><?php echo T_('The Project'); ?></a></div>
        <?php if (!isset($slimmed)) {?>
            
            <div><a href="update.html#3"><?php echo T_('Update Browser'); ?></a></div>
            <div><a href="stat.html"><?php echo T_('Statistics'); ?></a></div>
            <div><a href="blog.html"><?php echo T_('Blog'); ?></a></div>
        <?php }?>
            
        <?php
        $curfile="";
        preg_match('#/([^/]*)$#', $_SERVER["REQUEST_URI"], $matches);
        if (isset($matches[1]))
            $curfile=$matches[1];
        ?>    
            
            <div id="lang2">
                <a>Languages  ▼</a>
                <div>
                <a href="/en/<?php echo $curfile?>">english</a>
                <a href="/de/<?php echo $curfile?>">deutsch</a>
                <a href="/fr/<?php echo $curfile?>">français</a>
                <a href="/it/<?php echo $curfile?>">italiano</a>
                <a href="/pt/<?php echo $curfile?>">português</a>
                <a href="/es/<?php echo $curfile?>">español</a>
                <a href="/pl/<?php echo $curfile?>">polski</a>
                <a href="/nl/<?php echo $curfile?>">nederlands</a>
                <a href="/ja/<?php echo $curfile?>">japanese</a>
                <a href="/sl/<?php echo $curfile?>">slovenščina</a>
                <a href="/ru/<?php echo $curfile?>">Русский</a>
                <a href="/id/<?php echo $curfile?>">Bahasa Indonesia</a>
                <a href="/kr/<?php echo $curfile?>">한국어</a>
                <a href="/uk/<?php echo $curfile?>">Українська</a>
                <a href="/rm/<?php echo $curfile?>">rumantsch</a>
                <a href="/da/<?php echo $curfile?>">dansk</a>
                <a href="/sq/<?php echo $curfile?>">shqipe</a>
                <a href="/ca/<?php echo $curfile?>">català</a>
                <a href="/sv/<?php echo $curfile?>">svenska</a>
                <a href="/hu/<?php echo $curfile?>">magyar</a>
                <a href="/fa/<?php echo $curfile?>">فارسی</a>
                <a href="/gl/<?php echo $curfile?>">galego</a>
                <a href="/he/<?php echo $curfile?>">עברית</a>
                <a href="/cs/<?php echo $curfile?>">Čeština</a>
                <a href="/nb/<?php echo $curfile?>">Norsk bokmål</a>
                <a href="/zh/<?php echo $curfile?>">中文</a>
                <a href="/fi/<?php echo $curfile?>">suomi</a>
				<a href="/tr/<?php echo $curfile?>">Türkçe</a>
				<a href="/ro/<?php echo $curfile?>">Română</a>
                <a href="contact.html">translate...</a>
                </div>
            </div>

            <div><a href="contact.html"><?php echo T_('Contact'); ?></a></div>
        </div>
    </div>
</div>

<div id="co">
<!--
<div id="bookmark">
	<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
	<a class="addthis_button_preferred_1"></a>
	<a class="addthis_button_preferred_2"></a>
	<a class="addthis_button_preferred_3"></a>
	<a class="addthis_button_preferred_4"></a>
	<a class="addthis_button_compact"></a>
	</div>
	<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=Jossele"></script>
</div>
<div id="body">
-->
<?php
if (!isset($extratranslation))  {
    T_textdomain('site');
}
?>