@extends('layout.app')
@section('content')

<div class="container p-4">
    <div class="text-center">
        <h3>Felvitt osztályok listája</h3>
    </div>

    <div class="mt-5">
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <div>
        <a href="javascript:void(0)" class="btn btn-success float-end btn-sm" id="add-group">Osztály felvitele</a>
    </div>

    <div class="container w-75 pt-5">
        <table class="table list table-hover" id="table-adminGroup-list">
            <thead>
                <tr>
                    <th width="10%" scope="col">#</th>
                    <th width="40%" scope="col">Osztályok</th>
                    <th width="50%" scope="col">Műveletek</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach($groups as $group)
                <?php $i++; ?>
                <tr data-id="{{ $group->id }}">
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $group->name }}</td>
                    <td>
                        <a href="javascript:void(0)" data-id="{{ $group->id }}" class="edit btn btn-primary btn-sm" id="edit-group">Szerkesztés</a>
                        <a href="javascript:void(0)" data-id="{{ $group->id }}" class="btn btn-danger btn-sm" id="delete-group">Törlés</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>

@include('admin.groups.group_modal')

@endsection


@section('script')
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add-group').click(function() {
            $('#group_id').val('');
            $('#groupForm').trigger("reset");
            $('#submit-group').html("Mentés");
            $('#groupHeading').html("Osztály létrehozása");
            $('#groupModal').modal('show');
        });

        $('body').on('click', '#edit-group', function() {
            let group_id = $(this).data('id');
            $.get("{{ route('groups.index') }}" + '/' + group_id + '/edit', function(data) {
                $('#submit-group').html("Frissítés");
                $('#groupHeading').html("Osztály szerkesztése");
                $('#groupModal').modal('show');
                $('#group_id').val(data.id);
                $('#group_name').val(data.name);
            })
        });

        $('#submit-group').click(function(e) {
            e.preventDefault();

            $.ajax({
                data: $('#groupForm').serialize(),
                url: "{{ route('groups.store') }}",
                type: "POST",
                dataType: "JSON",
                success: function(data) {

                    $('#groupForm').trigger("reset");
                    $('#groupModal').modal('hide');
                    $('#table-adminGroup-list').load(location.href + ' #table-adminGroup-list');

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

        $('body').on('click', '#delete-group', function() {

            let group_id = $(this).data("id");
            confirm("Biztos törölni akarod az értéket?");

            $.ajax({
                type: "DELETE",
                url: "{{ route('groups.store') }}" + '/' + group_id,
                success: function(data) {

                    $('#table-adminGroup-list').load(location.href + ' #table-adminGroup-list');
                },
                error: function(data) {

                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
