<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employee</label>
            <div class="col-sm-9">
               <select name="employee_id" id="employee_id" class="form-control" required>
                   @foreach ($employees as $e)
                       
                   <option value="{{ $e->id }}">{{ $e->name }}</option>
                   @endforeach
               </select>
                @error('attandancestatus_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
               <select name="attandancestatus_id" id="attandancestatus_id" class="form-control">
                   @foreach ($attandancestatuses as $e)
                       
                   <option value="{{ $e->id }}">{{ $e->name }}</option>
                   @endforeach
               </select>
                @error('attandancestatus_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-9">
              <input type="date" name="att_date" id="att_date" class="form-control">
                @error('att_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Notes</label>
            <div class="col-sm-9">
              <input type="text" name="notes" id="notes" class="form-control">
                @error('notes')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>

</div>

<button type="submit" class="btn btn-primary">{{ $button_name }}</button>