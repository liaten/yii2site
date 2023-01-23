<?php
/** @var NewsForm $newsForm */
/** @var News $new */

use app\models\News;
use app\models\NewsForm;
use execut\autosizeTextarea\TextareaWidget;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$title = $new->title;
$description = $new->description;
$fullNew = $new->fullNew;

$session = Yii::$app->session;
$hasFlashNewOK = $session->hasFlash('newOK');
$hasFlashNewErr = $session->hasFlash('newERR');
$noFlashMessages = !($hasFlashNewOK || $hasFlashNewErr);

?>
<div class="site-login container">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo $this->title; ?></h1>

    <?php if($hasFlashNewOK):?>

        <div class="alert alert-success" role="alert">
            Пост изменён успешно.
        </div>
    </div>
</div>
<?php else: ?>
    <?php if($hasFlashNewErr):?>

            <div class="alert alert-warning" role="alert">
                Ошибка валидации формы. Вероятно, не все формы заполнены.
            </div>
        </div>

    <?php else: ?>

            <p class="lead">
                Для изменения поста необходимо заполнить поля: "Заголовок", "Описание", "Подробности".
            </p>
        </div>
    <?php endif;?>

    <?php $form = ActiveForm::begin([
        'id' => 'edit-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{hint}\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($newsForm, 'title')->textInput(['autofocus' => true])->widget(TextareaWidget::class,[
        'options' =>[
            'style' =>'height: 30 px'
        ]
    ]) ?>

    <?= $form->field($newsForm, 'description')->textInput()->widget(TextareaWidget::class,[
        'options' =>[
            'style' =>'height: 30 px'
        ]
    ])?>

    <?= $form->field($newsForm, 'fullNew')->textInput()->widget(TextareaWidget::class,[
        'options' =>[
            'style' =>'height: 30 px'
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php endif;?>
</div>

<?php if ($noFlashMessages):?>
<script>
    document.getElementById('newsform-title').value = '<?php echo $title;?>' ;
    document.getElementById('newsform-description').value = '<?php echo $description;?>' ;
    document.getElementById('newsform-fullnew').value = '<?php echo $fullNew;?>' ;
</script>
<?php endif; ?>