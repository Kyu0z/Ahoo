<?php
use OpenTok\OpenTok;
use OpenTok\Role;

class Join extends CAction
{
	public $room;

	public function __construct($controller, $id)
	{

		parent::__construct($controller, $id);

		// Find room by attributes
		if(!$this -> room = RoomModel::model() -> room(
			$this -> controller -> id, $controller -> publisher -> id
		) -> find()) {
			throw new CHttpException(400, Yii::t("app", "You don't have permissions to access this session"));
		}
	}

	public function run()
	{
		$controller = $this -> getController();

        // Initialize open tok library
        $opentok = new OpenTok(Yii::app()->params['vonage.key'], Yii::app()->params['vonage.secret']);

		InformerModel::model() -> deleteAll('to_sessionid=:publisherid AND sessionid=:to', array(
			':publisherid' => $controller -> publisher -> id,
			':to' => $controller -> subscriber -> id,
		));

        $token = $opentok -> generateToken($this -> room -> opentok_id, array(
            'role'       => Role::PUBLISHER,
            'expireTime' => Yii::app() -> params['param.token_time']
        ));

		$controller -> render("index", array(
			"publisher" => $controller -> publisher,
			"subscriber" => $controller -> subscriber,
			"token" => $token,
			"opentokid" => $this -> room -> opentok_id,
			"roomid" => $this -> room -> id,
            "apiKey"=>Yii::app()->params['vonage.key'],
		));
	}
}