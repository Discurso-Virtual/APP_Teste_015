/*MENU--SIDEBAR*/



document.getElementById('colapse-menu').onclick = function changeContent() {

    if(document.getElementById('sidebar').classList.contains('colapsed')){
        document.getElementById('sidebar').classList.remove('colapsed');

        document.getElementById('main').classList.replace('col-lg-12','col-lg-10');
        document.getElementById('paraRemover').classList.remove('col-lg-1');
    }else{
        document.getElementById('sidebar').classList.add('colapsed');
        document.getElementById('main').classList.replace('col-lg-10','col-lg-12');
        document.getElementById('linha').insertAdjacentHTML("afterbegin","<div class='col-lg-1' id='paraRemover'> </div>");
    }
    
 
 }

 /*MODAL */
   
 function openModal(id,current,operacao){
    $('#loadModal').load('http://192.168.1.20/teste/common/modal.php',{id:id,current:current,operacao:operacao})
    }
   
/*FOOOTER*/

function doDate(){

    var today = new Date();
    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
    $('#time').html (dateTime);

};
setInterval(doDate, 1000);

/////////////////////////////////////

function fetchInfo() {
    
    var tipo = document.getElementById("fiscCriar").value;

    if(tipo!=''){
        $.ajax({
            url:'http://192.168.1.20/teste/autofill.php',
            method:'post',
            data:{query:tipo},
            success:function(data){
                document.getElementById('tituloNewDoc').textContent="A inserir nova: "+data[1];

                document.getElementById('codTipoDoc').value=data[0];
                document.getElementById('tipoDoc').value=data[1];
                document.getElementById('numTipoDoc').value=data[2];



                document.getElementById('idDocFisc').value=data[3];
                
              

                document.getElementById('cancelarTipo').style.visibility = 'visible';;
            }
        });
    }

};

//---------------------------- PESQUISA DE CLIENTE POR CODIGO 
    $(document).ready(function(){
        $("#codCliente").keyup( function() {
          var id = $(this).val();
          if(id!=''){
              $.ajax({
                  url:'http://192.168.1.20/teste/searchInput.php',
                  method:'post',
                  data:{query:id},
                  success:function(response){
                      $('#show-list').html(response);
                  }
              });
          }
          else{
              $('#show-list').html('');
          }
        });
        
            $(document).on('click','#selection', function(){

                var id = $(this).text().split('-')[0];

                $('#codCliente').val(id);
           
                $('#show-list').html('');
            if(id!=''){
                $.ajax({
                    url:'http://192.168.1.20/teste/fillNomeCliente.php',
                    method:'post',
                    data:{query:id},
                    success:function(data){
                        $('#codCliente').val(data[0]);
                        $('#nomeCli').val(data[1]);
                        $('#contactCli').val(data[2]);
                        $('#mailCli').val(data[3]);
                        $('#codCondicao').val(data[4]);
                        $('#moradaCli').val(data[5]);
                        $('#dataVencDoc').val(data[6]);
                    }
                });
            }
            else{
                $('#nomeCli').html('');
            }
        });
        
    });

    function searchCliente(id){
     
       if(id!=''){
            $.ajax({
                url:'http://192.168.1.20/teste/searchCliente.php',
                method:'post',
                data:{query:id},
                success:function(data){
                    $('#show-list').html('');
    
                    document.getElementById('codCliente').value=data[0];
                    document.getElementById('nomeCli').value=data[1];
                    document.getElementById('contactCli').value=data[2];
                    document.getElementById('mailCli').value=data[3];
                    document.getElementById('codCondicao').value=data[4];
                    document.getElementById('moradaCli').value=data[5];
                    document.getElementById('dataVencDoc').value=data[6];

                }
            });
        }
      };

//------------------------------PESUISA DE CLIENTE POR NOME

$(document).ready(function(){
    $("#nomeCli").keyup( function() {
      var nome = $(this).val();
      if(nome!=''){
          $.ajax({
              url:'http://192.168.1.20/teste/searchInputNome.php',
              method:'post',
              data:{query:nome},
              success:function(response){
                  $('#show-list2').html(response);
              }
          });
      }
      else{
          $('#show-list2').html('');
      }
    });
    
        $(document).on('click','#selectionN', function(){
       
        var nome = $(this).text();
        $('#nomeCli').val(nome);
        $('#show-list2').html('');

        if(nome!=''){
            $.ajax({
                url:'http://192.168.1.20/teste/fillCodCliente.php',
                method:'post',
                data:{query:nome},
                success:function(response){
                    $('#codCliente').val(response[0]);
                    $('#nomeCli').val(response[1]);
                    $('#contactCli').val(response[2]);
                    $('#mailCli').val(response[3]);
                    $('#codCondicao').val(response[4]);
                    $('#moradaCli').val(response[5]);
                    $('#dataVencDoc').val(response[6]);
                    
                }
            });
        }
        else{
            $('#codCliente').html('');
        }
    });
    
});

