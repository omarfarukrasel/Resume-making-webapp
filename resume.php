<?php 
session_start();
$fullname = "";
$email    = "";
$gender="";
$mobno="";
$a=array();
if(isset($_POST['submit'])){
        $_SESSION['fullname']=$_POST['fullname'];
       $_SESSION['gender']=$_POST['gender'];
        $_SESSION['email']=$_POST['mailid'];
        $_SESSION['mobno']=$_POST['mobno'];
        $_SESSION['objective']=$_POST['objective'];
$_SESSION['sscyear']=$_POST['sscdate'];
$_SESSION['hscyear']=$_POST['hscdate'];
$_SESSION['feyear']=$_POST['fedate'];
$_SESSION['seyear']=$_POST['sedate'];
$_SESSION['teyear']=$_POST['tedate'];
$_SESSION['beyear']=$_POST['bedate'];
$_SESSION['sscpercent']=$_POST['sscpercent'];
$_SESSION['hscpercent']=$_POST['hscpercent'];
$_SESSION['sem1']=$_POST['sem1pointer'];
array_push($a,$_SESSION['sem1']);
$_SESSION['sem2']=$_POST['sem2pointer'];
array_push($a,$_SESSION['sem2']);
$_SESSION['sem3']=$_POST['sem3pointer'];
array_push($a,$_SESSION['sem3']);
$_SESSION['sem4']=$_POST['sem4pointer'];
array_push($a,$_SESSION['sem4']);
$_SESSION['sem5']=$_POST['sem5pointer'];
array_push($a,$_SESSION['sem5']);
$_SESSION['sem6']=$_POST['sem6pointer'];
array_push($a,$_SESSION['sem6']);
$_SESSION['sem7']=$_POST['sem7pointer'];
array_push($a,$_SESSION['sem7']);
$_SESSION['sem8']=$_POST['sem8pointer'];
array_push($a,$_SESSION['sem8']);
$_SESSION['certification1']=$_POST['certification1'];
$_SESSION['certification2']=$_POST['certification2'];
$_SESSION['certification3']=$_POST['certification3'];
$_SESSION['certification4']=$_POST['certification4'];
$_SESSION['certification5']=$_POST['certification5'];
$_SESSION['beproj']=$_POST['beproj'];
$_SESSION['extproj1']=$_POST['extproj1'];
$_SESSION['extproj2']=$_POST['extproj2'];
$_SESSION['miniproj1']=$_POST['miniproj1'];
$_SESSION['miniproj2']=$_POST['miniproj2'];
$_SESSION['miniproj3']=$_POST['miniproj3'];
$_SESSION['responsibility1']=$_POST['responsibility1'];
$_SESSION['responsibility2']=$_POST['responsibility2'];
$_SESSION['achievement1']=$_POST['achievement1'];
$_SESSION['achievement2']=$_POST['achievement2'];
$_SESSION['achievement3']=$_POST['achievement3'];
$_SESSION['know']=$_POST['know'];
$_SESSION['additonalinfo']=$_POST['additonalinfo'];
$_SESSION['hobbies']=$_POST['hobbies'];
$_SESSION['branch']=$_POST['branch'];
$_SESSION['college']=$_POST['college'];
$_SESSION['university']=$_POST['university'];
$count=0;
for ($i=0; $i <8; $i++) {
        if($a[$i]==0) {
$count+=1;
        }
}
$sem=8-$count;
$avg=($_SESSION['sem1']+$_SESSION['sem2']+$_SESSION['sem3']+$_SESSION['sem4']+$_SESSION['sem5']+$_SESSION['sem6']+$_SESSION['sem7']+$_SESSION['sem8'])/$sem;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Build your Resume</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <style>
            li {
    font-size: 25px;
}
li p {
    font-size: 15px;
}
            </style>
    <script>
function myFunction() {
document.getElementById('print').style.display="none";
  window.print();
}
</script>
    <body style="font-size:15px;">
    <button id="print" onclick="myFunction()">Print my Resume</button>
        <div align=center style="width:100%;margin-top:30px;padding-left:5px;height:auto;border:2px solid black;">
            <div id="personal-info" style="height:auto;width:100%;">
        <div id="content" align=left style="padding:15px;">
            Name : <label><?php echo $_SESSION['fullname']; ?></label><br>
            Gender : <label  name="gender"><?php echo $_SESSION['gender']; ?><br>
            E-mail Address : <label  name="mail"><?php echo $_SESSION['email']; ?><br>
            Mobile No. : <label  name="mobno"><?php echo $_SESSION['mobno']; ?><br>
        </div>
        </div>
        <hr>
            <div id="career-objective" style="border:3px soild black;width:100%;height:auto;">
        <div id="content" style="text-align:left;padding:10px;">
<b>Career Objectives  :</b> <p align="justify"><?php echo $_SESSION['objective']; ?></p>
        </div>
</div>
<hr>
<div id="academic-bg" style="background-color:white;width:100%;height:auto;display:table;margin-left:0px;">
<div>
    <table id="table" style="margin:5px;font-size:12px;text-align:center" border="5" cellpadding="5" cellspacing="1">
        <tr>
            <th colspan="6" style="background-color:#D0D0CE;color:black;">ACADEMIC BACKGROUND</th>
</tr>
<tr>
        <td>B.E
        <td><?php echo $_SESSION['beyear']; ?> 
        <td>SEM 8<br><?php 
        if ($_SESSION['sem8']==0){
        echo 'Yet to appear';}
        else{
        echo $_SESSION['sem8'];
        }
          ?> 
        <td>SEM 7<br><?php 
        if ($_SESSION['sem7']==0){
        echo 'Yet to appear';
        }
        else{
        echo $_SESSION['sem7'];
        }
          ?>  
        <td rowspan="4">Department of <?php echo $_SESSION['branch']; ?> Engineering <br><?php echo $_SESSION['college']; ?><br><?php echo $_SESSION['university']; ?>
        <td rowspan="4">CGPA <br> <?php echo $avg; ?>
</tr>
<tr>
        <td>T.E
        <td><?php echo $_SESSION['teyear']; ?>
        <td>SEM 6<br><?php 
        if ($_SESSION['sem6']==0){
        echo 'Yet to appear';}
        else{
        echo $_SESSION['sem6'];
        }
          ?> 
        <td>SEM 5<br><?php 
        if ($_SESSION['sem5']==0){}
        echo 'Yet to appear';
}
        else
        echo $_SESSION['sem5'];
          ?> 
        
