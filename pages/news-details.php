<?php

$slug = $_GET['slug'];

$db= new Database();

$newsData=$db->customQuery("SELECT * FROM news WHERE slug='$slug'");
$newsData=$newsData[0];
$id=$newsData->nid;
$pageVisite=$newsData->page_visite;
$pageVisite++;
$result=$db->customQuery("UPDATE news SET page_visite='$pageVisite' WHERE nid='$id'");
$categoryId=$newsData->category_id;
$relatedNews=$db->customQuery("SELECT * FROM news WHERE category_id='$categoryId' AND slug!='$slug'");
//$relatedNews=$db->customQuery("SELECT * FROM news WHERE category_id='$categoryId'");
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1><?=$newsData->title?></h1>
            <p>Total views <?=$newsData->page_visite;?></p>
            <img src="<?=url($newsData->image)?>" class="img-fluid" alt="">
            <p><?=$newsData->description?></p>
        </div>
        <div class="col-md-4">
            <h1>Related News</h1>
            <?php
            foreach($relatedNews as $news){
            ?>
                <ul>
                    <li>
                        <a href="<?=url('news-details?slug='.$news->slug)?>"><?=$news->title?></a>
                    </li>
                </ul>

            <?php } ?>
        </div>
    </div>
