<!DOCTYPE html>
        <!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
        <!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
        <head>
        <meta charset="utf-8">

        <title>@yield('title') | Text Alert Enrollment - SCE</title>
        <meta name="description" content="Meta Description">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- styles -->
        <!--[if gte IE 7]><!-->
        <link rel="stylesheet" href="/css/styles.css">
        <!--<![endif]-->

        <!--[if lt IE 7]>
        <link rel="stylesheet" media="all" href="http://universal-ie6-css.googlecode.com/files/ie6.0.3.css">
        <![endif]-->

        <!-- IE HTML 5 fixes (also see base.scss) -->

         <!--[if lt IE 9]>
           <script>
              document.createElement('header');
              document.createElement('nav');
              document.createElement('section');
              document.createElement('article');
              document.createElement('aside');
              document.createElement('footer');
           </script>
        <![endif]-->
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
    </head>
	<body>
        <ul class="skip-links">
            <li><a href="#main-content">Skip to the main content</a></li>
        </ul>
		<div class="wrapper">
            <a class="logo" href="http://sce.com">
                <svg width="149" height="53">
                    <image style="-webkit-user-select: none" xlink:href="/img/logo.svg" src="/img/logo.png" width="149" height="53" alt="SCE Logo" />
                </svg>
            </a>
        </div>
        @yield('home-header')
        <main id="main-content" class="wrapper" role="main">
			@yield('content')
		</main>
        <footer>
            <div class="wrapper smaller"><a class="basic-link" href="https://www.sce.com/wps/portal/home/privacy/" target="_blank">Privacy Policy</a> | &copy; <?php echo date("Y"); ?> Southern California Edison. All rights reserved.</div>
        </footer>
        <script src="/js/index.js"></script>
	</body>
</html>
