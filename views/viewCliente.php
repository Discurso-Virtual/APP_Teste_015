
<?php
$currentPage="Clientes";
session_start();
include_once '../common/cabecalho.php';


    $id = $_GET['id'];

    include_once '../common/connectDB.php';

    $database = new Connection();
    $db = $database->openConnection();
    $sql = "SELECT * from cliente where codCliente =". $id ;

?>
<main role="main" id="main" class="col-lg-12 container main">
    <div class="card col-md-12" >
        <article class="card-body">
            <h4 class="card-title mb-4 mt-1">Dados Cliente</h4>
            <div class="row container">
                <button class="tabButton" onclick="changeTab('DadosG',this)" id="default_tab">Dados Gerais</button>
                <button class="tabButton" onclick="changeTab('DadosF',this)">Dados Financeiros</button>
                <button class="tabButton" onclick="changeTab('ODados',this)">Outros dados</button>
            </div>    
            <div id="DadosG" class="tabDiv">
                <div class="row ">
                    <?php
                        foreach ($db->query($sql) as $row) {
                    ?> 
                    <div class="form-group col-md-3">
                        <label >Código Cliente</label>
                        <p><?php echo $row['codCliente'] ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nome Cliente</label>
                        <p><?php echo $row['nomeCliente'] ?></p>
                    </div>
                </div>
            </div>
            <div id="DadosF" class="tabDiv">
                <div class="row ">
                    <div class="form-group col-md-3">
                        <label>Contacto Cliente</label>
                        <p><?php echo $row['contacCliente'] ?></p>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Email Cliente</label>
                        <p><?php echo $row['emailCliente'] ?></p>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Desconto Habitual</label>
                        <p><?php echo $row['descontoHabitual'] ?></p>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Tabela de Preco</label>
                        <p><?php echo $row['tabelaPreco'] ?></p>
                    </div>
                   
                </div>
            </div>
            <div id="ODados" class="tabDiv">
                <div class="form-group col-md-3">
                    <label>Condição Pagamento</label>
                    <p><?php echo $row['idCondicao'] ?></p>
                </div>
            </div>
            <div class="form-group col-md-12">
                <button class="btn btn-danger" style="float:right;margin-top:20px"  onClick="javascript:history.go(-1)" >Voltar</button>
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