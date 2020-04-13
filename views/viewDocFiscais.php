
<?php
$currentPage="Documentos Fiscais";
session_start();
include_once '../common/cabecalho.php';
include_once '../common/connectDB.php';


$database = new Connection();
$db = $database->openConnection();
$sql = "SELECT codigoNumIVA,taxaIVA  FROM taxasiva " ;


$sql1 = "SELECT * FROM tiposdoc " ;



if(isset($_SESSION['codTipoDoc']) && isset($_SESSION['tipoDoc'])){

    $codTipo=$_SESSION['codTipoDoc'];
    $tipo=$_SESSION['tipoDoc'];


    unset($_SESSION['codTipoDoc']);
    unset($_SESSION['tipoDoc']);
};

$id=$_GET['id'];
$sql3= "SELECT * from doccab WHERE idCab=$id";

foreach($db->query($sql3)as $rowShow){
    $sql2 = "SELECT * FROM tiposdoc where codTiposDoc=".$rowShow['codTipoDoc'] ;
    foreach ($db->query($sql2) as $row){
        $codidoTipo=$row['codTiposDoc'];
        $nomeTipo=$row['nomeTiposDoc'];
    }

    $sql2 = "SELECT * FROM cliente where codCliente=".$rowShow['codCliente']  ;
    foreach ($db->query($sql2) as $row){
        $codCliente=$row['codCliente'];
        $nomeCliente=$row['nomeCliente'];
        $moradaCliente=$row['moradaCliente'];
        $contactoCliente=$row['contacCliente'];
        $emailCliente=$row['emailCliente'];
        $idCondicao=$row['idCondicao'];
    }

    $sqlLinhas="SELECT * FROM doclin where idCab=".$rowShow['idCab'];
    
?>



<main role="main" id="main" class="col-lg-12 container main">

            <div class="card col-md-12 formDocs" >
                
            <article class="card-body">
                <h4 class="card-title mb-4 mt-1 tituloNewDoc " id="tituloNewDoc">Novo Documento Fiscal</h4>
                <form action="<?php echo $path?>/inserts/insertDocFiscais.php" method="POST" id="form_docFiscais" autocomplete="off"></form>

                <label for="fiscCriar"> Tipo de Documento Fiscal a criar </label>                   
                <div class="row ">
                    <select class="form-control col-md-3" id="fiscCriar" name="fiscCriar" >
                            <option selected value="<?php echo $codidoTipo?>"><?php echo $nomeTipo ?></option>
                    <?php
                        foreach ($db->query($sql1) as $row){?>
                            <option value="<?php echo $row['codTiposDoc']?>"><?php echo $row['nomeTiposDoc'] ?></option>
                    <?php 
                        }
                    ?>
                    </select>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-8 rightSideCab">
                        <div class="row">
                                <div class="form-group form-inline col-md-2">
                                    <label class="col-md-6" for="numTipoDoc">DocNo</label>
                                    <input class="form-control col-md-6" type="text" id="numTipoDoc" form="form_docFiscais" name="numTipoDoc" value="<?php echo $rowShow['docNo'] ?>" readonly >
                                </div>
                                <div class="form-group date col-md-5">
                                    <label class="col-md-4 " for="dataDoc">Data</label>
                                    <input class="form-control col-md-8" type="date" id="dataDoc" name="dataDoc" style="border:0;float:right;"  form="form_docFiscais"  value="<?php echo $rowShow['Data'] ?>" >
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-4 " for="dataDoc">Data Vencimento</label>
                                    <input class="form-control col-md-8" type="date" id="dataVencDoc" name="dataVencDoc" style="border:0;float:right;"  form="form_docFiscais"  value="<?php echo $rowShow['dataVencimento'] ?>" >
                                </div> 
                                <div class="form-group col-md-4" style="text-align:center">
                                    <label style="font-weight:bold">
                                        Dados do Cliente
                                    </label>
                                </div>
                                <div class="form-group col-md-4"></div>
                                <div class="form-group col-md-4"></div>
                                <div class="form-group form-inline col-md-4">
                                    <label for="codCliente" class="col-md-3">Cod</label>
                                    <input class="form-control" type="text" id="codCliente" form="form_docFiscais" name="codCliente"  value="<?php echo $codCliente ?>">
                                </div>
                                <div class="form-group  form-inline  col-md-4 dadosCliente" >
                                    <label for="nomeCli" class="col-md-3">Nome</label>
                                    <input class="form-control col-md-8" type="text" id="nomeCli" form="form_docFiscais" name="nomeCli" value="<?php echo $nomeCliente ?>">

                                    <label for="contactCli" class="col-md-3">Contacto</label>
                                    <input class="form-control col-md-8" type="text" id="contactCli" form="form_docFiscais" name="contactCli" value="<?php echo $contactoCliente ?>" >

                                    <label for="mailCli" class="col-md-3">E-mail</label>
                                    <input class="form-control col-md-8" type="text" id="mailCli" form="form_docFiscais" name="mailCli" value="<?php echo $emailCliente ?>">

                                    <label for="moradaCli" class="col-md-3">Morada</label>
                                    <input class="form-control col-md-8" type="text" id="moradaCli" form="form_docFiscais" name="moradaCli" value="<?php echo $moradaCliente ?>">

                                </div>
                                <div class="form-group col-md-4"></div>
                                <div class="form-group form-inline col-md-4">
                                    <div class="list-group  col-md-8" id="show-list" style="margin:-35px 0px 0px 65px"></div> 
                                </div>

                                <div class="form-group col-md-4" >
                                    <div class="list-group col-md-8 " id="show-list2" style="margin:-12px 0px 0px 80px"></div>                                    
                                </div>
                            
                        </div>
                    </div>
                        <div class="col-md-4 dadosCab">
                            <div class="form-group form-inline col-md-12">
                                <label class="col-md-3" for="idDocFisc"> CódDoc</label>
                                <input class="form-control col-md-6" type="text" id="idDocFisc" name="idDocFisc" form="form_docFiscais" value="<?php echo $rowShow['idCab'] ?>" readonly  >
                            </div>
                            <div class="form-group form-inline col-md-12">
                                <label class="col-md-3" for="codTipoDoc">CódTipo</label>
                                <input class="form-control col-md-6" type="text" id="codTipoDoc" form="form_docFiscais" value="<?php echo $rowShow['codTipoDoc'] ?>" name="codTipoDoc" readonly >
                            </div>
                            <div class="form-group form-inline col-md-12">
                                <label class="col-md-3" for="tipoDoc">TipoDoc</label>
                                <input class="form-control col-md-6" type="text" id="tipoDoc"  form="form_docFiscais" value="<?php echo $nomeTipo ?>"  name="tipoDoc" readonly >
                            </div>
                            <div class="form-group form-inline col-md-12">
                                <label class="col-md-3" for="codCondicao">CodCondi</label>
                                <input class="form-control col-md-6" type="text" id="codCondicao"  form="form_docFiscais" value="<?php echo $idCondicao ?>"  name="codCondicao" readonly >
                            </div>
                        </div>
                        <div class ="col-md-12" style="border-bottom:solid 1px black; margin:15px 15px 50px 15px"></div>
                        <div class="col-md-12">
                            <table class="table" id="linTable">
                                <tr>
                                    <th>Id Linha</th>
                                    <th>Id Cabeçalho</th>
                                    <th>Ref Produto</th>
                                    <th>Desc Prod</th>
                                    <th>Quantidade</th>
                                    <th>Preço Uni</th>
                                    <th>Desconto</th>
                                    <th>TAB IVA</th>
                                    <th>Taxa IVA</th>
                                    <th>Total Ilíquido</th>
                                    <th>Total Líquido</th>
                                </tr>
                                <?php foreach ($db->query($sqlLinhas) as $row){ ?>
                                    <tr>
                                        <td><input class='form-control' type='text' value='<?php echo $row['idLin'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['idCab'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['refProduto'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['descProduto'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['Quantidade'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['precoUni'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['desconto'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['tabIVA'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['taxaIVA'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['precoIliq'] ?>' readonly></input></td>
                                        <td><input class='form-control' type='text' value='<?php echo $row['precoLiq'] ?>' readonly></input></td>
                                    </tr>    
                                <?php }
                                ?>
                            </table>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <button class="btn btn-light btn-block col-md-2 " onclick="novaLinha()" style="float:right;margin-top:0px;">Adicionar Linha</button>
                        </div>
                        <div class="col-md-4 incidencia">
                            <table class="table basesIncidencia " id="basesIncidencia" >
                                <tr>
                                    <th>TAB IVA</th>
                                    <th>Taxa IVA</th>
                                    <th>Base de Incidencia</th>
                                    <th>Valor do IVA</th>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td>23</td>
                                    <td id='totLiq23'></td>
                                    <td><input class="form-control-plaintext input-sm" type="text" id="valIVA23"   name="valIVA23" readonly ></input></td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td>6</td>
                                    <td id='totLiq6'></td>
                                    <td><input class="form-control-plaintext input-sm" type="text" id="valIVA6"  name="valIVA6" readonly></input></td>
                                </tr>
                                <tr>
                                    <td>03</td>
                                    <td>13</td>
                                    <td id='totLiq13'></td>
                                    <td><input class="form-control-plaintext input-sm" type="text" id="valIVA13"  name="valIVA13" readonly></input></td>
                                </tr>
                                <tr>
                                    <td>04</td>
                                    <td>0</td>
                                    <td id='totLiq0'></td>
                                    <td><input class="form-control-plaintext input-sm" type="text" id="valIVA0"  name="valIVA0" readonly></input></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 totais">
                            <div class="row">
                                <div class="col-md-12 form-inline">
                                    <label for="totIli"  class="col-md-8" >Total Ilíquido:</label>
                                    <input class="form-control-plaintext input-sm col-md-3" type="text" id="totIli" name="totIli" readonly>
                                </div>
                                <div class="col-md-12 form-inline ">
                                    <label for="totLiq"  class="col-md-8" >Total Líquido:</label>
                                    <input class="form-control-plaintext input-sm col-md-3" type="text" id="totLiq"  name="totLiq" readonly>
                                </div>
                                <div class="col-md-12 form-inline ">
                                    <label for="totDesc" class="col-md-8" >Total Descontos:</label>
                                    <input class="form-control-plaintext input-sm col-md-3" type="text" id="totDesc" name="totDesc" readonly>
                                </div>
                                <div class="col-md-12 form-inline">
                                    <label for="totIVA"  class="col-md-8">Total IVA:</label>
                                   <input class="form-control-plaintext input-sm col-md-3" type="text" id="totIVA" name="totIVA" readonly>
                                </div>
                                <div class="col-md-12 form-inline">
                                    <label for="totDoc"  class="col-md-8">Total Documento:</label>
                                    <input class="form-control-plaintext input-sm col-md-3" type="text" id="totDoc"   name="totDoc" readonly>
                                </div>
                            </div>
                        </div>
                        
                </div>

            </article>
        </div>
    
</main>
<?php
}
     include_once '../common/rodape.php'; 
?>
</body>
</html>