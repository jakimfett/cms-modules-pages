<nav <?=
(!$fixed) ?
        'style="top: 0px; opacity: 1; visibility: visible;' :
        'data-anchor-target="' . $fixed . '" data-200-top="opacity:0;" data-150-top="visibility:visible; top: -55px; opacity: 0.3;" data-100-top="top: 0px; opacity: 1;"';
?>>
    <div class="container">
        <a href="/"><div class="logo"></div></a>
        <a href="#" id="xpand"><div class="xpand"><i class="fa fa-bars"></i></div></a>
        <div class="clamp"></div>
        <div class="actions left">
            <ul>
                <li><a href="/" class="<?= (($group == "index") ? "active" : "") ?>">Home</a></li>
                <?php if (!isset($tickets_page)): ?>
                    <li><a href="http://www.bookeo.com/labyrinth">Book Now</a></li>
                <?php endif; ?>
                <li><a href="/games" class="<?= (($group == "games") ? "active" : "") ?>">Games</a></li>
                <li><a href="/faq" class="<?= (($group == "faq") ? "active" : "inactive") ?>">FAQ</a></li>
                <li><a href="/contact" class="<?= (($group == "contact") ? "active" : "inactive") ?>">Contact</a></li>
            </ul>
        </div>
        <div class="actions right">
            <ul>
                <li class="smi"><a href="https://www.facebook.com/solvethelabyrinth" target="_blank">
                        <i class="fa square-facebook-link-icon"></i></a>
                </li>
                <li class="smi"><a href="https://twitter.com/labyrinthpdx" target="_blank">
                        <i class="fa square-twitter-link-icon"></i></a>
                </li>
            </ul>
        </div>
        <div class="clamp"></div>
    </div>
</nav>