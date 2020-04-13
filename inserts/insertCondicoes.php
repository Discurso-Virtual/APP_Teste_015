<?php 

include_once '../common/connectDB.php';

try
{
    $database = new Connection();
    $db = $database->openConnection();

    $id=$_POST['codCondPag'];
    $nomeCond=$_POST['descCondPag'];
    $nDias=$_POST['nDiasCond'];
    $desc=$_POST['descontoCondi'];

    $stm = $db->prepare("INSERT INTO condicoespagamento ( idCondi, nomeCondi, nDiasCondi, descontoCondi) VALUES ( :id, :nome, :nDias, :desconto)") ;
    $stm->execute(
        array(
            ':id' => $id ,
            ':nome' => $nomeCond ,
            ':nDias' => $nDias ,
            ':desconto' => $desc
        ));
        header('location:../../showCondicoesP.php'); // se der erro ver isto

}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}

?>