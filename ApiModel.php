<?php
require_once ("Database.php");


class ApiModel {

	private $_provider = null;

	private $_host = "www.mwahchat.com";
    private $_google_api_key = "AIzaSyAkzewSegPxm39WsKIREgGPozUkpQPTcHs";

	public function __construct() {
		$this -> _provider = new Database();
	}
	
	public function __destruct() {
		$this -> _provider = null;
	}

	public static function getInstance() {
		return new ApiModel();
	}
	
	public function provider() {
		return $this -> _provider;
	}

	private function push($deviceToken, $body = array()) {

		if ($deviceToken == "")
			return false;

		$deviceToken = strtolower(str_replace(array(" ", "-", "_"), array("", "", ""), $deviceToken));

		// Put your private key's passphrase here:
		$passphrase = 'rootroot1987';
		
		////////////////////////////////////////////////////////////////////////////////

		$ctx = stream_context_create();
//		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_pro.pem');
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_dev.pem');

		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		// Open a connection to the APNS server
		//gateway.push.apple.com
//		$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
		
		if (!$fp) {
			return false;
		}

		// Create the payload body
		/*
		 $body['aps'] = array(
		 'alert' => $message,
		 'sound' => 'default'
		 );
		 *
		 */

		// Encode the payload as JSON
		$payload = json_encode($body);

		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));

		if (!$result)
			return false;

		// Close the connection to the server
		fclose($fp);
		return true;
	}
	
	public function android_push($regids, $body = array()) {
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array('registration_ids' => $regids, 'data' => $body);
		
        $headers = array('Authorization: key=' . $this -> _google_api_key, 'Content-Type: application/json');

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        curl_close($ch);
        
    }

	public function registerDevice(){
		$device_id = $_POST['device_token'];
		$device_type = $_POST['device_type'];
		
		if(!$this -> provider() -> execute("INSERT INTO 'device' (id, device_id, device_type) VALUES (NULL, '$device_id', $_device_type)")){
			echo json_encode(array("fail" => "0"));exit;	
		}
		
		echo json_encode(array("success" => "1"));exit;	
	}
	
	public function sendPushNotification() {

		$message = $_POST['message'];		
		$devices = $this -> provider() -> result("SELECT * FROM device");
		
		for($i = 0; $i < count($devices); $i++){

			$device_type = $devices[$i]['device_type'];
			$device_id = $devices[$i]['device_id'];
			
			if($device_type == '1'){	// iphone
				$this -> push($device_id, array("aps" => array("alert" => $message)));
			}else{					// android				
				$this->android_push(array($device_id), array("message" => $message));
			}
		}
	}
}
