<div class="modal fade" id="fakeTeamModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fakeTeamHeading"></h4>
            </div>
            <div class="modal-body">

                <div class="errorMessages mb-3"></div>

                <form id="fakeTeamForm" name="fakeTeamForm" class="form-horizontal">

                    <div class="mb-3">
                        <label for="group_id" class="form-label">Válassz osztályt <sup>*</sup></label>
                        <select name="group_id" id="group_id" class="form-control">
                            <option value="0" disabled selected>Válassz osztályt</option>
                            @foreach ($groups as $group)
                            <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('group_id'))
                        <div class="text-danger">{{ $errors->first('group_id') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="number" class="form-label">Generálandó csapatok száma <sup>*</sup></label>
                        <select name="number" id="number" class="form-control">
                            <option value="0" disabled selected>Generálandó csapatok száma</option>
                            @for ($i=1; $i<=10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Kilépés</button>
                        <button type="button" class="btn btn-primary btn-sm" id="submit-fakeTeam"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
