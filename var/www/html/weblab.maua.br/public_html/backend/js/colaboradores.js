idEditar = 0;
idDeletar = 0;

$(document).ready(function(){

    carregarUsuarios();
    carregarSetores(carregarCargos);

    $("#selectSetor").change(function(){
        carregarCargos($('#selectCargo'),$("#selectSetor").val());
    });
    
    $("#editSetor").change(function(){
        carregarCargos($('#editCargo'),$("#editSetor").val());
    });
});

function carregarUsuarios(){

    $.get({
        type: 'get',
        url: 'backend/controls/usuariosControl.php',
        data: {carregarUsuariosEmpresa: "true"},
        success: function(data) {

            obj = JSON.parse(data);

            for (var i = 0; i < obj.length; i++) {

                param = "'"+obj[i].nome_user+"'";

                $('#usuarios-box').append('<div class="row pl-2 pt-3 pb-3" id="user-'+obj[i].id_user+'"><div class="col-3"><span class="text-primary h6">'+obj[i].nome_user+'</span></div><div class="col-3"><span class="text-success h6">'+obj[i].nome_cargo+'</span></div><div class="col-3"><span class="text-secondary h6">'+obj[i].nome_setor+'</span></div><div class="col-3 flex-column justify-content-end"><span onclick="editarUsuario('+obj[i].id_user+')" data-feather="edit" class="color-alert act-icon"></span><span onclick="alertaDeletar('+obj[i].id_user+','+param+')" data-feather="trash-2" class="color-danger act-icon"></span><span onclick="visualizarUsuario('+obj[i].id_user+')" data-feather="zoom-in" class="color-primary act-icon"></span></div></div>');
                
                feather.replace();
            }
        }
    });

}

function carregarSetores(){

    $('#selectSetor').children().remove();

    $.get({
        type: 'get',
        url: 'backend/controls/estruturaControl.php',
        data: {loadSetores: "true"},
        success: function(data) {

            obj = JSON.parse(data);

            for (var i = 0; i < obj.length; i++) {

                $('#selectSetor').append('<option value="'+obj[i].id_setor+'">'+obj[i].nome_setor+'</option>');

                $('#editSetor').append('<option value="'+obj[i].id_setor+'">'+obj[i].nome_setor+'</option>');
                
                feather.replace();

            }

            carregarCargos($('#selectCargo'),$("#selectSetor").val());
            carregarCargos($('#editCargo'),$("#selectSetor").val());
        }
    });
}

function carregarCargos(tipo,setor){

    tipo.children().remove();

    $.get({
        type: 'get',
        url: 'backend/controls/estruturaControl.php',
        data: {loadCargos:setor},
        success: function(data) {

            obj = JSON.parse(data);

            for (var i = 0; i < obj.length; i++) {

                tipo.append('<option value="'+obj[i].id_cargo+'">'+obj[i].nome_cargo+'</option>');

                feather.replace();

            }
        }
    })
}

function addColab(){

    nome = $('#colab_name').val();
    senha = $('#colab_password').val();
    setor = $('#colab_sector').val();
    cargo = $('#colab_occupation').val();
    email = $('#colab_email').val();
    
    adm = $( "input:checked" ).length;

    setorNome = $('#selectSetor option:selected').text();

    cargoNome = $('#selectCargo option:selected').text();

    $.post({
        type: 'post',
        url: 'backend/controls/usuariosControl.php',
        data: {nomeUsuario:nome,matUsuario:matricula,setorUsuario:setor,cargoUsuario:cargo,emailUsuario:email,senhaUsuario:senha,admUsuario:adm},
        success: function(data) {

            id = data.slice(1,-1);
            param = "'"+nome+"'";
            $('#usuarios-box').append('<div class="row pl-2 pt-3 pb-3" id="user-'+id+'"><div class="col-3"><span class="text-primary h6">'+nome+'</span></div><div class="col-3"><span class="text-success h6">'+cargoNome+'</span></div><div class="col-3"><span class="text-secondary h6">'+setorNome+'</span></div><div class="col-3 flex-column justify-content-end"><span onclick="editarUsuario('+id+')" data-feather="edit" class="color-alert act-icon"></span><span onclick="alertaDeletar('+id+','+param+')" data-feather="trash-2" class="color-danger act-icon"></span><span onclick="visualizarUsuario('+id+')" data-feather="zoom-in" class="color-primary act-icon"></span></div></div>');

            $('#nome_user').val("");
            $('#mat_user').val("");
            $('#senha_user').val("");
            $('#nome_user').val("");
            $('#email_user').val("");

            feather.replace();

        }
    });  

}

function alertaDeletar(id,nome){

    idDeletar = id;

    $("#nomeDeletar").text(nome);

    $("#deletarColab").modal();

} 

function deletarUsuario(){
    
    $.post({
        type: 'post',
        url: 'backend/controls/usuariosControl.php',
        data: {delUsuario:idDeletar},
        success: function(data) {

            $("#user-"+idDeletar).remove();
            idDeletar = 0;

        }   
    }); 

}

function visualizarUsuario(id){
    

    $.get({
        type: 'get',
        url: 'backend/controls/usuariosControl.php',
        data: {carregarUsuarioId: id},
        success: function(data) {

            usuario = JSON.parse(data);
            console.log(usuario);

            $("#viewNome").text(usuario.nome_user);
            $("#viewEmail").text(usuario.email_user);
            $("#viewMat").text(usuario.mat_user);
            $("#viewSetor").text(usuario.nome_cargo);
            $("#viewCargo").text(usuario.nome_setor);

            
            
        }
    });

    $("#visualizarColab").modal();


}

function editarUsuario(id){

    $.get({
        type: 'get',
        url: 'backend/controls/usuariosControl.php',
        data: {carregarUsuarioId: id},
        success: function(data) {

            usuario = JSON.parse(data);

            $("#editNome").val(usuario.nome_user);
            $("#editEmail").val(usuario.email_user);
            $("#editMat").val(usuario.mat_user);
            // if(usuario.grupo_user == 1){
            //     $('input[name=editAdm]').prop('checked', true);
            // }
            
        }
    });

    idEditar = id;

    $("#editColab").modal();


}

function atualizarDados(){

    nome = $("#editNome").val();
    email = $("#editEmail").val();
    mat = $("#editMat").val();
    cargo = $("#editCargo").val();
    setor = $("#editSetor").val();
    senha = $("#editSenha").val();
    // adm = $("#editNome").val();

    $.post({
        type: 'post',
        url: 'backend/controls/usuariosControl.php',
        data: {atualizarDados:idEditar,editarNome:nome,editarEmail:email,editarMat:mat,editarCargo:cargo,editarSetor:setor,editarSenha:senha},
        success: function(data) {

            $('#usuarios-box').children().remove();
            carregarUsuarios();
            
        }
    });


}