<?php

function databaseconnect(){
$databasebhost = "localhost";
$databasebuser = "root";
$databasebpass = "";
$databasebname = "covidtracker";


try
{
    if ($connect = mysqli_connect($databasebhost, $databasebuser, $databasebpass, $databasebname))
    {
      return $connect;
    }
    else
    {
        throw new Exception('could not connect to database');
    }
}
catch(Exception $exceotion)
{
    echo $exceotion->getMessage();
}

}

function CloseCon($connect)
 {
 $connect -> close();
 }

?>
