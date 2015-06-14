<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">

        <?php foreach ($scripts as $script) : ?>
            <script type="text/javascript" src="<?= $script; ?>"></script>
        <?php endforeach; ?>

        <title><?= $title ?></title>

    </head>