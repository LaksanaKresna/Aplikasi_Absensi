
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">PIN</label>
            <div class="col-sm-9">
                <input type="hidden" id="type" name="type">
                <input type="hidden" id="lat" name="lat">
                <input type="hidden" id="lng" name="lng">
                <input type="hidden" id="employee_id" name="employee_id" value="{{ $employee->id }}">
                <input type="password" class="form-control @error('pin') is-invalid @enderror pinpad" id="pin" maxlength="4" name="pin"
                    value="{{  old('pin') }}" placeholder="Input Your PIN" required>
                    @error('pin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
        </div>
    </div>
    <div class="col-md-12 notes">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Notes</label>
            <div class="col-sm-9">

                <input type="text" class="form-control" id="notes" name="notes"
                    value="{{  old('notes') }}" placeholder="Notes">

            </div>
        </div>
    </div>
    <div class="col-md-12 absen">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Opsi</label>
            <div class="col-sm-9">

               <select name="typeabsen" id="typeabsen" class="form-control">
                   <option value="masuk">Absen Masuk</option>
                   <option value="pulang">Absen Pulang</option>
               </select>

            </div>
        </div>
    </div>

</div>

<button type="submit" class="btn btn-primary">{{ $button_name }}</button>
