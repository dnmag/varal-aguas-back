<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use \app\models\Colaborador;
use \yii\web\UploadedFile;

class ColaboradorController extends ActiveController {

    public $modelClass = 'app\models\Colaborador';

    public static function allowedDomains() {
        return [
             '*',                        // star allows all domains
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return array_merge(parent::behaviors(), [
            // For cross-domain AJAX request
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to domains:
                    'Origin' => static::allowedDomains(),
                    'Access-Control-Request-Method' => ['POST'],
                    'Access-Control-Allow-Credentials' => false,
                    'Access-Control-Max-Age' => 3600, // Cache (seconds)
                ],
            ],
        ]);
    }

    public function actionCreateNew() {

        $model = new Colaborador();
        $model->load(Yii::$app->request->post(), '');

        $imgFile = UploadedFile::getInstanceByName('imageFile');
        if ($imgFile != null) {
            $model->imageFile = $imgFile;
            $model->foto = date('YmdHis-') . substr($model->imageFile->name, 0, 5);
            if ($model->validate()) {
                if($model->termos){
                    $model->save();
                } else{
                    return ['model'=> null,
                            'error'=> ['termos'=>'É necessário aceitar os termos!'],
                            'status'=> false];
                }
                $model->imageFile->saveAs(Yii::getAlias('@webroot/uploads/' . $model->foto));
                return ['model'=> $model,
                        'error'=> null,
                        'status'=> true];
            } else {
                return ['model'=> null,
                        'error'=> $model->errors,
                        'status'=> false];
            }
        } else {
            $model->validate();
            return ['model'=> null,
                    'error'=> $model->errors,
                    'status'=> false];
        }
    }

}
