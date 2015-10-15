<body>
    <link rel="stylesheet" id="labyrinth-theme" href="/media/labyrinth/css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="/media/labyrinth/css/font-awesome.min.css">
    <div id="page">
        <div id="content-container">

            <div id="header-container">
                <div id="header">
                    <img id='logo' src="/media/labyrinth/images/logo.png"/>
                </div>
            </div>
            <div id='header-spacer'></div>

            <div id="navigation">
                <div class="left">
                    <a href="/" class="nav-button">Home</a>
                    <a href="/faq" class="nav-button">FAQ</a>
                </div>
                <div class="right s-media-buttons">
                    <a href="https://www.facebook.com/solvethelabyrinth" target="_blank">
                        <i class="fa square-facebook-link-icon"></i>
                    </a>
                    <a href="https://twitter.com/labyrinthpdx" target="_blank">
                        <i class="fa square-twitter-link-icon"></i>
                    </a>
                    <br/>
                </div>
                <div class="right">
                    <a href="/contact" class="nav-button">Contact</a>
                </div>

                <?php if (!isset($tickets_page)): ?>
                    <div id="nav-tickets" class="center">
                        <a href="http://www.bookeo.com/labyrinth" class="nav-button">Purchase Tickets Now</a>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (!isset($tickets_page)): ?>
                <div id="purchase-float" class="floating-nav hidden">
                    <div>
                        <div class="center">
                            <a href="http://www.bookeo.com/labyrinth" class="nav-button">Purchase Tickets Now</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div id="content-wrapper">
                <div id="content" class="center">
                    <?= $content; ?>
                </div>
            </div>
            <div id="push"></div>
        </div>
    </div>
    <div id="footer">
        <div id="footer-container">
            <div id="footer-blurb">
                <?= $footerblurb; ?>
            </div>
            <div id="footer-nav">
                <?= $footnav; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</body>
