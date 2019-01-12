<?php
use yii\helpers\Html;
use backend\assets\LoginAsset;

LoginAsset::register($this);
$bodyClass = str_replace('/', '-', Yii::$app->controller->route);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" style="width:100%;">
   <head>
       <meta charset="<?= Yii::$app->charset; ?>" />
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />
       <?= Html::csrfMetaTags(); ?>
       <?= $this->head(); ?>
       <title><?= Html::encode($this->title) ?></title>
   </head>
   <body class="<?= $bodyClass ?>">
      <?php $this->beginBody(); ?>
      <div class="container">
          <?= $content; ?>
      </div>
      <?php $this->endBody(); ?>
   </body>
</html>
<?php $this->endPage(); ?>