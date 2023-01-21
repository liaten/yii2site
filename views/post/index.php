<?php
/** @var string $title */
/** @var string $creationDateTime */
/** @var string $updateDateTime */
/** @var string $description */
/** @var string $fullNew */
/** @var int $creatorID */
/** @var int $updaterID */
?>
<div class="site-index">

    <div class="container">
        <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4"><?php echo $title; ?></h1>
        </div>
        <p class="lead">Дата создания поста: <?php echo $creationDateTime?>.
            Создатель: <?php echo $creatorID?>.<br>
            Последнее изменение: <?php echo $updateDateTime?>.
            Редактор последних изменений: <?php echo $updaterID?>.</p>

        <div class="body-content ">
            <div class="row">
                <p><?php echo $description?></p>
                <p><?php echo $fullNew?></p>
            </div>
        </div>
    </div>

</div>
