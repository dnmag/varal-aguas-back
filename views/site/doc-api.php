<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'API Doc';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
  <h1><?= Html::encode($this->title) ?></h1>

  <p><strong>GET</strong> <code>/colaborador</code> <em>responseBody</em></p>

  <div class="highlight highlight-source-json">
    <pre>[
  {
    <span class="pl-s"><span class="pl-pds">"</span>id<span class="pl-pds">"</span></span>: <span class="pl-ii">int</span>,
    <span class="pl-s"><span class="pl-pds">"</span>nome<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>string<span class="pl-pds">"</span></span>,
    <span class="pl-s"><span class="pl-pds">"</span>local_foto<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>string<span class="pl-pds">"</span></span>,
    <span class="pl-s"><span class="pl-pds">"</span>nome_foto<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>string<span class="pl-pds">"</span></span>,
    <span class="pl-s"><span class="pl-pds">"</span>data_foto<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>date string ISO-8601<span class="pl-pds">"</span></span>,
    <span class="pl-s"><span class="pl-pds">"</span>foto<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>string file name in server<span class="pl-pds">"</span></span>,
    <span class="pl-s"><span class="pl-pds">"</span>termos<span class="pl-pds">"</span></span>: <span class="pl-ii">bool</span>
  }
]</pre>
  </div>
  <br />
  <p><strong>POST</strong> <code>/colaborador</code> <em>requestBody</em></p>

  <div class="highlight highlight-source-json">
    <pre>{
  <span class="pl-s"><span class="pl-pds">"</span>nome<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>string<span class="pl-pds">"</span></span>,
  <span class="pl-s"><span class="pl-pds">"</span>local_foto<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>string<span class="pl-pds">"</span></span>,
  <span class="pl-s"><span class="pl-pds">"</span>nome_foto<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>string<span class="pl-pds">"</span></span>,
  <span class="pl-s"><span class="pl-pds">"</span>data_foto<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>date string ISO-8601<span class="pl-pds">"</span></span>,
  <span class="pl-s"><span class="pl-pds">"</span>img_base64<span class="pl-pds">"</span></span>: <span class="pl-s"><span class="pl-pds">"</span>base64 string - non dataURL<span class="pl-pds">"</span></span>,
  <span class="pl-s"><span class="pl-pds">"</span>termos<span class="pl-pds">"</span></span>: <span class="pl-ii">bool</span>
}</pre>
  </div>
</div>