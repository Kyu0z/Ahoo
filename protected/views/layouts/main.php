<!DOCTYPE html>
<html lang="<?php echo Yii::app() -> language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="language" content="<?php echo Yii::app() -> language ?>" />
    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl ?>/favicon.ico">
    <?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/static/js/bootstrap.min.js', CClientScript::POS_END) ?>
    <title><?php echo CHtml::encode($this -> title) ?></title>
    <?php echo Yii::app()->params['template.head'] ?>
</head>
<body>
<?php echo $content; ?>
</body>
</html>