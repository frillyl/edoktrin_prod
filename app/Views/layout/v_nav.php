<ul>
  <li>
    <a href="<?= base_url('dashboard'); ?>">Dashboard</a>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Master
    </a>
    <ul class="dropdown-menu" aria-labelledby="masterDropdown" style="justify-content: center; align-items:center;"> <!-- Mengatur jarak dropdown ke bawah -->
      <li><a class="dropdown-item" href="<?= base_url('master/pengguna'); ?>">Pengguna</a></li>
      <li><a class="dropdown-item" href="<?= base_url('master/pencipta'); ?>">Asal Doktrin</a></li>
      <li><a class="dropdown-item" href="<?= base_url('master/unit'); ?>">Unit Organisasi</a></li>
      <li><a class="dropdown-item" href="<?= base_url('master/klasifikasi'); ?>">Jenis Doktrin</a></li>
    </ul>
  </li>


  <li>
    <a href="<?= base_url('manajemen/arsip'); ?>">Arsip</a>
  </li>
</ul>

<div class="icon-container">
  <i class="far fa-bell"></i>
  <div class="dropdown no-caret dropdown-user me-3 me-lg-4">
    <img class="profile-img" src="<?= base_url('public/assets/images/profile_pict/' . session()->get('photo')) ?>" id="profileImage">

    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage" id="dropdownMenu" style="display: none;">
      <a class="dropdown-item" href="<?= base_url('master/profile'); ?>"> <!-- Link to the profile page -->
        <div class="dropdown-item-icon">
          <i class="fas fa-user"></i> <!-- You can change this icon -->
        </div>
        Profile
      </a>
      <a class="dropdown-item" onclick="window.location.href='<?= base_url('login'); ?>'">
        <div class="dropdown-item-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
        </div>
        Logout
      </a>
    </div>
  </div>


</div>
</nav>