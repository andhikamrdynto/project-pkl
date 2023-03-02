@extends('auth.view')

@push('page_css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('pageJudul', 'Data Mahasiswa')
@section('bread', 'Mahasiswa')

@section('main-content')
    <div class="modal fade" id="createModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ route('auth.mahasiswa.store') }}" id="modal_add" method="post">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">NIM</label>
                        <input type="number" class="form-control" name="nim">
                        <small class="form-text text-danger" data-field="nim"><p></p></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" name="nama">
                        <small class="form-text text-danger" data-field="nama"><p></p></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jurusan</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="id_jurusan" data-placeholder="--- pilih jurusan ---">
                            <option selected value=""></option>
                            @foreach ($dataJurusan as $jurusan) 
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-danger" data-field="id_jurusan"><p></p></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir">
                        <small class="form-text text-danger" data-field="tgl_lahir"><p></p></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="jk" data-placeholder="--- pilih jenis kelamin ---">
                            <option selected value=""></option>
                            <option value="laki-laki">laki-laki</option>
                            <option value="perempuan">perempuan</option>
                        </select>
                        <small class="form-text text-danger" data-field="jk"><p></p></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">No. Telepon</label>
                        <input type="number" class="form-control" name="no_tlp">
                        <small class="form-text text-danger" data-field="no_tlp"><p></p></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" class="form-control" name="alamat">
                        <small class="form-text text-danger" data-field="alamat"><p></p></small>
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
        <form action="{{ route('auth.mahasiswa.update') }}" id="modal_edit_form" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIM</label>
                            <input type="number" class="form-control" name="nim" id="nim">
                            <small class="form-text text-danger" data-field="nim"><p></p></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                            <small class="form-text text-danger" data-field="nama"><p></p></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jurusan</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="id_jurusan" id="id_jurusan">
                                @foreach ($dataJurusan as $jurusan) 
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger" data-field="id_jurusan"><p></p></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                            <small class="form-text text-danger" data-field="tgl_lahir"><p></p></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="jk" id="jk">
                                <option value="laki-laki">laki-laki</option>
                                <option value="perempuan">perempuan</option>
                            </select>
                            <small class="form-text text-danger" data-field="jk"><p></p></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Telepon</label>
                            <input type="number" class="form-control" name="no_tlp" id="no_tlp">
                            <small class="form-text text-danger" data-field="no_tlp"><p></p></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat">
                            <small class="form-text text-danger" data-field="alamat"><p></p></small>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="id" type="hidden" id="mahasiswa_id">
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-edit">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="d-flex">
        <div class="">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg> Add</button>
        </div>
        <div class="ml-1">
            <button type="button" class="btn btn-primary border" id="btnFilter"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                </svg> Filter
            </button>

            
            {{-- export --}}
            <a href="{{ route('auth.mahasiswa.export') }}" class="btn btn-success ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
            </svg> Export</a>

            {{-- import --}}
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-file-spreadsheet" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1H4zm9 6h-3v2h3V7zm0 3h-3v2h3v-2zm0 3h-3v2h2a1 1 0 0 0 1-1v-1zm-4 2v-2H6v2h3zm-4 0v-2H3v1a1 1 0 0 0 1 1h1zm-2-3h2v-2H3v2zm0-3h2V7H3v2zm3-2v2h3V7H6zm3 3H6v2h3v-2z"/>
                </svg> 
                Import
            </button>
            
            <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('auth.mahasiswa.import') }}" id="modal_import_form" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Import file</label>
                                    <input type="file" class="form-control-file" name="file">
                                    <small class="form-text text-danger" data-field="file"><p></p></small>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn-import">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card position-absolute z-index d-none" id="cardFilter" style="width: 18rem; z-index: 99;">
                <div class="card-header">
                    <button type="button" class="close closeFilter">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form id="myForm" action="#">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="font-weight-normal">Filter Jurusan</label>
                            <select class="form-control select2bs4Filter" style="width: 100%;" id="jurusan">
                                <option selected value="{{ NULL }}">All</option>
                                @foreach ($dataJurusan as $jurusan) 
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="font-weight-normal">Filter JK</label>
                            <select class="form-control select2bs4Filter" style="width: 100%;" id="jk_filter">
                                <option selected value="{{ NULL }}">All</option>
                                <option value="laki-laki">laki-laki</option>
                                <option value="perempuan">perempuan</option>
                            </select>
                        </div>
                    </form>
                    <button type="button" class="btn btn-primary" id="resetFilter">Reset</button>
                </div>
            </div>
        </div>

        
    </div>


    <div class="card shadow-none border">
        <div class="card-header">
            <h3 class="card-title">Mahasiswa Tables</h3>
        </div>
        <div class="card-body overflow-auto">
            <table id="tableMahasiswa" class="table table-hover table-sm" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Tgl Lahir</th>
                        <th>JK</th>
                        <th>No.Tlp</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('page_js')
