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
$('#formLista').submit(e =>{
    e.preventDefault();
    /*const estado = $('#estado').val();
    const movieId = $('#idMovieTv').val();

    console.log(estado);
    //if(  ){

    //}*/
    alert("gay");

});

//#endregion