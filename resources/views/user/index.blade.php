 @extends('layouts.admin.app')

 @section('css')
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/bootstrap.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/buttons.bootstrap4.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/dataTables.bootstrap4.css') }}">
 @endsection

 @section('content')
     <div class="row">

         <div class="col-lg-8">
             <div class="card">

                 <div class="card-header">
                     <h4 class="card-title"> Tabel {{ $title }}</h4>
                 </div>

                 <div class="card-body">
                     <div class="table-responsive">
                         <table id="tabel_user" class="display table table-striped table-hover dataTable table-bordered"
                             role="grid">
                             <thead>
                                 <tr role="row">
                                     <th>No</th>
                                     <th>Nama</th>
                                     <th>Email</th>
                                     <th>Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>

                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-lg-4">
             <div class="card">

                 <div class="card-header">
                     <h4 class="card-title">Form {{ $title }}</h4>
                 </div>

                 <div class="card-body">

                     <div class="card-body pl-0 pt-0">
                         <input type="hidden" name="id_user" class="form-control" id="id_user">

                         {{-- level --}}
                         <div class="form-group">
                             <label>Level</label>
                             <select id="level" class="form-control select2" style="width: 100%;">
                             </select>
                         </div>

                         {{-- name --}}
                         <div class="form-group">
                             <label for="name">Nama</label>

                             <input type="text" name="name" class="form-control" id="name" placeholder="Nama">
                         </div>

                         {{-- username --}}
                         <div class="form-group">
                             <label for="email">Email</label>

                             <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                         </div>

                         {{-- password --}}
                         <div id="form_password" class="form-group">
                             <label for="password">Password</label>

                             <input type="password" name="password" class="form-control" id="password"
                                 placeholder="Password">
                         </div>


                     </div>

                     <div class="card-footer">
                         <button id="reset_form" class="btn btn-{{ getButton('reset', 'color') }}"><i class="fas fa-{{ getButton('reset', 'icon') }}"></i> Reset</button>
                         <button id="save_form" class="btn btn-{{ getButton('save', 'color') }}"><i class="fas fa-{{ getButton('save', 'icon') }}"></i> Save</button>
                     </div>


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

             loadTabelUser();
             loadLevel();

             // load tabel unit
             function loadTabelUser() {

                 $('#tabel_user').DataTable().destroy();

                 $.post('{{ URL::to('admin/load-tabel-user') }}', {
                     _token: '{{ csrf_token() }}'
                 }, function(e) {
                     var tabel = $("#tabel_user").DataTable({
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
                                 data: 'email',
                                 className: "text-left",
                             },
                              {
                                 data: 'aksi',
                                 className: "text-left",
                             }
                            
                         ],
                         columnDefs: [{
                             width: 200,
                             targets: 1
                         }],
                     }).buttons().container().appendTo('#tabel_unit_wrapper .col-md-6:eq(0)');

                     tabel.on('order.dt search.dt', function() {
                         tabel.column(0, {
                             search: 'applied',
                             order: 'applied'
                         }).nodes().each(function(cell, i) {
                             cell.innerHTML = i + 1;
                         });
                     });

                 }).done(function(data) {

                 });
             }

             //  load select 2 level
             function loadLevel() {
                 $('#level').empty()

                 $.post('{{ URL::to('select-level') }}', {
                     _token: '{{ csrf_token() }}'
                 }, function(e) {

                     $("#level").select2({
                         data: e,
                         theme: 'bootstrap4'
                     })

                 });
             }

             $(document).on("click", ".edit_user", function(e) {

                 var id_user = $(this).data("id");
                 var level = $(this).data("level");
                 var name = $(this).data("name");
                 var email = $(this).data("email");

                 $("#id_user").val(id_user);
                 $('#level').val(level).trigger('change')
                 $("#name").val(name);
                 $("#email").val(email);

                 $("#form_password").hide();
             });

             //  save_form
             $(document).on("click", "#save_form", function(e) {
                 var id_user = $("#id_user").val();
                 var level = $("#level").val();
                 var name = $("#name").val();
                 var email = $("#email").val();
                 var password = $("#password").val();

                 if (level == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi', 'level tidak boleh kosong!');
                 } else if (name == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi', 'Name tidak boleh kosong!');
                 } else if (email == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi', 'Email tidak boleh kosong!');
                 } else {
                     $.ajax({
                         url: "/admin/store-user",
                         cache: false,
                         type: 'post',
                         data: {
                             id_user,
                             level,
                             name,
                             email,
                             password,
                             _token: '{{ csrf_token() }}'
                         },
                         success: function(result) {
                             console.log(result);
                             loadTabelUser();

                             resetForm();
                             tampilPesan('success', 'fa fa-info', 'Informasi', result.message);
                         },
                         fail: function(xhr, textStatus, errorThrown) {
                             tampilPesan('danger', 'fa fa-info', 'Informasi', 'request failed');
                         }
                     });
                 }

             });

             //  hapus_user
             $(document).on("click", ".hapus_user", function(e) {
                 var id_jenjang = $(this).data('id');
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
                             url: '/admin/destroy-jenjang',
                             cache: false,
                             type: 'post',
                             data: {
                                 id: id_jenjang,
                                 _token: '{{ csrf_token() }}'
                             },
                             success: function(result) {
                                 console.log(result);
                                 loadTabelUser();

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
                 $("#id_user").val('');
                 loadLevel();
                 $("#name").val('');
                 $("#email").val('');
                 $("#password").val('');
                 $("#form_password").show();
             }

         });
     </script>
 @endsection
