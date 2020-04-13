<?php 

include_once '../common/connectDB.php';

try
{
    $database = new Connection();
    $db = $database->openConnection();

    $id=$_POST['codCondPag'];
    $descricaoCond=$_POST['descCondPag'];
    $nDias=$_POST['nDiasCond'];
    $descontoCondi=$_POST['descontoCondi'];
 
    $stmt = $db-> prepare("UPDATE condicoespagamento  SET  nomeCondi= '".$descricaoCond."', nDiasCondi=".$nDias.", descontoCondi=".$descontoCondi." WHERE idCondi = '$id'" ) ;
    $affectedrows = $stmt ->execute();

    header('location:../showCondicoesP.php');
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}

?>