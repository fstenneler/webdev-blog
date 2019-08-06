<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Blog FS</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="public/frontend/css/base.css">
    <link rel="stylesheet" href="public/frontend/css/vendor.css">
    <link rel="stylesheet" href="public/frontend/css/main.css">
    <link rel="stylesheet" href="public/frontend/css/custom.css">

    <!-- script
    ================================================== -->
    <script src="public/frontend/js/modernizr.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="public/favicon.ico" type="image/x-icon">
    <link rel="icon" href="public/favicon.ico" type="image/x-icon">

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
    <?= $this->app()->getContent('mainContent'); ?>


    <!-- s-footer
    ================================================== -->
    <?= $this->app()->getContent('footer'); ?>



    <!-- Java Script
    ================================================== -->
    <script src="public/frontend/js/jquery-3.2.1.min.js"></script>
    <script src="public/frontend/js/plugins.js"></script>
    <script src="public/frontend/js/main.js"></script>
    <script src="public/frontend/js/custom.js"></script>

</body>

</html>