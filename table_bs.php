<?php require_once("header.php"); ?>
<?php
	// table.php

	//getting our config
	require_once("../../config.php");

	//create connection
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_carmet");


	/*
		IF THERE IS ?DELETE=ROW_ID in the url
	*/
	if(isset($_GET["delete"])){

		echo "Deleting row with id:".$_GET["delete"];

		// NOW() = current date-time
		$stmt = $mysql->prepare("UPDATE printing service SET deleted=NOW() WHERE id = ?");

		echo $mysql->error;

		//replace the ?
		$stmt->bind_param("i", $_GET["delete"]);

		if($stmt->execute()){
			echo "deleted successfully";
		}else{
			echo $stmt->error;
		}

		//closes the statement, so others can use connection
		$stmt->close();

	}



	//SQL sentence
	$stmt = $mysql->prepare("SELECT id, document_name, pages, color_or_bw,  FROM printing service WHERE deleted IS NULL ORDER BY created DESC ");

	//WHERE deleted IS NULL show only those that are not deleted

	//if error in sentence
	echo $mysql->error;

	//variables for data for each row we will get
	$stmt->bind_result($id,$document_name,$pages,$color_or_bw);

	//query
	$stmt->execute();

	$table_html = "";
	$sum=0;
	//add smth to string .=
	$table_html .= "<table class='table table-striped'>";
		$table_html .= "<tr>";
			$table_html .= "<th>ID</th>";
			$table_html .= "<th>document_name</th>";
			$table_html .= "<th>pages</th>";
				$table_html .= "<th>color_or_bw</th>";
			//$table_html .= "<th>Created</th>";
			$table_html .= "<th>Print</th>";
		$table_html .= "</tr>";

	// GET RESULT
	//we have multiple rows

	while($stmt->fetch()){
			$sum=$sum+$amount;


		//DO SOMETHING FOR EACH ROW
		//echo $id." ".$message."<br>";
		$table_html .= "<tr>"; //start new row
			$table_html .= "<td>".$id."</td>"; //add columns
			$table_html .= "<td>".$document_name."</td>";
			$table_html .= "<td>".$pages."</td>";
			$table_html .= "<td>".$color_or_bw."</td>";
			//$table_html .= "<td>".$created."</td>";
			$table_html .= "<td>

								<a class='btn btn-danger'
								href='?print=".$id."'>X</a>
							</td>";

		$table_html .= "</tr>"; //end row
	}
	$table_html .= "</table>";




	//echo $table_html;



?>


		<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>

		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		  <ul class="nav navbar-nav">


			<li class="active" >
				<a href="table_b.php">
					Table
				</a>
			</li>

		  </ul>

		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

		<h1> This is the Table page </h1>

    <?php echo $table_html; ?>
        <?php echo $sum; ?>



	</div>







  </body>
</html>
