@extends('layout.main')

@section('body')
<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Kangaroo Tracker</a>
    <div class="navbar-nav">
        <a class="nav-item nav-link" id="logoutButton" href="#">Logout</a>
    </div>
</nav>
@endsection

@section('scripts')
<script>
const logoutButton = document.querySelector('#logoutButton');
logoutButton.addEventListener('click', () => {
    axios.post('/logout')
        .then(() => window.location.reload());
});
</script>
@endsection
