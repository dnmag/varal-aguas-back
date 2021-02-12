<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "participante".
 *
 * @property int $id
 * @property string $nome
 * @property string $local_foto
 * @property string $nome_foto
 * @property string $data_foto
 * @property string $foto
 * @property bool $termos
 */
class Participante extends \yii\db\ActiveRecord
{
    public $img_base64;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'participante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'local_foto', 'nome_foto', 'data_foto', 'foto'], 'required'],
            [['data_foto'], 'safe'],
            [['termos'], 'boolean'],
            [['nome', 'local_foto', 'nome_foto', 'foto'], 'string', 'max' => 50],
            ['img_base64', 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'local_foto' => 'Local Foto',
            'nome_foto' => 'Nome Foto',
            'data_foto' => 'Data Foto',
            'foto' => 'Foto',
            'termos' => 'Termos',
            'img_base64' => 'Imagem',
        ];
    }
}
