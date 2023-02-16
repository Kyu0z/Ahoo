<?php $this->title=Yii::app()->name . ' - ' .$error['code']; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default mt-20">
                <div class="panel-body">
                    <h2>Error <?php echo $error['code'] ?></h2>
                    <p>
                        <?php echo $error['message']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>