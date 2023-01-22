<?php
/** @var PostForm $postForm */

use app\models\PostForm;
use execut\autosizeTextarea\TextareaWidget;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>
<div class="site-login container">

    <?php if(Yii::$app->session->hasFlash('postOK')):?>
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo $this->title; ?></h1>

        <div class="alert alert-success" role="alert">
            Пост создан успешно.
        </div>
    </div>
</div>
<?php else: ?>
    <?php if(Yii::$app->session->hasFlash('postERR')):?>

        <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4"><?php echo $this->title; ?></h1>

            <div class="alert alert-warning" role="alert">
                Не все формы заполнены.
            </div>
        </div>

    <?php else: ?>

        <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4"><?php echo $this->title; ?></h1>

            <p class="lead">
                Для создания поста необходимо заполнить поля: "Заголовок", "Описание", "Подробности".
            </p>
        </div>
    <?php endif;?>

    <?php $form = ActiveForm::begin([
        'id' => 'post-form',
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
        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'post-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php endif;?>

</div>