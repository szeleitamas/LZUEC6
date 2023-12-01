@extends('layout.app')
@section('content')


<div class="container p-4">
    <div class="text-center">
        <h3>Csapatok adatai</h3>
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
        <a href="javascript:void(0)" class="btn btn-primary float-end btn-sm" id="add-fakeTeam">Nem létező csapat felvitele</a>
    </div>

    {{--Csapat számai--}}
    <div class="container w-25 pt-5">
        <table class="table caption-top" id="table-listTeamNumber-list">
            <caption class="caption">Osztályhoz rendelt csapatok száma</caption>
            <thead>
                <tr>
                    <th width="50%" scope="col">Osztály</th>
                    <th width="50%" scope="col">Csapatok száma</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($groups as $group)
                <td>{{ $group->name }}</td>
                <td>{{ $group->teams->count() }}</td>
            </tbody>
            @endforeach
        </table>
    </div>



    {{--Csapat adatai--}}
    <div class="container w-75 pt-5">
        <table class="table table-hover caption-top" id="table-listTeam-list">
            <caption class="caption">Csapat adatai</caption>
            <thead>
                <tr>
                    <th width="5%" scope="col">Sorszám</th>
                    <th width="20%" scope="col">Csapatnév</th>
                    <th width="15%" scope="col">Pálya</th>
                    <th width="10%" scope="col">Játéknap</th>
                    <th width="10%" scope="col">Játékosok száma</th>
                    <th width="10%" scope="col">Csoport</th>
                    <th width="30%" scope="col">Műveletek</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 0 ?>
                @foreach ($teams as $team)
                <?php $i++ ?>
                <tr id="sid{{ $team->id }}">
                <tr data-id="{{ $team->id }}">
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $team->name }}</td>
                    @if ($team->track)
                    <td>{{ $team->track->name }}</td>
                    @else
                    <td>-</td>
                    @endif
                    @if ($team->day)
                    <td>{{ $team->day->name }}</td>
                    @else
                    <td>-</td>
                    @endif
                    @if ($team->users)
                    <td>{{ $team->users->count() }}</td>
                    @else
                    <td>-</td>
                    @endif
                    @if ($team->group_id)
                    <td>{{ $team->group->name }}</td>
                    @else
                    <td>-</td>
                    @endif
                    <td>
                        <div class="actionMenu">
                            <a href="{{ route('teamList.show', $team->id) }}" class="btn btn-secondary btn-sm">Részletek</a>
                            @if ($team->users->count() < 3) <button class="btn btn-light btn-sm" type="button" disabled>Csoport +</button>
                                @else
                                <a href="{{ route('teamToGroup.edit', $team->id) }}" class="btn btn-primary btn-sm" id="edit_group">Csoport +</a>
                                @endif
                                <a href="javascript:void(0)" data-id="{{ $team->id }}" class="btn btn-danger btn-sm" id="delete-fakeTeam">Törlés</a>
                        </div>
                    </td>
            </tbody>
            @endforeach

        </table>
    </div>
</div>

@include('list.teams.fakeTeam_modal')

@endsection

@section('script')
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Modal kialakítás a létrehozáshoz
        $('#add-fakeTeam').click(function() {
            $('#fakeTeam_id').val('');
            $('#fakeTeamForm').trigger("reset");
            $('#submit-fakeTeam').html("Mentés");
            $('#fakeTeamHeading').html("Nem létező csapat felvitele");
            $('#fakeTeamModal').modal('show');
        });

        //Modal kialakítás a módosításhoz
        $('body').on('click', '#edit-fakeTeam', function() {
            let fakeTeam_id = $(this).data('id');
            $.get("{{ route('teamList.index') }}" + '/' + fakeTeam_id + '/edit', function(data) {
                $('#submit-fakeTeam').html("Frissítés");
                $('#fakeTeamHeading').html("Játéknap szerkesztése");
                $('#fakeTeamModal').modal('show');
                $('#fakeTeam_id').val(data.id);
                $('#fakeTeam_name').val(data.name);
            })
        });

        //Mentés és frissítés metódusa
        $('#submit-fakeTeam').click(function(e) {
            e.preventDefault();

            $.ajax({
                data: $('#fakeTeamForm').serialize(),
                url: "{{ route('fakeTeam.store') }}",
                type: "POST",
                dataType: "JSON",
                success: function(data) {

                    $('#fakeTeamForm').trigger("reset");
                    $('#fakeTeamModal').modal('hide');
                    $('#table-listTeamNumber-list').load(location.href + ' #table-listTeamNumber-list');
                    $('#table-listTeam-list').load(location.href + ' #table-listTeam-list');

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

        //Törlés metódusa
        $('body').on('click', '#delete-fakeTeam', function() {

            let fakeTeam_id = $(this).data("id");
            confirm("Biztos törölni akarod az értéket? A csapat és az összes játékos véglegesen törlésre kerül!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('teams.store') }}" + '/' + fakeTeam_id,
                success: function(data) {

                    $('#table-listTeamNumber-list').load(location.href + ' #table-listTeamNumber-list');
                    $('#table-listTeam-list').load(location.href + ' #table-listTeam-list');
                },
                error: function(data) {

                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
