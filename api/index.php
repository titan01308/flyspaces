<?php
function deliver_response($response){
	$http_response_code = [
		100 => 'Continue',  
		101 => 'Switching Protocols',  
		200 => 'OK',
		201 => 'Created',  
		202 => 'Accepted',  
		203 => 'Non-Authoritative Information',  
		204 => 'No Content',  
		205 => 'Reset Content',  
		206 => 'Partial Content',  
		300 => 'Multiple Choices',  
		301 => 'Moved Permanently',  
		302 => 'Found',  
		303 => 'See Other',  
		304 => 'Not Modified',  
		305 => 'Use Proxy',  
		306 => '(Unused)',  
		307 => 'Temporary Redirect',  
		400 => 'Bad Request',  
		401 => 'Unauthorized',  
		402 => 'Payment Required',  
		403 => 'Forbidden',  
		404 => 'Not Found',  
		405 => 'Method Not Allowed',  
		406 => 'Not Acceptable',  
		407 => 'Proxy Authentication Required',  
		408 => 'Request Timeout',  
		409 => 'Conflict',  
		410 => 'Gone',  
		411 => 'Length Required',  
		412 => 'Precondition Failed',  
		413 => 'Request Entity Too Large',  
		414 => 'Request-URI Too Long',  
		415 => 'Unsupported Media Type',  
		416 => 'Requested Range Not Satisfiable',  
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',  
		501 => 'Not Implemented',  
		502 => 'Bad Gateway',  
		503 => 'Service Unavailable',  
		504 => 'Gateway Timeout',  
		505 => 'HTTP Version Not Supported'
		];

	header('HTTP/1.1 '.$response['status'].' '.$http_response_code[ $response['status'] ]);

	header('Content-Type: application/json; charset=utf-8');

	$json_response = json_encode($response['data']);

	echo $json_response;
	exit;
}

$response['status'] = 404;
$response['data'] = NULL;
$url_array = explode('/', $_SERVER['REQUEST_URI']);

$method = $_SERVER['REQUEST_METHOD'];

require_once("order.php");
$order = new Order();	
if($method == 'GET'){
	if(!isset($url_array[5])){ 

		$data = $order->getAllOrder();
		$response['status'] = 200;
		$response['data'] = $data;
	}else{ 

		$id = $url_array[5];
		$data = $order->getOrder($id);
		if(empty($data)) {
			$response['status'] = 404;
			$response['data'] = ['error' => 'Record does not exist'];	
		}else{
			$response['status'] = 200;
			$response['data'] = $data;	
		}
	}
}
elseif($method == 'POST'){
	
	$post = (object)$_POST;
	$post->order = json_encode([
		'bread' => $post->bread,
		'sauce' => $post->sauce,
		'sandwichType' => $post->sandwichType,
		'cheese' => $post->cheese,
		'veggies' => $post->veggies,
	]);


	if($post->name == "" || $post->email == ""){
		$response['status'] = 400;
		$response['data'] = ['error' => 'Please complete all fields!'];
	}else{
		$status = $order->insertOrder($post->name, $post->email, $post->order);
		if($status == 1){
			$response['status'] = 201;
			$response['data'] = ['success' => 'Order is complete!'];
		}else{
			$response['status'] = 400;
			$response['data'] = ['error' => 'Something bad happened!'];
		}
	}
}
elseif($method == 'PUT'){

	$json = file_get_contents('php://input');
	$datum = urldecode($json);
	parse_str($datum,$datas);
	$post = (object)$datas;	

	$data = $order->getOrder($post->id);
	if(empty($data)) { 
		$response['status'] = 404;
		$response['data'] = ['error' => 'Record does not exist!'];	
	}else{
		$order->name = $post->name;
		$order->email = $post->email;
		$order->order = json_encode([
			'bread' => $post->bread,
			'sauce' => $post->sauce,
			'sandwichType' => $post->sandwichType,
			'cheese' => $post->cheese,
			'veggies' => $post->veggies,
		]);

		if($post->name == "" || $post->email == "") {
			$response['status'] = 400;
			$response['data'] = ['error' => 'Please complete fields!'];
		}else{
			$status = $order->updateOrder($post->id, $order->name, $order->email, $order->order);
			if($status==1){
				$response['status'] = 200;
				$response['data'] = ['success' => 'Record successfully updated!'];
			}else{
				$response['status'] = 400;
				$response['data'] = ['error' => 'Failed to update record!'];
			}
		}
	}
	
}
elseif($method == 'DELETE'){
	
	if(isset($url_array[5])){
		$id = $url_array[5];

		$data = $order->getOrder($id);
		if(empty($data)) {
			$response['status'] = 404;
			$response['data'] = ['error' => 'Order does not exist'];	
		}else{
			$status = $order->deleteOrder($id);
			if($status == 1){
				$response['status'] = 200;
				$response['data'] = ['success' => 'Order is deleted!'];
			}else{
				$response['status'] = 400;
				$response['data'] = ['error' => 'Failed to delete order'];
			}
		}
	}
}

deliver_response($response);
?>
