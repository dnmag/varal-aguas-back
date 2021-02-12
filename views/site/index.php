<?php

use yii\helpers\Html;


/* @var $this yii\web\View */

$this->title = 'Varal das Águas - API';

$this->registerCss("
    .participante-container {
        width: 100%; 
        display: flex; 
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .participante { 
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width:32%; 
        border: solid 1px #c3c3c3; 
        border-radius: 10px; 
        box-shadow: rgb(0 0 0 / 10%) 5px 4px 9px;
        margin-bottom: 15px;
    }

    @media (max-width: 1000px) {
        .participante { 
            width:48%; 
         }
    }

    @media (max-width: 768px) {
        .participante { 
            width:90%; 
         }
    }
");

?>
<div class="site-index">

    <h1>Participantes</h1>
    <br />
    <div class="row">
        <div class="participante-container">

            <?php foreach ($colaboradores as $c) : ?>
                <div class="participante">
                    <div style="width: 50%;">
                        <div class="col-md-12"><b>Nome: </b><?= $c->nome ?></div>
                        <div class="col-md-12"><b>Local: </b><?= $c->local_foto ?></div>
                        <div class="col-md-12"><b>Foto: </b><?= $c->nome_foto ?></div>
                        <div class="col-md-12"><b>Data: </b><?= date_format(date_create($c->data_foto), "d/m/Y") ?></div>
                    </div>
                    <div style="width: 45%;"><?= Html::img('uploads/' .  $c->foto, ['width' => '100%', 'height' => 'auto']) ?></div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>