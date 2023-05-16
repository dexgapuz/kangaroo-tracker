@extends('layout.main')

@section('body')
<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Kangaroo Tracker</a>
    <div class="navbar-nav">
        <a class="nav-item nav-link" id="logoutButton" href="#">Logout</a>
    </div>
</nav>
<div class="container mt-5">
    <div id="datagrid"></div>
</div>
@endsection

@section('scripts')
<script>
const logoutButton = document.querySelector('#logoutButton');
logoutButton.addEventListener('click', () => {
    axios.post('/logout')
        .then(() => window.location.reload());
});

axios.get('/kangaroo')
    .then(res => {
        $('#datagrid').dxDataGrid({
            dataSource: res.data,
            keyExpr: 'id',
            filterRow: { visible: true },
            sorting: { mode: 'single' },
            headerFilter: { visible: true },
            searchPanel: { visible: true },
            columns: [
                {
                    dataField: 'name',
                    alignment: 'right'
                },
                {
                    dataField: 'birthday',
                    dataType: 'date',
                    alignment: 'right'
                },
                {
                    dataField: 'weight',
                    alignment: 'right'
                },
                {
                    dataField: 'height',
                    alignment: 'right'
                },
                {
                    dataField: 'friendliness',
                    alignment: 'right'
                },
                {
                    dataField: 'action',
                    alignment: 'right',
                    allowFiltering: false,
                    allowSorting: false,
                    cellTemplate (container, options) {
                        console.log(options);
                        $('<div>')
                            .append($(`<button class="btn btn-primary edit-kangaroo" onClick="editKangaroo(${options.data.id})">Edit</button>`))
                            .appendTo(container);
                    }
                }
            ],
            showBorders: true,
        });
    });

function editKangaroo(data) {
    console.log(data);
}

</script>
@endsection
