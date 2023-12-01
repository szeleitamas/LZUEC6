@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('teams.index') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>Felvitt játékosok listája</h3>
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
        <a href="javascript:void(0)" class="btn btn-success float-end btn-sm" id="add-player">Játékos felvitele</a>
    </div>

    <div class="container w-75 pt-5">
        <table class="table list" id="table-teamPlayersPlayers-list">
            <thead>
                <tr>
                    <th width="10%" scope="col">#</th>
                    <th width="35%" scope="col">Név</th>
                    <th width="35%" scope="col">Szerepkör</th>
                    <th width="20%" scope="col">Műveletek</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach($users as $user)
                @foreach ($user->roles as $role)
                @if ($role->id === 4 )
                <?php $i++; ?>
                <th scope="row">{{ $i }}</th>
                <td>{{ $user->name }}</td>
                @if ($user->roles)
                <td>{{ $user->roles->sortBy('id')->first()->name }}</td>
                @else
                <td>-</td>
                @endif
                <td>
                    <div class="actionMenu">
                        <a href="{{ route('players.edit', $user->id) }}" class="btn btn-success btn-sm">Szerkesztés</a>
                        <form action="{{ route('players.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger btn-sm" type="submit" value="Törlés">
                        </form>
                    </div>
                </td>
                </tr>
                @endif
                @endforeach
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@include('teams.players.player_modal')

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
        $('#add-player').click(function() {
            $('#player_id').val('');
            $('#playerForm').trigger("reset");
            $('#submit-player').html("Mentés");
            $('#playerHeading').html("Játékos létrehozása");
            $('#playerModal').modal('show');
        });

        //Modal kialakítás a módosításhoz
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

        //Mentés és frissítés metódusa
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
                    $('#table-teamPlayersPlayers-list').load(location.href + ' #table-teamPlayersPlayers-list');

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
        $('body').on('click', '#delete-player', function() {

            let player_id = $(this).data("id");
            confirm("Biztos törölni akarod az értéket?");

            $.ajax({
                type: "DELETE",
                url: "{{ route('players.store') }}" + '/' + player_id,
                success: function(data) {

                    $('#table-teamPlayersPlayers-list').load(location.href + ' #table-teamPlayersPlayers-list');
                },
                error: function(data) {

                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
