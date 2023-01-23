<?php
/** @var News ...$allNews */
/** @var yii\data\Pagination $pagination */

use app\models\News;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

$this->title = 'Новости';
$session = Yii::$app->session;
$user = $session['user'];
?>

<div class="site-index">
    <div class="row">
        <div class="col-auto">
            <?php echo $session['weather']; ?>
            <p style="font-family: var(--bs-font-monospace); font-size: 0.875em">Таймер обновления: 1 час</p>
        </div>
        <div class="col">
            <div class="jumbotron text-center bg-transparent">
                <h1 class="display-4"><?php echo $this->title; ?></h1>

                <p class="lead">Здесь вы можете просмотреть список новостей и перейти к каждой новости при нажатии на кнопку.</p>
                <?php
                if($user){
                    echo '<a class="btn btn-outline-secondary" href="'.Url::base(true).'/?r=new/create">Создать новостную запись</a>';
                }
                ?>
            </div>
            <?php
            foreach ($allNews as $new) {
                $id = $new->id;
                $header = $new->title;
                $creationDate = $new->creationDateTime;
                $description = $new->description;
                echo '<div class="row">';
                echo '<h2>' . $header . '</h2>';
                echo '<p class="small">' . 'Дата создания поста: '.$creationDate . '</p>';
                echo '<p>' . $description . '</p>';
                echo '<p><a class="btn btn-outline-secondary" href="'.Url::base(true).'/?r=new&id='.$id.'">Перейти &raquo;</a>';

                if($user){
                    $userType = $user['userType'];
                    if($userType===1){ // 1 = editor
                        echo '<a class="btn btn-outline-secondary" style="margin-right: 15px;margin-left: 15px;" href="'.Url::base(true).'/?r=new/edit&id='.$id.'">Изменить &raquo;</a>'.
                            '<button class="btn btn-outline-secondary" onclick="AcceptDelete('.$id.')">Удалить &raquo;</button>'.
                            '<div class="toast" id="deleteToast'.$id.'" role="alert" aria-live="assertive" aria-atomic="true">'.
                            '<div class="toast-header">'.
                            '<strong>Подтверждение удаления записи №'.$id.'</strong>'.'</div>'.
                            '<div class="toast-body">'.
                            '<a class="btn btn-outline-secondary" style="margin-right: 15px;" aria-hidden="true" href="'.Url::base(true).'/?r=new/delete&id='.$id.'">Подтвердить</a>'.
                            '<a class="btn btn-outline-secondary close" aria-hidden="true" data-bs-dismiss="toast" aria-label="Close">Отменить</a>'.
                            '</div>'.
                            '</div>';
                    }
                }
                echo '</p>';
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
</div>
</div>
<script>
    let option = {
        animation : true,
        delay : 1000*60
    };

    function AcceptDelete(id){
        let toastHTMLElement = document.getElementById("deleteToast" + id);
        let toastElement = new bootstrap.Toast(toastHTMLElement,option);
        toastElement.show();
    }
</script>