<?php
/** @var string $title */
/** @var string $creationDateTime */
/** @var string $description */
/** @var string $fullNew */
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo $title; ?></h1>

        <p class="lead">Дата создания новости: <?php echo $creationDateTime?></p>
    </div>

    <div class="body-content ">
        <div class="row">
            <p><?php echo $description?></p>
            <p><?php echo $fullNew?></p>
        </div>
    </div>
</div>