</tr>
<tr>
        <td>S.E
        <td><?php echo $_SESSION['seyear']; ?>
        <td>SEM 4<br><?php 
        if ($_SESSION['sem4']==0)
        echo 'Yet to appear';
        else
        echo $_SESSION['sem4'];
          ?> 
        <td>SEM 3<br><?php 
        if ($_SESSION['sem3']==0)
        echo 'Yet to appear';
        else
        echo $_SESSION['sem3'];
          ?> 
        
</tr>
<tr>
        <td>F.E
        <td><?php echo $_SESSION['feyear']; ?>
        <td>SEM 2<br><?php 
        if ($_SESSION['sem2']==0)
        echo 'Yet to appear';
        else
        echo $_SESSION['sem2'];
          ?> 
        <td>SEM 1<br><?php 
        if ($_SESSION['sem1']==0)
        echo 'Yet to appear';
        else
        echo $_SESSION['sem1'];
          ?> 
        
</tr>
<tr>
        <td>Class XII
        <td><?php echo $_SESSION['hscyear']; ?>
        <td colspan="3" align=center>HSC
        <td><?php echo $_SESSION['hscpercent']; ?>

</tr>
<tr>
        <td>Class X
        <td><?php echo $_SESSION['sscyear']; ?>
        <td colspan="3" align=center>SSC
        <td><?php echo $_SESSION['sscpercent']; ?>
</tr>
      
    </table>
</div>
</div>

<div id="certifications" style="border:3px soild black;height:auto;width:100%;">
<div style="background-color:#D0D0CE;color:black;"><h2 align=left>CERTIFICATIONS</h2></div>
        <div id="content" align=left style="margin:10px;">
        <ul type="disc">
         <li id="li9"><p align="justify"><?php 
         if ($_SESSION['certification1']!="") 
         echo $_SESSION['certification1']; 
         else
         echo '<script>document.getElementById("li9").style.display="none"</script>';
         ?></p>
         <li id="li10"><p align="justify"><?php 
         if ($_SESSION['certification2']!="") 
         echo $_SESSION['certification2']; 
         else
         echo '<script>document.getElementById("li10").style.display="none"</script>';
         ?></p>
         <li id="li11"><p align="justify"><?php 
         if ($_SESSION['certification3']!="") 
         echo $_SESSION['certification3']; 
         else
         echo '<script>document.getElementById("li11").style.display="none"</script>';
         ?></p>
         <li id="li12"><p align="justify"><?php 
         if ($_SESSION['certification4']!="") 
         echo $_SESSION['certification4']; 
         else
         echo '<script>document.getElementById("li12").style.display="none"</script>';
         ?></p>
         <li id="li13"><p align="justify"><?php echo $_SESSION['certification5']; ?>
         <?php 
         if ($_SESSION['certification5']!="") 
         echo $_SESSION['certification5']; 
         else
         echo '<script>document.getElementById("li13").style.display="none"</script>';
         ?>
        </p>
