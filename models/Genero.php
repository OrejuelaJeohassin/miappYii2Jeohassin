<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property int $idcategoria
 * @property string|null $nombre
 * @property string|null $descripcion
 *
 * @property Pelicula[] $fkIdpeliculas
 * @property PeliculaHasGenero[] $peliculaHasGeneros
 */
class Genero extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'default', 'value' => null],
            [['idcategoria'], 'required'],
            [['idcategoria'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 255],
            [['idcategoria'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcategoria' => Yii::t('app', 'Idcategoria'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * Gets query for [[FkIdpeliculas]].
     *
     * @return \yii\db\ActiveQuery|PeliculaQuery
     */
    public function getFkIdpeliculas()
    {
        return $this->hasMany(Pelicula::class, ['idpelicula' => 'fk_idpelicula'])->viaTable('pelicula_has_genero', ['fk_idcategoria' => 'idcategoria']);
    }

    /**
     * Gets query for [[PeliculaHasGeneros]].
     *
     * @return \yii\db\ActiveQuery|PeliculaHasGeneroQuery
     */
    public function getPeliculaHasGeneros()
    {
        return $this->hasMany(PeliculaHasGenero::class, ['fk_idcategoria' => 'idcategoria']);
    }

    /**
     * {@inheritdoc}
     * @return GeneroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeneroQuery(get_called_class());
    }

}
