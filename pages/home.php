<?php

$db= new Database();

$newsData =$db->All("news");

?>



<div class="row">
    <?php
    foreach($newsData as $news){
    ?>
    <div class="col-md-4">
        <div class="card">
            <img src="<?=url($news->image)?>" style="height: 200px;" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">
                    <?=$news->title; ?>
                </h5>
                <p class="card-text">
                    <?=$news->summary; ?>
                </p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>