<?php
class VideochatController extends Controller {

	public function actions() {
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

	public function actionIndex() {
		$this -> layout = 'signed_column';

        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile(Yii::app()->baseUrl."/static/js/dashboard.js", CClientScript::POS_END);

        $this->title = Yii::t("app", "Dashboard title", array(
            "{app_name}"=>Yii::app()->name
        ));

		$this -> render ("index", array(
			'user' => Yii::app() -> user,
		));
	}

	public function actionLogin() {
		if(!Yii::app() -> user -> isGuest) {
			$this ->  redirect($this -> createUrl("videochat/index"));
		}

        $this->title = Yii::t("app", "Login title", array(
            "{app_name}"=>Yii::app()->name
        ));

		// Initialize Login Form
		$loginForm = new LoginForm();

		// If user trying to login
		if(Yii::app() -> request -> isPostRequest AND isset($_POST['LoginForm']) AND is_array($_POST['LoginForm'])) {

			// Set the form attributes
			$loginForm -> setAttributes($_POST['LoginForm']);

			// If form data is valid, continue login process
			if($loginForm -> validate()) {

				// Copy form attributes and unset unnecessary parameters
				$data = $loginForm -> getAttributes();
				unset($data['verifyCode']);

				// Initialize session model
				$session = new SessionModel();
				$session -> username = $data['username'];

				// Save user in session table
				$session -> save();

				// Authenticate user
				$identity = new UserIdentity($session -> username, null);
				$identity -> setUser($session);
				$identity -> authenticate();

				Yii::app() -> user -> login($identity, 0);

				Yii::app() -> user -> setReturnUrl(array('videochat/index'));
				$this -> redirect(Yii::app() -> user -> returnUrl);
			}
		}

		$this -> render("login", array(
			"loginForm" => $loginForm,
		));
	}

	public function actionLogout() {
		Yii::app() -> user -> logout();
		$this -> redirect(Yii::app() -> homeUrl);
	}

	public function actionError() {
        $error = Yii::app()->errorHandler->error;
        if ($error) {
            $this->render('error', array('error'=>$error));
        } else {
            throw new CHttpException(404, 'Page not found.');
        }
    }
}