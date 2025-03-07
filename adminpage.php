<!DOCTYPE html>

	<head>
		<title>Donate The blood</title>
		<meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="blood Donation Website">
        <meta name="author" content="Rupesh & Krishna">

        <link rel="stylesheet" href="css/styles.css">

		<!-- Bootstrap Link CSS Files -->
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

        <!-- Custom Link CSS Files -->
		<link rel="stylesheet" href="css/custom.css">

		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

	</head>



	<?php
include 'include/config.php';
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include 'include/adminnav.php';
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM donor WHERE id = ?";
    
    if ($stmt = mysqli_prepare($connection, $delete_sql)) {
        mysqli_stmt_bind_param($stmt, "i", $delete_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
		echo "<script>alert('Donor deleted successfully!'); window.location.href='adminpage.php';</script>";
    } else {
        echo "<script>alert('Error deleting donor.');</script>";
    }
}
?>

<style>
	.size{
		min-height: 0px;
		padding: 60px 0 40px 0;

	}
	.loader{
		display:none;
		width:69px;
		height:89px;
		position:absolute;
		top:25%;
		left:50%;
		padding:2px;
		z-index: 1;
	}
	.loader .fa{
		color: #e74c3c;
		font-size: 52px !important;
	}
	.form-group{
		text-align: left;
	}
	h1{
		color: white;
	}
	h3{
		color: #e74c3c;
		text-align: center;
	}
	.red-bar{
		width: 25%;
	}
	span{
		display: block;
	}
	.name{
		color: #e74c3c;
		font-size: 22px;
		font-weight: 700;
	}
	.donors_data{
		background-color: white;
		border-radius: 5px;
		margin:20px 5px 0px 5px;
		-webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		-moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		padding: 20px;
	}
</style>
<div class="container" style="padding: 60px 0;">
    <div class="row data">
        <?php
        $sql = "SELECT * FROM donor";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $url = $row['link'];
                echo '<div class="col-md-3 col-sm-12 col-lg-3 donors_data">
                        <span> <img class="img-responsive" width="100" height="130" src="images/' . $row['image'] . '" /> </span>
                        <span class="name"> ' . $row['name'] . ' </span>
                        <span> ' . $row['city'] . ' </span>
                        <span> ' . $row['blood_group'] . ' </span>
                        <span> ' . $row['gender'] . ' </span>
                        <span> ' . $row['email'] . ' </span>
                        <span> ' . $row['contact_no'] . ' </span>
                        <span> <a href="' . $url . '" >Facebook profile</a> </span>
						<a href="?delete_id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this donor?\');" class="btn btn-danger">Delete</a>
					  </div>';
            }
        } else {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Data not found.</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
        }
        ?>
    </div>
</div>


<?php

	include ('include/footer.php');

?>
