<li class="nav-item has-treeview">
   <li class="nav-item">
      <a href="{{ route('ketua.calendar.index') }}" class="nav-link">
         <i class="fa fa-calendar" aria-hidden="true"></i>
         <p>
            Kalender
         </p>
      </a>
   </li>
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
            <a href="{{ route('ketua.peminjaman.mahasiswa') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>
                  Mahasiswa
               </p>
            </a>
         </li>
      </ul>
      <ul class="nav nav-treeview">
         <li class="nav-item">
            <a href="{{ route('ketua.peminjaman.pegawai') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>
                  Pegawai
               </p>
            </a>
         </li>
      </ul>
      <ul class="nav nav-treeview">
         <li class="nav-item">
            <a href="{{ route('ketua.peminjaman.umum') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>
                  Umum
               </p>
            </a>
         </li>
      </ul>
   </li>
<li class="nav-item has-treeview">
   <li class="nav-item">
      <a href="{{ route('ketua.laporan.index') }}" class="nav-link">
         <i class="fa fa-file" aria-hidden="true"></i>
         <p>
            Laporan peminjam
         </p>
      </a>
   </li>
</li>
