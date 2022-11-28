<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">NIK</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik"
                    value="{{  old('nik', $employee->nik) }}" placeholder="NIK" required>
                    @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{  old('name', $employee->name) }}" placeholder="Name" required>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Gender</label>
            <div class="col-sm-9">
                <select name="gender" id="gender" class="form-control">
                    <option value="L">Male</option>
                    <option value="P">FeMale</option>
                </select>
                    @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                    value="{{  old('phone', $employee->phone) }}" placeholder="Phone">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">PIN</label>
            <div class="col-sm-9">
                <input type="password" class="form-control @error('pin') is-invalid @enderror" id="pin" name="pin"
                     placeholder="PIN">
                @error('pin')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">JobTitle</label>
            <div class="col-sm-9">
                <select name="jobtitle_id" id="jobtitle_id" class="form-control @error('jobtitle_id') is-invalid @enderror" required>
                    <option value="">Select Jobtitle</option>
                    @foreach ($jobtitles as $j)
                        <option value="{{ $j->id }}">{{ $j->name }}</option>
                    @endforeach
                </select>
                    @error('jobtitle_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Marital Status</label>
            <div class="col-sm-9">
                <select name="maritalstatus_id" id="maritalstatus_id" class="form-control @error('maritalstatus_id') is-invalid @enderror" required>
                    <option value="">Select Marital Status</option>
                    @foreach ($maritalstatuses as $ms)
                        <option value="{{ $ms->id }}">{{ $ms->name }}</option>
                    @endforeach
                </select>
                    @error('maritalstatus_id')
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
                <select name="status_id" id="status_id" class="form-control @error('status_id') is-invalid @enderror">
                    @foreach ($statuses as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
                    @error('status_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
        </div>
    </div>
    
</div>

<button type="submit" class="btn btn-primary">{{ $button_name }}</button>