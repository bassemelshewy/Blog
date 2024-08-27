<div class="box">
    <div class="card-header pb-0 d-flex justify-content-between">
        <h3 class="box-title">Delete Account</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <a href="#confirm-user-deletion" class="popup-with-form popup-link btn btn-danger">
            <i class="ti-trash"></i>Delete Account
        </a>

        <div id="confirm-user-deletion" class="white-popup-block mfp-hide">
            <form method="post" action="{{ route('profile.destroy') }}" novalidate>
                @csrf
                @method('Delete')
                <div class="box-body">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Are you sure you want to delete your account?
                    </h2>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="controls">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                    name="password" required minlength="8" placeholder="Password">
                            </div>
                            @error('password')
                                <span class="input-group-text text-danger border-danger mt-5">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-danger">
                        <i class="ti-trash"></i>Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.box-body -->
</div>
