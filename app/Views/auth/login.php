<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-lg border-0" style="width: 420px; border-radius: 16px;">
        
        <div class="card-body p-4">

            <h3 class="text-center mb-4 fw-bold">Welcome Back</h3>

            <form method="POST" action="/mvc_blog_system/public/?url=login">
                <input type="hidden" name="csrf_token" value="<?= Csrf::generate() ?>">

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email address</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="Enter your email"
                        required
                    >
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <!-- Remember / Forgot -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label small" for="remember">
                            Remember me
                        </label>
                    </div>

                    <a href="#" class="small text-decoration-none">
                        Forgot password?
                    </a>
                </div>

                <!-- Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success py-2 fw-semibold">
                        Login
                    </button>
                </div>

            </form>

            <!-- Divider -->
            <div class="text-center my-3 text-muted">or</div>

            <!-- Register link -->
            <p class="text-center mb-0">
                Don’t have an account?
                <a href="/mvc_blog_system/public/?url=register" class="fw-semibold text-decoration-none">
                    Register
                </a>
            </p>

        </div>
    </div>
</div>