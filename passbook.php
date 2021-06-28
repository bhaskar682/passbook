
<?php
include('connection.php');	
include('inc/header.php');	


if(isset($_POST['subtn']))
    {
      
      $description= $_POST['description'];
      $amount=$_POST['amount'];
        $query_bal= mysqli_query($con,"SELECT `balance` from `passbook`  ORDER BY `id` DESC LIMIT 1");
/*        $count=mysqli_num_rows($query_bal);
*/        $row=mysqli_fetch_array($query_bal);
        $total=$row['balance'];
       $total=$total+$amount;
       
$sql=mysqli_query ($con,"INSERT INTO `passbook` (`description`,`amount`,`balance`) VALUES ('$description','$amount', '$total')");

   if ($sql==true) 
    	{ 
           echo "New record created successfully";
    	}
      else 
      {
           echo "Error: " . $sql . "" . mysqli_error($con);
      }
  }
  ?>
<html>
<title> Passbook </title>
<body>
<h1> Passbook of employee</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Enter the details of the employee </br>
<fieldset>
Description:  <input type="text" name="description" />
Amount:  <input type="number" name="amount" />
        

<input type="submit" value="Save" name="subtn"/>
</fieldset>
<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Passbook details</h4>
                                   
                                </div>
                                <div class="card-body table-full-width table-responsive">

            <?php
                $query = "SELECT * FROM passbook";
                $query_run = mysqli_query($con, $query);
            ?>

                                    <table class="table table-hover table-striped">
                                        <thead>
                        <tr>
                            <th> Description </th>
                            <th> Amount </th>
                             <th> Balance </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(mysqli_num_rows($query_run) > 0)        
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                            <tr>
                                <td><?php  echo $row['description']; ?></td>
                                <td>
                                    <?php
                                     if ($row['amount']>0)
                                    {

                                        echo "<span style='color:green'>" .$row['amount']."</span>";
                                    }
                                    else
                                    {
                                        echo "<span style='color:red'>".$row['amount']."</span>";
                                    }

                                 ?>
                                </td>
                                
                                <td><?php  echo $row['balance']; ?></td>
                                
                                <td>
                                    
                                    </form>
                                </td>
                                
                            </tr>
                        <?php
                            } 
                        }
                        else {
                            echo "No Record Found";
                        }
                        ?>
                    </tbody>
               </table>
                                </div>
                            </div>
                        </div>
</form>
</body>
</html>
