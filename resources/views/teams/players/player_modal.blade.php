<div class="modal fade" id="playerModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="playerHeading"></h4>
            </div>
            <div class="modal-body">

                <div class="errorMessages mb-3"></div>

                <form id="playerForm" name="playerForm" class="form-horizontal">
                    <input type="hidden" name="player_id" id="player_id">
                    <div class="mb-3">
                        <label for="player_name" class="col-sm-2 control-label">Név <sup>*</sup></label>
                        <input type="text" class="form-control" id="player_name" name="name" value="" required minlength="2" maxlength="50">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Kilépés</button>
                        <button type="button" class="btn btn-primary btn-sm" id="submit-player"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