function searchClienteNome(nome){
 
  /* if(nome!=''){
        $.ajax({
            url:'http://192.168.1.20/teste/searchClienteNome.php',
            method:'post',
            data:{query:nome},
            success:function(data){
                $('#show-list2').html('');

                document.getElementById('codCliente').value=data[0];
                document.getElementById('nomeCli').value=data[1];
            }
        });
    }*/
  };


    
    var j = 0;
    function novaLinha(){

        var table = document.getElementById("linTable");

        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        var cell10 = row.insertCell(9);
        var cell11 = row.insertCell(10);
        var cell12 = row.insertCell(11);
      

    
      

        cell1.innerHTML = "<td><button type='button' class='close' aria-label='Close' onclick='removerLinha(this)'><span aria-hidden='true'>&times;</span></button></td>"
        cell2.innerHTML = "<input class='form-control' type='text' name='idLin[]' id='idLin["+j+"]' form='form_docFiscais' value='' readonly></input>";
        cell3.innerHTML = "<input class='form-control' type='text' name='idCab[]' id='idCab["+j+"]' form='form_docFiscais' value='"+document.getElementById(`idDocFisc`).value+"' readonly></input>";
        cell4.innerHTML = "<input class='form-control' type='text' name='refProdLin[]' id='refProdLin["+j+"]' form='form_docFiscais' onblur='searchProd(value,this)'</input>";
        cell5.innerHTML = "<input class='form-control' type='text' name='descProdLin[]' id='descProdLin["+j+"]' form='form_docFiscais'></input>";
        cell6.innerHTML = "<input class='form-control' type='text' name='Quantidade[]' id='Quantidade["+j+"]' oninput='precoTot(value,this)' form='form_docFiscais'></input>";
        cell7.innerHTML = "<input class='form-control' type='text' name='precUni[]' id='precUni["+j+"]' form='form_docFiscais'></input>";
        cell8.innerHTML = "<input class='form-control' type='text' name='desconto[]' id='desconto["+j+"]' oninput='descontosPre(value,this)'  form='form_docFiscais'></input>";
        cell9.innerHTML = "<input class='form-control' type='text' name='tabIva[]' id='tabIva["+j+"]'  form='form_docFiscais'></input>";
        cell10.innerHTML = "<input class='form-control' type='text' name='taxaIVA[]' id='taxaIVA["+j+"]' form='form_docFiscais'></input>" ;
        cell11.innerHTML = "<input class='form-control' type='text' name='totalIliLin[]' id='totalIliLin["+j+"]' value='0' form='form_docFiscais'></input>" ;
        cell12.innerHTML = "<input class='form-control' type='text' name='totalLiqLin[]' id='totalLiqLin["+j+"]' value='0' form='form_docFiscais'></input>" ;
       
      


        if(j==0){
            getIdLinha(j);
        } else {
            var anterior=j-1;
            
            var val = document.getElementById('idLin['+anterior+']').value

            val++;

            document.getElementById('idLin['+j+']').value=val;

        }

        j++;
       
    };

   



 function searchProd(ref, r){
    var rowIndex = r.parentNode.parentNode.rowIndex;
    var a =rowIndex;
    a--;


    if(ref!=''){
        $.ajax({
            url:'http://192.168.1.20/teste/searchProd.php',
            method:'post',
            data:{query:ref},
            success:function(data){
                document.getElementById('descProdLin['+a+']').value=data[1];
                document.getElementById('precUni['+a+']').value=data[2];
                document.getElementById('Quantidade['+a+']').value="1";
                document.getElementById('tabIva['+a+']').value=data[3];
                document.getElementById('taxaIVA['+a+']').value=data[4];

            }
        });
    }
  };

  function cancelarTipo(){

    
    document.getElementById('cancelarTipo').style.visibility = 'hidden';;
    document.getElementById('tituloNewDoc').textContent="Novo Documento Fiscal";
    document.getElementById('codTipoDoc').value="";
    document.getElementById('tipoDoc').value="";
    document.getElementById('numTipoDoc').value="";
    document.getElementById('idDocFisc').value="";



    
    for(var t=0; t < j ;t++){
        document.getElementById("linTable").deleteRow(-1);
    }
    j=0;
}  ;

function removerLinha (r){
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("linTable").deleteRow(i);


    j--;
}

function precoTot(val,r){
    
    var i = r.parentNode.parentNode.rowIndex;
    i--;
    var uni = document.getElementById('precUni['+i+']').value;

    var totIli=val*uni;

    document.getElementById('totalIliLin['+i+']').value=totIli.toFixed(2);


}

