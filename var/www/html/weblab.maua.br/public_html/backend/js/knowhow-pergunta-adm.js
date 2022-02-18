test = 0;
function loadQuestions(idTest){
    test = idTest;
    $('#question-list').children().remove();

    $.get({
        type: 'get',
        url: 'backend/controls/perguntaControl.php',
        data: {loadPergunta: idTest},
        success: function(data) {
            if(data){
                obj = JSON.parse(data);
                for (var i = 0; i < obj.length; i++){
                    //$('#question-list').append('<div id="pergunta-'+obj[i].id_pergunta+'" class="container row d-questao"><div class="col-11"><p class="display-7"><span>'+(i+1)+'.</span>'+obj[i].texto_pergunta+'</p></div><div class="col-1"><span onclick="editarPergunta('+obj[i].id_pergunta+')" id="tool" class="edit" data-feather="edit">▲</span><span onclick="deletarPergunta('+obj[i].id_pergunta+')" id="tool" class="del" data-feather="trash-2">X</span></div></div>');
                    $('#question-list').append('<div id="question-'+obj[i].id_pergunta+'" class="pergunta-rgtrd"><div class="row pt-3"><div class="col-1">'+(i+1)+'.</div><div class="col-9"><div class="pergunta-txt">'+obj[i].texto_pergunta+'</div></div><div class="col-2"><i onclick="deleteQuestion('+obj[i].id_pergunta+')" class="far fa-trash-alt"></i><i class="far fa-edit"></i></div></div></div>');
                }
            }
            else{
                $('#question-list').append('O teste ainda não possui nenhuma questão');
            } 
        }
    });

}

function deleteQuestion(id){
    
    var linktoexecute = "backend/controls/perguntaControl.php";

    $("#question-"+id).remove();

    $.post({
        type: 'post',
        url: linktoexecute,
        data: {delPergunta:id},

    });
}


function addQuestion(){

    var p = $('#question_text').val();
    var a = $('#question_alt_a_text').val();
    var b = $('#question_alt_b_text').val();
    var c = $('#question_alt_c_text').val();
    var d = $('#question_alt_d_text').val();
    if($("input[name='answer']:checked").val()){
        var r = $("input[name='answer']:checked").val();
    }
    else{
        var r = "";
    }
    
    $.post({
        type: 'post',
        url: 'backend/controls/perguntaControl.php',
        data: {textPergunta:p,altA:a,altB:b,altC:c,altD:d,resp:r,idTest:test},
        success: function(data) {
            console.log(data);
            if(data){
                id = data.slice(1,-1);
                $('#question-list').append('<div id="question-'+id+'" class="pergunta-rgtrd"><div class="row pt-3"><div class="col-1">'+(1)+'.</div><div class="col-9"><div class="pergunta-txt">'+p+'</div></div><div class="col-2"><i onclick="deleteQuestion('+id+')" class="far fa-trash-alt"></i><i class="far fa-edit"></i></div></div></div>');
                $('#question_text').val('');
                $('#question_alt_a_text').val('');
                $('#question_alt_b_text').val('');
                $('#question_alt_c_text').val('');
                $('#question_alt_d_text').val('');
                $("input[name='answer']:checked").prop('checked', false); 

             }
            else{

                alert("ERRO DE VALIDACAO");

            }

        }
    }); 

}