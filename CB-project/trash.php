
<?php
if(isset($_GET['id'])){
	$link = mysqli_connect("localhost", "root", "", "db1");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    $get_id = $_GET['id'];
    $insert_category = "DELETE from appointments where aID = '$get_id'";
    $insert_cat = mysqli_query($link, $insert_category);
    header("Location: dummy.php");


}
