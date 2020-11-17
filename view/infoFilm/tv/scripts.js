$('#formReview').submit(function (e) {
    e.preventDefault();

    const comment = $('#newReview').val();

    //console.log(u_name, u_comment);
    $.ajax({
        url: '/HUEHUECINE/controller/insertComment.php',
        method: 'POST',
        data: { comment: comment },
        dataType: 'json'
    }).done(function (result) {
        $('#name').val('');
        $('#comment').val('');
        console.log(result);
        getComments();
    });
});

function getComments() {
    console.log('tee')
    $.ajax({
        url: '/HUEHUECINE/controller/getComment.php',
        method: 'GET',
        dataType: 'json'
    }).done(function (result) {
        console.log(result);

        for (var i = 0; i < result.length; i++) {
            $('.box_comment').prepend('<div class="b_comm"><h4>' + result[i].name + '</h4><p>' + result[i].comment + '</p></div>');
        }
    });
}

getComments();