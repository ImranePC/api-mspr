<?php
	// Connect to database
	include("db_connect.php");
	mysqli_query($conn, "SET CHARACTER SET utf8");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getConcerts()
	{
		global $conn;
		$query = "SELECT * FROM concert";
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

    function getConcert($id=0)
    {
		global $conn;
		$query = "SELECT * FROM concert";
		if($id != 0)
		{
			$query .= " WHERE id_concert =".$id." LIMIT 1";
		}
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
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				getConcert($id);
			}
			else
			{
				getConcerts();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter un produit
			//AddProduct();
			break;
			
		case 'PUT':
			// Modifier un produit
			//$id = intval($_GET["id"]);
			//updateProduct($id);
			break;
			
		case 'DELETE':
			// Supprimer un produit
			//$id = intval($_GET["id"]);
			//deleteProduct($id);
			break;

	}
?>