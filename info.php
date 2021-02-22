<?php
	// Connect to database
	include("db_connect.php");
	mysqli_query($conn, "SET CHARACTER SET utf8");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getInfos()
	{
		global $conn;
		$query = "SELECT * FROM info";
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

    function getLastInfo()
    {
		global $conn;
		$query = "SELECT * FROM info ORDER BY id_info DESC LIMIT 1";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
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
			if(!empty($_GET["last"]))
			{
				if($_GET["last"] == true) {
					getLastInfo();
				}
			} else {
				getInfos();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
?>