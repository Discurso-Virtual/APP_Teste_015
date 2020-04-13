<?php 

include_once '../common/connectDB.php';

try
{
    $database = new Connection();
    $db = $database->openConnection();

    $idCab=$_POST['idDocFisc'];
    $idTipoDoc=$_POST['codTipoDoc'];
    $idCliente=$_POST['codCliente'];
    $nomeCliente=$_POST['nomeCli'];
    $docNo=$_POST['numTipoDoc'];
    $data=$_POST['dataDoc'];
    $dataVen=$_POST['dataVencDoc'];
    $descontoC=null;
    $totLiq=$_POST['totLiq'];
    $totIli=$_POST['totIli'];
    $totDesc=$_POST['totDesc'];
    $totDoc=$_POST['totDoc'];
    $tab01=$_POST['valIVA23'];
    $tab02=$_POST['valIVA6'];
    $tab03=$_POST['valIVA13'];
    $tab04=$_POST['valIVA0'];




    if(isset($idTipoDoc)){
        $sql = "SELECT tipoDoc FROM tiposdoc WHERE codTiposDoc=".$idTipoDoc ;
        foreach ($db->query($sql) as $row){
            $tipoDoc=$row['tipoDoc'];
        }
    }

    $stm = $db->prepare("
    INSERT INTO doccab ( idCab, codTipoDoc, tipoDoc, codCliente, nomeCliente, docNo, Data, dataVencimento, descontoComercial, totalLiquido, totalIliquido, totalDesconto, totalDocumento, valorTAB01IVA, valorTAB02IVA, valorTAB03IVA, valorTAB04IVA) 
    VALUES ( :id, :codTipoDoc, :tipoDoc, :codCliente, :nomeCliente, :docNo, :Data, :dataVen, :descontoC, :totLiqDoc, :totIliDoc, :totDesc, :totDoc, :valTAB01, :valTAB02, :valTAB03, :valTAB04)") ;
    $stm->execute(
        array(
            ':id' => $idCab ,
            ':codTipoDoc' => $idTipoDoc ,
            ':tipoDoc' => $tipoDoc ,
            ':codCliente' => $idCliente ,
            ':nomeCliente' => $nomeCliente ,
            ':docNo' => $docNo ,
            ':Data' => $data,
            ':dataVen' => $dataVen ,
            ':descontoC' => $descontoC ,
            ':totLiqDoc' => $totLiq ,
            ':totIliDoc' => $totIli ,
            ':totDesc' => $totDesc ,
            ':totDoc' => $totDoc ,
            ':valTAB01' => $tab01 ,
            ':valTAB02' => $tab02 ,
            ':valTAB03' => $tab03 ,
            ':valTAB04' => $tab04

        ));

        $idLin=$_POST['idLin'];
        $codCab=$_POST['idCab'];
        $refProduto=$_POST['refProdLin'];
        $descProduto=$_POST['descProdLin'];
        $Qtd=$_POST['Quantidade'];
        $precoUni=$_POST['precUni'];
        $precoIli=$_POST['totalIliLin'];
        $precoLiq=$_POST['totalLiqLin'];
        $desconto =$_POST['desconto'];
        $tabIVA = $_POST['tabIva'];
        $taxaIVA=$_POST['taxaIVA'];

        $size=count($idLin);
        $stm = $db->prepare("INSERT INTO 
        doclin ( idLin, idCab, refProduto, descProduto, Quantidade, precoUni, precoIliq, idTaxaIVAProd, precoLiq, tabIVA, taxaIVA, desconto) 
        VALUES ( :idLin, :idCab, :refProduto, :descProduto, :Quantidade,  :precoUni, :precoIli, :idTaxaIVA, :precoLiq, :tabIVA, :taxaIVA, :desconto )") ;

        for($i=0;$i<$size;$i++){

            $linha=$idLin[$i];
            $cab=$codCab[$i];
            $rProd=$refProduto[$i];
            $nProd=$descProduto[$i];
            $quantidade=$Qtd[$i];
            $uni=$precoUni[$i];
            $ili=$precoIli[$i];
            $liq=$precoLiq[$i];
            $desc=$desconto[$i];
            $tabelaIVA=$tabIVA[$i];
            $taxIVA=$taxaIVA[$i];


            $stm->execute(
                array(
                    ':idLin' => $linha ,
                    ':idCab' => $cab ,
                    ':refProduto' => $rProd ,
                    ':descProduto'=> $nProd,
                    ':Quantidade' => $quantidade ,
                    ':precoUni' => $uni ,
                    ':precoIli' => $ili ,
                    ':idTaxaIVA' => 0,
                    ':precoLiq' => $liq ,
                    ':tabIVA' => $tabelaIVA ,
                    ':taxaIVA' => $taxIVA ,
                    ':desconto' => $desc
                ));

        };
        header('location:../docFiscais.php');
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}

?>