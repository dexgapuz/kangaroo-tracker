@extends('layout.main')

@section('body')
<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Kangaroo Tracker</a>
    <div class="navbar-nav">
        <a class="nav-item nav-link" id="logoutButton" href="#">Logout</a>
    </div>
</nav>
<div class="container-fluid mt-5">
    <button id="addButton" class="btn btn-primary" data-toggle="modal" data-target="#modal-form">Add</button>
    <div id="datagrid"></div>
</div>

<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="kangaroo-form">
                <div class="form-group">
                  <label class="col-form-label">Name</label>
                  <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Nickname</label>
                    <input type="text" class="form-control" name="nickname">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Weight</label>
                    <input type="number" step=".01" class="form-control" name="weight">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Height</label>
                    <input type="number" step=".01" class="form-control" name="height">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Color</label>
                    <input type="text" class="form-control" name="color">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Friendliness</label>
                    <select name="friendliness" class="form-control">
                        <option value="friendly">Friendly</option>
                        <option value="not friendly">Not Friendly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Birthday</label>
                    <input type="date" class="form-control" name="birthday">
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
    'name',
    'nickname',
    'weight',
    'height',
    'gender',
    'color',
    'friendliness',
    'birthday'
];

const logoutButton = document.querySelector('#logoutButton');
const addButton = document.querySelector('#addButton');
const kangarooForm = document.querySelector('#kangaroo-form');
let isEdit = false;
let kangarooId = null;

const datagrid = $('#datagrid').dxDataGrid({
    dataSource: '/kangaroo',
    filterRow: { visible: true },
    sorting: { mode: 'single' },
    headerFilter: { visible: true },
    searchPanel: { visible: true },
    rowAlternationEnabled: true,
    scrolling: { rowRenderingMode: 'virtual' },
    paging: { pageSize: 10 },
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
                let data = encodeURIComponent(JSON.stringify(options.data))
                $('<div>')
                    .append($(
                        `<button
                            type="button"
                            class="btn btn-primary mr-2"
                            onClick="populate('${data}')"
                            data-toggle="modal"
                            data-target="#modal-form"
                        >
                            Edit
                        </button>`
                    ))
                    .append($(
                        `<button
                            class="btn btn-danger"
                            onClick="deleteKangaroo('${options.data.id}')"
                        >
                            Delete
                        </button>`
                    ))
                    .appendTo(container);
            }
        }
    ],
    showBorders: true,
}).dxDataGrid('instance');

logoutButton.addEventListener('click', () => {
    axios.post('/logout')
        .then(() => window.location.reload());
});

$('#modal-form').on('hidden.bs.modal', () => {
    isEdit = false;
    kangarooId = null;
    clearValidation();
    kangarooForm.reset();
});

function populate (row) {
    let data = JSON.parse(decodeURIComponent(row));
    isEdit = true;
    kangarooId = data.id;
    kangarooForm.elements.name.value = data.name;
    kangarooForm.elements.nickname.value = data.nickname;
    kangarooForm.elements.weight.value = data.weight;
    kangarooForm.elements.height.value = data.height;
    kangarooForm.elements.gender.value = data.gender;
    kangarooForm.elements.color.value = data.color;
    kangarooForm.elements.friendliness.value = data.friendliness;
    let date = new Date(data.birthday);
    kangarooForm.elements.birthday.value = date.toISOString().slice(0, 10);
}

kangarooForm.addEventListener('submit', event => {
    event.preventDefault();
    clearValidation();
    let formData = new FormData(event.target);
    let data = {
        name: formData.get('name'),
        nickname: formData.get('nickname'),
        weight: formData.get('weight'),
        height: formData.get('height'),
        gender: formData.get('gender'),
        color: formData.get('color'),
        friendliness: formData.get('friendliness'),
        birthday: formData.get('birthday')
    };

    let url = isEdit ? `/kangaroo/${kangarooId}` : '/kangaroo';
    axios({
        method: isEdit ? 'PUT' : 'POST',
        url: url,
        data: data
    }).then(res => {
        datagrid.refresh();
        $('#modal-form').modal('hide');
    }).catch(error => {
        const errors = error.response.data.errors;
        const errorFields = FIELDS.filter(field => Object.keys(errors).includes(field));
        errorFields.forEach(field => {
            kangarooForm.elements[field].classList.add('is-invalid');
            kangarooForm.elements[field].insertAdjacentHTML(
                'afterend',
                `<div class="invalid-feedback">${errors[field][0]}</div>`
            );
        });
    });
});

function clearValidation () {
    FIELDS.forEach(field => {
        kangarooForm.elements[field].classList.remove('is-invalid');
        kangarooForm.elements[field].nextElementSibling?.remove();
    });
}

function deleteKangaroo (id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/kangaroo/${id}`)
                .then(res => datagrid.refresh())
        }
    });
}
</script>
@endsection
