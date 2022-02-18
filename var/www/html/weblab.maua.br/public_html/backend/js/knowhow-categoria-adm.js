// $(document).ready(function(){

//     carregarCategorias();
//     });
function categoryLoad(){

    $.get({
        type: 'get',
        url: 'backend/controls/categoriaControl.php',
        data: {'loadCategoria': 'true'},
        success: function(data) {
            obj = JSON.parse(data);
            for (var i = 0; i < obj.length; i++) {
                nomeStr = "'"+obj[i].nome_categoria+"'";
                $('#knowhow-box').append('<div class="col-md-3"><div id="categoria-'+obj[i].id_categoria+'" class="card"><a href="knowhow-categoria-adm.php?idCategoria='+obj[i].id_categoria+'"><div class="view overlay"><img class="card-img-top card-display" src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" alt="Card image cap"><div class="mask rgba-white-slight"></div></div></a><div class="card-body categ-card"><div class="row justify-content-between"><div class="col-8"><h4>'+obj[i].nome_categoria+'</h4></div><div class="col-4 text-right"><span><i onclick="deleteCategory('+obj[i].id_categoria+','+nomeStr+')" class="far fa-trash-alt pr-2 c-pointer"></i><i class="far fa-edit c-pointer"></i></span></div></div><div class="categ-desc">'+obj[i].desc_categoria+'</div></div></div></div>');
            }
        }
    });

}

function addCategory() {
    
    var nome = $('#categ_name').val();
    var desc = $('#categ_desc').val();

    if(nome != ""){
        var linktoexecute = "backend/controls/categoriaControl.php";
        $.get({
            type: 'post',
            url: linktoexecute,
            data: {nomeCategoria:nome,descCategoria:desc},
            success: function(data) {
                id = data.slice(1,-1);
                nomeStr = "'"+nome+"'";
                $('#knowhow-box').append('<div class="col-md-3"><div id="categoria-'+id+'" class="card"><div class="view overlay"><a href="knowhow-categoria-adm.php?idCategoria='+id+'"><img class="card-img-top card-display" src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" alt="Card image cap"></a><div class="mask rgba-white-slight"></div></div><div class="card-body categ-card"><div class="row justify-content-between"><div class="col-8"><h4>'+nome+'</h4></div><div class="col-4 text-right"><span><i onclick="deleteCategory('+id+',"'+nomeStr+'")" class="far fa-trash-alt pr-2 c-pointer"></i><i class="far fa-edit c-pointer"></i></span></div></div><div class="categ-desc">'+desc+'</div></div></div></div>');

                $('#categ_name').val('');

                $('#categ_desc').val('');
                
            }
        });
    }
    
} 

function deleteCategory(id,nome){

    Swal.fire({
        title: 'Certeza que deseja apagar "'+nome+'"?',
        text: "Você não poderá recuperar a categoria",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText: 'Sim, Apagar'
    }).then((result) => {
            if (result.value) {
                var linktoexecute = "backend/controls/categoriaControl.php";

                $("#categoria-"+id).remove();

                $.get({
                    type: 'post',
                    url: linktoexecute,
                    data: {delCategoria:id},

                }); 
                Swal.fire(
                'Apagado!',
                'Categoria apagada com sucesso',
                'success'
            )
        }
    });

    
}

function categorySelect(id) {
    //document.getElementById("btn-voltar").style.visibility="visible";
    $('#knowhow-box').empty();

    document.getElementById("btn_add").setAttribute( "onClick", "javascript: addTest();" );

    $('#categ_name_lbl').text("Nome do Teste");

    $("#title-display").text("Testes Cadastrados");

    $("#knowhow-label").text("Cadastrar Teste");

    carregarTestes(id);

}

function carregarTestes(id) {
        
    $.get({
        type: 'get',
        url: 'backend/controls/categoriaControl.php',
        data: {loadTeste: id},
        success: function(data) {
            obj = JSON.parse(data);
            for (var i = 0; i < obj.length; i++) {
                nomeStr = "'"+obj[i].nome_teste+"'";
                $('#knowhow-box').append('<div class="col-md-3" id="test-'+obj[i].id_teste+'"><div class="card border-primary mb-3"><a href="knowhow-pergunta-adm.php?idCategoria='+id+'&idTeste='+obj[i].id_teste+'"><div class="card-header">'+obj[i].nome_teste+'</div></a><div class="card-body teste-card text-primary"><div class="row"><div class="col-6"><span class="teste-questoes">10 Questoes</span></div><div class="col-6 text-right"><i onclick="deleteTest('+obj[i].id_teste+','+nomeStr+')" class="far fa-trash-alt"></i><i class="far fa-edit"></i></div></div><div class="teste-desc">'+obj[i].desc_teste+'</div><div class="teste-tags"><span class="badge badge-default">Raciciocinio</span><span class="badge badge-default">Matematica</span><span class="badge badge-default">QI</span></div></div></div></div>');
            }
        }
    });

}

function addTest() {
    
    var nome = $('#categ_name').val();
    var desc = $('#categ_desc').val();

    if(nome != ""){
        var linktoexecute = "backend/controls/categoriaControl.php";
        $.get({
            type: 'post',
            url: linktoexecute,
            data: {nomeTeste:nome,descTeste:desc},
            success: function(data) {
                console.log(data);
                
                id = data.slice(1,-1);
                
                nomeStr = "'"+nome+"'";

                $('#knowhow-box').append('<div class="col-md-3" id="test-'+id+'"><div class="card border-primary mb-3"><a href="knowhow-pergunta-adm.php?idCategoria='+id+'&idTeste='+id+'"><div class="card-header">'+nome+'</div></a><div class="card-body teste-card text-primary"><div class="row"><div class="col-6"><span class="teste-questoes">10 Questoes</span></div><div class="col-6 text-right"><i onclick="deleteTest('+id+','+nomeStr+')" class="far fa-trash-alt"></i><i class="far fa-edit"></i></div></div><div class="teste-desc">'+desc+'</div><div class="teste-tags"><span class="badge badge-default">Raciciocinio</span><span class="badge badge-default">Matematica</span><span class="badge badge-default">QI</span></div></div></div></div>');

                $('#categ_name').val('');

                $('#categ_desc').val('');
                
            }
        });
    }
    
}

function deleteTest(id,nome){

    Swal.fire({
        title: 'Certeza que deseja apagar "'+nome+'"?',
        text: "Você não poderá recuperar o teste",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText: 'Sim, Apagar'
    }).then((result) => {
            if (result.value) {
                var linktoexecute = "backend/controls/categoriaControl.php";

                $("#test-"+id).remove();

                    $.get({
                    type: 'post',
                    url: linktoexecute,
                    data: {delTeste:id},

                });
                Swal.fire(
                'Apagado!',
                'Teste apagado com sucesso',
                'success'
            )
        }
    });

    
}

function voltar(){

    document.getElementById("btn-voltar").style.visibility="hidden";

    document.getElementById("btn-adicionar").setAttribute( "onClick", "javascript: addCategoria();" );

    document.getElementById("nome").setAttribute( "placeholder", "Categoria" );

    document.getElementById("desc").setAttribute( "placeholder", "Descrição da Categoria" );

    $('#knowhow-box').empty();

    $("#title-display").text("Categorias Disponíveis");

    $("#knowhow-title").text("Criar Categoria");


    carregarCategorias();

}

