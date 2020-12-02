@extends('template.ui')
@section('title', 'Data mahasiswa')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active">Data mahasiswa</li>
</ol>
@endsection

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Data mahasiswa</h3>
               </div>
               <div class="card-body">
                  @if(session('pesan'))
                     <div class="alert alert-primary alert-flat" id="notif">{{ session('pesan') }}</div>
                  @endif
                  <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary btn-flat mb-2">Tambah mahasiswa</a>
                  <table id="dataTable" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Nim</th>
                           <th>Nama</th>
                           <th>Fakultas</th>
                           <th>Jurusan</th>
                           <th>Alamat</th>
                           <th>No Telp</th>
                           <th>Email</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@push('styles')
   <!-- DataTables -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

   <!--- Sweet alert -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme/bootstrap-4.min.css') }}">
@endpush

@push('scripts')
<!-- DataTables -->
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

   <!-- Sweet alert -->
   <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
   <script>
      $(function() {
      //dataTable
      $('#dataTable').DataTable({
         "processing" : true,
         "serverSide" : true,
         "responsive" : true,
         "autoWidth" : true,
         ajax: '{{ route('admin.data.mahasiswa') }}',
         columns : [
            {data: 'DT_RowIndex'},
            {data: 'nim'},
            {data: 'nama'},
            {data: 'fakultas'},
            {data: 'jurusan'},
            {data: 'alamat'},
            {data: 'noTelp'},
            {data: 'email'},
            {data: 'action'},
         ]
      });
         //sweet alert
      $('#dataTable').on('click', 'button#delete', function(e){
         e.preventDefault();
         var id = $(this).data('id'); //ambil dari data-id

         Swal.fire({
            title: 'Yakin menghapus data?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel!',
         }).then((result) => {
            if (result.value) {
               $.ajax({
                  type: "DELETE",
                  url: "/administator/mahasiswa/"+id,
                  data: {
                     "id": id,
                     "_token": "{{ csrf_token() }}"
                  },

                  //setelah berhasil di hapus
                  success: function(data){
                     if(data.success === true){
                        Swal.fire(
                        'Hapus data!',
                        'Data telah di hapus.',
                        'success'
                        )
                        //setelah alert succes, maka reload halaman
                        location.reload(true);
                     }else if(data.success === false){
                        Swal.fire('Info! ', data.message, 'info')
                     }
                  }
               })
            }
         })
      });
         //notif
      $('#notif').fadeTo(2000, 500).slideUp(500, function(){
               $('#notif').slideUp(500);
         })
      });
   </script>
@endpush