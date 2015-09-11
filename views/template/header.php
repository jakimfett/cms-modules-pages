<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">

        <link rel="stylesheet" id="labyrinth-theme" href="/media/labyrinth/css/style.css" type="text/css" media="all">
        <link rel="stylesheet" href="/media/labyrinth/css/font-awesome.min.css">

        <?php foreach ($scripts as $script) : ?>
            <script type="text/javascript" src="<?= $script; ?>"></script>
        <?php endforeach; ?>

        <?php if (isset($meta_data)) : ?>
            <?php foreach ($meta_data as $meta_name => $meta_content) : ?>
                <meta name="<?= $meta_name; ?>" content="<?= $meta_content; ?>" />
            <?php endforeach; ?>
        <?php endif; ?>
        <script>
            $(document).ready(function () {
                $(".media-embed").fitVids();
            });
        </script>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-62694747-1', 'auto');
            ga('send', 'pageview');

        </script>

        <title><?= $title ?></title>

    </head>