<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                    value="{{  old('username', $user->username) }}" placeholder="Username" required>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Pengguna</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{  old('name', $user->name) }}" placeholder="Nama Pengguna" required>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                    value="{{  old('password') }}" placeholder="password" required>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Role</label>
            <div class="col-sm-9">
                <select name="role_id" id="role_id" class="form-control">
                    @can('isAdmin')
                    <option value="1">Administrator</option>
                    @endcan()
                    <option value="2">Employee</option>
                </select>
                @error('role_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employees</label>
            <div class="col-sm-9">
                <select name="employee_id" id="employee_id" class="form-control">
                   @foreach ($employees as $e)
                       
                   <option value="{{ $e->id }}">{{ $e->name }}</option>
                   @endforeach
                </select>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
   
    
</div>

<button type="submit" class="btn btn-primary">{{ $button_name }}</button>

