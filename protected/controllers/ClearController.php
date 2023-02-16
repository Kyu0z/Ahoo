<?php
class ClearController extends CController {
	public function init() {
		$app_key = Yii::app() -> params['app.command_key'];
		$get_key = Yii::app() -> request -> getQuery('key');
		if(empty($app_key)) {
			throw new CHttpException(400, Yii::t("app", "Access Denied"));
		}
		if(strcmp($app_key, $get_key) !== 0) {
			throw new CHttpException(400, Yii::t("app", "Access Denied"));
		}
	}
	
	public function actionIndex() {
		// params
		$args = array('yiic', 'clearsession', 'removeall');
		
		// Get command path
		$commandPath = Yii::app() -> getBasePath() . DIRECTORY_SEPARATOR . 'commands';

		// Create new console command runner
		$runner = new CConsoleCommandRunner();

		// Adding commands
		$runner -> addCommands($commandPath);

		// If something goes wrong return error
		$runner -> run ($args);

		echo 'ok';
	}
}