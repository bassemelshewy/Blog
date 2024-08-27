<div class="box">
    <div class="card-header pb-0 d-flex justify-content-between">
        <h3 class="box-title">Profile Information</h3>
    </div>
    <!-- /.box-header -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" novalidate>
        @csrf
        @method('patch')
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <div class="controls">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') ?? $user->name }}" required minlength="2">
                    </div>
                    @error('name')
                        <span class="input-group-text text-danger border-danger mt-5">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="controls">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') ?? $user->email }}" required>
                    </div>
                    @error('email')
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
    <!-- /.box-body -->
</div>
