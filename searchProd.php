<?php 
    $path = "http://192.168.1.20/teste";

    session_start();
    include_once './common/connectDB.php';
    $database = new Connection();
    $db = $database->openConnection();

    if(isset($_POST['query'])){
        $ref=$_POST['query'];
        $sql="SELECT refProduto,descProduto,preco1Produto,idTaxaDeIva FROM produto WHERE refProduto=".$ref;
        $result =$db->query($sql);

        if($result->rowCount()>0){
            while($row=$result->fetch(PDO::FETCH_ASSOC)){

                $refProd=$row['refProduto'];
                $descProd= $row['descProduto'];
                $precoProd= $row['preco1Produto'];
                $idIva=$row['idTaxaDeIva'];
            }
            $sql1="SELECT taxaIVA,codigoNumIVA FROM taxasiva WHERE idTaxas=".$idIva;
            foreach($db->query($sql1) as $row1){
                $numIVA=$row1['codigoNumIVA'];
                $taxaIva=$row1['taxaIVA'];
            }
            $vals=array($refProd,$descProd,$precoProd,$numIVA,$taxaIva);

            header("Content-Type: application/json");

            echo json_encode($vals);
        }
        else {
            $refProd=$ref;
            $descProd= "";
            $precoProd= "";
            $numIVA="";
            $taxaIva="";

            $vals=array($refProd,$descProd,$precoProd,$numIVA,$taxaIva);

                header("Content-Type: application/json");

                echo json_encode($vals);
        }
    }
?>
