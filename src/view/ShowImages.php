<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    </head>
    <body style="background-color: #99afe9; text-align: center">
        <div class="container" style="">
            <h3>Enter a keyword to search for recent images</h3>
            <div class="row">
                <form method="GET">
                    <input class="xs-10" type="text" value="<?= $keyword ?>" name="keyword" maxlength="50"/>
                    <input class="xs-2" type="submit" value="Get Images!">
                </form>
                <br/>
            </div>

            <div class="row">
                <div class="col-xs-1"></div>
                <?php foreach ($photos as $photo): ?>
                    <div class="col-xs-2">
                        <a href="<?= $photo['big_url'] ?>" target="_blank">
                            <img class="img-responsive" src="<?= $photo['thumbnail'] ?>"/>
                        </a>
                    </div>
                <?php endforeach; ?>
                <div class="col-xs-1"></div>
            </div>
            <br>
            <div class="row">
                <div class="xs-12">
                    [&nbsp;<?php foreach ($pagination as $page): ?>
                        <?php if ($page['inactive'] === true) : ?>
                            <a href="?keyword=<?= $keyword ?>&page=<?= $page['number'] ?>">
                                <?= $page['number'] ?></a>&nbsp;
                        <?php else : ?>
                            -<?= $page['number'] ?>-&nbsp;
                        <?php endif; ?>
                    <?php endforeach; ?>]
                </div>
            </div>
        </div>
    </body>

</html>
