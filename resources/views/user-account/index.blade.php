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
                                 class="img-preview avatar-img rounded-circle">
                         </div>


                         <h3 class="mt-3">{{ Auth::user()->name }}</h3>
                         <p class="text-small">{{ getLevel(Auth::user()->id_level) }}</p>
                     </div>

                     <form action="/upload-user-img-account" method="post" enctype="multipart/form-data">
                         @csrf

                         @if (session()->has('success'))
                             <div class="alert alert-success alert-dismissible" role="alert">
                                 {{ session('success') }}
                             </div>
                         @endif

                         <div class="row pt-3">

                             <div class="col">
                                 <input required name="image" onchange="previewImage()"
                                     class="form-control @error('image') is-invalid @enderror" type="file"
                                     id="image">
                                 @error('image')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <div class="col">
                                 <button class="btn btn-success">
                                     <span class="btn-label">
                                         <i class="fa fa-upload"></i>
                                     </span>
                                     Upload
                                 </button>
                             </div>

                         </div>
                     </form>
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
         function previewImage() {
             const image = document.querySelector('#image');
             const imgPreview = document.querySelector('.img-preview');

             imgPreview.style.display = 'block';

             const oFReader = new FileReader();
             oFReader.readAsDataURL(image.files[0]);

             oFReader.onload = function(oFREvent) {
                 imgPreview.src = oFREvent.target.result;
             }
         }

         $(function() {

         });
     </script>
 @endsection
