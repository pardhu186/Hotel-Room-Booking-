<!DOCTYPE html>
<html>
<head>
  <title>Select city - Hyderabad</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="cssa/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
  <?php
        $db=new mysqli('localhost','root','','hotel');
        if (isset($_POST['book'])) 
        {
          $temp=0;
          $setvar=' ';
          $name=$_POST['uname'];
          $num=$_POST['mobno'];
          $mail=$_POST['mailid'];
          $pw=$_POST['pass'];
          $rtype=$_POST['rtype'];
          $city=$_POST['city'];
          $cin=$_POST['cindate'];
          $cout=$_POST['coutdate'];
          $sql="INSERT INTO details(name,mobile,email,pass,city,date1,date2,room)
            VALUES ('$name','$num','$mail','$pw','$city','$cin','$cout','$rtype')";
          if(empty($name) || empty($num) || empty($mail) || empty($pw) || empty($rtype) || empty($cin) || empty($cout) || empty($city))
          {
            //$temp=1 ;
            $setvar="Please fill all the fields";
          }
          else
          {
          /*$mailidcheck=" SELECT * FROM details WHERE email='$mail' OR name='$name'";
          $result=$db-query($mailidcheck);
          $regyes=$result->num_rows;
          if($regyes>0)
          {
            echo '<script type="text/javascript">alert("Email or Userid exists already");</script>' ;
          }
          else
          {
          $sql="INSERT INTO details(name,mobile,email,address)
            VALUES ('$name','$num','$mail','$addr')";*/
          if($db->query($sql))
          {
            echo '<script type="text/javascript">alert("Registration success!!");</script>' ;
            echo("<script>location.href ='ackn.php';</script>") ;
          }
          }
        }

      ?>
      
  <form method="post" action="checkin1.php" style="width: 40%; margin: 0 auto; padding-top: 5px;">
    <div class="row">
  <label for="hyd"><h6>City</h6></label>
  <input type="text" value="Bangalore" readonly id="hyd" name="city">
      </div>

     <h4>Enter user details</h4><h6 style="color: #ef361a; display: inline;"><?php  echo $setvar;?></h6>
        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix">account_circle</i>
              <input type="text" name="uname" id="un"<br>
              <label for="un"><h6>Enter name</h6></label>
          </div>
        </div>
        <!--<div class="row">
            <div class="input-field">              
              <h6>Gender</h6>
                 <p style="display: inline;">
                    <label>
                    <input style="display: inline;" value="male" type="radio" name="gend" id="gen" />
                    <span>Male</span>
                    </label>
                </p>&nbsp&nbsp&nbsp
                <p style="display: inline;">
                    <label>
                    <input style="display: inline;" value="female" type="radio" name="gend" id="gen" />
                    <span>Female</span>
                    </label>
                </p>
            </div>
         </div> -->       
        <div class="row">
          <div class="input-field">
              <i class="material-icons prefix">phone</i>
              <input type="number" name="mobno" id="mn"<br>
              <label for="mn"><h6>Enter mobile number</h6></label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix">mail</i>
              <input type="email" name="mailid" id="mi"<br>
              <label for="mi"><h6>Enter E-mail ID</h6></label>
          </div>
        </div>

        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix">enhanced_encryption</i>
              <input type="password" name="pass" id="ad"<br>
              <label for="ad"><h6>Set Password</h6></label>
          </div>
        </div>
        <div class="row">
        <label for="cout"><h6>Check in and check out dates</h6></label>
          <div class="input-field col s6" style="display: inline;">
              <input style="display: inline; width: 200px;"  type="date" name="cindate" id="cin" class="datepicker">
          </div>      
          <div class="input-field col s6" style="display: inline">
              <input  style="display: inline; width: 200px;" type="date" name="coutdate" id="cout" class="datepicker"><br>
          </div>
        </div>
        <div class="row">
            <div class="input-field">              
              <h6>Select room type</h6>
                 <p style="display: inline;">
                    <label>
                    <input style="display: inline;" value="single(500/day)" type="radio" name="rtype" id="gen" />
                    <span>Single (500/-)</span>
                    </label>
                </p>&nbsp&nbsp&nbsp
                <p style="display: inline;">
                    <label>
                    <input style="display: inline;" value="double(750/day)" type="radio" name="rtype" id="gen" />
                    <span>Double (750/-)</span>
                    </label>
                </p>&nbsp&nbsp&nbsp
                <p style="display: inline;">
                    <label>
                    <input style="display: inline;" value="deluxe(1000/day)" type="radio" name="rtype" id="gen" />
                    <span>Deluxe (1000/-)</span>
                    </label>
                </p>
            </div>
         </div>
            <button class="btn" type="submit" name="book" style="margin-bottom: 20px; display: inline;">Book now</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <button class="btn" style="margin-bottom: 20px; display: inline;"><a href="index.html" style="text-decoration: none;color: white;">Cancel</a></button>

     </form>
     <script type="text/javascript" src="jsa/materialize.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>