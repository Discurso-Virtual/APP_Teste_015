<?php 

include_once './common/connectDB.php';

try
{
    $database = new Connection();
    $db = $database->openConnection();

    $id=$_GET['id'];
   
    
 
    $stmt = $db-> prepare("UPDATE doccab  SET  anulado = 1  WHERE idCab = ".$id ) ;
    $affectedrows = $stmt ->execute();

    header('location:./docFiscais.php');
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}

?>