</ul>
</div>
        </div>
        <div id="Proj-and-reasearch" style="border:3px soild black;height:auto;width:100%;">
<div style="background-color:#D0D0CE;color:black;"><h2 align=left>PROJECT AND RESEARCH PAPERS</h2></div>
        <div name="finalproj">
<h3 align=left>Final Year Project:</h3>
<ul type="disc">
         <li id="li1"><p align="justify"><?php 
         if ($_SESSION['beproj']!="") 
         echo $_SESSION['beproj']; 
         else
         echo '<script>document.getElementById("li1").style.display="none"</script>';
         ?></p>
</ul>
</div>
<div name="externalproj">
<h3 align=left>External Projects:</h3>
<ul type="disc">
         <li id="li2"><p align="justify"><?php 
         if ($_SESSION['extproj1']!="") 
         echo $_SESSION['extproj1']; 
         else
         echo '<script>document.getElementById("li2").style.display="none"</script>';
         ?></p>
         <li id="li3"><p align="justify"><?php 
         if ($_SESSION['extproj2']!="") 
         echo $_SESSION['extproj2']; 
         else
         echo '<script>document.getElementById("li3").style.display="none"</script>';
         ?></p>
</ul>
</div>
<div name="miniproj">
<h3 align=left>Mini Projects:</h3>
<ul type="disc">
         <li id="li4"><p align="justify"><?php 
         if ($_SESSION['miniproj1']!="") 
         echo $_SESSION['miniproj1']; 
         else
         echo '<script>document.getElementById("li4").style.display="none"</script>';
         ?></p>
         <li id="li5"><p align="justify"><?php 
         if ($_SESSION['miniproj2']!="") 
         echo $_SESSION['miniproj2']; 
         else
         echo '<script>document.getElementById("li5").style.display="none"</script>';
         ?></p>
         <li id="li6"><p align="justify"><?php 
         if ($_SESSION['miniproj3']!="") 
         echo $_SESSION['miniproj3']; 
         else
         echo '<script>document.getElementById("li6").style.display="none"</script>';
         ?></p>
</ul>
</div>
        <p align="justify"></p>
</div>
<div id="position-of-responsibility" style="border:3px soild black;height:auto;width:100%;">
<div style="background-color:#D0D0CE;color:black;"><h2 align=left>POSITION OF RESPONSIBILITY</h2></div>
<ul type="disc">
         <li id="li7"><p align="justify"><?php 
         if ($_SESSION['responsibility1']!="") 
         echo $_SESSION['responsibility1']; 
         else
         echo '<script>document.getElementById("li7").style.display="none"</script>';
         ?></p>
         <li id="li8"> <p align="justify"><?php 
         if ($_SESSION['responsibility2']!="") 
         echo $_SESSION['responsibility2']; 
         else
         echo '<script>document.getElementById("li8").style.display="none"</script>';
         ?></p>
</div>
<div id="extra-curricular" style="border:3px soild black;height:auto;width:100%;">
<div style="background-color:#D0D0CE;color:black;"><h2 align=left>EXTRA CURRICULAR ACHIEVEMENTS</h2></div>
<ul type="disc">
         <li id="li14"><p align="justify"><?php 
         if ($_SESSION['achievement1']!="") 
         echo $_SESSION['achievement1']; 
         else
         echo '<script>document.getElementById("li14").style.display="none"</script>';
         ?></p>
         <li id="li15"><p align="justify"><?php 
         if ($_SESSION['achievement2']!="") 
         echo $_SESSION['achievement2']; 
         else
         echo '<script>document.getElementById("li15").style.display="none"</script>';
         ?></p>
         <li id="li16"><p align="justify"><?php 
         if ($_SESSION['achievement3']!="") 
         echo $_SESSION['achievement3']; 
         else
         echo '<script>document.getElementById("li16").style.display="none"</script>';
         ?></p>
</ul>
        </div>
<div id="addition-info" style="border:3px soild black;height:auto;width:100%;">
<div style="background-color:#D0D0CE;color:black;" ><h2 align=left>ADDITIONAL INFORMATION</h2></div>
        <h3 align=left>Preferred  Programming Language : </h3><p align=left><?php echo $_SESSION['know'] ?></p>
        <p align="justify"><?php echo $_SESSION['additonalinfo'] ?></p><br>
<h3 align=left>Hobbies : </h3><p align=left><?php echo $_SESSION['hobbies']; ?></p></div>  
</div>
    </body>
</html>