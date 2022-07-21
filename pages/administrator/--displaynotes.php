<!doctype html>
<html lang="en">
    <head>
        <title>Notes AJAX</title>

        <?php include '--header.php' ?>

    </head>

    

    <body>

    <div class="row" >
               
               <style>
               .col-sm-12:nth-child(4n+2) .card-body  {
                 background-color: #003049; color: white;
               }
               .col-sm-12:nth-child(4n+3) .card-body  {
                 background-color: #D62828; color: white;
               }
               .col-sm-12:nth-child(4n+4) .card-body  {
                 background-color: #F77F00; color: white;
               }
               .col-sm-12:nth-child(4n+5) .card-body  {
                 background-color: #FCBF49; color: white;
               }
               
               .container .col-sm-12{
                 padding-top:5px;
               }
               .container .col-sm-12 .card-body{
                 border-radius: 10px;
               }
               
               body.dark input[type=text], textarea[type=text] {
                 background-color: var(--sidebar-color);
                 color: var(--text-color);
               }
               
               input[type=text], textarea[type=text] {
                 background-color: var(--sidebar-color);
                 color: var(--text-color);
               }
               </style>

<?php
                    session_start();
                    error_reporting(0);
                    ini_set('display_errors', 0);

                    function custom_echo($x, $length) {
                        if(strlen($x)<=$length) {
                            echo $x;
                        } else {
                            $y=substr($x,0,$length) . ' ...';
                            echo $y;
                        }
                    }


                    // Include config file
                    require_once "--config.php";
                    $sql = "SELECT * FROM notes ORDER by RAND()";
                    

                    
                    $val = $_POST['option'];
                    if($_REQUEST['action']=="data"){
                        $_SESSION['val']=$val;
                    }elseif ($val=="") {
                    // Attempt select query execution
                    if($_SESSION['val'] == "new"){
                      echo '<h6>NEWEST <i class="bi bi-sort-alpha-up-alt"></i></h6>';
                      $sql = "SELECT * FROM notes ORDER BY id DESC";
                    } elseif($_SESSION['val'] == "old"){
                      echo '<h6>OLDEST <i class="bi bi-sort-alpha-down"></i></h6>';
                      $sql = "SELECT * FROM notes ORDER BY id ASC";
                    } elseif($_SESSION['val'] == "fav"){
                      echo '<h6>FAVORITES <i class="bi bi-bookmark-check-fill"></i></h6>';
                      $sql = "SELECT * FROM notes WHERE priority = 1";
                    } 

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
  
                            while($row = mysqli_fetch_array($result)){
                                echo '<div class="col-sm-12">';
                                  echo '<div class="card-body">';
                                  


                                    echo '<div class="row">';
                                        echo '<div class="col-sm-5">';
                                            echo "<h6>". $row['date'] .'</h6>';
                                        echo '</div>';
                                        echo '<div class="col-sm-4" style="text-align:left;">';
                                            echo "<h6>". date('h:i A', strtotime($row['time'])) ."</h6>";
                                        echo '</div>';
                                        if($row['priority'] == 1){
                                          $icon = "bi bi-bookmark-fill";
                                        }elseif($row['priority'] == 0){
                                          $icon = "bi bi-bookmark";
                                        }
                                        echo '<div class="col-sm-3">';
                                            echo '<h6>';
                                                echo '<a href="notes.php?mode=view&id='.$row['id'].'#view" style="color:white;" title="View" class="bi bi-eye-fill"></a>&nbsp;';
                                                echo '<a href="notes.php?mode=star&id='.$row['id'].'" style="color:white;" title="Favorites" class="'.$icon.'"></a>&nbsp;';
                                                echo '<a href="notes.php?mode=delete&id='.$row['id'].'#delete" style="color:white;" title="Delete" class="bi bi-trash"></a>&nbsp;';
                                            echo '</h6>';
                                        echo '</div>';

                                        echo '<div class="row">';
                                            echo '<div class="col-sm-12">';
                                                echo "<h4>". stripslashes($row['title']) . "</h4>";
                                                echo '<h6 style="text-align: justify;">';
                                                custom_echo(stripslashes($row['content']), 90);
                                                echo "</h6>";
                                      echo '</div>';
                                    echo '</div>';
                                  echo '</div>';
                              echo "</div>";                            
                              echo "</div>";
                            }
                        

                            // Free result set
                            mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><h5><i class="bi bi-exclamation-triangle"></i> No records were found.</h5></div>';
                            }
                        } else{
                      echo '<div class="alert alert-warning"><h6><i class="bi bi-exclamation-triangle"></i><strong> Warning!</strong> No connection to the database.</h6></div>';
                    }
 
                    // Close connection
                    mysqli_close($link);
                }
?>
</div>
</body>
</html>