<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script type="text/javascript">
    $(function () {
        var table = $('#tableMahasiswa').DataTable({
            searchDelay: 500,
			processing: true,
            serverSide: true,
			stateSave: true,
            
            ajax: {
                url: "{{ route('auth.mahasiswa.data') }}",
                data: function (d) {
					d.id_jurusan = $('#jurusan').val(),
					d.jk = $('#jk_filter').val(),
                    d.search = $('input[type="search"]').val()
				}
            },
            columns: [
				{ data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
				{ data: 'nim' },
				{ data: 'nama' },
				{ data: 'jurusan' },
				{ data: 'tgl_lahir' },
				{ data: 'jk' },
				{ data: 'no_tlp' },
				{ data: 'alamat' },
				{ data: 'action' , orderable: false, searchable: false},
			],
        });

        table.search('').columns().search('').state.clear().draw();

        // filter
        $('#btnFilter').on('click', function() {
            $('#cardFilter').toggleClass('d-none');
        });

        $('.closeFilter').on('click', function(){
            $('#cardFilter').toggleClass('d-none');
        });        

        $('#resetFilter').click(function() {
            jQuery('#jurusan').val('').change();
            jQuery('#jk_filter').val('').change();
        });
        // ----------------

        $("#reset_add").click(function(){
            $("#modal_add")[0].reset();
            $("#modal_add").find(":selected").val('').change();
        });


        // select2
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })

        $('.select2bs4Filter').select2({
            theme: 'bootstrap4',
        })
        // ---------------

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
                url: "{{ route('auth.mahasiswa.edit') }}",
                method: 'GET',
                data: {
                    id: id,
                },
                success: function(response) {
                    $("#nama").val(response.nama);
                    $("#id_jurusan").val(response.id_jurusan).change();
                    $("#mahasiswa_id").val(response.id);
                    $("#nim").val(response.nim);
                    $("#tgl_lahir").val(response.tgl_lahir);
                    $("#jk").val(response.jk).change();
                    $("#no_tlp").val(response.no_tlp);
                    $("#alamat").val(response.alamat);
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
            const parent = e.target.closest('tr');
			const FieldName = parent.querySelectorAll('td')[2].innerText;
            Swal.fire({
                title: "Are you sure you want to delete " + FieldName + "?",
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('auth.mahasiswa.destroy') }}",
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

        const importButton = document.querySelector('#btn-import');
        importButton.addEventListener('click', function(e) {
            e.preventDefault();
            let formData = new FormData($('#modal_import_form')[0]);
            $.ajax({
                url: $('#modal_import_form').attr('action'),
                type: $('#modal_import_form').attr('method'),
                data: $('#modal_import_form').serializeArray(),
                data: formData,
				contentType: false,
				processData: false,
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
                    $('#importModal').modal('toggle')
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully',
                        text: 'Data berhasil ditambahkan!',
                    }).then(function() {
                        table.draw();
                    })
                }),
                error: ((response) => {
                    Swal.close();
                    if (response.responseJSON.errors) {
                        $.each(response.responseJSON.errors, (k,i) => {
                            $("#modal_import_form").find("[name='"+k+"']").addClass('border border-danger');
							$("#modal_import_form").find("[data-field='"+k+"']").html(i);
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!',
                        })
                    }
                })
            })
        })

        $('#jurusan').change(function() {
			table.draw();
		})

        $('#jk_filter').change(function() {
            table.draw();
		})
    });

    
</script>
@endpush