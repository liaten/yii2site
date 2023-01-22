
<?php
/** @var PostForm $postForm */
/** @var string $title */
/** @var string $description */
/** @var string $fullNew */

use app\models\PostForm;
use execut\autosizeTextarea\TextareaWidget;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$session = Yii::$app->session;
$hasFlashPostOK = $session->hasFlash('postOK');
$hasFlashPostErr = $session->hasFlash('postERR');
$noFlashMessages = !($hasFlashPostOK || $hasFlashPostErr);

?>
<div class="site-login container">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo $this->title; ?></h1>

    <?php if($hasFlashPostOK):?>

        <div class="alert alert-success" role="alert">
            Пост изменён успешно.
        </div>
    </div>
</div>
<?php else: ?>
    <?php if($hasFlashPostErr):?>

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

    <?= $form->field($postForm, 'title')->textInput(['autofocus' => true])->widget(TextareaWidget::class,[
        'options' =>[
            'style' =>'height: 30 px'
        ]
    ]) ?>

    <?= $form->field($postForm, 'description')->textInput()->widget(TextareaWidget::class,[
        'options' =>[
            'style' =>'height: 30 px'
        ]
    ])?>

    <?= $form->field($postForm, 'fullNew')->textInput()->widget(TextareaWidget::class,[
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
    document.getElementById('postform-title').value = '<?php echo $title;?>' ;
    document.getElementById('postform-description').value = '<?php echo $description;?>' ;
    document.getElementById('postform-fullnew').value = '<?php echo $fullNew;?>' ;
</script>
<?php endif; ?>