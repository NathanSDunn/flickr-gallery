<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/gallery.css">
    </head>
    <body>
        <div class="gallery">
            <h1>Enter a keyword to search for recent images</h1>
            <form class="search" method="GET">
                <input class="search-keyword" type="text" value="<?= $keyword ?>" name="keyword" maxlength="50"/>
                <input class="search-button" type="submit" value="Get Images!">
            </form>
            <div class="photos">
                <?php foreach ($photos as $photo): ?>
                    <div class="photo">
                        <a href="<?= $photo['big_url'] ?>" target="_blank">
                            <img class="img-responsive" src="<?= $photo['thumbnail'] ?>"/>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <span class="pagination">
                <?php foreach ($pagination as $page): ?>
                    <?php if ($page['inactive'] === true) : ?>
                        <a href="?keyword=<?= $keyword ?>&page=<?= $page['number'] ?>"><?= $page['number'] ?></a>&nbsp;
                    <?php else : ?>
                        -<?= $page['number'] ?>-&nbsp;
                    <?php endif; ?>
                <?php endforeach; ?>
            </span>
        </div>
    </body>
</html>
