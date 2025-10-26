<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Director $model */

$this->title = Yii::t('app', 'Crear Director');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Directores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
