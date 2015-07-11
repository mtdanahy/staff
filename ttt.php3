<HTML>
<head>
<title>ESU2 Staff Database</title>
</head>
<body text="#000000" bgcolor="#FFFFFF" background="/Vimage/ESUbackground1.jpg">
<H1>
  <CENTER>
    <p align="left"><img src="Vimage/ESUname2.jpg" width="338" height="38"><b><font color="#FF0000"><font face="Arial, Helvetica, sans-serif" size="2"><font color="#000080">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#000066">&nbsp;&nbsp;
      </font></font></font></font></b></p>
    <p align="left">
</font>
<font face="Arial, Helvetica, sans-serif" size="3">

<?php

 function printoutall($ar,$num)
  {
printf("<h1><center><a href = mailto:");
# echo "$num <br>";
for ($i=0; $i < $num+1; $i++)
  {
   if ($ar[$i] != "")
   {
        if($i != $num)
          {
           printf("%s,",$ar[$i]);
          }
       if($i == $num)
        {
          printf("%s",$ar[$i]);
        }
  }
}
printf(">Mail all of the above!</a></h1></center>");
printf ("<P><center><H1>");
 
  }

function printoutall2($ar,$num)
  {
printf("Or Cut and Paste all:/n");
# echo "$num <br>";
for ($i=0; $i < $num+1; $i++)
  {
   if($i % 8 == 0)
      {
        printf("<br>");
     }

   if ($ar[$i] != "")
   {
        if($i != $num)
          {
           printf("%s,",$ar[$i]);
          }
       if($i == $num)
        {
          printf("%s",$ar[$i]);
        }
  }
}
printf(">Mail all of the above!</a></h1></center>");
printf ("<P><center><H1>");

  }

if (!empty($_POST['submit'])) 
{
$q1=$_POST['q1'];
$q1a=trim($_POST['q1a']);
$q2=$_POST['q2'];
$q2a=trim($_POST['q2a']);
$q3=$_POST['q3'];
$q3a=trim($_POST['q3a']);

$con1=$_POST['con1'];
$con2=$_POST['con2'];
$sort=$_POST['sort'];

if ($sort == "First Name") $sort = "Fn";
if ($sort == "Last Name") $sort = "Ln";
if ($sort == "School") $sort = "Institution";
if ($sort == "Mail") $sort = "Mail";
if ($sort == "Position") $sort = "Pos";

if ($q1 == "First Name") $q1 = "Fn";
if ($q1 == "Last Name") $q1 = "Ln";
if ($q1 == "First Name") $q1 = "Fn";
if ($q1 == "School") $q1 = "Institution";
if ($q1 == "Mail") $q1 = "Mail";
if ($q1 == "Position") $q1 = "Pos";

if ($q2 == "First Name") $q2 = "Fn";
if ($q2 == "Last Name") $q2 = "Ln";
if ($q2 == "First Name") $q2 = "Fn";
if ($q2 == "School") $q2 = "Institution";
if ($q2 == "Mail") $q2 = "Mail";
if ($q2 == "Position") $q2 = "Pos";

if ($q3 == "First Name") $q3 = "Fn";
if ($q3 == "Last Name") $q3 = "Ln";
if ($q3 == "First Name") $q3 = "Fn";
if ($q3 == "School") $q3 = "Institution";
if ($q3 == "Mail") $q3 = "Mail";
if ($q3 == "Position") $q3 = "Pos";


   echo "<table border=1>\n";

@ $db = new mysqli('localhost','root','password','staff');

 if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
}
if (($q2a != "") && ($q3a == ""))
{ 
   $query = "select * from NDE where  $q1 like '%$q1a%' $con1 $q2  like '%$q2a%'  order by $sort ";
$result=$db->query($query);

}



if ($q2a == "")
{
$query = "select * from NDE where $q1 like '%$q1a%' order by $sort ";
  $result=$db->query($query);

}

if($q3a != "")
{
echo "we got here 3rd $con2 $q1 $q3 $q3a";
$query = "select * from NDE where ($q1 like '%$q1a%' $con1   $q2 like '%$q2a%') $con2 $q3 like '%$q3a%' order by $sort ";
$result=$db->query($query);
}
print("<tr><td><center><b>Name</td><td><b><center>School</td><td><b><center>Position</td><td><center><b>e-mail</td></tr>");

$num_results = $result->num_rows;
 
echo "<p> Number of Records found: ".$num_results."</p>";

for ($i=0; $i <$num_results+1; $i++)
 {
  $myrow=$result->fetch_assoc();
  if ($myrow["Mail"] != "") {$email="@esu2.org";}
   $all=$myrow["Mail"] . "@esu2.org,";
   $email=$myrow["Mail"];
   $printemail[$i]=$email;

printf("<tr><td>%s %s</td><td>%s</td><td>%s</td><td><a href = mailto:%s>$email</a></td></tr>",ucwords(strtolower($myrow["Fn"])),ucwords(strtolower($myrow["Ln"])),$myrow["Institution"],ucwords(strtolower($myrow["Pos"])),$myrow["Mail"]);

 # printf("<tr><td>%s %s</td><td>%s</td><td>%s</td><td><a href = mailto:%s>$email</a></td></tr>",$myrow["Fn"],$myrow["Ln"],$myrow["Institution"],$myrow["Pos"],$myrow["Mail"]);

    }

    printf("</table>");
printf("<br><br>");
printf("<b><h1><size=2><Center>Cut and Paste emails to your e-mail client</h1></Center></b>");

printoutall($printemail,$num_results);
printoutall2($printemail,$num_results);
printf ("<P><center><H1>"); 
printf("<a href=\"http://zabbix2.esu2.org/staff.html\">Back To The Main Search Page</a>");
} 

?>
</HTML>
 <script src='sort.js' language='JavaScript1.2' type='text/javascript'></script>
