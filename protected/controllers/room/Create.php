<?php
use OpenTok\OpenTok;
use OpenTok\Role;

class Create extends CAction
{
	public function run()
	{
		// Get the controller
		$controller = $this -> getController();

		// Get subscriber's id
		$subid = $controller -> subscriber -> id;

		// Get publisher's id
		$pubid = $controller -> publisher -> id;

		// Initialize room model
		$roomModel = new RoomModel();

		// Find room by attributes
		$room = $roomModel -> room(
			$pubid, $subid
		) -> find();

		// Initialize open tok library
        $opentok = new OpenTok(Yii::app()->params['vonage.key'], Yii::app()->params['vonage.secret']);

		if($room) {
			$OpenTokID = $room -> opentok_id;
			$roomID = $room -> id;
		} else {
			$session = $opentok -> createSession(array(
                'location'=>$controller->ip
            ));
			$OpenTokID = $session->getSessionId();

			$roomModel -> sessionid = $pubid;
			$roomModel -> to_sessionid = $subid;
			$roomModel -> opentok_id = $OpenTokID;

			$roomModel -> save();
			$roomID = $roomModel -> id;
		}

		$informer = new InformerModel();

		$inform = $informer -> issetInform($pubid, $subid) -> count();
		if(!$inform) {
			$informer -> sessionid = $pubid;
			$informer -> to_sessionid = $subid;
			$informer -> save();
		}

        $token = $opentok -> generateToken($OpenTokID, array(
            'role'       => Role::PUBLISHER,
            'expireTime' => Yii::app() -> params['param.token_time']
        ));

		$controller -> render("index", array(
			"publisher" => $controller -> publisher,
			"subscriber" => $controller -> subscriber,
			"token" => $token,
			"opentokid" => $OpenTokID,
			"roomid" => $roomID,
            "apiKey"=>Yii::app()->params['vonage.key'],
		));
	}
}