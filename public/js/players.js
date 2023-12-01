$(document).ready(function(){

    var table = '#list-player-table';
    var modal = '#add-player-modal';
    var form = '#add-player-form';

    $(form).on('submit', function(event){
        event.preventDefault();

        var url = $(this).attr('data-action');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                var row = '<tr>';
                    row += '<th scope="row">'+response.id+'</th>';
                    row += '<td>'+response.name+'</td>';
                    row += '<td>'+response.birthyear+'</td>';
                row += '</tr>';

                $(table).find('tbody').prepend(row);


                $(form).trigger("reset");
                $(modal).modal('hide');
            },
            error: function(response) {
            }
        });
    });

});
