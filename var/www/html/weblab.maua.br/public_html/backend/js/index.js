$(document).ready(function(){

    

    $.get({
        type: 'get',
        url: 'backend/controls/knowhowControl.php',
        data: {'load': 'true' },
        success: function(data) {
            obj = JSON.parse(data);
            for (var i = 0; i < obj.length; i++) {
                $('#knowhow-container').append('<div class="row"><div class="col-4"><span>'+obj[i].nome+'</span></div><div class="col-7"><div class="progress-container"><div class="progress" style="width: '+((!obj[i].media) ? 0 : ((obj[i].media)*10))+'%"></div></div></div><div class="col-1"><i value="'+obj[i].id+'" class="fas fa-chevron-circle-up"></i></div></div>');
            }

        }
    });

    $.get({
        type: 'get',
        url: 'backend/controls/aval360Control.php',
        data: {'load': 'true' },
        success: function(data) {
            obj = JSON.parse(data);
            $('#perc-sub').text(obj[0]+"%");
            $('#perc-colab').text(obj[1]+"%");
            $('#perc-sup').text(obj[2]+"%");
        }
    });

    $.get({
        type: 'get',
        url: 'backend/controls/nineboxControl.php',
        data: {load: true },
        success: function(data) {
            console.log(data);
            if(data < 4){
                $("#ninebox-"+data).addClass("bg-danger");
            }
            else if(data > 3 && data < 7){
                $("#ninebox-"+data).addClass("bg-alert");
            }
            else{
                $("#ninebox-"+data).addClass("bg-success");
            }
            
        }
    });

    var array1 = new Array("Insuficiente: Reavalie sua area de atuacao, pois essa e uma situacao de risco se voce ja fez o teste", "Questionavel: Seu potencial esta sendo gasto de forma ineficiente ou nao possui notas na avaliacao Ninebox, reavalie sua area de atuacao", "Eficaz: Sua Eficiencia na sua atual area e mediana. muito ainda deve ser melhorado", "Diamante Bruto: Existe um grande potencial, porem sua eficacia nao o acompanha, e recomendado um treinamento para elevar sua eficacia ", "Comprometido: Existe uma alta eficacia no servico prestado, porem seu potencial de crescimento na area e muito baixo, uma reavaliacao da area de atuacao e recomendado", "Mantenedor: Um profissional que tem muito espaco pra crescimento na area, porem ha muito a ser melhorado", "Forte Desempenho: Alta Eficiencia e um bom potencial, avaliar se o trabalho esta sendo feito da melhor forma possivel e essencial ", "Forte Desempenho: Sua Eficiencia ainda poderia estar melhor, uma conversa com seu gestor e recomendada ", "Alto Potencial: Voce ja providencia o seu melhor nessa ocupacao, uma conversa com o gestor e recomendada");
    for (let index = 0; index < 9; index++) {
        $("#ninebox-"+(index+1)).bind("mouseover", function () {
            $("#ninebox-text-general").hide();
            $("#ninebox-text-general").text(array1[index]).fadeIn(300);
        });    
        $("#ninebox-"+(index+1)).bind("mouseout", function () { 
            $("#ninebox-text-general").hide();
            $("#ninebox-text-general").text("A matriz Nine Box é uma ferramenta simples e eficaz, utilizada para avaliar o talento nas organizações.").fadeIn(300);
        });
    }

    $.get({
        type: 'get',
        url: 'backend/controls/todoControl.php',
        data: {'load': 'true' },
        success: function(data) {
            obj = JSON.parse(data);
            for (var i = 0; i < obj.length; i++) {
                $( '#todo_box' ).append('<li id="toDo'+obj[i].id_todo+'" class="barlow font-weight-bold "><input type="checkbox" id="test" value=""><label for="test" class="text noselect">'+obj[i].text_todo+'</label><span class="badge bg-primary ml-2" style="font-size:1.4vh"><span data-feather="clock" style="height:2vh;"></span>Agora</span><div class="tools"><span onclick="delToDo('+obj[i].id_todo+')" data-feather="trash-2"></span></div></li><script>feather.replace();</script>');

            }
        }
    });
    
});

function delToDo(id){
    
    var linktoexecute = "backend/controls/todoControl.php";

    $("#toDo"+id).addClass("remove").stop().delay(100).slideUp("fast", function(){
    $("#toDo"+id).remove();
    });

    $.get({
        type: 'post',
        url: linktoexecute,
        data: {delToDo:id},

    });
}

function addToDo() {
    
    var text = $('#inputToDo').val();
    if(text != ""){
        var linktoexecute = "backend/controls/todoControl.php";
        $.get({
            type: 'post',
            url: linktoexecute,
            data: {addToDo:text},
            success: function(data) {
                
                id = data.slice(1,-1);

                $('#todo_box').append('<li id="toDo'+parseInt(id)+'" class="barlow font-weight-bold "><input type="checkbox" id="test" value=""><label for="test" class="text noselect">'+text+'</label><span class="badge bg-primary ml-2" style="font-size:1vh"><span data-feather="clock" style="height:1.8vh;"></span>Agora</span><div class="tools"><span onclick="delToDo('+parseInt(id)+')" data-feather="trash-2"></span></div></li><script>feather.replace();</script>');
                
                $('#inputToDo').val('');
                
            }
        });
    }
} 
