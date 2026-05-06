<div class="min-vh-100 d-flex justify-content-center align-items-center bg-light">
    <div class="card shadow-lg border-0 rounded-4" style="width: 100%; max-width: 420px;">
        <div class="card-body p-4">

            <h3 class="text-center fw-bold mb-2">Welcome Back</h3>
            <p class="text-center text-muted mb-4">Login to continue to MVC Blog</p>

            <form method="POST" action="/mvc_blog_system/public/?url=login">
                <input type="hidden" name="csrf_token" value="<?= Csrf::generate() ?>">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email address</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control form-control-lg" 
                        placeholder="Enter email"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control form-control-lg" 
                        placeholder="Enter password"
                        required
                    >
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg">
                        Login
                    </button>
                </div>
            </form>

            <p class="text-center text-muted mt-4 mb-0">
                Don't have an account?
                <a href="/mvc_blog_system/public/?url=register" class="fw-semibold">
                    Register
                </a>
            </p>

        </div>
    </div>
</div>