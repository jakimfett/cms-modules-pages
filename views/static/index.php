
<body>
    <div id="page">

        <div id="header-container">
            <div id="header">
                <img id='logo' src="media/labyrinth/images/logo.png"/>
            </div>
        </div>
        <div id='header-spacer'></div>

        <div id='navigation-container'>
            <div id="navigation">
                <ul class="left">
                    <li><a href="index">Home</a></li>
                    <li><a href="index/faq">FAQ</a></li>
                </ul>

                <span class="center">
                    <a href="index/tickets">Buy Now</a>
                </span>

                <ul class="right">
                    <li><a href="index/contact">contact</a></li>
                    <li>(T)(F)</li>
                </ul>
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
                <div id="pitch">
                    <?php if (isset($pitch)) : ?>
                        <?= trim($pitch); ?>
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
        <div id="footer">
            
        </div>
    </div>
</body>
