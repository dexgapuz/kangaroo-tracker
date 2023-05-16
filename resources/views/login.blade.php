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
const FIELDS = [
    'username',
    'password'
];
const loginForm = document.querySelector('#loginForm');
loginForm.addEventListener('submit', (event) => {
    event.preventDefault();
    resetForm();

    const formData = new FormData(event.target);
    let data = {
        username: formData.get('username'),
        password: formData.get('password')
    }

    axios.post('/login', data)
        .then(() => window.location.reload())
        .catch(error => {
            const errors = error.response.data.errors;
            const errorFields = FIELDS.filter(field => Object.keys(errors).includes(field));
            errorFields.forEach(field => {
                loginForm.elements[field].classList.add('is-invalid');
                loginForm.elements[field].insertAdjacentHTML(
                    'afterend',
                    `<div class="invalid-feedback">${errors[field][0]}</div>`
                );
            });
        });
});

function resetForm () {
    FIELDS.forEach(field => {
        loginForm.elements[field].classList.remove('is-invalid');
        loginForm.elements[field].nextElementSibling?.remove();
    });
}
</script>
@endsection
