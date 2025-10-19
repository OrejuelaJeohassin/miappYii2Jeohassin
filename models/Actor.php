<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property int $idactor
 * @property string|null $nombre
 * @property string|null $apellidos
 * @property string|null $biografia
 *
 * @property ActorHasPelicula[] $actorHasPeliculas
 * @property Pelicula[] $fkIdpeliculas
 */
class Actor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellidos', 'biografia'], 'default', 'value' => null],
            [['idactor'], 'required'],
            [['idactor'], 'integer'],
            [['nombre', 'apellidos'], 'string', 'max' => 45],
            [['biografia'], 'string', 'max' => 255],
            [['idactor'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idactor' => Yii::t('app', 'Idactor'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'biografia' => Yii::t('app', 'Biografia'),
        ];
    }

    /**
     * Gets query for [[ActorHasPeliculas]].
     *
     * @return \yii\db\ActiveQuery|ActorHasPeliculaQuery
     */
    public function getActorHasPeliculas()
    {
        return $this->hasMany(ActorHasPelicula::class, ['fk_idactor' => 'idactor']);
    }

    /**
     * Gets query for [[FkIdpeliculas]].
     *
     * @return \yii\db\ActiveQuery|PeliculaQuery
     */
    public function getFkIdpeliculas()
    {
        return $this->hasMany(Pelicula::class, ['idpelicula' => 'fk_idpelicula'])->viaTable('actor_has_pelicula', ['fk_idactor' => 'idactor']);
    }

    /**
     * {@inheritdoc}
     * @return ActorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActorQuery(get_called_class());
    }

}
