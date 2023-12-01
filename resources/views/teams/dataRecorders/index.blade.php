@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('teams.index') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>Felvitt adatrögzítők listája</h3>
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
        <a href="javascript:void(0)" class="btn btn-success float-end btn-sm" id="add-dataRecorder">Adatrögzítő hozzáadása</a>
    </div>

    <div class="container w-75 pt-5">
        <table class="table list table-hover" id="table-teamDataRecordersDataRecorders-list">
            <thead>
                <tr>
                    <th width="8%" scope="col">#</th>
                    <th width="30%" scope="col">Név</th>
                    <th width="30%" scope="col">Email</th>
                    <th width="32%" scope="col">Műveletek</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach($dataRecorders as $dataRecorder)
                @foreach ($dataRecorder->roles as $role)
                @if ($role->id === 3 )
                <?php $i++; ?>
                <tr data-id="{{ $dataRecorder->id }}">
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $dataRecorder->name }}</td>
                    @if ($dataRecorder->registrationdata)
                    <td>{{ $dataRecorder->registrationdata->email }}</td>
                    @else
                    <td>-</td>
                    @endif
                    <td>
                        <div class="actionMenu">
                            <a href="{{ route('dataRecorders.edit', $dataRecorder->id) }}" class="btn btn-primary btn-sm">Szerkesztés</a>
                            <form action="{{ route('dataRecorders.destroy', $dataRecorder->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger btn-sm" type="submit" value="Törlés">
                            </form>
                            <a href="{{ route('password.change') }}" class="edit btn btn-info btn-sm">Jelszó módosítás</a>
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

@include('teams.datarecorders.datarecorder_modal')

@endsection

@section('script')
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add-dataRecorder').click(function() {
            $('#dataRecorder_id').val('');
            $('#dataRecordeForm').trigger("reset");
            $('#submit-dataRecorder').html("Mentés");
            $('#dataRecorderHeader').html("Adatrögzítő létrehozása");
            $('#dataRecorderModal').modal('show');
        });

        $('#submit-dataRecorder').click(function(e) {
            e.preventDefault();

            $.ajax({
                data: $('#dataRecorderForm').serialize(),
                url: "{{ route('dataRecorders.store') }}",
                type: "POST",
                dataType: "JSON",
                success: function(data) {

                    $('#dataRecorderForm').trigger("reset");
                    $('#dataRecorderModal').modal('hide');
                    $('#table-teamDataRecordersDataRecorders-list').load(location.href + ' #table-teamDataRecordersDataRecorders-list');

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

        $('body').on('click', '#delete-dataRecorder', function() {

            let dataRecorder_id = $(this).data("id");
            confirm("Biztos törölni akarod az értéket?");

            $.ajax({
                type: "DELETE",
                url: "{{ route('dataRecorders.store') }}" + '/' + dataRecorder_id,
                success: function(data) {

                    $('#ttable-teamDataRecordersDataRecorders-list').load(location.href + ' #ttable-teamDataRecordersDataRecorders-list');
                },
                error: function(data) {

                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
