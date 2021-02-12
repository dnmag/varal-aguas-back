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

        if ($model->img_base64 != null) {
            $fileExtension = $this->getImageMimeType($model->img_base64);
            if (is_null($fileExtension) || empty($fileExtension)) {
                Yii::$app->response->statusCode = 400;
                return ['model'=> null,
                            'error'=> ['img_base64'=>'Imagem inválida!'],
                            'status'=> false];
            }
            $model->foto = date('YmdHis-') . Yii::$app->security->generateRandomString(5) . '.' . $fileExtension;
            if ($model->validate()) {
                if($model->termos){
                    $model->save();
                } else{
                    Yii::$app->response->statusCode = 400;
                    return ['model'=> null,
                            'error'=> ['termos'=>'É necessário aceitar os termos!'],
                            'status'=> false];
                }
                if (file_put_contents(Yii::getAlias('@webroot/uploads/' . $model->foto), base64_decode($model->img_base64)) === false) {
                    throw new \yii\base\Exception("Couldn't save image to $model->foto");
                }
                return ['model'=> $model,
                        'error'=> null,
                        'status'=> true];
            } else {
                Yii::$app->response->statusCode = 400;
                return ['model'=> null,
                        'error'=> $model->errors,
                        'status'=> false];
            }
        } else {
            $model->validate();
            Yii::$app->response->statusCode = 400;
            return ['model'=> null,
                    'error'=> $model->errors,
                    'status'=> false];
        }
    }

    public function getBytesFromHexString($hexdata) {
        for ($count = 0; $count < strlen($hexdata); $count += 2)
            $bytes[] = chr(hexdec(substr($hexdata, $count, 2)));
    
        return implode($bytes);
    }
    
    public function getImageMimeType($imageString) {
        $imagedata = base64_decode($imageString);
        $imagemimetypes = array(
            "jpeg" => "FFD8",
            "png" => "89504E470D0A1A0A",
            "gif" => "474946",
            "bmp" => "424D",
            "tiff" => "4949",
            "tiff" => "4D4D"
        );
    
        foreach ($imagemimetypes as $mime => $hexbytes) {
            $bytes = $this->getBytesFromHexString($hexbytes);
            if (substr($imagedata, 0, strlen($bytes)) == $bytes)
                return $mime;
        }
    
        return null;
    }

}
