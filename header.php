<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo T_('Update your Browser'); ?> - Browser-Update.org</title>
    <meta name="description" content="" />
    <meta name="keywords" content="browser, webbrowser, choice, change browser, firefox, safari, opera, firefox 3, internet explorer 6, internet explorer update, ie, safari, konqueror" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="<?php echo request_lang(); ?>" />
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png"/>
    <link rel="icon" href="/img/favicon.png" type="image/png"/>

    <meta name="robots" content="index,follow" />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300&subset=latin,latin-ext,cyrillic,greek' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="/base2.css" type="text/css" />
    <?php
    if ($detected_lang=="en_SE") {
        ?>
        <script type="text/javascript">
            var _jipt = [];
            _jipt.push(['project', 'browser-update']);
        </script>
        <script type="text/javascript" src="//cdn.crowdin.com/jipt/jipt.js"></script>
        <?php
    }
    ?>
    <!--[if lte IE 7]>
    <link rel="stylesheet" href="/drecksie.css" type="text/css" />
    <![endif]-->
    <!--[if lte IE 6]>
    <link rel="stylesheet" href="/drecksie6.css" type="text/css" />
    <![endif]-->
    <script type="text/javascript" src="/base.js">	</script>
</head>
<body><div class="header">
    <div class="innerhead">
        <h1><a href="./">Browser-Update.org</a></h1>
        <div class="tagline"><?php echo T_('An initiative by websites to inform users to update their web browser'); ?></div>
        <div class="men">
        <div><a href="./"><?php echo T_('About the Project'); ?></a></div>
        <?php if (!isset($slimmed)) {?>
            
            <div><a href="update.html#3"><?php echo T_('Update your Browser'); ?></a></div>
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
                <a href="/ko/<?php echo $curfile?>">한국어</a>
                <a href="/id/<?php echo $curfile?>">Bahasa Indonesia</a>                
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
                <a href="/zh/<?php echo $curfile?>">簡體中文</a>
                <a href="/zh_TW/<?php echo $curfile?>">正體中文</a>
                <a href="/fi/<?php echo $curfile?>">suomi</a>
                <a href="/tr/<?php echo $curfile?>">Türkçe</a>
                <a href="/ro/<?php echo $curfile?>">Română</a>
                <a href="/hr/<?php echo $curfile?>">hrvatski</a>
                <a href="/bg/<?php echo $curfile?>">български</a>
                <a href="/el/<?php echo $curfile?>">Ελληνικά</a> 
                <a href="/ar/<?php echo $curfile?>">العربية</a>
                <a href="/sr/<?php echo $curfile?>">Srpski</a>
                <a href="/lv/<?php echo $curfile?>">Latviešu</a>   
                <a href="/ga/<?php echo $curfile?>">Gaeilge</a>
                <a href="/no/<?php echo $curfile?>">Norsk</a>
                <a href="/th/<?php echo $curfile?>">ภาษาไทย</a>                
                <a href="contact.html"><b>translate...</b></a>
                </div>
            </div>

            <div><a href="contact.html"><?php echo T_('Contact'); ?></a></div>
        </div>
    </div>
</div>

<div id="co">
<?php
if (!isset($extratranslation))  {
    T_textdomain('site');
}
?>
