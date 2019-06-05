<?php

namespace app\models;

use Yii;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "colaborador".
 *
 * @property int $id
 * @property string $nome
 * @property string $local_foto
 * @property string $nome_foto
 * @property string $data_foto
 * @property string $foto
 * @property bool $termos
 */
class Colaborador extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colaborador';
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
            ['imageFile', 'file', 'extensions' => 'jpg, png, jpeg, gif'],
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
            'imageFile' => 'Imagem',
        ];
    }
}
