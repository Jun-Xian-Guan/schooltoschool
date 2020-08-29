<?php



session_start();

include_once('includes/header.php');
include_once('includes/Userdbconfig.php');



//include_once("dbconn.php");


/*$sqls="SELECT * FROM staff";


$result = mysql_query($sqls, $conn);

$row_num = mysql_num_rows($result);

echo $row_num."<br>";

while ($row = mysql_fetch_assoc($result) {
	foreach ($row as $key => $value) {
		echo $value."<br>";
	}

}


$conn->close();*/

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

// $obj['username'];
// $obj['password'];

$username = $obj['username'];
$PWD = $obj['password'];

$isFound=false;
$fetchdata;
$keys;
$usertoken;

if($username!="" && $PWD!="" && isset($username) && isset($PWD) ){
	if(!$isFound){
		$ref="users/staff/";
		$fetchdata=$userDB->getReference($ref)->getValue();
		if($fetchdata){
			$keys = array_keys($fetchdata);
			for($i=0;$i<count($keys);$i++) {
				if($keys[$i] == $username){
					$usertoken=$keys[$i];
					$isFound=true;
					break;
				}
			}
		}
		else{
			echo json_encode("net");
		}
		
	}
	

	if(!$isFound){
		$ref="users/parents/";
		$fetchdata=$userDB->getReference($ref)->getValue();
		if($fetchdata){
			$keys = array_keys($fetchdata);
			for($i=0;$i<count($keys);$i++) {
				if($keys[$i] == $username){
					$usertoken=$keys[$i];
					$isFound=true;
					break;
				}
			}
		}
		else{
			echo json_encode("net");
		}
		
	}
	

	if(!$isFound){
		$ref="users/students/";
		$fetchdata=$userDB->getReference($ref)->getValue();
		if($fetchdata){
			$keys = array_keys($fetchdata);
			for($i=0;$i<count($keys);$i++) {
				if($keys[$i] == $username){
					$usertoken=$keys[$i];
					$isFound=true;
					break;
				}
			}
		}
		else{
			echo json_encode("net");
		}
		
	}
	
	if($isFound)
	{
		//echo $fetchdata[$usertoken]['Name'];

		echo json_encode('ok');
	}
	else{
		echo json_encode("wrong");
	}
	
}else{
	echo json_encode("fail");
}


?>

<?php include_once('includes/footer.php');?>