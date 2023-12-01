@extends('layout.app')
@section('content')

<div>
    @foreach ($groups as $group)
    <a class="btn btn-primary submit" data-group-id="{{ $group->id }}" type="submit">{{ $group->name }}</a>
    @endforeach
</div>

<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Csapatnév</th>
                <th scope="col">Pálya</th>
                <th scope="col">Játéknap</th>
            </tr>
        </thead>

        <tbody id="tdata">

        </tbody>
    </table>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //gombok id lekérése
        $(document).on('click', '.submit', function() {

            let group_id = $(this).data('group-id');

            $.ajax({
                url: "{{url('championship/teams/getTeamsByGroupId')}}",
                type: "POST",
                data: {
                    group_id: group_id,
                },
                dataType: 'json',
                success: function(response) {
                    
                    $('#tdata').empty();
                    $.each(response.teams, function(key, value) {

                        $('#tdata').append('<tr>' +
                            '<td>' + value.name + '</td>' +
                            '<td>' + value.track.name + '</td>' +
                            '<td>' + value.day.name + '</td>' +
                            '</tr>'
                        );
                    });
                }
            });
        });
    });
</script>
@endsection
