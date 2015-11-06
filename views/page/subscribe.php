<div id="subscribe-notice">
    <img src="<?= $newsletter_subscribe_image; ?>"/>
    <?= $newsletter_subscribe; ?>

    <div id="subscribe-form" class="padded">
        <?php if (isset($response)): ?>
            <?php if ($response == 'SUBSCRIBED'): ?>
                Successfully subscribed!
            <?php elseif ($response == 'DUPLICATE'): ?>
                You've already subscribed!
            <?php else: ?>
                Something went wrong, please <a href="mailto:webmaster@solvethelabyrinth.com?Subject=Newsletter%20Subscription%20Failure">contact the webmaster</a>.
            <?php endif; ?>
        <?php else: ?>
            <form id="subscribe" method="POST" class="padded">
                Email:
                <input type="text" name="email">
                Name (optional):
                <input type="text" name="name">
                <input type="submit" value="Submit" onclick="ga('send', 'event', 'Newsletter', 'Subscription', 'User subscribed to the Labyrinth newsletter');">
            </form>
        <?php endif; ?>
    </div>


    <?= $press_notice; ?>
</div>
