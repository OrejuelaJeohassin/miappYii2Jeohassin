<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Director;

/** @var yii\web\View $this */
/** @var app\models\Pelicula $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pelicula-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

    <?php if ($model->portada): ?>
   <div class="form-group">
    <?= Html::label('Imagen Actual') ?>
    <div>
        <?= Html::img(Yii::getAlias('@web') . "/portadas/" . $model->portada, ['style' => 'width: 200px']) ?>
    </div>
    </div>
    <?php endif; ?>

    <?= $form->field($model, 'idpelicula')->textInput() ?>

    <?php //$form->field($model, 'portada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput()-> label("Seleccionar portada") ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength'=> true, 'placeholder'=> 'Titulo de la pelicula', 'required'=>true]) ?>

    <?= $form->field($model, 'sinopsis')->textarea(['maxlength' => true, 'placeholder'=> 'Escriba aquí la sipnosis....', 'required'=>true]) ?>

    <?= $form->field($model, 'anio')->Input('number', ['min'=>1900, 'max'=>date('Y')]) 
        -> textinput(['pattern'=>'\d{4}', 'title'=> 'Debe ser un año de 4 digitos', 'placeholder'=> 'Año de lanzamiento', 'required'=>true])
    ?>

    <?= $form->field($model, 'duracion')->Input("text") ->
        textinput(['pattern' => '^(([0-1]?[0-9])|(2[0-3])):[0-5][0-9]:[0-5][0-9]$', 'title'=> 'Formato HH:MM', 'placeholder'=> 'Formato 00:00:00', 'required'=>true])
    
    ?>

    <?= $form->field($model, 'fk_iddirector')->dropDownList(ArrayHelper::map(Director::find()->select(['iddirector', 'CONCAT(apellido, ", ", nombre) AS nombre_completo'])
                                                                                                ->orderBy('apellido') 
                                                                                                ->asArray()
                                                                                                ->all(), 'iddirector', 'nombre_completo'), ['prompt' => 'Seleccione un director', 'required' => true])
                                                                                                
?>
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
