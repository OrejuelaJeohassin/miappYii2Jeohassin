<?php

/** @var yii\web\View $this */
use app\models\Pelicula;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Películas';
$this->registerCssFile('@web/css/netflix.css', ['depends' => \app\assets\AppAsset::class]);

$peliculas = Pelicula::find()->orderBy(['anio' => SORT_DESC])->all();
$featured = $peliculas[0] ?? null;
?>
<div class="site-netflix">

    <?php if ($featured): ?>
        <section class="site-netflix-hero">
            <div class="hero-content container">
                <?php if ($featured->portada): ?>
                    <img class="hero-poster" src="<?= Url::to('@web/portadas/' . $featured->portada) ?>" alt="<?= Html::encode($featured->titulo) ?>">
                <?php else: ?>
                    <div class="hero-poster placeholder">No imagen</div>
                <?php endif; ?>

                <div class="hero-meta">
                    <h1><?= Html::encode($featured->titulo) ?></h1>
                    <p class="text-muted"><?= Html::encode($featured->sinopsis) ?></p>
                    <p><a class="btn btn-danger" href="<?= Url::to(['pelicula/view', 'idpelicula' => $featured->idpelicula]) ?>">Ver detalles</a></p>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <div class="container">
        <h2 class="section-title">Últimas películas</h2>
        <div class="row-rail">
            <?php foreach ($peliculas as $p): ?>
                <div class="card" onclick="location.href='<?= Url::to(['pelicula/view', 'idpelicula' => $p->idpelicula]) ?>'">
                    <?php if ($p->portada): ?>
                        <img class="poster" src="<?= Url::to('@web/portadas/' . $p->portada) ?>" alt="<?= Html::encode($p->titulo) ?>">
                    <?php else: ?>
                        <div class="placeholder"></div>
                    <?php endif; ?>
                    <div class="title"><?= Html::encode($p->titulo) ?></div>
                    <div class="year"><?= Html::encode($p->anio) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
