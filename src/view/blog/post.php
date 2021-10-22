<?php

use App\Factory;

$app = Factory::getFactory();
$post = $app->getTable('post')->find($_GET['id']);
if($post === false)
{
    $app->notFound();
}
$categories = $app->getTable('category')->all();
$app->setTitle($post->name);
?>
<section>
    <nav>
        <ul>
            <li><strong>Catégories:</strong></li>
        </ul>
        <ul>
            <?php foreach ($categories as $category) : ?>
                <li><a href="<?= $category->url; ?>"><?= $category->name; ?> | </a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</section>

<h1><?= $post->name; ?></h1>
<p>
    <small>
        Publié le <?= $post->creation_date; ?> par </a>
    </small>
</p>
<p>
    <?= $post->content; ?>
</p>