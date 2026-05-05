<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-lg border-0" style="width: 420px; border-radius: 16px;">
        
        <div class="card-body p-4">

            <h3 class="text-center mb-4 fw-bold">Create Account</h3>

            <form method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?= Csrf::generate() ?>">

                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Username</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input 
                            type="text" 
                            name="username" 
                            class="form-control" 
                            placeholder="Enter username"
                            required
                        >
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email address</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="Enter email"
                        required
                    >
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Enter password"
                        required
                    >
                </div>

                <!-- Button -->
                <div class="d-grid">
                    <button class="btn btn-primary py-2 fw-semibold">
                        Register
                    </button>
                </div>

            </form>

            <!-- Divider -->
            <div class="text-center my-3 text-muted">or</div>

            <!-- Login link -->
            <p class="text-center mb-0">
                Already have an account? 
                <a href="/mvc_blog_system/public/?url=login" class="fw-semibold text-decoration-none">
                    Login
                </a>
            </p>

        </div>
    </div>
</div>