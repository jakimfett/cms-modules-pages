<div id="unsubscribe-div">
    <img id="unsubscribe-image" src="/<?= $unsubscribe_image; ?>"/>
    <p>
        <?= $unsubscribe_notice; ?>
    </p>
    <?php if (isset($response)): ?>
        <p>
            <?php if ($response == 'UNSUBSCRIBED'): ?>
                Successfully unsubscribed!
            <?php elseif ($response == 'UNREGISTERED'): ?>
                This email address was not subscribed.
            <?php elseif ($response == 'REUNSUBSCRIBED'): ?>
                This email address has already been unsubscribed.
            <?php else: ?>
                Something went wrong, please <a href="mailto:webmaster@solvethelabyrinth.com?Subject=Newsletter%20Unsubscribe%20Failure">contact the webmaster</a>.
            <?php endif; ?>
        </p>
    <?php else: ?>
        <div >
            <form id="unsubscribe-form" method="POST">
                <em>Would you like to let us know why you're no longer interested?</em>
                <textarea name="note" cols="50" rows="5"></textarea>
                <br/>
                Email:
                <input type="text" name="email" value="<?= $email_address; ?>" size="<?= strlen($email_address); ?>" readonly="true">
                <br/><br/>
                <input type="submit" value="Submit" onclick="ga('send', 'event', 'Newsletter', 'Unsubscribe', 'User unsubscribed from the Labyrinth newsletter');">
            </form>
        </div>
        <p id="unsubscribe-contact">
            <em >
                If for any reason you are having difficulty unsubscribing,
                please <a href="mailto:webmaster@solvethelabyrinth.com?Subject=Newsletter%20Unsubscribe%20Failure">contact the webmaster</a>
            </em>
        </p>
    <?php endif; ?>
</div>