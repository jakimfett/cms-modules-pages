<div id="beta-test-notice">
    <img src="<?= $beta_test_image; ?>"/>
    <?= $beta_test_notice; ?>

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


    <?= $beta_press_notice; ?>
</div>