function descontosPre(val,r){

    var i = r.parentNode.parentNode.rowIndex;
    i--;

    if(val!=0){
        var totIli = document.getElementById('totalIliLin['+i+']').value;
        var percent = val/100;

        var desconto = totIli*percent;
        var totLiq = totIli-desconto;

        document.getElementById('totalLiqLin['+i+']').value=totLiq.toFixed(2);



    } else {
        document.getElementById('totalLiqLin['+i+']').value=document.getElementById('totalIliLin['+i+']').value


    }

}

function doTotais(){
    
    var totLiqDoc=0,totIliDoc=0,totIVADoc=0;
    var tabela = document.getElementById('linTable');
    var tabela2 = document.getElementById('basesIncidencia');

    for(var i=1;i<tabela.rows.length;i++)
    {
        totIliDoc += parseFloat(tabela.rows[i].cells[10].getElementsByTagName('input')[0].value);
        totLiqDoc += parseFloat(tabela.rows[i].cells[11].getElementsByTagName('input')[0].value);
    }
       
    document.getElementById('totIli').value=totIliDoc.toFixed(2);
    document.getElementById('totLiq').value=totLiqDoc.toFixed(2);

    var descontosTot=totIliDoc-totLiqDoc;
    document.getElementById('totDesc').value=descontosTot.toFixed(2);


    for(var t=1;t<tabela2.rows.length;t++)
    {
        totIVADoc += parseFloat(tabela2.rows[t].cells[3].getElementsByTagName('input')[0].value);
    }

    console.log(totIVADoc);
    document.getElementById('totIVA').value=totIVADoc.toFixed(2);

    totalDocumento = totIVADoc+totLiqDoc;

    document.getElementById('totDoc').value=totalDocumento.toFixed(2);


   
};

function doBasesIncidencia(){
    var tot23Liq=0,tot6Liq=0,tot13Liq=0,tot0Liq=0;
    var tabela = document.getElementById('linTable');
   

    for(var i=1;i<tabela.rows.length;i++)
    {
        switch(tabela.rows[i].cells[8].getElementsByTagName('input')[0].value){
            case '01':
            {
                tot23Liq += parseFloat(tabela.rows[i].cells[11].getElementsByTagName('input')[0].value);
            }
            break;
            case '02':
            {
                tot6Liq += parseFloat(tabela.rows[i].cells[11].getElementsByTagName('input')[0].value)
            }
            break;
            case '03':
            {
                tot13Liq += parseFloat(tabela.rows[i].cells[11].getElementsByTagName('input')[0].value)
            }
            break;
            case '04':
            {
                tot0Liq += parseFloat(tabela.rows[i].cells[11].getElementsByTagName('input')[0].value)
            }
            break;
        }
    }
    document.getElementById('totLiq23').innerText=tot23Liq.toFixed(2);
    document.getElementById('totLiq6').innerText=tot6Liq.toFixed(2);
    document.getElementById('totLiq13').innerText=tot13Liq.toFixed(2);
    document.getElementById('totLiq0').innerText=tot0Liq.toFixed(2);

    doValorPorIVA(tot23Liq,tot6Liq,tot13Liq,tot0Liq);
}
setInterval(doBasesIncidencia,1000 );

setInterval(doTotais, 1000);





function doValorPorIVA(tot23Liq,tot6Liq,tot13Liq,tot0Liq){


    valIVA23=tot23Liq*0.23;
    valIVA6=tot6Liq*0.06;
    valIVA13=tot13Liq*0.13;
    valIVA0=tot0Liq*0;



    document.getElementById('valIVA23').value=valIVA23.toFixed(2);
    document.getElementById('valIVA6').value=valIVA6.toFixed(2);
    document.getElementById('valIVA13').value=valIVA13.toFixed(2);
    document.getElementById('valIVA0').value=valIVA0.toFixed(2);

}

function getIdLinha(i){
        $.ajax({
            url:'http://192.168.1.20/teste/getPrimeiraLinha.php',
            success:function(data){
                document.getElementById('idLin['+i+']').value=data;
            }
        });
    }

function changeTabIVA(){

}


//-------------------TABPAGE-------------------------------------------------


function changeTab(pagina, button){

  var i, tabcontent, tabs;
  tabcontent = document.getElementsByClassName("tabDiv");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tabs = document.getElementsByClassName("tabButton");
  for (i = 0; i < tabs.length; i++) {
    tabs[i].style.backgroundColor = "";
  }

  document.getElementById(pagina).style.display = "block";

  document.getElementById(pagina).style.backgroundColor = "#e9ecef";

  button.style.backgroundColor = '#e9ecef';

}

document.getElementById("default_tab").click();




function verDetalhes(link){
    window.location.href = link;
}



