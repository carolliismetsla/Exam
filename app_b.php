<?php require_once("header.php"); ?>
<?php
 // require another php file
 // ../../=> 3 folders back
 require_once("../../config.php");
 $everything_was_okay = true;
 //*********************
 // TO field validation
 //*********************
 if(isset($_GET["document_name"])){ //if there is ?to= in the URL
   if(empty($_GET["document_name"])){ //if it is empty
     $everything_was_okay = false; //empty
     echo "Please enter the document name <br>"; // yes it is empty
   }else{
     echo "Document name: ".$_GET["document_name"]."<br>"; //no it is not empty
   }
 }else{
   $everything_was_okay = false; // do not exist
 }
 //check if there is variable in the URL
 if(isset($_GET["pages"])){

   //only if there is message in the URL
   //echo "there is amount";

   //if its empty
   if(empty($_GET["pages"])){
     //it is empty
     $everything_was_okay = false;
     echo "Please enter the pages! <br>";
   }else{
     //its not empty
     echo "pages: ".$_GET["pages"]."<br>";
   }

 }else{
   //echo "there is no such thing as amount";
   $everything_was_okay = false;
 }
 if(isset($_GET["color_or_bw"])){ //if there is ?to= in the URL
   if(empty($_GET["color_or_bw"])){ //if it is empty
     $everything_was_okay = false; //empty
     echo "Please enter if color or bw <br>"; // yes it is empty
   }else{
     echo "Color or BW: ".$_GET["color_or_bw"]."<br>"; //no it is not empty
   }
 }else{
   $everything_was_okay = false; // do not exist
 }


 /***********************
 **** SAVE TO DB ********
 ***********************/

 // ? was everything okay
 if($everything_was_okay == true){

   echo "Saving to database ... ";


   //connection with username and password
   //access username from config
   //echo $db_username;

   // 1 servername
   // 2 username
   // 3 password
   // 4 database
   $mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_carmet");

   $stmt = $mysql->prepare("INSERT INTO exam (document_name, pages, color_or_bw) VALUES (?,?,?)");

   //echo error
   echo $mysql->error;

   // we are replacing question marks with values
   // s - string, date or smth that is based on characters and numbers
   // i - integer, number
   // d - decimal, float

   //for each question mark its type with one letter
   $stmt->bind_param("sds", $_GET["document_name"], $_GET["pages"],$_GET["color_or_bw"]);

   //save
   if($stmt->execute()){
     echo "saved sucessfully";
   }else{
     echo $stmt->error;
   }


 }


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
     <a class="navbar-brand" href="#">Brand</a>
   </div>

   <!-- Collect the nav links, forms, and other content for toggling -->
   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

     <ul class="nav navbar-nav">

     <li class="active">
       <a href="app_b.php">
         App page
       </a>
     </li>


     <li>
       <a href="table_b.php">
         Table
       </a>
     </li>

     </ul>

   </div><!-- /.navbar-collapse -->
   </div><!-- /.container-fluid -->
 </nav>

 <div class="container">

   <h1 style="color:Purple;">This is the app</h1>
   <h2 style="color:black;">Printing  service</h2>

   <form>
     <div class="row">
       <div class="col-md-3 col-sm-6">
         <div class="form-group">
           <label for="document_name">Document name: </label>
           <input name="document_name" id="document_name" type="text" class="form-control">
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-md-3 col-sm-6">
         <div class="form-group">
           <label for="pages">Pages: </label>
           <input name="pages" id="pages" type="text" class="form-control">
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-md-3 col-sm-6">
         <label for="color_or_bw">Color or BW: </label>
         <input name="color_or_bw" id="color_or_bw" type="text" class="form-control">
       </div>
     </div>

         <input class="btn btn-success hidden-xs" type="submit" value="Save data ">
         <input class="btn btn-success btn-block visible-xs-block" type="submit" value="Save data 2">
       </div>
     </div>
   </form>




 </div>

  </body>
</html>
