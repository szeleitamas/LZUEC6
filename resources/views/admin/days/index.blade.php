@extends('layout.app')

@section('content')
<div class="container p-4">
    <div class="text-center">
        <h3>Felvitt játéknapok listája</h3>
    </div>
    <div>
        <a href="javascript:void(0)" class="btn btn-success float-end btn-sm" id="add-day">Játéknap felvitele</a>
    </div>

    <div class="container w-75 pt-5">
    <table class="table list table-hover" id="table-adminDay-list">
        <thead>
            <tr>
                <th width="10%" scope="col">#</th>
                <th width="40%" scope="col">Játéknap</th>
                <th width="50%" scope="col">Műveletek</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 0; ?>
            @foreach($days as $day)
            <?php $i++; ?>
            <tr data-id="{{ $day->id }}">
                <th scope="row">{{ $i }}</th>
                <td>{{ $day->name }}</td>
                <td>
                    <a href="javascript:void(0)" data-id="{{ $day->id }}" class="edit btn btn-primary btn-sm" id="edit-day">Szerkesztés</a>
                    <a href="javascript:void(0)" data-id="{{ $day->id }}" class="btn btn-danger btn-sm" id="delete-day">Törlés</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    </div>
</div>

@include('admin.days.day_modal')

@endsection


@section('script')
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add-day').click(function() {
            $('#day_id').val('');
            $('#dayForm').trigger("reset");
            $('#submit-day').html("Mentés");
            $('#dayHeading').html("Játéknap létrehozása");
            $('#dayModal').modal('show');
        });

        $('body').on('click', '#edit-day', function() {
            let day_id = $(this).data('id');
            $.get("{{ route('days.index') }}" + '/' + day_id + '/edit', function(data) {
                $('#submit-day').html("Frissítés");
                $('#dayHeading').html("Játéknap szerkesztése");
                $('#dayModal').modal('show');
                $('#day_id').val(data.id);
                $('#day_name').val(data.name);
            })
        });

        $('#submit-day').click(function(e) {
            e.preventDefault();

            $.ajax({
                data: $('#dayForm').serialize(),
                url: "{{ route('days.store') }}",
                type: "POST",
                dataType: "JSON",
                success: function(data) {

                    $('#dayForm').trigger("reset");
                    $('#dayModal').modal('hide');
                    $('#table-adminDay-list').load(location.href + ' #table-adminDay-list');

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

        $('body').on('click', '#delete-day', function() {

            let day_id = $(this).data("id");
            confirm("Biztos törölni akarod az értéket?");

            $.ajax({
                type: "DELETE",
                url: "{{ route('days.store') }}" + '/' + day_id,
                success: function(data) {

                    $('#table-adminDay-list').load(location.href + ' #table-adminDay-list');
                },
                error: function(data) {

                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
