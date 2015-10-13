<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta charset="UTF-8">

        <link rel='shortcut icon' href='/media/labyrinth/images/favicon.ico' type='image/x-icon'/>
        <link rel="icon" href="/media/labyrinth/images/favicon.png" type="image/png" />

        <?php foreach ($scripts as $script) : ?><script async type="text/javascript" src="<?= $script; ?>"></script>
        <?php endforeach; ?>

        <?php foreach ($meta_data as $meta_name => $meta_content) : ?><meta name="<?= $meta_name; ?>" content="<?= $meta_content; ?>" />
        <?php endforeach; ?>

        <?php foreach ($opengraph_data as $og_property => $og_content) : ?><meta property="<?= $og_property; ?>" content="<?= $og_content; ?>" />
        <?php endforeach; ?>

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
