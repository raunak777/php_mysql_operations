<?php
include 'connection.php';
extract($_POST);
if($data=='yes'){
	$select= "select * from register";
	$res= $conn->query($select);	
}
else if ($data == 'no') {
	
		$select= "select * from register ORDER BY {$column} {$sort}";
		$res= $conn->query($select);
}
else if ($data == 'filter') {
	$qu= "select * from register where id like '%{$livesearch}%' or parents like '%{$livesearch}%' or email like '%{$livesearch}%' or sname like '%{$livesearch}%' or sgender like '%{$livesearch}%' or sbirthday like '%{$livesearch}%' or contact like '%{$livesearch}%' or address like '%{$livesearch}%' or city like '%{$livesearch}%' or zipcode like '%{$livesearch}%'";
		$res= $conn->query($qu);
}
$output="";
if ($res->num_rows>0) {
	$output="<table border='1px' width='100%' cellspacing='0' cellpading='10px'>
	<tr height='50px' class='bg-success'>
	<th width='100px'>Std ID</th>
	<th>Parents Name</th>
	<th>Student Name</th>
	<th>Gender</th>
	<th>Birth Date</th>
	<th>Email address</th>
	<th>Mobile number</th>
	<th>Address</th>
	<th >Update</th>
	<th >Delete</th>
	</tr>
	";
	while ($rows= $res->fetch_assoc()) {
		$output.="<tr>
		<td>". $rows['id'] ."</td>
		<td>". $rows['parents'] ."</td>
		<td>". $rows['sname'] ."</td>
		<td>". $rows['sgender'] ."</td>
		<td>". $rows['sbirthday'] ."</td>
		<td>". $rows['email'] ."</td>
		<td>". $rows['contact'] ."</td>
		<td>". $rows['address'] .' '. $rows['city'].' '.$rows['zipcode'] ."</td>
		<td><button class='edit-btn btn btn-success mb-2 btn-sm' data-eid='{$rows['id']}' >Edit</button></td>
		<td><button class='del-btn btn btn-danger mb-2 btn-sm' data-did='{$rows['id']}'>Delete</button></td>
		<tr>";
	}
	$output.="</table>";
	$conn->close();
	echo $output;
}
else{
	echo "<h2 class='text-danger text-center'><strong>Record Not found!</strong></h2>";
}

?>