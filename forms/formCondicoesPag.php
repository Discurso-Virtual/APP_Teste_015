
<?php
$currentPage="Condicoes";
session_start();

include_once '../common/cabecalho.php';
   

?>

<main role="main" id="main" class="col-lg-12 container main">
    <div class="card col-md-12 " >
        <article class="card-body">
            <h4 class="card-title mb-4 mt-1">New Condiçao</h4>
            <div class="row container">
                <button class="tabButton" onclick="changeTab('DadosG',this)" id="default_tab">Dados Gerais</button>
                <button class="tabButton" onclick="changeTab('DadosF',this)">Dados Financeiros</button>
                <button class="tabButton" onclick="changeTab('ODados',this)">Outros dados</button>
            </div>   
            <form action="<?php echo $path?>/inserts//insertCondicoes.php" method="POST" id="Form_condicoes" autocomplete="off"></form>
            <div id="DadosG" class="tabDiv">
                <div class="row ">
                    <div class="form-group col-md-3">
                        <label for="codCondPag">Código Condição Pagamento</label>
                        <input class="form-control" type="text" id="codCondPag" name="codCondPag" form="Form_condicoes"  >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="descCondPag">Descrição Condiçao Pagamento</label>
                        <input class="form-control" type="text" id="descCondPag" name="descCondPag" form="Form_condicoes" >
                    </div>
                </div>
            </div>
            <div id="DadosF" class="tabDiv">
                <div class="row ">
                    <div class="form-group col-md-3">
                        <label for="nDiasCond">Número dias condição</label>
                        <input class="form-control" type="text" id="nDiasCond" name="nDiasCond" form="Form_condicoes" >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="descontoCondi">Desconto Condição</label>
                        <input class="form-control" type="text" id="descontoCondi" name="descontoCondi" form="Form_condicoes" >
                    </div>
                </div>
            </div>
            <div id="ODados" class="tabDiv"></div>            
            <div class="form-group col-md-12" style="margin-top:50px">
                <button class="btn btn-info" style="float:right" type="submit" form="Form_condicoes" name="submit">Criar</button>
                <button class="btn btn-danger" style="float:right;margin-right:5px;"  onClick="javascript:history.go(-1)" >Cancelar</button>
            </div>    
        </article>
    </div>
</main>
    <?php
     include_once '../common/rodape.php'; 
    ?>
</body>
</html>