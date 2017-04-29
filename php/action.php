<?php include("db.php");?>

<?php
	header('Content-Type: application/json');
	 if($_SERVER['REQUEST_METHOD'] == "GET"){
	  	$key = $_GET['action'];
	  	//print_r(json_encode($key));
	  	if ($key == "workers") {	
  			$query = mysqli_query($con,"SELECT * FROM `workers`");
  			$numWorker = mysqli_num_rows($query);
  			$result = array();
  			for ($i=1; $i <= $numWorker; $i++) { 
			  	$query1 = mysqli_query($con,"SELECT * FROM `workers` WHERE `id` = '$i'");
			  	$index = $i - 1;
			  	$result[$index] = mysqli_fetch_assoc($query);
  			}
  			print(json_encode($result));
	  	}else if ($key == "comments") {
	  		$query = mysqli_query($con, "SELECT * FROM `comments`");
			$numberOfComments = mysqli_num_rows($query);
			$comments = array();
			for ($i=0; $i < 3; $i++) { 
				$number = rand(1,$numberOfComments);
				$subQuery = mysqli_query($con, "SELECT * FROM `comments` WHERE `commentID` = '$number'");
				$comments[$i] = mysqli_fetch_assoc($subQuery);
			}
			print(json_encode($comments));
		}
	 }elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
	 		$jsonObject = file_get_contents("php://input");
	 		$jsonArray = json_decode($jsonObject,true);
	 		$response = array();

	 		if($jsonArray['data']['key'] == "postingComments"){
	 			$username = $jsonArray['data']['name'];
		 		$userComment = $jsonArray['data']['comment'];
		 		$query = mysqli_query($con, "INSERT INTO `comments` (`name`,`comment`) VALUES ('$username', '$userComment')");
		 		if($query){
		 			$response['response'] = "success message";
		 		}else{
		 			$response['response'] = "failure message";
		 		}
		 		print(json_encode($response));
	 		}
	 }


?>

