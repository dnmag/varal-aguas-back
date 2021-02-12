<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use \app\models\Participante;

class ParticipanteController extends ActiveController
{

    public $modelClass = 'app\models\Participante';

    public static function allowedDomains()
    {
        return [
            '*',                        // star allows all domains
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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

    public function actionCreateNew()
    {

        $model = new Participante();
        $model->load(Yii::$app->request->post(), '');

        if ($model->img_base64 != null) {
            $fileExtension = $this->getImageMimeType($model->img_base64);
            if (is_null($fileExtension) || empty($fileExtension)) {
                Yii::$app->response->statusCode = 400;
                return [
                    'errors' => ['img_base64' => ['Imagem inválida!']],
                ];
            }
            $model->foto = date('YmdHis-') . Yii::$app->security->generateRandomString(5) . '.' . $fileExtension;
            if ($model->validate()) {
                if ($model->termos) {
                    $model->save();
                } else {
                    Yii::$app->response->statusCode = 400;
                    return [
                        'errors' => ['termos' => ['É necessário aceitar os termos!']],
                    ];
                }
                if (file_put_contents(Yii::getAlias('@webroot/uploads/' . $model->foto), base64_decode($model->img_base64)) === false) {
                    throw new \yii\base\Exception("Couldn't save image to $model->foto");
                }
                return [
                    'participante' => $model,

                ];
            } else {
                Yii::$app->response->statusCode = 400;
                return [
                    'errors' => $model->errors,
                ];
            }
        } else {
            $model->validate();
            Yii::$app->response->statusCode = 400;
            return [
                'errors' => $model->errors,
            ];
        }
    }

    public function getBytesFromHexString($hexdata)
    {
        for ($count = 0; $count < strlen($hexdata); $count += 2)
            $bytes[] = chr(hexdec(substr($hexdata, $count, 2)));

        return implode($bytes);
    }

    public function getImageMimeType($imageString)
    {
        $imagedata = base64_decode($imageString);
        $imagemimetypes = array(
            "jpeg" => "FFD8",
            "png" => "89504E470D0A1A0A",
        );

        foreach ($imagemimetypes as $mime => $hexbytes) {
            $bytes = $this->getBytesFromHexString($hexbytes);
            if (substr($imagedata, 0, strlen($bytes)) == $bytes)
                return $mime;
        }

        return null;
    }
}
