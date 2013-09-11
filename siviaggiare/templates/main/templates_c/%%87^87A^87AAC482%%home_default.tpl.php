<?php /* Smarty version 2.6.26, created on 2013-09-02 16:03:29
         compiled from home_default.tpl */ ?>
<!DOCTYPE HTML>
<html>

<head>
    <title><?php echo $this->_tpl_vars['titolo']; ?>
</title>
    <meta name="description" content="website description" />
    <meta name="keywords" content="website keywords, website keywords" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="templates/main/template/css/style.css" />
    <!-- modernizr enables HTML5 elements and feature detects -->
    <!--<script type="text/javascript" src="js/modernizr-1.5.min.js"></script>-->
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
                    <li><a href>Home</a></li>
                    <li><a href="examples.html">Examples</a></li>
                    <li><a href="page.html">A Page</a></li>
                    <li><a href="another_page.html">Another Page</a></li>
                    <li><a href="#">Example Drop Down</a>
                        <ul>
                            <li><a href="#">Drop Down One</a></li>
                            <li><a href="#">Drop Down Two</a>
                                <ul>
                                    <li><a href="#">Sub Drop Down One</a></li>
                                    <li><a href="#">Sub Drop Down Two</a></li>
                                    <li><a href="#">Sub Drop Down Three</a></li>
                                    <li><a href="#">Sub Drop Down Four</a></li>
                                    <li><a href="#">Sub Drop Down Five</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down Three</a></li>
                            <li><a href="#">Drop Down Four</a></li>
                            <li><a href="#">Drop Down Five</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div id="site_content">
        <div id="sidebar_container">
            <?php echo $this->_tpl_vars['contenuti_menu_sinistro1']; ?>

            <div class="sidebar">
                <h3>Latest News</h3>
                <h4>New Website Launched</h4>
                <h5>January 1st, 2013</h5>
                <p>2013 sees the redesign of our website. <a href="#">Read more</a></p>
            </div>
            <div class="sidebar">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="#">First Link</a></li>
                    <li><a href="#">Another Link</a></li>
                    <li><a href="#">And Another</a></li>
                    <li><a href="#">Last One</a></li>
                </ul>
            </div>
        </div>
        <div id="sidebar_container2">
            <?php echo $this->_tpl_vars['contenuti_menu_destro1']; ?>

            <div class="sidebar">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="#">First Link</a></li>
                    <li><a href="#">Another Link</a></li>
                    <li><a href="#">And Another</a></li>
                    <li><a href="#">Last One</a></li>
                </ul>
            </div>
        </div>
        <?php echo $this->_tpl_vars['contenuto_principale']; ?>

    </div>
    <div id="scroll">
        <a title="Scroll to the top" class="top" href="#"><img src="images/top.png" alt="top" /></a>
    </div>
    <footer>
        <p><img src="images/twitter.png" alt="twitter" />&nbsp;<img src="images/facebook.png" alt="facebook" />&nbsp;<img src="images/rss.png" alt="rss" /></p>
        <p><a href="index.html">Home</a> | <a href="examples.html">Examples</a> | <a href="page.html">A Page</a> | <a href="another_page.html">Another Page</a> | <a href="contact.php">Contact Us</a></p>
        <p>Copyright &copy; CSS3_grass | <a href="http://www.css3templates.co.uk">design from css3templates.co.uk</a></p>
    </footer>
</div>
</body>
</html>