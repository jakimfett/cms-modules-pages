
<body>
    <div id="page">
        <div id="content-container">

            <div id="header-container">
                <div id="header">
                    <img id='logo' src="media/labyrinth/images/logo.png"/>
                </div>
            </div>
            <div id='header-spacer'></div>

            <div id="navigation">

                <div>
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
                    <div class="center">
                        <a href="/tickets" class="nav-button">Reserve Your Tickets Now</a>
                    </div>
                </div>
            </div>

            <div id="purchase-float" class="floating-nav hidden">
                <div>
                    <div class="center">
                        <a href="index/tickets" class="nav-button">Reserve Your Tickets Now</a>
                    </div>
                </div>
            </div>
            <div id="content-wrapper">
                <div id="content" class="center">
                    <div id="tagline">
                        <h1>
                            <?php if (isset($mediatitle)) : ?>
                                <?= trim($mediatitle); ?>
                            <?php endif; ?>
                        </h1>
                    </div>
                    <div id="video-pitch">
                        <?php if (isset($video)) : ?>
                            <?= trim($video); ?>
                        <?php endif; ?>
                    </div>

                    <div id="tagline">
                        <h1>
                            <?php if (isset($fivewords)) : ?>
                                <?= trim($fivewords); ?>
                            <?php endif; ?>
                        </h1>
                    </div>
                    
                    <div id="rooms">

                        <div>
                            <img src="media/labyrinth/images/room.jpg"/>
                            <?= trim($lroom); ?>
                        </div>
                        <div>
                            <img src="media/labyrinth/images/room.jpg"/>
                            <?= trim($rroom); ?>
                        </div>
                    </div>
                    <div id="blurbs">
                        <div id="blurb-left">
                            <div class="circle">
                                <i class="fa fa-cogs"></i>
                            </div>
                            <?= trim($blurbleft); ?>
                        </div>
                        <div id="blurb-center">
                            <div class="circle">
                                <i class="fa fa-leanpub"></i>
                            </div>
                            <?= trim($blurbcenter); ?>
                        </div>
                        <div id="blurb-right">
                            <div class="circle">
                                <i class="fa fa-key"></i>
                            </div>
                            <?= trim($blurbright); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="push"></div>
        </div>
    </div>
    <div id="footer">
        <div>Footer stuff</div>
    </div>
</body>
