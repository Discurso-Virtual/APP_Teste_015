
<?php
$currentPage="Condicoes";
session_start();

include_once '../common/cabecalho.php';
    $id = $_GET['id'];

    include_once '../common/connectDB.php';

    $database = new Connection();
    $db = $database->openConnection();
    $sql = "SELECT * from condicoespagamento where idCondi =". $id ;

?>

<main role="main" id="main" class="col-lg-12 container main">
    <div class="card col-md-12 " >
        <article class="card-body">
            <h4 class="card-title mb-4 mt-1">Update Condiçao</h4>
            <div class="row container">
                <button class="tabButton" onclick="changeTab('DadosG',this)" id="default_tab">Dados Gerais</button>
                <button class="tabButton" onclick="changeTab('DadosF',this)">Dados Financeiros</button>
                <button class="tabButton" onclick="changeTab('ODados',this)">Outros dados</button>
            </div>   
            <form action="./updateCondicoesPag.php" method="POST" id="uForm_condicoes" autocomplete="off"></form>
            <div id="DadosG" class="tabDiv">
                <div class="row ">
                    <?php
                        foreach ($db->query($sql) as $row) {
                    ?>
                    <div class="form-group col-md-3">
                        <label for="codCondPag">Código Condição Pagamento</label>
                        <input class="form-control" type="text" id="codCondPag" name="codCondPag" form="uForm_condicoes" value="<?php echo $row['idCondi'] ?>" readonly >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="descCondPag">Descrição Condiçao Pagamento</label>
                        <input class="form-control" type="text" id="descCondPag" name="descCondPag" form="uForm_condicoes" value="<?php echo $row['nomeCondi'] ?>">
                    </div>
                </div>
            </div>
            <div id="DadosF" class="tabDiv">
                <div class="row ">
                    <div class="form-group col-md-3">
                        <label for="nDiasCond">Número dias condição</label>
                        <input class="form-control" type="text" id="nDiasCond" name="nDiasCond" form="uForm_condicoes" value="<?php echo $row['nDiasCondi'] ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="descontoCondi">Desconto Condição</label>
                        <input class="form-control" type="text" id="descontoCondi" name="descontoCondi" form="uForm_condicoes" value="<?php echo $row['descontoCondi'] ?>">
                    </div>
                </div>
            </div>
            <div id="ODados" class="tabDiv"></div>            
            <div class="form-group col-md-12" style="margin-top:50px">
                <button class="btn btn-success" style="float:right" type="submit" form="uForm_condicoes" name="submit">Alterar</button>
                <button class="btn btn-danger" style="float:right;margin-right:5px;"  onClick="javascript:history.go(-1)" >Cancelar</button>
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