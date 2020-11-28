//Init
document.onreadystatechange = function () {
    if (document.readyState === 'complete') {
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
//OBS:
//Discutir sobre o fato de verificar a lista toda vez que houver uma mudança na lista ao ver se mudar estaticamente...
//Pode resolver o problema de retorno do banco das solicitações vierem vazias
//Discutir sobre como adicionar temporada/Ep nos TVs, inicalmente conclui que deve se ter scripts diferentes para melhor organização, porém não é uma necessidade.

//Função para Controle Visual dos Botoes da Lista
function atualizaBtns(btnclickado) {

    if(btnclickado == "submitAdd"){
        document.getElementById('submitAdd').style.display = 'none';
        document.getElementById('submitAtt').style.display = "";
        document.getElementById('submitRem').style.display = "";
    }else{
        document.getElementById('submitAdd').style.display = "";
        document.getElementById('submitAtt').style.display = "none";
        document.getElementById('submitRem').style.display = "none";
    }
    
}

//Botão para Adicionar
$('#submitAdd').click(e => {
    e.preventDefault();

    const estado = $('#estadoLista').val();
    const movieId = $('#idMovieTv').val();
    const typeMTV = $('#typeMTV').val();

    if (movieId !== "" && movieId !== undefined && movieId !== null) {
        $.ajax({
            url: '/HUEHUECINE/controller/list/insertList.php',
            method: 'POST',
            data: { state: estado, typeMTV: typeMTV, movieId: parseInt(movieId) },
            dataType: 'json'
        }).done(result => {
            //Trabalhar se a solitação foi efetuada com sucesso
            //

            //Atualiza botões na tela
            atualizaBtns("submitAdd"); // Puxar dados pelo evento.
            
        });
    }
});

//Botão para Atualizar
$('#submitAtt').click(e => {
    e.preventDefault();

    const estado = $('#estadoLista').val();
    const movieId = $('#idMovieTv').val();
    const typeMTV = $('#typeMTV').val();

    if (movieId !== "" && movieId !== undefined && movieId !== null) {
        $.ajax({
            url: '/HUEHUECINE/controller/list/updateList.php',
            method: 'POST',
            data: { state: estado, typeMTV: typeMTV, movieId: parseInt(movieId) },
            dataType: 'json'
        }).done( ()=> {
            alert("Atualizado com sucesso!");

        });
    }
});

//Botão para Remover da Lista
$('#submitRem').click(e => {
    e.preventDefault();

    const estado = $('#estadoLista').val();
    const movieId = $('#idMovieTv').val();
    const typeMTV = $('#typeMTV').val();

    if (movieId !== "" && movieId !== undefined && movieId !== null) {
        $.ajax({
            url: '/HUEHUECINE/controller/list/deleteList.php',
            method: 'POST',
            data: { state: estado, typeMTV: typeMTV, movieId: parseInt(movieId) },
            dataType: 'json'
        }).done(result => {
            //Trabalhar se a solitação foi efetuada com sucesso
            //

            //Atualiza botões na tela
            atualizaBtns("submitRem");

        });
    }
});

//Verifica se o filme atual está na lista.
const verifyList = () => {

    const movieId = $('#idMovieTv').val();
    const typeMTV = $('#typeMTV').val();

    if ((movieId !== "" && movieId !== undefined)) {
        
        $.ajax(
            {
                url: '/HUEHUECINE/controller/list/getList.php',
                method: 'POST',
                data: { typeMTV: typeMTV, movieId: parseInt(movieId) },
                dataType: 'json'
            }).done(result => {
                console.log(result);
                //Ja esta adicionado na lista?
                if (result != null) { //Caso Positivo

                    //Atualzia Botões na tela
                    atualizaBtns("submitAdd"); //Add pois se ele existe na lista, deve ser passado como parametros submitAdd na função

                    //Seta opção da select option de acordo com retorno
                    document.getElementById('estadoLista').value = result['idStatus'];

                }
                else { //Caso Negativo

                    //Atualzia Botões na tela
                    atualizaBtns("submitRem"); //Rem pois se ele não existe na lista, deve ser passado como parametros submitRem na função
                }
            });
    }
}

//#endregion