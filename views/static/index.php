
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
                        <a href="index">Home</a>
                        <a href="index/faq">FAQ</a>
                    </div>
                    <div class="right">
                        <a href="index/contact">Contact</a>
                        <a >(T)(F)</a>
                    </div>
                    <div class="center">
                        <a href="index/tickets">Reserve Your Tickets Now</a>
                    </div>
                </div>
            </div>

            <div id="purchase-float" class="floating-nav hidden">
                <div>
                    <div class="center">
                        <a href="index/tickets">Reserve Your Tickets Now</a>
                    </div>
                </div>
            </div>
            <div id="content-wrapper">
                <div id="content" class="center">
                    <div id="tagline">
                        <h1>
                            <?php if (isset($fivewords)) : ?>
                                <?= trim($fivewords); ?>
                            <?php endif; ?>
                        </h1>
                    </div>
                    <div id="video-pitch">
                        <?php if (isset($video)) : ?>
                            <?= trim($video); ?>
                        <?php endif; ?>
                    </div>

                    <div id="rooms">
                        <div>
                            <img src="media/labyrinth/images/room.jpg"/>
                            <p class="text">
                                <?= trim($lroom); ?>
                            </p>
                        </div>
                        <div>
                            <img src="media/labyrinth/images/room.jpg"/>
                            <p class="text">
                                <?= trim($rroom); ?>
                            </p>
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
