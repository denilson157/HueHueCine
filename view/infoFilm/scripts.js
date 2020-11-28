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

//Botão para Adicionar
$('#submitAdd').click(e => {
    e.preventDefault();
    e.stopImmediatePropagation();
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
                + 'Atualizar' +
                '</button>' +
                //Botão para Atualizar estado da Lista
                '<button class="ml-1 btn btn-sm btn-warning" form="formLista" type="submit" id="submitRem">'
                + 'Remover' +
                '</button>');
        });
    }
});

//Botão para Atualizar
$('#submitAtt').click(e => {
    e.preventDefault();
    console.log("Botão Atualizar Clickado"); //------------Teste

    const estado = $('#estadoLista').val();
    const movieId = $('#idMovieTv').val();
    const typeMTV = $('#typeMTV').val();

    console.log(estado);
    if (movieId !== "" && movieId !== undefined && movieId !== null) {
        $.ajax({
            url: '/HUEHUECINE/controller/list/updateList.php',
            method: 'POST',
            data: { state: estado, typeMTV: typeMTV, movieId: parseInt(movieId) },
            dataType: 'json'
        }).done(result => {
            //Colocar mensagem/alert para sinalizar que foi atualizado com sucesso.
            alert("Atualizado com sucesso!");

        });
    }
});

//Botão para Remover da Lista
$('#submitRem').click(e => {
    e.preventDefault();
    console.log("Botão Remover Clickado"); //------------Teste

    const estado = $('#estadoLista').val();
    const movieId = $('#idMovieTv').val();
    const typeMTV = $('#typeMTV').val();

    console.log(estado);
    if (movieId !== "" && movieId !== undefined && movieId !== null) {
        $.ajax({
            url: '/HUEHUECINE/controller/list/deleteList.php',
            method: 'POST',
            data: { state: estado, typeMTV: typeMTV, movieId: parseInt(movieId) },
            dataType: 'json'
        }).done(result => {
            //Fazer regra com base no retorno => Para isso verificar como vem o retorno do delete

            //Atualiza os botões da tela
            document.getElementById('submitAtt').remove();
            document.getElementById('submitRem').remove();
            $('#submits').append(
                //Botão para Adicionar na Lista
                '<button class="ml-1 btn btn-sm btn-primary" form="formLista" type="submit" id="submitAdd">'
                + 'Adicionar' +
                '</button>');
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
                console.log("Verificou");

                //Ja esta adicionado na lista?
                if (result != null) {

                    //Remove Botão para adicionar caso ele exista
                    if (document.getElementById('submitAdd') != null) { document.getElementById('submitAdd').remove(); }

                    //Adiciona os botões para gerenciar lista
                    $('#submits').append(
                        //Botão para Atualizar estado da Lista
                        '<button class="ml-1 btn btn-sm btn-secondary" form="formLista" type="submit" id="submitAtt">'
                        + 'Atualizar' +
                        '</button>' +
                        //Botão para Atualizar estado da Lista
                        '<button class="ml-1 btn btn-sm btn-warning" form="formLista" type="submit" id="submitRem">'
                        + 'Remover' +
                        '</button>');

                    //Seta opção da select option de acordo com retorno
                    document.getElementById('estadoLista').value = result['idStatus'];


                    //Não Está na Lista
                } else {
                    $('#submits').append(
                        //Botão para Atualizar estado da Lista
                        '<button class="ml-1 btn btn-sm btn-primary" form="formLista" type="submit" id="submitAdd">'
                        + 'Adicionar' +
                        '</button>');
                    console.log("Ta não pai");
                }

            });
    }

}

//#endregion