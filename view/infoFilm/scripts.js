//Init
document.onreadystatechange = function () {
    if(document.readyState === 'complete'){
        verifyList();
    }
  }

//#region Comentario
$('#formReview').submit(e => {
    e.preventDefault();

    const comment = $('textarea#review').val();
    const movieId = $('#idMovieTv').val();

    if ((comment !== "" && comment !== undefined) && (movieId !== "" && movieId !== undefined))
        $.ajax({
            url: '/HUEHUECINE/controller/comment/insertComment.php',
            method: 'POST',
            data: { comment: comment, movieId: parseInt(movieId) },
            dataType: 'json'
        }).done(() => {
            $('textarea#review').val('');
            getComments();
        });
});

const getComments = () => {
    const movieId = $('#idMovieTv').val();
    const emailUser = $('#emailUser').val();

    if ((movieId !== "" && movieId !== undefined))
        $.ajax({
            url: '/HUEHUECINE/controller/comment/getComment.php',
            method: 'POST',
            dataType: 'json',
            data: { movieId: parseInt(movieId) },
        }).done(result => {

            let box_comm = document.querySelector('.box-comment');
            while (box_comm.firstChild) {
                box_comm.firstChild.remove();
            }

            if (result != null)
                result.forEach(element => {

                    $('.box-comment')
                        .append(
                            '<div class="mx-0 py-2">' +
                            '<div class="info-user">' +
                            '<span class="text-green h5 mr-2">' +
                            element.nome + " " + element.sobrenome +
                            '</span>' +
                            '<span class="text-secondary">' +
                            new Date(element.dataComentario).toLocaleDateString("pt-BR") +
                            '</span>' +
                            (emailUser == element.email &&
                                ('<span class="text-danger" onclick="removeComment(' + element.id + ')" style="cursor:pointer">' +
                                    ' Excluir' +
                                    '</span>'
                                )
                            )
                            +
                            '</div>' +
                            '<p class="text-secondary mb-1">' +
                            element.comentario +
                            '</p>' +
                            '</div>'
                        )
                });

        });
}

const removeComment = idComment => {
    if (idComment !== "" && idComment !== undefined && !isNaN(parseInt(idComment)))
        $.ajax({
            url: '/HUEHUECINE/controller/comment/deleteComment.php',
            method: 'POST',
            data: { commentId: parseInt(idComment) },
            dataType: 'json'
        }).done(() => {
            getComments();
        });
}

getComments();
//#endregion


//#region Lista

//Botão para Adicionar
$('#submitAdd').click(e => {
    e.preventDefault();
        console.log(e);

        const estado = $('#estadoLista').val();
        const movieId = $('#idMovieTv').val();
        const typeMTV = $('#typeMTV').val();

        console.log(estado);
        if (movieId !== "" && movieId !== undefined && movieId !== null) {
            $.ajax({
                url: '/HUEHUECINE/controller/list/insertList.php',
                method: 'POST',
                data: { state: estado, typeMTV: typeMTV, movieId: parseInt(movieId) },
                dataType: 'json'
            }).done(() => {
                //Atualiza os botões da tela
                document.getElementById('submitAdd').remove();
                $('#submits').append(
                    //Botão para Atualizar estado da Lista
                    '<button class="ml-1 btn btn-sm btn-secondary" form="formLista" type="submit" id="submitAtt">'
                    +'Atualizar'+
                    '</button>'+
                    //Botão para Atualizar estado da Lista
                    '<button class="ml-1 btn btn-sm btn-warning" form="formLista" type="submit" id="submitRem">'
                    +'Remover'+
                    '</button>')
            });
        }
});

//Botão para Atualizar
$('#submitAtt').click(e => {
    e.preventDefault();
    console.log("Botão Atualizar Clickado");
    /*
         const estado = $('#estadoLista').val();
         const movieId = $('#idMovieTv').val();
         const typeMTV = $('#typeMTV').val();
 
         console.log(estado);
         if (movieId !== "" && movieId !== undefined && movieId !== null) {
             $.ajax({
               //  url: '/HUEHUECINE/controller/list/insertList.php',
                 method: 'POST',
                 data: { state: estado, typeMTV: typeMTV, movieId: parseInt(movieId) },
                 dataType: 'json'
             }).done(() => {
                 //Atualizar botão ou tela para sinalizar que o filme ja esta na lista
                 
             });
         }*/
 });

//Botão para Remover da Lista
$('#submitRem').click(e => {
    e.preventDefault();
    console.log("Botão Remover Clickado");
    /*
        const estado = $('#estadoLista').val();
        const movieId = $('#idMovieTv').val();
        const typeMTV = $('#typeMTV').val();

        console.log(estado);
        if (movieId !== "" && movieId !== undefined && movieId !== null) {
            $.ajax({
              //  url: '/HUEHUECINE/controller/list/insertList.php',
                method: 'POST',
                data: { state: estado, typeMTV: typeMTV, movieId: parseInt(movieId) },
                dataType: 'json'
            }).done(() => {
                //Atualizar botão ou tela para sinalizar que o filme ja esta na lista
                
            });
        }*/
});

//Verifica se o filme atual está na lista.
const verifyList = () => {

    //Teste para atualizar UI
    result = [1, "2"];

    /*
    * Inserir busca no banco pela requisão http
    */

    //Ja esta adicionado na lista?
    if(result[0] == 1){ 

        //Remove Botão para adicionar caso ele exista
        if(document.getElementById('submitAdd') != null){ document.getElementById('submitAdd').remove(); }

        //Adiciona os botões para gerenciar lista
        $('#submits').append(
            //Botão para Atualizar estado da Lista
            '<button class="ml-1 btn btn-sm btn-secondary" form="formLista" type="submit" id="submitAtt">'
            +'Atualizar'+
            '</button>'+
            //Botão para Atualizar estado da Lista
            '<button class="ml-1 btn btn-sm btn-warning" form="formLista" type="submit" id="submitRem">'
            +'Remover'+
            '</button>');
        
        

    }else{ //Não Está na Lista
        $('#submits').append(
            //Botão para Atualizar estado da Lista
            '<button class="ml-1 btn btn-sm btn-primary" form="formLista" type="submit" id="submitAdd">'
            +'Adicionar'+
            '</button>');
        console.log("Ta não pai");
    }

}

//#endregion