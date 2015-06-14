
<body>
    <div id="page">
        <div id="header">
            <img id='logo' src="media/labyrinth/images/logo.png"/>
        </div>
        <div id='navigation-container'>
            <div id="navigation">
                <ul>
                    <li><a href="index">Home</a></li>
                    <li><a href="index/about">About</a></li>
                    <li><a href="index/contact">Contact</a></li>
                    <li><a href="index/faq">FAQ</a></li>
                    <li><a href="index/tickets">Tickets</a></li>
                </ul>
            </div>
        </div>
        <div id="content">
            <?php if (isset($promotext)) : ?>
                <?php for ($i = 0; $i < 120; $i++) : ?>
                    <?= trim($promotext); ?>
                <?php endfor; ?>

            <?php endif; ?>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
