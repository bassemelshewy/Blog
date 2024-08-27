<div class="box">
    <div class="card-header pb-0 d-flex justify-content-between">
        <h3 class="box-title">Update Password</h3>
    </div>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" novalidate>
        @csrf
        @method('put')
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <div class="controls">
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password"
                            name="current_password" required minlength="8">
                    </div>
                    @error('current_password')
                        <span class="input-group-text text-danger border-danger mt-5">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <div class="controls">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" required minlength="8">
                    </div>
                    @error('password')
                        <span class="input-group-text text-danger border-danger mt-5">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="controls">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                            name="password_confirmation" required minlength="8">
                    </div>
                    @error('password_confirmation')
                        <span class="input-group-text text-danger border-danger mt-5">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="ti-save-alt"></i> Save
                </button>
            </div>
        </div>
    </form>
</div>
