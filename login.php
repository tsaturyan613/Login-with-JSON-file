Click here to <a href="logout.php" title="Logout"> Logout </a>
<?php
session_start();
$id = $_GET['id'];

echo $id;

echo $_SESSION['email'];

if(empty($_SESSION['email'])){
    	unset($_SESSION['email']);
	header('Location: index.php');
};

if (isset($_POST['submit'])) {
 	$target_dir = "upload/";
	$target_file = basename($_FILES["file"]["name"]);
 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir .$target_file)) {

		if (file_exists('data.json')) {
		$current_data = file_get_contents('data.json');
		$array_data = json_decode($current_data);

		$ddd = file_get_contents('data.json');
		$sss = json_decode($ddd);
		$emails=[];
		foreach ($sss as $key) {
			$emails[]=$key->email;
		}
			if ($array_data[$id]->email == $emails[$id]) {
				$array_data[$id]->image = $target_file;
				$finel_data = json_encode($array_data,JSON_PRETTY_PRINT);
				file_put_contents('data.json', $finel_data);
			}else{
				echo "chexav";
			};

}
header("Location: login.php?id=$id");
 	}else{
 		echo "lracreq dashtere";
 	}


	}

if (isset($_POST['insert'])) {

 $countfiles = count($_FILES['file']['name']);
 $dd_file=[];
 for($i=0;$i<$countfiles; $i++){
 $filename = $_FILES['file']['name'][$i];
 $target_dirr = "upload/";
 $tt_file = $_FILES['file']['tmp_name'][$i];
 $dd_file = basename($filename);
 if(move_uploaded_file($tt_file,$target_dirr .$dd_file)){
		if (file_exists('data.json')) {

		$ddd = file_get_contents('data.json');
		$sss = json_decode($ddd);
		$emails=[];
		foreach ($sss as $key) {
			$emails[]=$key->email;
		}
		foreach ($sss[$id] as $key=>$values) {
			print_r($values);
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
		}

		$current_data = file_get_contents('data.json');
		$array_data = json_decode($current_data);
		
			if ($array_data[$id]->email == $emails[$id]) {
				$array_data[$id]->images[] = $dd_file;
				$finel_data = json_encode($array_data,JSON_PRETTY_PRINT);
				file_put_contents('data.json', $finel_data);
				}
				// }
			else{
				echo "chexav";
			};

}
header("Location: login.php?id=$id");
}else{
	echo "lracreq dashtere";
}
}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<!-- <a href="index.php">Login/Register</a> -->
<form method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; width: 30%; margin-top: 50px; padding: 25px; background-color: lightgreen; border-radius: 11px;border: 2px solid gray">
	<label for="image">image</label>
	<input type="file" name="file" style="margin-top: 20px;">
	<input type="submit" name="submit" style="margin-top: 20px;">
</form>
<form method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; width: 30%; margin-top: 50px; padding: 25px; background-color: lightgreen; border-radius: 11px;border: 2px solid gray">
		<label for="gallery" style="margin-top: 20px;">Gallery</label>
	<input type="file" name="file[]" style="margin-top: 20px;" multiple="multiple">
	<input type="submit" name="insert" style="margin-top: 20px;">
</form>
<?php
$current_data = file_get_contents('data.json');
		$array_data = json_decode($current_data);
  ?>
  <div style="width: 100%;display: flex; justify-content: space-around;">
  <div style="width: 200px; height: 250px;text-align: center;">
  	<h1>Profile Pic</h1>
  	<div style="width: 200px; height: 200px;border: 2px solid gray; border-radius: 50%; ">
<img src="upload/<?= $array_data[$id]->image ?>" style="width: 100%; height:100%;object-fit: cover; border-radius: 50%;">
  	</div>
  	<h1><?= $array_data[$id]->name ?></h1>

  </div>
<div style="width: 400px; height: 650px;text-align: center;">
	<h1>Gallery</h1>
<div style="width: 100%;display: flex;flex-wrap: wrap;">
	<?php foreach ($array_data[$id]->images as $key) { ?>
		<img src="http://log.loc/upload/<?= $key ?>" style="width: 35%;object-fit: cover; margin-right: 25px; margin-left: 25px; margin-top: 25px;">
<?php 	} ?>
</div>
</div>
</div>
</body>
</html>
