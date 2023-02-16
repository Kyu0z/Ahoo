<?php $this->beginContent('//layouts/main'); ?>

<div class="container wrapper">

    <nav class="navbar navbar-default" role="navigation">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><?php echo Yii::app() -> name ?></a>
      </div>

      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li></li>
          <li><a href="<?php echo $this -> createAbsoluteUrl("videochat/index") ?>"><?php echo Yii::t("app", "Home") ?></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo $this -> createAbsoluteUrl("videochat/logout") ?>"><?php echo Yii::t("app", "Logout") ?></a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?php echo Yii::t("app", "Greetings", array("{Name}" => '<strong>'.CHtml::encode(Yii::app() -> user -> name).'</strong>')) ?>
            </div>

            <div class="alert alert-dismissable alert-warning red-bg">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?php echo Yii::t("app", "Advice - webcam access") ?>
            </div>
        </div>
    </div>


    <div class="row">
        <?php echo $content ?>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo Yii::t("app", "Developed by {Developer}", array("{Developer}" => Yii::app()->params['param.developed_by'])) ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $this->endContent(); ?>