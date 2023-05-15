@extends('layout.main')

@section('body')
    <div class="container">
        <div class="auth-form vh-100 d-flex justify-content-center align-items-center">
            <div class="card w-50">
                <div class="card-header text-center">Login</div>
                <div class="card-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control text-center" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control text-center" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const loginForm = document.querySelector('#loginForm');
    loginForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);
        console.log(formData.get('username'));
    });
</script>
@endsection
