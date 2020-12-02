   <li class="nav-header">Master data</li>

   <li class="nav-item">
      <a href="{{ route('admin.room.index') }}" class="nav-link">
         <i class="fa fa-tags" aria-hidden="true"></i>
         <p>
            Master Item
         </p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link">
         <i class="fa fa-graduation-cap" aria-hidden="true"></i>
         <p>
            Master mahasiswa
         </p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{ route('admin.masterPegawai.index') }}" class="nav-link">
         <i class="fa fa-user" aria-hidden="true"></i>
         <p>
            Master pegawai
         </p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{ route('admin.kelolaRuang.index') }}" class="nav-link">
         <i class="fa fa-table" aria-hidden="true"></i>
         <p>
            Kelola Ruang
         </p>
      </a>
   </li>

   <li class="nav-header">Peminjaman dan pengembalian</li>

   <li class="nav-item">
      <a href="{{ route('admin.auditorium.index') }}" class="nav-link">
         <i class="fa fa-hospital"></i>
         <p>
            Auditorium
         </p>
      </a>
   </li>

   <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
         <i class="fa fa-bookmark"></i>
         <p>
            Peminjaman
            <i class="right fas fa-angle-left"></i>
         </p>
      </a>
      <ul class="nav nav-treeview">
         <li class="nav-item">
            <a href="{{ route('admin.peminjaman.index') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>
                  Mahasiswa
               </p>
            </a>
         </li>
         <li class="nav-item">
            <a href="{{ route('admin.pegawai.index') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>
                  Pagawai
               </p>
            </a>
         </li>

         <li class="nav-item">
            <a href="{{ route('admin.umum.index') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>
                  Umum
               </p>
            </a>
         </li>
      </ul>
   </li>

   <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
         <i class="fa fa-arrow-circle-left"></i>
         <p>
            Pengembalian
            <i class="right fas fa-angle-left"></i>
         </p>
      </a>
      <ul class="nav nav-treeview">
         <li class="nav-item">
            <a href="{{ route('admin.pengembalian.mahasiswa') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>
                  Mahasiswa
               </p>
            </a>
         </li>
         <li class="nav-item">
            <a href="{{ route('admin.pengembalian.pegawai') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>
                  Pagawai
               </p>
            </a>
         </li>

         <li class="nav-item">
            <a href="{{ route('admin.pengembalian.umum') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>
                  Umum
               </p>
            </a>
         </li>
      </ul>
   </li>

   <li class="nav-header">Monitoring</li>
   <li class="nav-item">
      <a href="{{ route('admin.calendar.index') }}" class="nav-link">
         <i class="fa fa-calendar" aria-hidden="true"></i>
         <p>
            Kalender
         </p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{ route('admin.laporan.index') }}" class="nav-link">
         <i class="fa fa-file" aria-hidden="true"></i>
         <p>
            Laporan
         </p>
      </a>
   </li>

   <li class="nav-header">User Kontrol</li>
   <li class="nav-item">
      <a href="{{ route('admin.user.index') }}" class="nav-link">
         <i class="fa fa-user" aria-hidden="true"></i>
         <p>
            User
         </p>
      </a>
   </li>
