@extends('layout.app')

@section('content')
<div class="container p-4">
    <div class="text-center">
        <h3>Felvitt pályák listája</h3>
    </div>
    <div>
        <a href="javascript:void(0)" class="btn btn-success float-end btn-sm" id="add-track">Pálya felvitele</a>
    </div>

    <div class="container w-75 pt-5">
        <table class="table list table-hover" id="table-adminTrack-list">
            <thead>
                <tr>
                    <th width="10%" scope="col">#</th>
                    <th width="40%" scope="col">Pálya</th>
                    <th width="50%" scope="col">Műveletek</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach($tracks as $track)
                <?php $i++; ?>
                <tr data-id="{{ $track->id }}">
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $track->name }}</td>
                    <td>
                        <a href="javascript:void(0)" data-id="{{ $track->id }}" class="edit btn btn-primary btn-sm" id="edit-track">Szerkesztés</a>
                        <a href="javascript:void(0)" data-id="{{ $track->id }}" class="btn btn-danger btn-sm" id="delete-track">Törlés</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@include('admin.tracks.track_modal')

@endsection


@section('script')
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add-track').click(function() {
            $('#track_id').val('');
            $('#trackForm').trigger("reset");
            $('#submit-track').html("Mentés");
            $('#trackHeading').html("Pálya létrehozása");
            $('#trackModal').modal('show');
        });

        $('body').on('click', '#edit-track', function() {
            let track_id = $(this).data('id');
            $.get("{{ route('tracks.index') }}" + '/' + track_id + '/edit', function(data) {
                $('#submit-track').html("Frissítés");
                $('#trackHeading').html("Pálya szerkesztése");
                $('#trackModal').modal('show');
                $('#track_id').val(data.id);
                $('#track_name').val(data.name);
            })
        });

        $('#submit-track').click(function(e) {
            e.preventDefault();

            $.ajax({
                data: $('#trackForm').serialize(),
                url: "{{ route('tracks.store') }}",
                type: "POST",
                dataType: "JSON",
                success: function(data) {

                    $('#trackForm').trigger("reset");
                    $('#trackModal').modal('hide');
                    $('#table-adminTrack-list').load(location.href + ' #table-adminTrack-list');

                },
                error: function(data) {

                    console.log('Error:', data);
                    let error = data.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errorMessages').append('<span class="text-danger">' + value + '</span>' + '<br>');
                    });
                }
            });
        });

        $('body').on('click', '#delete-track', function() {

            let track_id = $(this).data("id");
            confirm("Biztos törölni akarod az értéket?");

            $.ajax({
                type: "DELETE",
                url: "{{ route('tracks.store') }}" + '/' + track_id,
                success: function(data) {

                    $('#table-adminTrack-list').load(location.href + ' #table-adminTrack-list');
                },
                error: function(data) {

                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
