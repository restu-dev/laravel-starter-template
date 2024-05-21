 @extends('layouts.admin.app')

 @section('css')
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/bootstrap.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/buttons.bootstrap4.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/dataTables.bootstrap4.css') }}">
 @endsection

 @section('content')
     @include('menu.partials.modal_menu_header_add_edit')
     @include('menu.partials.modal_menu_parent_add_edit')

     <div class="row">

         <div class="col-lg-6">
             <div class="card">

                 <div class="card-header">
                     <h4 class="card-title">Tabel Menu Header</h4>
                 </div>

                 <div class="card-body">
                     <div class="table-responsive">
                         <table id="tabel_menu_header"
                             class="display table table-striped table-hover dataTable table-bordered" role="grid">
                             <thead>
                                 <tr role="row">
                                     <th>No</th>
                                     <th>Nama</th>
                                     <th>URL</th>
                                     <th>SUB</th>
                                     <th>Icon</th>
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

         <div class="col-lg-6">
             <div class="card">

                 <div class="card-header">
                     <input type="hidden" id="id_header">
                     <h4 class="card-title">Tabel Menu Parent</h4>
                 </div>

                 <div class="card-body">
                     <div class="table-responsive">
                         <table id="tabel_menu_parent"
                             class="display table table-striped table-hover dataTable table-bordered" role="grid">
                             <thead>
                                 <tr role="row">
                                     <th>No</th>
                                     <th>Nama</th>
                                     <th>URL</th>
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

             loadTabeMenuHeader();

             // load tabel header menu
             function loadTabeMenuHeader() {

                 $('#tabel_menu_header').DataTable().destroy();

                 $.post('{{ URL::to('admin/load-tabel-menu-header') }}', {
                     _token: '{{ csrf_token() }}'
                 }, function(e) {
                     var tabel = $("#tabel_menu_header").DataTable({
                         layout: {
                             topStart: {
                                 buttons: [{
                                     text: 'Add',
                                     className: 'btn-primary',
                                     action: function(e, dt, node, config) {
                                         addMenuHeader();
                                     }
                                 }, "excel", "pdf"],
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
                                 data: 'nama',
                                 className: "text-left",
                             },
                             {
                                 data: 'url',
                                 className: "text-left",
                             },
                             {
                                 data: 'punya_sub',
                                 className: "text-left",
                             },
                             {
                                 data: 'icon',
                                 className: "text-left",
                             },
                             {
                                 data: null,
                                 "render": function(data, type, row) {
                                     if (row.punya_sub == 'Y') {
                                         return '<div class="btn-group">' +
                                             '<button data-id="' + row.id + '" data-nama="' +
                                             row
                                             .nama + '" data-icon="' + row.icon +
                                             '" data-url="' + row.url +
                                             '" data-urut="' + row.urut_header +
                                             '" data-sub="' + row.punya_sub +
                                             '" data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn btn-primary btn-sm edit_menu_header"><i class="fas fa-edit"></i></button>' +
                                             '<button data-id="' + row.id +
                                             '" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-info btn-sm detail_header"><i class="fa fa-eye"></i></button>' +
                                             '</div>'
                                     } else {
                                         return '<div class="btn-group">' +
                                             '<button data-id="' + row.id + '" data-nama="' +
                                             row
                                             .nama + '" data-icon="' + row.icon +
                                             '" data-url="' + row.url +
                                             '" data-urut="' + row.urut_header +
                                             '" data-sub="' + row.punya_sub +
                                             '" data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn btn-primary btn-sm edit_menu_header"><i class="fas fa-edit"></i></button>' +
                                             '</div>'
                                     }
                                 },
                             },
                         ]
                     }).buttons().container().appendTo('#tabel_menu_header_wrapper .col-md-6:eq(0)');

                     tabel.on('order.dt search.dt', function() {
                         tabel.column(0, {
                             search: 'applied',
                             order: 'applied'
                         }).nodes().each(function(cell, i) {
                             cell.innerHTML = i + 1;
                         });
                     });

                 }).done(function(data) {
                     clearFormMenuHeader();
                 });
             }

             function clearFormMenuHeader() {
                 $("#id_menu_header").val("");
                 $("#nama_menu_header").val("");
                 $("#url_menu_header").val("");
                 $("#icon_menu_header").val("");
                 $("#urut_menu_header").val("");
             }

             function addMenuHeader() {
                 clearFormMenuHeader();
                 $('#modal-default').modal('show');
                 $('.modal-title').html('Add Menu Header');
             }

             $(document).on("click", ".detail_header", function(e) {
                 var id_header = $(this).data("id");


                 $.ajax({
                     url: "/admin/detail-menu-header",
                     cache: false,
                     type: 'post',
                     data: {
                         id_header,
                         _token: '{{ csrf_token() }}'
                     },
                     success: function(result) {
                         $("#id_header").val(result.id);
                         $("#nama_header").html(result.nama);

                         loadTableParentMenu(result.id, result.nama);
                         // alert(result.id);
                     },
                     fail: function(xhr, textStatus, errorThrown) {
                         tampilPesan('warning', 'fa fa-info', 'Informasi', 'request failed');
                     }
                 });
             });

             $(document).on("click", ".edit_menu_header", function(e) {
                 var id_menu = $(this).data("id");
                 var nama_menu = $(this).data("nama");
                 var url_menu = $(this).data("url");
                 var sub_menu = $(this).data("sub");
                 var icon_menu = $(this).data("icon");
                 var urut_menu = $(this).data("urut");

                 $("#id_menu_header").val(id_menu);
                 $("#nama_menu_header").val(nama_menu);
                 $("#url_menu_header").val(url_menu);
                 $("#icon_menu_header").val(icon_menu);
                 $("#urut_menu_header").val(urut_menu);

                 $('#modal-default').modal('show');
                 $('.modal-title').html('Edit Menu Header');
             });

             //  save_menu_header
             $(document).on("click", "#save_menu_header", function(e) {
                 var id = $("#id_menu_header").val();
                 var nama = $("#nama_menu_header").val();
                 var url = $("#url_menu_header").val();
                 var sub = $("#punya_sub").val();
                 var icon = $("#icon_menu_header").val();
                 var urut_header = $("#urut_menu_header").val();

                 if (nama == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi',
                         'Nama menu header tidak boleh kosong!');
                 } else if (url == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi',
                         'URL menu header tidak boleh kosong!');
                 } else if (sub == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi',
                         'Punya Sub menu header tidak boleh kosong!');
                 } else if (icon == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi',
                         'Icon menu header tidak boleh kosong!');
                 } else if (urut_header == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi',
                         'Urut menu header tidak boleh kosong!');
                 } else {

                     $.ajax({
                         url: "/admin/store-menu-header",
                         cache: false,
                         type: 'post',
                         data: {
                             id,
                             nama,
                             url,
                             sub,
                             icon,
                             urut_header,
                             _token: '{{ csrf_token() }}'
                         },
                         success: function(result) {
                             console.log(result);
                             loadTabeMenuHeader();

                             tampilPesan('success', 'fa fa-info', 'Informasi', result.message);
                             clearFormMenuHeader();
                             $('#modal-default').modal('hide');

                         },
                         fail: function(xhr, textStatus, errorThrown) {
                             tampilPesan('danger', 'fa fa-info', 'Informasi', 'request failed');
                             $('#modal-default').modal('hide');
                         }
                     });
                 }

             });

             // load tabel parent
             function loadTableParentMenu(id_header, nama_header) {

                 $('#tabel_menu_parent').DataTable().destroy();

                 $.post('{{ URL::to('admin/load-tabel-menu-parent') }}', {
                     id_header,
                     _token: '{{ csrf_token() }}'
                 }, function(e) {
                     var tabel = $("#tabel_menu_parent").DataTable({
                         layout: {
                             topStart: {
                                 buttons: [{
                                     text: 'Add',
                                     className: 'btn-primary',
                                     action: function(e, dt, node, config) {
                                         addMenuParent(id_header, nama_header);
                                     }
                                 }, "excel", "pdf"],
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
                                 data: 'nama',
                                 className: "text-left",
                             },
                             {
                                 data: 'url',
                                 className: "text-left",
                             },
                             {
                                 data: null,
                                 "render": function(data, type, row) {
                                     return '<div class="btn-group">' +
                                         '<button data-id="' + row.id +
                                         '" data-nama="' + row.nama +
                                         '" data-icon="' + row.icon +
                                         '" data-url="' + row.url +
                                         '" data-urut="' + row.urut_parent +
                                         '" data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn btn-primary btn-sm edit_menu_parent"><i class="fas fa-edit"></i></button>' +
                                         '<button data-id="' + row.id +
                                         '" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger btn-sm hapus_parent"><i class="fa fa-trash"></i></button>' +
                                         '</div>'
                                 },
                             },
                         ]
                     }).buttons().container().appendTo('#tabel_menu_parent_wrapper .col-md-6:eq(0)');

                     tabel.on('order.dt search.dt', function() {
                         tabel.column(0, {
                             search: 'applied',
                             order: 'applied'
                         }).nodes().each(function(cell, i) {
                             cell.innerHTML = i + 1;
                         });
                     });

                 }).done(function(data) {

                     clearFormMenuParent();
                 });
             }

             function clearFormMenuParent() {
                 $("#id_parent").val("");
                 $("#nama_menu_parent").val("");
                 $("#url_parent").val("");
                 $("#urut_menu_parent").val("");
             }

             function addMenuParent(id_header, nama_header) {
                 clearFormMenuHeader();
                 $("#id_header").val(id_header);
                 $('#modal-default-parent').modal('show');
                 $('.modal-title-parent').html('Add Menu Parent ' + nama_header);
             }

             $(document).on("click", ".edit_menu_parent", function(e) {
                 var id_parent = $(this).data("id");
                 var nama_menu = $(this).data("nama");
                 var url_menu = $(this).data("url");
                 var urut_parent = $(this).data("urut");

                 $("#id_parent").val(id_parent);
                 $("#nama_menu_parent").val(nama_menu);
                 $("#url_parent").val(url_menu);
                 $("#urut_menu_parent").val(urut_parent);

                 $('#modal-default-parent').modal('show');
                 $('.modal-title-parent').html('Edit Menu Parent');
             });

             $(document).on("click", "#save_menu_parent", function(e) {
                 var id_header = $("#id_header").val();
                 var id_parent = $("#id_parent").val();
                 var nama = $("#nama_menu_parent").val();
                 var url = $("#url_parent").val();
                 var urut_parent = $("#urut_menu_parent").val();

                 if (nama == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi',
                         ' Nama menu parent tidak boleh kosong!');
                 } else if (url == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi',
                         ' URL menu parent tidak boleh kosong!');
                 } else if (urut_parent == "") {
                     tampilPesan('warning', 'fa fa-info', 'Informasi',
                         ' Urut menu parent tidak boleh kosong!');
                 } else {

                     $.ajax({
                         url: "/admin/store-menu-parent",
                         cache: false,
                         type: 'post',
                         data: {
                             id_header,
                             id_parent,
                             nama,
                             url,
                             urut_parent,
                             _token: '{{ csrf_token() }}'
                         },
                         success: function(result) {
                             console.log(result);
                             loadTableParentMenu(result.id_header, result.nama)

                             tampilPesan('success', 'fa fa-info', 'Informasi', result.message);
                             clearFormMenuParent();
                             $('#modal-default-parent').modal('hide');

                         },
                         fail: function(xhr, textStatus, errorThrown) {
                             tampilPesan('warning', 'fa fa-info', 'Informasi', 'request failed');
                             $('#modal-default').modal('hide');

                         }
                     });
                 }
             });

             //  hapus_parent
             $(document).on("click", ".hapus_parent", function(e) {
                 var id_parent = $(this).data('id');

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
                             url: '/admin/destroy-menu-parent',
                             cache: false,
                             type: 'post',
                             data: {
                                 id: id_parent,
                                 _token: '{{ csrf_token() }}'
                             },
                             success: function(result) {
                                 console.log(result);
                                 var id = $("#id_header").val();
                                 var nama = $("#nama_header").html();
                                 loadTableParentMenu(id, nama)
                                 tampilPesan('success', 'fa fa-info', 'Informasi', result
                                     .message);
                             },
                             fail: function(xhr, textStatus, errorThrown) {
                                 tampilPesan('warning', 'fa fa-info', 'Informasi',
                                     'request failed');
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

         });
     </script>
 @endsection
