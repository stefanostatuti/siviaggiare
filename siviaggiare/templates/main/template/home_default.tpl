<!DOCTYPE HTML>
<html>
<head>
    <title>{$titolo}</title>
    <meta name="description" content="website description" />
    <meta name="keywords" content="website keywords, website keywords" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link rel="icon" href="templates/main/template/images/logo.png" />
    <link rel="stylesheet" type="text/css" href="templates/main/template/css/style.css" />
    <link rel="stylesheet" type="text/css" href="templates/main/template/css/ratingbar.css" />
    <link rel="stylesheet" href="templates/main/template/js/jquery-ui-1.10.3.custom/development-bundle/themes/base/jquery.ui.all.css" />
    <script type="text/javascript" src="templates/main/template/js/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="templates/main/template/js/jquery.validate.js"></script>
    <script type="text/javascript" src="templates/main/template/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
    <script type="text/javascript" src="templates/main/template/js/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="templates/main/template/js/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.autocomplete.js"></script>
    <script type="text/javascript" src="templates/main/template/js/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.accordion.js"></script>
    <script type="text/javascript" src="templates/main/template/js/ricerca.js"></script>
    <script type="text/javascript" src="templates/main/template/js/jquery.ratingbar.js"></script>
    <script type="text/javascript" src="templates/main/template/js/jquery.complexify.js"></script>
    <script type="text/javascript" src="templates/main/template/js/jquery.easing-sooper.js"></script>
    <script type="text/javascript" src="templates/main/template/js/jquery.sooperfish.js"></script>
    <script type="text/javascript" src="templates/main/template/js/home.js"></script>
    <noscript>
        <meta http-equiv="Refresh" content="0; url=/siviaggiare/siviaggiare/noscript.html" />
    </noscript>

</head>

<body>
<div id="main">
    <header>
        <div id="logo">
            <div id="logo_text">
                <!-- class="logo_colour", allows you to change the colour of the text -->
                <h1><a><span class="logo_colour">Y</span>es<span class="logo_colour">Y</span>ou<span class="logo_colour">T</span>ravel</a></h1>
                <h2>Viaggia.Condividi.</h2>
            </div>
        </div>
        <nav>
            <div id="menu_container">
                <ul class="sf-menu" id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php?controller=info">Info</a>
                    <li><a href="index.php?controller=contattaci">Contattaci</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div id="site_content">
        <div id="sidebar_container">
            {$contenuti_menu_sinistro1}
            {$contenuti_menu_sinistro2}
        </div>
        <div id="sidebar_container2">
            {$contenuti_menu_destro1}
        </div>
        {$contenuto_principale}
    </div>
    <div id="scroll">
        <a title="Scroll to the top" class="top" href="#"><img src="templates/main/template/images/top.png" alt="top" /></a>
    </div>
    <footer>
        <p><img src="templates/main/template/images/twitter.png" alt="twitter" />&nbsp;<img src="templates/main/template/images/facebook.png" alt="facebook" />&nbsp;<img src="templates/main/template/images/rss.png" alt="rss" /></p>
        <p><a href="index.php">Home</a>   <a href="index.php?controller=contattaci">Contattaci</a>   <a href="index.php?controller=info">Info</a></p>
        <p>Copyright &copy; CSS3_grass | <a href="http://www.css3templates.co.uk">design from css3templates.co.uk</a></p>
    </footer>
</div>
</body>
</html>