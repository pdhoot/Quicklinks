<?php
session_start();
$conn = new mysqli("localhost" , "root" , "1234","Project");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
$username = $_SESSION['username'];
$link = $_GET['link'];
$ind = $_GET['id_no'];
//echo $ind;
//print_r($_GET);
//echo "Hello";
//echo $username;
//echo "\n";
//echo $link;
$count =0;
//WHERE User='$username' AND Link ='$link'
//AND index='$ind'
$sql = "SELECT count FROM posts WHERE post='$link' AND id =$ind ";
$result = $conn->query($sql);
//var_dump($result);
//var_dump($conn);
if($result->num_rows > 0)
{
	echo "aaaaa";
	while($row = $result->fetch_assoc())
	{
		$count = $row['Count'];
		echo $count;

		$count+=1;
		echo $count;

	} 
	$sal = "UPDATE UserData SET Count = $count WHERE Link ='$link' WITH id = $ind";
	$conn->query($sal);
}
header("Location: http://".$link."");
?>