<div class="modal" id="dataRecorderModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="dataRecorderHeader"</h4>
            </div>

            <form id="dataRecorderForm" name="dataRecorderForm" class="form-horizontal">
            <input type="hidden" name="dataRecorder_id" id="dataRecorder_id">
                <div class="modal-body">

                <div class="errorMessages mb-3"></div>

                    <div class="mb-3">
                        <label for="dataRecorder_name" class="form-label">Név <sup>*</sup></label>
                        <select name="player_id" id="dataRecorder_name" class="form-control">
                            <option value="0" disabled selected>Válassz játékost</option>
                            @foreach ($dataRecorders as $player)
                            @foreach ($player->roles as $role)
                            @if ($role->id === 4)
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endif
                            @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dataRecorder_email" class="form-label">Email <sup>*</sup></label>
                        <input type="email" id="dataRecorder_email" name="email" class="form-control" required maxlength="50">
                    </div>

                    <div class="mb-3">
                        <label for="dataRecorder_password" class="form-label">Jelszó <sup>*</sup></label>
                        <input type="password" id="dataRecorder_password" name="password" class="form-control" aria-describedby="passwordHelp" required minlength="5">
                        <div id="passwordHelp" class="form-text">A jelszónak minimum 5 karakter hosszúnak kell lennie. Legyen benne kisbetű, nagybetű, szám</div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Jelszó ismét <sup>*</sup></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required minlength="5">
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" id="submit-dataRecorder"></button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Bezár</button>
                </div>

            </form>
        </div>
    </div>
</div>
