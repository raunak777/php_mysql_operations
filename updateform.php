<?php
session_start();

if(!isset($_SESSION['username']))
{
  header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<?php include 'config.php'; 
	include 'connection.php';
	$id= $_GET['id'];
	$select= "select * from register where id={$id}";
	$res= $conn->query($select);
	if ($res->num_rows>0) {
		while ($rows= $res->fetch_assoc()) {
			?>
			<div class="div1">
				<h1>Update Data</h1><hr>
				<form method="POST" action="">
					<input type="hidden" name="id"  value="<?php echo $rows['id']?>" />
					<label for="pname">Parent(s) Name(s)</label>
					<input type="text" id="pname" name="pname" value="<?php echo $rows['parents']?>">

					<label for="email">Email Address</label>
					<input type="email" id="email" name="email" value="<?php echo $rows['email']?>">

					<label for="sname">Student's Name</label>
					<input type="text" id="sname" name="sname" value="<?php echo $rows['sname']?>" >
					<label>Student Gender</label><br>
					<input type="radio" name="gender" value="male" <?php if($rows['sgender'] == 'male') {echo "checked";}?> >
					<label>Male</label><br>
					<input type="radio" name="gender" value="female" <?php if ($rows['sgender'] == 'female') {echo "checked";}?> >
					<label>Female</label><br><br>
					<label for="mob">Student's Birthday</label>
					<input type="date" id="birthday" name="birth" value="<?php echo $rows['sbirthday']?>" >
					<label for="mob">Contact number</label>
					<input type="text" id="mobile" maxlength="10" name="mobile" value="<?php echo $rows['contact']?>" >
					<label for="address">Address</label>
					<input type="text" id="address" name="address" value="<?php echo $rows['address']?>" >
					<label for="city">City</label>
					<input type="text" id="city" name="city" value="<?php echo $rows['city']?>" >
					<label for="code">Zip code</label>
					<input type="number" id="code" name="code" value="<?php echo $rows['zipcode']?>" onKeyPress="if(this.value.length==6) return false;" >
					<input type="submit" name="update" value="Update">
				</form>
			</div>
			<?php 
		}
	} ?>
</div>
</body>
<?php
if (isset($_POST['update'])) {
	extract($_POST);
	$rawdate = htmlentities($_POST['birth']);
  	$birth = date('Y-m-d', strtotime($rawdate));
	$update="UPDATE register SET parents='{$pname}',email='{$email}',sname='{$sname}',sgender='{$gender}',sbirthday='{$birth}',contact='{$mobile}',address='{$address}',city='{$city}',zipcode='{$code}' WHERE id= '{$id}'";
	$conn->query($update) or die("Can't update");

	header("Location: adminhome.php");
}
?>
</html>
