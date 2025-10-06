<h1 class="text-center mt-2">Se connecter</h1>
<div class="container justify-content-center align-items-center">
    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login"
                type="button" role="tab" aria-controls="pills-login" aria-selected="true">Login</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register"
                type="button" role="tab" aria-controls="pills-register" aria-selected="false">Register</button>
        </li>
    </ul>
    <div class="tab-content">
        <div id="pills-login" class="tab-pane fade in active" role="tabpanel" aria-labelledby="pills-login-tab">
            <h2 class="text-center">login</h2>
        </div>
        <div id="pills-register" class="tab-pane fade">
            <form id="formRegister" class="needs-validation" novalidate>
                <h2 class="text-center">register</h2>
                <div class="mb-3">
                    <label for="firstname" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstname" placeholder="Enter firstname"
                        name="firstname">
                    <span class="response"></span>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lastname" placeholder="Enter lastname" name="lastname">
                    <span class="response"></span>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                    <span class="response"></span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password"
                        name="password">
                    <span class="response"></span>
                </div>
                <button id="submitRegister" type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>