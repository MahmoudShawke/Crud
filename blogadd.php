<?php
require('function.php');
require('connection/connect.php');


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $errors    = [];
    $title     = Clean($_POST['title']);
    $content   = Clean($_POST['content']);
    $date      = Clean($_POST['date']);
    $image     = $_FILES['image'];
  
    $tit     = validatetitle($title);
    $cont    = validatecontent($content);
    $file    = validatefile($image);
    $date    = validateDate($date);
   

    if (!empty($title) && !empty($content) &&!empty($file)&& !empty($date)) {
       
        $sqlstmt="insert into blogs (title,content,image,date) values('$tit','$content','uploads/$file','$date')";
        $op=mysqli_query($con,$sqlstmt);
        if($op){
            header('location:index.php');
            $_SESSION['Message']="Row Inserted";
        }else{
           echo 'con';
        }
     
  
     
    }
    elseif(empty($date)||!empty($image) ){
   
     
      $errors['Date']   = "*";
      
     
    }
   
  
      
   
  }
?>
<html>

<head>
  <title>ِBlog Details</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">
    <h2>Blog Details</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <?php

        if (isset($_POST['title'])) {
          if (!empty($errors['Title'])) {
            echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            ' . $errors['Title'] . '
             </div>';
          } else {
            echo "<p> <font color=green>Valid Data </font> </p>";
            
          }
        }
        ?>

      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Content</label>
        <input type="textarea" name="content" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

        <?php

        if (isset($_POST['content'])) {
          if (!empty($errors['Content'])) {

            echo '<div class="alert alert-danger" role="alert">
           <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
           <span class="sr-only">Error:</span>
           ' . $errors['Content'] . '
            </div>';
          } else {
            echo "<p> <font color=green>Valid Data </font> </p>";
           
          }
        }
        ?>


      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Image</label>
        <input type="file" name="image" class="form-control" id="exampleInputPassword1">
        <?php
        if (isset($_POST['register'])) {
          if (!empty($errors['Image'])) {
            echo '<div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          ' . $errors['Image'] . '
           </div>';
          } else {
            echo "<p> <font color=green>Uploaded Successfully </font> </p>";
          }
        }
        ?>

      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Date</label>
        <input type="date" name="date" class="form-control" id="exampleInputPassword1">
        <?php
        if (isset($_POST['register'])) {
          if (!empty($errors['Date'])) {
            echo '<div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          ' . $errors['Date'] . '
           </div>';
          } else {
            echo "<p> <font color=green>Uploaded Successfully </font> </p>";
          }
        }
        ?>

      </div>

      <button type="submit" name="register" class="btn btn-primary">Add Blog</button>


    </form>
  </div>

</body>

</html>