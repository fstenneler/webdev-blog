<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>WebDev.fr, blog de Fabien Stenneler, développeur web</title>
    <meta name="description" content="Intégrateur web et développeur PHP, je vous propose mon savoir-faire et mon expérience pour tout projet de site ou application web."/>
    <meta name="robots" content="noindex,follow"/>
    <meta name="author" content="Fabien Stenneler">
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="WebDev.fr, blog de Fabien Stenneler, développeur web" />
    <meta property="og:description" content="Intégrateur web et développeur PHP, je vous propose mon savoir-faire et mon expérience pour tout projet de site ou application web." />
    <meta property="og:url" content="http://webdev-blog.orlinstreet.rocks/" />
    <meta property="og:site_name" content="WebDev.fr" />
    <meta name="twitter:card" content="" />
    <meta name="twitter:description" content="Intégrateur web et développeur PHP, je vous propose mon savoir-faire et mon expérience pour tout projet de site ou application web." />
    <meta name="twitter:title" content="WebDev.fr, blog de Fabien Stenneler, développeur web" />
    <meta name="twitter:image" content="" />

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="public/front/css/base.css">
    <link rel="stylesheet" href="public/front/css/vendor.css">
    <link rel="stylesheet" href="public/front/css/main.css">
    <link rel="stylesheet" href="public/front/css/custom.css">

    <!-- script
    ================================================== -->
    <script src="public/front/js/modernizr.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="public/front/favicon.ico" type="image/x-icon">
    <link rel="icon" href="public/front/favicon.ico" type="image/x-icon">

</head>

<body id="top">

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>


    <!-- header
    ================================================== -->
    <?= $this->app()->getContent('header'); ?>

    <!-- s-content
    ================================================== -->
    <?= $this->app()->getContent($this->app()->getPageName()); ?>


    <!-- s-footer
    ================================================== -->
    <?= $this->app()->getContent('footer'); ?>



    <!-- Java Script
    ================================================== -->
    <script src="public/front/js/jquery-3.2.1.min.js"></script>
    <script src="public/front/js/plugins.js"></script>
    <script src="public/front/js/main.js"></script>
    <script src="public/front/js/custom.js"></script>

</body>

</html>
