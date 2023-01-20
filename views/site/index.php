<?php
/** @var array $allNews */
/** @var yii\data\Pagination $pagination */


use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

$this->title = 'Новости';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo $this->title; ?></h1>

        <p class="lead">Здесь вы можете просмотреть список новостей и перейти к каждой новости при нажатии на кнопку.</p>
    </div>

    <div class="body-content ">
    <?php
    var_dump(Yii::$app->session['user']);
    for($i=0;$i<count($allNews);$i++){
        $id = $allNews[$i]['id'];
        $header = $allNews[$i]['header'];
        $creationDate = $allNews[$i]['creation_date'];
        $description = $allNews[$i]['description'];
        echo '<div class="row">';
        echo '<h2>' . $header . '</h2>';
        echo '<p class="lead">' . 'Дата создания поста: '.$creationDate . '</p>';
        echo '<p>' . $description . '</p>';
        echo '<p><a class="btn btn-outline-secondary" href="'.Url::base(true).'/?r=post&id='.$id.'">Перейти к новости &raquo;</a></p>';
    }
    ?>
    </div>
    <?php echo LinkPager::widget([
            'pagination' => $pagination,
            'activePageCssClass' => 'active-page' ,
            'maxButtonCount' => 5 ,
            'options' => [
                'class' => 'ip-mosaic__pagin-list'
            ]
    ]);
    ?>
</div>
