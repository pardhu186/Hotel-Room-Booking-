<!DOCTYPE html>
<html>
<head>
	<title>Customer acknowledgement</title>
	<meta name = "viewport" content = "width = device-width, initial-scale = 1">      
      <link rel = "stylesheet"
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<?php
        $db=new mysqli('localhost','root','','hotel');
        if (isset($_POST['geta']))
        {
        	$geta=$_POST['uname'];
        	$getp=$_POST['mobno'];
        	$sql="SELECT * FROM details WHERE name='$geta' AND pass='$getp'";
        	$result=$db->query($sql);
        }
        if(isset($_POST['pay']))
        {
        	$payin=$_POST['payamount'];
        	$payname=$_POST['accname'];
        	$payacc=$_POST['accno'];
        	$ins="INSERT INTO payment(amount,acname,acno) VALUES ('$payin','$payname','$payacc')";
        	if($db->query($ins))
        	{
        		echo '<script type="text/javascript">alert("Payment success!!");</script>';
        		echo '<script>location.href="intro.html"</script>';
        	}
        }
    ?>
<form method="post" action="ackn1.php" style="width: 40%; margin: 0 auto; padding-top: 5px;">
    <h4><center>Enter the login details</center></h4>
	<input type="text" name="uname" placeholder="Enter name">
	<input type="password" min="0" name="mobno" placeholder="Enter password">

	<button class="btn" type="submit" name="geta" style="margin-bottom: 20px; display: inline;">Get acknowledgement</button>
</form>
<table>
	<thead>
		<th>Name</th>
		<th>Contact</th>
		<th>Check in date</th>
		<th>Check out date</th>
		<th>Room No.</th>
		<th>Room type</th>
		<th>Amount</th>
	</thead>
	<?php
	if ($result->num_rows > 0){
	while ($rows=$result->fetch_assoc()) {
		?>	
	<tr>
		<td><?php echo $rows["name"];?></td>
		<td><?php echo $rows["mobile"];?></td>
		<td><?php  $temp1=$rows["date1"]; echo $rows["date1"];?></td>
		<td><?php  $temp2=$rows["date2"]; echo $rows["date2"];?></td>
		<td><?php  echo $rows["sno"]+100;?></td>
		<td><?php $temp3=$rows["room"]; if($temp3=='single(500/day)'){$mul=500;}
		else if($temp3=='double(750/day)')
		{
			$mul=750;
		} 
		else
		{
			$mul=1000;
		} 
		echo $rows["room"];?></td>
		<td><?php $date1=date_create("$temp1");
				  $date2=date_create("$temp2");
				  $diff=date_diff($date1,$date2); $dis=$diff->format("%a");echo $dis*$mul;?>
	    </td>
	</tr>
	<?php
}

}
?>
</table><br><br><br>
      <script>
  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
</body>
</html>