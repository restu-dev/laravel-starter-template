 @extends('layouts.admin.app')

 @section('css')
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/bootstrap.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/buttons.bootstrap4.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/datatable/button/css/dataTables.bootstrap4.css') }}">
 @endsection

 @section('content')
     <div class="row">

         <div class="col-lg-2">
             <div class="card">
                 <div class="card-header">
                     <h5 class="m-0">Level</h5>
                 </div>
                 <div class="card-body">
                     <div class="card-body p-0 m-0">
                         @forelse ($level as $d)
                             <button data-id="{{ $d->id }}" data-name="{{ $d->name }}" type="button"
                                 class="level_akses btn btn-block btn-primary">{{ $d->name }}</button>
                         @empty
                             <p>Tidak ada data</p>
                         @endforelse
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-lg-10">
             <div id="tampil_akses"></div>
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

             //  level_akses
             $(document).on("click", ".level_akses", function(e) {
                 var id_level = $(this).data("id");
                 var name_level = $(this).data("name");

                 $.ajax({
                     url: "/admin/tampil-level-akses",
                     cache: false,
                     type: 'post',
                     data: {
                         id_level,
                         name_level,
                         _token: '{{ csrf_token() }}'
                     },
                     success: function(result) {
                         $("#tampil_akses").html(result);
                     },
                     fail: function(xhr, textStatus, errorThrown) {
                        tampilPesan('warning', 'fa fa-info', 'Informasi', 'request failed');
                     }
                 });

             });

             // simpan akses menu
             $(document).on("click", "#simpanaksesmenu", function(e) {

                 var data = $("#form_akses").serialize();

                 $.ajax({
                     url: '/admin/simpan-akses-menu',
                     cache: false,
                     type: 'post',
                     data: {
                         data: data,
                         _token: '{{ csrf_token() }}'
                     },
                     success: function(e) {
                     tampilPesan('success', 'fa fa-info', 'Informasi', 'Berhasil add akses');
                     }
                 })

             });

         });
     </script>
 @endsection
