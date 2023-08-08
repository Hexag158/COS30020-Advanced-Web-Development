<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Programming :: Lab 2" />
<meta name="keywords" content="Web,programming" />
<meta name="Nghia" content="103806269">
</head>
<body>
<p>The days of the week in English are: <br>
<?php
    $days = array ("Sunday", "Monday", "Tuesday","Wednesday","Thursday","Friday","Saturday"); // declare and initialise array
    $len=count($days);
    for ($i=0;$i<$len-1;$i++){
       echo "$days[$i], ";
    }
    $j = $len - 1;
    echo "$days[$j].";

?></p>


<p>The days of the week in French are:<br>
<?php
    $days[0] = "Dimanche";
    $days[1] = "Lundi";
    $days[2] = "Mardi";
    $days[3] = "Mercredi";
    $days[4] = "Jeudi";
    $days[5] = "Vendredi";
    $days[6] = "Samedi";
    for ($i=0;$i<$len-1;$i++){
        echo "$days[$i], ";
     }
     $j = $len - 1;
     echo "$days[$j].";
?>
</p>
</body>
</html>