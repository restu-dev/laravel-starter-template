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
                         <table id="tabel_button" class="display table table-striped table-hover dataTable table-bordered"
                             role="grid">
                             <thead>
                                 <tr role="row">
                                     <th style="width: 134.517px;">No</th>
                                     <th style="width: 134.517px;">Nama</th>
                                     <th style="width: 134.517px;">Color</th>
                                     <th style="width: 134.517px;">Icon</th>
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
                         <input type="hidden" name="id_button" class="form-control" id="id_button">

                         {{-- nama_button --}}
                         <div class="form-group">
                             <label for="nama_button">Nama Button</label>

                             <input type="text" name="nama_button" class="form-control" id="nama_button"
                                 placeholder="Nama Button">
                         </div>

                         {{-- color_button --}}
                         <div class="form-group">
                             <label for="color_button">Color Button</label>

                             <input type="text" name="color_button" class="form-control" id="color_button"
                                 placeholder="Color Button">
                         </div>

                         {{-- icon_button --}}
                         <div class="form-group">
                             <label for="icon_button">Icon Button</label>

                             <input type="text" name="icon_button" class="form-control" id="icon_button"
                                 placeholder="Icon Button">
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

             loadTabeButton();

             // load tabel unit
             function loadTabeButton() {

                 $('#tabel_button').DataTable().destroy();

                 $.post('{{ URL::to('load-tabel-button') }}', {
                     _token: '{{ csrf_token() }}'
                 }, function(e) {
                     var tabel = $("#tabel_button").DataTable({
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
                                 data: 'color',
                                 className: "text-left",
                             },
                             {
                                 data: 'icon',
                                 className: "text-left",
                             },
                             {
                                 data: 'button',
                                 className: "text-left",
                             },
                             {
                                 data: 'aksi',
                                 className: "text-left",
                             }
                         ]
                     }).buttons().container().appendTo('#tabel_button_wrapper .col-md-6:eq(0)');

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

             $(document).on("click", ".edit_button", function(e) {
                 var id_button = $(this).data("id");
                 var nama_button = $(this).data("name");
                 var color_button = $(this).data("color");
                 var icon_button = $(this).data("icon");

                 $("#id_button").val(id_button);
                 $("#nama_button").val(nama_button);
                 $("#color_button").val(color_button);
                 $("#icon_button").val(icon_button);
             });

             //  save_form
             $(document).on("click", "#save_form", function(e) {
                 var id_button = $("#id_button").val();
                 var nama_button = $("#nama_button").val();
                 var color_button = $("#color_button").val();
                 var icon_button = $("#icon_button").val();

                 if (nama_button == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi', 'Nama button tidak boleh kosong!');
                 } else if (color_button == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi', 'Color button tidak boleh kosong!');
                 } else if (icon_button == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi', 'Icon button tidak boleh kosong!');
                 } else {
                     $.ajax({
                         url: "/store-button",
                         cache: false,
                         type: 'post',
                         data: {
                             id_button,
                             nama_button,
                             color_button,
                             icon_button,
                             _token: '{{ csrf_token() }}'
                         },
                         success: function(result) {
                             console.log(result);
                             loadTabeButton();
                             tampilPesan('success', 'fa fa-info', 'Informasi',
                                 'Berhasil tambah data button!');
                             resetForm();
                         },
                         fail: function(xhr, textStatus, errorThrown) {
                             tampilPesan('danger', 'fa fa-info', 'Informasi',
                                 'Gagal tambah data button!');
                         }
                     });
                 }

             });

             //  hapus_button
             $(document).on("click", ".hapus_button", function(e) {
                 var id_button = $(this).data('id');

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
                             url: '/destroy-button',
                             cache: false,
                             type: 'post',
                             data: {
                                 id: id_button,
                                 _token: '{{ csrf_token() }}'
                             },
                             success: function(result) {
                                 console.log(result);
                                 loadTabeButton();

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
                                     'Gagal hapus data button!');
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
                 $("#id_button").val('');
                 $("#nama_button").val('');
                 $("#color_button").val('');
                 $("#icon_button").val('');
             }
         });
     </script>
 @endsection
