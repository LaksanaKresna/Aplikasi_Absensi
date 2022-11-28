<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Job Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{  old('name', $jobtitle->name) }}" placeholder="Job Title" required>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
        </div>
    </div>
    
</div>

<button type="submit" class="btn btn-primary">{{ $button_name }}</button>