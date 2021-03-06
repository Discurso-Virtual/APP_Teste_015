<?php 
    include_once './common/connectDB.php';
    $database = new Connection();
    $db = $database->openConnection();

    if(isset($_POST['query'])){
        $id=$_POST['query'];
        $sql="SELECT codCliente,nomeCliente,contacCliente,emailCliente,idCondicao,moradaCliente FROM cliente WHERE codCliente = $id";
        $result =$db->query($sql);

        if($result->rowCount()>0){
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                $codCliente=$row['codCliente'];
                $nomeCli= $row['nomeCliente'];
                $contacCliente=$row['contacCliente'];
                $emailCliente= $row['emailCliente'];
                $idCondi=$row['idCondicao'];
                $moradaCli= $row['moradaCliente'];               
            }
            $sql1="SELECT nDiasCondi FROM condicoespagamento WHERE idCondi='$idCondi'";
                foreach($db->query($sql1) as $row1){
                    $date=date('Y-m-d');
                    $nDias=$row1['nDiasCondi'];
                    $nDias--;

                    $newDate = date('Y-m-d',strtotime('+'.$nDias.' days'. $date)); 
                }

                $vals=array($codCliente,$nomeCli,$contacCliente, $emailCliente,$idCondi,$moradaCli,$newDate);   
                
                header("Content-Type: application/json");
                echo json_encode($vals);
        }
        else {
            $codCliente=$row['codCliente'];
            $nomeCli= "";

            $contacCliente="";
            $emailCliente="";
            $idCondi="";
            $moradaCli="";

            $vals=array($codCliente,$nomeCli,$contacCliente, $emailCliente,$idCondi,$moradaCli,$newDate);   
                
            header("Content-Type: application/json");
            echo json_encode($vals);
        }
    }

?>