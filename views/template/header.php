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
        <script>
            $(document).ready(function () {
                $(".media-embed").fitVids();
            });
        </script>

        <title><?= $title ?></title>

    </head>