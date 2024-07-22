<?php

$db = new Database();

if (!empty($_GET['search'])) {
    $search = $_GET['search'];
    $newsData = $db->customQuery("SELECT * FROM news WHERE title LIKE '%$search%' OR summary LIKE '%$search%' OR description LIKE '%$search%'");
} else {
    $newsData = $db->All("news");
}
?>


<div class="row">
    <?php
    foreach ($newsData as $news) {
        ?>
        <div class="col-md-4">
            <div class="card">
                <img src="<?= url($news->image) ?>" style="height: 200px;" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $news->title; ?>
                    </h5>
                    <p class="card-text">
                        <?= $news->summary; ?>
                    </p>
                    <a href="<?= url('news-details?slug=' . $news->slug) ?>" class="btn btn-primary">Read more...</a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>