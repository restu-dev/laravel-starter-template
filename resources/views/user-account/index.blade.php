 @extends('layouts.admin.app')

 @section('css')
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/bootstrap.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/buttons.bootstrap4.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/dataTables.bootstrap4.css') }}">
 @endsection

 @section('content')
     <div class="row">
         <div class="col-12 col-lg-4">
             <div class="card">
                 <div class="card-body">
                     <div class="d-flex justify-content-center align-items-center flex-column">
                         <div class="avatar avatar-xxl">
                             <img src="/img/user/{{ Auth::user()->image }}" alt="{{ Auth::user()->image }}"
                                 class="avatar-img rounded-circle">
                         </div>


                         <h3 class="mt-3">{{ Auth::user()->name }}</h3>
                         <p class="text-small">{{ getLevel(Auth::user()->id_level) }}</p>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-12 col-lg-8">
             @if (session()->has('success'))
                 <div class="alert alert-success alert-dismissible" role="alert">
                     {{ session('success') }}
                 </div>
             @endif

             @if (session()->has('error'))
                 <div class="alert alert-warning alert-dismissible" role="alert">
                     {{ session('error') }}
                 </div>
             @endif

             <div class="card">
                 <div class="card-body">
                     <form method="POST" action="edit-user-account">
                         @csrf

                         <input required type="hidden" name="id_user" id="id_user" value="{{ Auth::user()->id }}">

                         <div class="form-group">
                             <label for="email" class="form-label">Email</label>
                             <input disabled type="text" name="email" id="email"
                                 class="form-control @error('email') is-invalid @enderror" placeholder="Your Email"
                                 value="{{ Auth::user()->email }}">
                         </div>

                         <div class="form-group">
                             <label for="name" class="form-label">Name</label>
                             <input required type="text" name="name" id="name"
                                 class="form-control @error('name') is-invalid @enderror" placeholder="Your Name"
                                 value="{{ Auth::user()->name }}">

                             @error('name')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>

                         <div class="form-group">
                             <label for="password" class="form-label">Password</label>
                             <input required type="text" name="password" id="password"
                                 class="form-control @error('password') is-invalid @enderror" placeholder="Your password">

                             @error('password')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>

                         <div class="form-group">
                             <label for="password_confirmation" class="form-label">Confirmation Password</label>
                             <input required type="text" name="password_confirmation" id="password_confirmation"
                                 class="form-control" placeholder="Your Confirmation Password">
                         </div>

                         <div class="form-group">
                             <button type="submit" class="btn btn-primary">Save Changes</button>
                         </div>

                     </form>
                 </div>
             </div>
         </div>
     </div>
 @endsection

 @section('script')
     <!-- Datatables -->
     <script src="{{ asset('assets/datatable/button/js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/dataTables.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/dataTables.bootstrap4.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/dataTables.buttons.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/buttons.bootstrap4.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/jszip.min.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/pdfmake.min.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/vfs_fonts.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/buttons.html5.min.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/buttons.print.min.js') }}"></script>
     <script src="{{ asset('assets/datatable/button/js/buttons.colVis.min.js') }}"></script>

     <!-- Atlantis JS -->
     <script src="{{ asset('assets/js/atlantis.min.js') }}"></script>
     <!-- Atlantis DEMO methods, don't include it in your project! -->
     <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>

     <script>
         $(function() {



             // load tabel unit
             function loadTabeLevel() {

                 $('#tabel_level').DataTable().destroy();

                 $.post('{{ URL::to('admin/load-tabel-level') }}', {
                     _token: '{{ csrf_token() }}'
                 }, function(e) {
                     var tabel = $("#tabel_level").DataTable({
                         layout: {
                             topStart: {
                                 buttons: ['copy', 'excel', 'pdf']
                             }
                         },
                         "searching": true,
                         "paging": false,
                         "responsive": true,
                         "lengthChange": false,
                         "autoWidth": false,
                         "data": e,
                         "columns": [{
                                 data: 'id',
                                 render: function(data, type, row, meta) {
                                     return meta.row + 1;
                                 },
                                 className: "text-center",
                             },
                             {
                                 data: 'name',
                                 className: "text-left",
                             },
                             {
                                 data: null,
                                 "render": function(data, type, row) {
                                     return '<div class="btn-group">' +
                                         '<button data-id="' + row.id + '" data-name="' + row
                                         .name +
                                         '" data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn btn-info btn-sm edit_level"><i class="fas fa-edit"></i></button>' +
                                         '<button data-id="' + row.id +
                                         '" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger btn-sm hapus_level"><i class="fa fa-trash"></i></button>' +
                                         '</div>'
                                 },
                             },
                         ]
                     }).buttons().container().appendTo('#tabel_level_wrapper .col-md-6:eq(0)');

                     tabel.on('order.dt search.dt', function() {
                         tabel.column(0, {
                             search: 'applied',
                             order: 'applied'
                         }).nodes().each(function(cell, i) {
                             cell.innerHTML = i + 1;
                         });
                     });

                 }).done(function(data) {
                     resetForm();
                 });
             }

             $(document).on("click", ".edit_level", function(e) {
                 var id_level = $(this).data("id");
                 var nama_level = $(this).data("name");

                 $("#id_level").val(id_level);
                 $("#nama_level").val(nama_level);
             });

             //  save_form
             $(document).on("click", "#save_form", function(e) {
                 var id_level = $("#id_level").val();
                 var nama_level = $("#nama_level").val();

                 if (nama_level == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi', 'Nama level tidak boleh kosong!');
                 } else {
                     $.ajax({
                         url: "/admin/store-level",
                         cache: false,
                         type: 'post',
                         data: {
                             id_level,
                             nama_level,
                             _token: '{{ csrf_token() }}'
                         },
                         success: function(result) {
                             console.log(result);
                             loadTabeLevel();
                             tampilPesan('success', 'fa fa-info', 'Informasi',
                                 'Berhasil tambah data level!');
                             resetForm();
                         },
                         fail: function(xhr, textStatus, errorThrown) {
                             tampilPesan('danger', 'fa fa-info', 'Informasi',
                                 'Gagal tambah data level!');
                         }
                     });
                 }

             });

             //  hapus_level
             $(document).on("click", ".hapus_level", function(e) {
                 var id_level = $(this).data('id');

                 swal({
                     title: 'Are you sure?',
                     text: "You won't be able to revert this!",
                     type: 'warning',
                     buttons: {
                         cancel: {
                             visible: true,
                             text: 'No, cancel!',
                             className: 'btn btn-danger'
                         },
                         confirm: {
                             text: 'Yes, delete it!',
                             className: 'btn btn-success'
                         }
                     }
                 }).then((willDelete) => {
                     if (willDelete) {
                         $.ajax({
                             url: '/admin/destroy-level',
                             cache: false,
                             type: 'post',
                             data: {
                                 id: id_level,
                                 _token: '{{ csrf_token() }}'
                             },
                             success: function(result) {
                                 console.log(result);
                                 loadTabeLevel();

                                 swal("Poof! Your imaginary file has been deleted!", {
                                     icon: "success",
                                     buttons: {
                                         confirm: {
                                             className: 'btn btn-success'
                                         }
                                     }
                                 });

                             },
                             fail: function(xhr, textStatus, errorThrown) {
                                 tampilPesan('danger', 'fa fa-info', 'Informasi',
                                     'Gagal hapus data level!');
                             }
                         })
                     } else {
                         swal("Your imaginary file is safe!", {
                             buttons: {
                                 confirm: {
                                     className: 'btn btn-success'
                                 }
                             }
                         });
                     }
                 });

             });

             // reset_form
             $(document).on("click", "#reset_form", function() {
                 resetForm();
             });

             function resetForm() {
                 $("#id_level").val('');
                 $("#nama_level").val('');
             }
         });
     </script>
 @endsection
