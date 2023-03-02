@extends('auth.view')

@push('page_css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('pageJudul', 'Data Mata kuliah')
@section('bread', 'Mata kuliah')

@section('main-content')

<div class="modal fade" id="createModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('auth.matakuliah.store') }}" id="modal_add" method="post">
        <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Mata Kuliah</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode Matakuliah</label>
                    <input type="number" class="form-control" name="kode_mk">
                    <small class="form-text text-danger" data-field="kode_mk"><p></p></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Matakuliah</label>
                    <input type="text" class="form-control" name="nama_mk">
                    <small class="form-text text-danger" data-field="nama_mk"><p></p></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">SKS</label>
                    <input type="number" class="form-control" name="sks">
                    <small class="form-text text-danger" data-field="sks"><p></p></small>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="reset_add">reset</button>
            <button type="submit" class="btn btn-primary" id="btn-add" value="create">Save changes</button>
            </div>
        </div>
        </div>
    </form>
</div>

<div class="modal fade" id="editModal" aria-hidden="true">
    <form action="{{ route('auth.matakuliah.update') }}" id="modal_edit_form" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Mata Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Matakuliah</label>
                        <input type="number" class="form-control" name="kode_mk" id="kode_mk">
                        <small class="form-text text-danger" data-field="kode_mk"><p></p></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Matakuliah</label>
                        <input type="text" class="form-control" name="nama_mk" id="nama_mk">
                        <small class="form-text text-danger" data-field="nama_mk"><p></p></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">SKS</label>
                        <input type="number" class="form-control" name="sks" id="sks">
                        <small class="form-text text-danger" data-field="sks"><p></p></small>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input name="id" type="hidden" id="matakuliah_id">
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn-edit">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="mb-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg> Add</button>
    <a href="{{ route('auth.matakuliah.export') }}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
    </svg> Export</a>
</div>

<div class="card shadow-none border">
    <div class="card-header">
        <h3 class="card-title">Mata kuliah Tables</h3>
    </div>
    <div class="card-body overflow-auto">
        <table id="tableMatakuliah" class="table table-hover table-sm" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Matakuliah</th>
                    <th>Nama Matakuliah</th>
                    <th>SKS</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('page_js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
        var table = $('#tableMatakuliah').DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ route('auth.matakuliah.data') }}"
            },
            columns: [
                { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                { data: 'kode_mk' },
                { data: 'nama_mk' },
                { data: 'sks' },
                { data: 'action', orderable: false, searchable: false },
            ],
        })

        table.search('').columns().search('').state.clear().draw();

        $("#reset_add").click(function(){
            $("#modal_add")[0].reset();
            $("#modal_add").find(":selected").val('').change();
        });

        const createButton = document.querySelector('#btn-add');
        createButton.addEventListener('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: $("#modal_add").attr('action'),
                type: $("#modal_add").attr('method'),
                data: $("#modal_add").serializeArray(),
                beforeSend: (() => {
					Swal.fire({
						text: "Processing your data...",
						icon: "info",
						buttonsStyling: false,
						allowOutsideClick: false,
						allowEscapeKey: false,
						showConfirmButton: false
					});
				}),
                success: ((response) => {
                    $('#createModal').modal('toggle')
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully',
                        text: 'Data berhasil ditambahkan!',
                    }).then(function() {
                        $("#modal_add").find("[name]").val('').change();
                        table.draw();
                    })
                }),
                error: ((response) => {
                    Swal.close();
                    if (response.responseJSON.errors) {
                        $.each(response.responseJSON.errors, (k,i) => {
                            $("#modal_add").find("[name='"+k+"']").addClass('is-invalid');
							$("#modal_add").find("[data-field='"+k+"']").html(i);
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!',
                        })
                    }
                })
            });
        });

        $('body').on('click', '[data-original-title="Edit"]', function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');

            $.ajax({
                url: "{{ route('auth.matakuliah.edit') }}",
                method: 'GET',
                data: {
                    id: id,
                },
                success: function(response) {
                    $("#matakuliah_id").val(response.id);
                    $("#nama_mk").val(response.nama_mk);
                    $("#kode_mk").val(response.kode_mk);
                    $("#sks").val(response.sks);
                    $("#editModal").modal("toggle");
                },
                error: (() => {
					Swal.close();
					Swal.fire({
						text: "Failed to fetch data, please reload page!",
						icon: "failed",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn fw-bold btn-primary",
						}
					});
				})
            });
        })

        $(document).on('click', '.deletePost', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let csrf = '{{ csrf_token() }}';
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
                    $.ajax({
                        url: "{{ route('auth.matakuliah.destroy') }}",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            ).then(function(){
                                table.draw();
                            })
                        }
                    });
                }
            })
        });

        const editButton = document.querySelector('#btn-edit');
        editButton.addEventListener('click', function (e) {
			e.preventDefault();
			$.ajax({
				url: $("#modal_edit_form").attr('action'),
				type: $("#modal_edit_form").attr('method'),
				data: $("#modal_edit_form").serializeArray(),
				beforeSend: (() => {
					Swal.fire({
						text: "Processing your data...",
						icon: "info",
						buttonsStyling: false,
						allowOutsideClick: false,
						allowEscapeKey: false,
						showConfirmButton: false
					});
				}),
				success: ((response) => {
					$("#editModal").modal('toggle');
					Swal.fire({
						text: "Store data saved successfully!",
						icon: "success",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn fw-bold btn-primary",
						}
					}).then(function () {
						table.draw();
					});
				}),
				error: ((response) => {
					if(response.responseJSON.errors){
                        Swal.close();
						$.each(response.responseJSON.errors, (k, i) => {
							$("#modal_edit_form").find("[name='"+k+"']").addClass('is-invalid');
							$("#modal_edit_form").find("[data-field='"+k+"']").html(i);
						});
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!',
                        })
                    }
				})
			});
		});
    })
</script>
@endpush