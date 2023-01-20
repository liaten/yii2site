<?php
/** @var array $allNews */
/** @var yii\data\Pagination $pagination */


use matejch\yii2sidebar\Sidebar;
use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

$this->title = 'Новости';
?>

<div class="site-index">
        <div class="weather">
            <?php
            $ch = curl_init('https://wttr.in/?сыктывкар&lang=ru&0QT');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $weather = curl_exec($ch);
            curl_close($ch);
            echo $weather;
            ?>
        </div>

        <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4"><?php echo $this->title; ?></h1>

            <p class="lead">Здесь вы можете просмотреть список новостей и перейти к каждой новости при нажатии на кнопку.</p>
        </div>

        <?php
    //    var_dump(Yii::$app->session['user']);
        for($i=0;$i<count($allNews);$i++){
            $id = $allNews[$i]['id'];
            $header = $allNews[$i]['title'];
            $creationDate = $allNews[$i]['creation_datetime'];
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
