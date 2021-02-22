<?php
	// Connect to database
	include("db_connect.php");
	mysqli_query($conn, "SET CHARACTER SET utf8");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getFaq()
	{
		global $conn;
		$query = "SELECT * FROM faq";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_assoc($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	switch($request_method)
	{
		
		case 'GET':
			// Retrive Products
            getFaq();
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
?>