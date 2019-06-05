<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use \app\models\Colaborador;
use \yii\web\UploadedFile;

class ColaboradorController extends ActiveController {

    public $modelClass = 'app\models\Colaborador';

    public function actionCreateNew() {

        $model = new Colaborador();
        $model->load(Yii::$app->request->post(),'');

        $imgFile = UploadedFile::getInstanceByName('imageFile');
        if ($imgFile != null) {
            $model->imageFile = $imgFile;
            $model->foto = date('YmdHis-') . $model->imageFile->name;
            if ($model->validate()) {
                $model->save();
                $model->imageFile->saveAs(Yii::getAlias('@webroot/uploads/' . $model->foto));
                return $model;
            } else {
                return $model->errors;
            }
        } else {
            $model->validate();
            return $model->errors;
        }
    }

}
