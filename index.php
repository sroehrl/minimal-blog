<?php
$current = $_GET['entry'] ?? null;
$all = [];
$menu = '';
foreach (glob('articles/*.json') as $i => $entry) {
    $all[] = json_decode(file_get_contents($entry), true);
    if (!$current) {
        $current = $all[0]['slug'];
    }
    // menu
    $src = '?entry=' . $all[$i]['slug'];
    $title = $all[$i]['name'];
    $menu .= "<li class='nav-item'><a class='nav-link' href='$src'>$title</a></li>";
}
$thisArticle = array_filter($all, fn($item) => $item['slug'] === $current)[0];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Blog</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand text-uppercase " href="#">Most primitive blog</a>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1><?= $thisArticle['name'] ?></h1>
            <p><?= $thisArticle['teaser'] ?></p>
            <hr>
            <?php foreach ($thisArticle['article_content'] as $content) {
                echo $content['html'];
            } ?>
        </div>
        <div class="col">
            <ul class="nav flex-column">
                <?= $menu ?>
            </ul>
        </div>

    </div>
</div>
</body>
</html>
