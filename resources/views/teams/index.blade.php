@extends('layout.app')
@section('content')


<div class="container p-4">
    <div class="text-center">
        <h3>{{ $team->name }} csapat adatai</h3>
        @if ($team->group)
        <h3>{{ $team->group->name }}</h3>
        @endif
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

    {{--Csapat adatai--}}
    <div class="container w-75 pt-5">
        <table class="table caption-top" id="table-teamTeam-list">
            <caption class="caption">Csapat adatai</caption>
            <a class="btn btn-success float-end btn-sm" href="{{ route('teams.edit', $team->id) }}">Szerkesztés</a>
            <thead>
                <tr>
                    <th width="33%" scope="col">Csapatnév</th>
                    <th width="33%" scope="col">Pálya</th>
                    <th width="33%" scope="col">Játéknap</th>
                </tr>
            </thead>

            <tbody>
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
            </tbody>
        </table>

        {{--Csapatkapitány adatai--}}
        <table class="table caption-top" id="table-teamTeamCaptain-list">
            <caption class="caption">Csapatkapitány adatai</caption>
            <a class="btn btn-info float-end btn-sm" href="{{ route('teamCaptains.index') }}">Részletek</a>
            <thead>
                <tr>
                    <th width="33%" scope="col">Név</th>
                    <th width="33%" scope="col">Email</th>
                    <th width="33%" scope="col">Telefonszám</th>
                </tr>
            </thead>

            <tbody>
                <td>{{ $teamCaptain->name }}</td>
                @if ($teamCaptain->registrationdata)
                <td>{{ $teamCaptain->registrationdata->email }}</td>
                @else
                <td>-</td>
                @endif
                @if ($teamCaptain->phone)
                <td>{{ $teamCaptain->phone->phone }}</td>
                @else
                <td>-</td>
                @endif
            </tbody>
        </table>

        {{--Játékosok adatai--}}
        <table class="table caption-top" id="table-teamPlayers-list">
            <caption class="caption">Játékosok adatai</caption>
            <a class="btn btn-info float-end btn-sm" href="{{ route('players.index') }}">Részletek</a>
            <thead>
                <tr>
                    <th width="10%" scope="col">#</th>
                    <th width="30%" scope="col">Név</th>
                    <th width="30%" scope="col">Telefonszám</th>
                    <th width="30%" scope="col">Állapot</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach ($users as $user)
                @foreach ($user->roles as $role)
                <?php $i++; ?>
                @if ($role->id === 4)
                <th scope="row">{{ $i }}</th>
                <td>{{ $user->name }}</td>
                @if ($user->phone)
                <td>{{ $user->phone->phone }}</td>
                @else
                <td>-</td>
                @endif
                @if ($user->status === 1)
                <td>aktív</td>
                @else
                <td>passzív</td>
                @endif
            </tbody>
            @endif
            @endforeach
            @endforeach
        </table>

        {{--Adatrögzítő adatai--}}
        <table class="table caption-top" id="table-teamDataRecorders-list">
            <caption class="caption">Adatrögzítők adatai</caption>
            <a class="btn btn-info float-end btn-sm" href="{{ route('dataRecorders.index') }}">Részletek</a>
            <thead>
                <tr>
                    <th width="10%" scope="col">#</th>
                    <th width="30%" scope="col">Név</th>
                    <th width="30%" scope="col">Email</th>
                    <th width="30%" scope="col">Telefonszám</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach ($users as $user)
                @foreach ($user->roles as $role)
                <?php $i++; ?>
                @if ($role->id === 3)
                <th scope="row">{{ $i }}</th>
                <td>{{ $user->name }}</td>
                @if ($user->registrationdata)
                <td>{{ $user->registrationdata->email }}</td>
                @else
                <td>-</td>
                @endif
                @if ($user->phone)
                <td>{{ $user->phone->phone }}</td>
                @else
                <td>-</td>
                @endif
            </tbody>
            @endif
            @endforeach
            @endforeach
        </table>
    </div>
</div>






@endsection


@section('script')
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add-player').click(function() {
            $('#player_id').val('');
            $('#playerForm').trigger("reset");
            $('#submit-player').html("Mentés");
            $('#playerHeading').html("Játékos létrehozása");
            $('#playerModal').modal('show');
        });

        $('body').on('click', '#edit-player', function() {
            let player_id = $(this).data('id');
            $.get("{{ route('players.index') }}" + '/' + player_id + '/edit', function(data) {
                $('#submit-player').html("Frissítés");
                $('#playerHeading').html("Játékos szerkesztése");
                $('#playerModal').modal('show');
                $('#player_id').val(data.id);
                $('#player_name').val(data.name);
            })
        });

        $('#submit-player').click(function(e) {
            e.preventDefault();

            $.ajax({
                data: $('#playerForm').serialize(),
                url: "{{ route('players.store') }}",
                type: "POST",
                dataType: "JSON",
                success: function(data) {

                    $('#playerForm').trigger("reset");
                    $('#playerModal').modal('hide');
                    $('#list-player-table').load(location.href + ' #list-player-table');

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

        $('body').on('click', '#delete-player', function() {

            let player_id = $(this).data("id");
            confirm("Biztos törölni akarod az értéket?");

            $.ajax({
                type: "DELETE",
                url: "{{ route('players.store') }}" + '/' + player_id,
                success: function(data) {

                    $('#list-player-table').load(location.href + ' #list-player-table');
                },
                error: function(data) {

                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
