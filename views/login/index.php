<?php
/** @var LoginForm $loginForm */
/** @var string $userTypeName */

use app\models\LoginForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>
<div class="site-login">

    <?php if(Yii::$app->session->hasFlash('auth_ok')):?>
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo $this->title; ?></h1>

        <div class="alert alert-success" role="alert">
            Успешная авторизация. Логин: <?php echo $loginForm->login?>. Пароль: <?php echo $loginForm->password ?>. Тип пользователя: <?php echo $userTypeName ?>
        </div>
    </div>
</div>
    <?php else: ?>
    <?php if(Yii::$app->session->hasFlash('auth_err')):?>

        <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4"><?php echo $this->title; ?></h1>

            <div class="alert alert-warning" role="alert">
                Ошибка авторизации. Введённые данные: Логин: <?php echo $loginForm->login?> Пароль: <?php echo $loginForm->password ?>
            </div>
        </div>

    <?php else: ?>

        <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4"><?php echo $this->title; ?></h1>

            <p class="lead">
                Здесь вы можете авторизоваться, как пользователь
                <span style="color: red">(user:user)</span>
                и как редактор
                <span style="color: red">(red:red)</span>
            </p>
        </div>
    <?php endif;?>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{hint}\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($loginForm, 'login')->textInput(['autofocus' => true]) ?>

    <?= $form->field($loginForm, 'password')->passwordInput() ?>

    <?= $form->field($loginForm, 'rememberMe')->checkbox([
        'template' => "<div class=\"col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>

    <div class="form-group">
            <?= Html::submitButton('Авторизоваться', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php endif;?>

</div>