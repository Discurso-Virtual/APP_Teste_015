
<?php
$currentPage="Fornecedores";
session_start();

include_once '../common/cabecalho.php';
    $id = $_GET['id'];

    include_once '../common/connectDB.php';

    $database = new Connection();
    $db = $database->openConnection();
    $sql = "SELECT * from fornecedor where codForne =". $id ;

?>

<main role="main" id="main" class="col-lg-12 container main">
    <div class="card col-md-12 " >
        <article class="card-body">
            <h4 class="card-title mb-4 mt-1">Dados Fornecedor</h4>
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
                        <label>Código Fornecedor</label>
                        <p><?php echo $row['codForne'] ?> </p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nomeF">Nome Fornecedor</label>
                        <p><?php echo $row['nomeForne'] ?></p>
                    </div>
                </div>
            </div>
            <div id="DadosF" class="tabDiv">
                <div class="row ">
                    <div class="form-group col-md-3">
                        <label>Contacto Fornecedor</label>
                        <p><?php echo $row['contacForne'] ?></p>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Email Fornecedor</label>
                        <p><?php echo $row['emailForne'] ?></p>
                    </div>
                </div>
            </div>
            <div id="ODados" class="tabDiv"></div>            
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