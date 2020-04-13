
<?php
    $currentPage="Produtos";
    session_start();

    include_once '../common/cabecalho.php';

        $id = $_GET['id'];

        include_once '../common/connectDB.php';
    
        $database = new Connection();
        $db = $database->openConnection();
        $sql = "SELECT * from produto where refProduto =". $id ;
    ?>
    <main role="main" id="main" class="col-lg-12 container main">
    <div class="card col-md-12">
        <article class="card-body">
            <h4 class="card-title mb-4 mt-1">Dados Produto</h4>
                <div class="row container">
                    <button class="tabButton" onclick="changeTab('DadosG',this)" id="default_tab">Dados Gerais</button>
                    <button class="tabButton" onclick="changeTab('DadosF',this)">Dados Financeiros</button>
                    <button class="tabButton" onclick="changeTab('ODados',this)">Outros dados</button>
                </div>
            <div id="DadosG" class="tabDiv" > 
                <div class="row" >
                    <?php
                        foreach ($db->query($sql) as $row) {
                    ?>
                    <div class="form-group col-md-2">
                        <label>Referência</label>
                        <p><?php echo $row['refProduto'] ?></p> 
                    </div>
                    <div class="form-group col-md-2">
                        <label>Unidade Produto</label>
                        <p><?php echo $row['unidadeProduto'] ?></p>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Familia Produto</label>
                        <p><?php echo $row['familiaProduto'] ?></p>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Descrição Produto</label>
                        <p><?php echo $row['descProduto'] ?></p>
                    </div>
                </div>
            </div>
            <div id="DadosF" class="tabDiv">
                <div class="row ">
                    <div class="form-group col-md-2">
                        <label>Preço1 Produto</label>
                        <p><?php echo $row['preco1Produto'] ?></p>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="preco2Prod">Preço2 Produto</label>
                        <p><?php echo $row['preco2Produto'] ?></p>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Preço3 Produto</label>
                        <p><?php echo $row['preco3Produto'] ?></p>
                    </div>
                </div>
            </div>
            <div id="ODados" class="tabDiv">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>ean13</label>
                        <p><?php echo $row['ean13'] ?></p>
                    </div>

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