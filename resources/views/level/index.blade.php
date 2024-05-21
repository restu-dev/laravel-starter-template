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
                     <h4 class="card-title">Tabel {{ $title }}</h4>
                 </div>

                 <div class="card-body">
                     <div class="table-responsive">
                         <table id="tabel_level" class="display table table-striped table-hover dataTable table-bordered"
                             role="grid">
                             <thead>
                                 <tr role="row">
                                     <th style="width: 134.517px;">No</th>
                                     <th style="width: 134.517px;">Nama</th>
                                     <th style="width: 134.517px;">Aksi</th>
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
                         <input type="hidden" name="id_level" class="form-control" id="id_level">

                         {{-- nama_level --}}
                         <div class="form-group">
                             <label for="nama_level">Nama Level</label>

                             <input type="text" name="nama_level" class="form-control" id="nama_level"
                                 placeholder="Nama Level">
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

             loadTabeLevel();

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
                                 data: 'aksi',
                                 className: "text-left",
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
