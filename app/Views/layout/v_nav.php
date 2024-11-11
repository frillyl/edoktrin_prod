<style>
  .notification-menu {
    display: inline-block;
    margin-left: 20px;
    padding: 10px;
    position: relative;
  }

  .notification-menu .glyphicon-bell {
    font-size: 1.5rem;
    position: relative;
  }

  .notification-menu .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: #8A3A42;
    color: #fff;
    font-size: 0.8rem;
    padding: 3px 7px;
    border-radius: 50%;
  }

  .notification-dropdown-menu {
    min-width: 300px;
    border-radius: 8px;
    background-color: white;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    position: absolute;
    top: 100%;
    right: 0;
    display: none;
    /* Initially hidden */
    z-index: 1000;
  }

  .notification-menu:hover .notification-dropdown-menu {
    display: block;
  }

  .notifications-wrapper {
    overflow-y: auto;
    max-height: 250px;
  }

  .menu-title {
    color: #333333;
    font-size: 1.3rem;
  }

  .view-all {
    font-size: 0.9rem;
    color: #8A3A42;
    text-decoration: none;
  }

  .view-all:hover {
    text-decoration: underline;
  }

  .notification-heading,
  .notification-footer {
    padding: 10px 15px;
    background-color: #f8f9fa;
  }

  .notification-item {
    display: flex;
    align-items: center;
    padding: 10px;
    margin: 5px 0;
    background: #f0f0f0;
    border-radius: 5px;
    transition: background-color 0.3s;
  }

  .notification-item:hover {
    background-color: #e2e2e2;
  }

  .notification-item .icon {
    margin-right: 10px;
    font-size: 1.2rem;
    color: #8A3A42;
  }

  .notification-item .text {
    flex-grow: 1;
  }

  .item-title {
    font-size: 1rem;
    font-weight: bold;
    color: #333;
    margin: 0;
  }

  .item-info {
    font-size: 0.85rem;
    color: #999;
    margin: 0;
  }

  .divider {
    margin: 0;
    border-top: 1px solid #e0e0e0;
  }
</style>

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
  <div class="notification-menu">
    <a id="dLabel" role="button" data-toggle="notification-dropdown" data-target="#" href="/page.html">
      <i class="far fa-bell"></i>
      <?php if ($unreadCount > 0): ?>
        <span class="badge"><?php echo $unreadCount; ?></span>
      <?php endif; ?>
    </a>

    <ul class="notification-dropdown-menu" role="menu" aria-labelledby="dLabel">
      <div class="notification-heading">
        <h4 class="menu-title"><?php echo $unreadCount; ?> Notifikasi</h4>
        <a class="view-all" href="#" class="mark-all-read pull-right">Tandai semua telah dibaca</a>
      </div>
      <li class="divider"></li>
      <div class="notifications-wrapper">
        <?php
        $recentNotifications = $unreadNotifications;
        foreach ($recentNotifications as $notif):
        ?>
          <p class="content">
          <div class="notification-item">
            <div class="icon"><i class="far fa-bell"></i></div>
            <div class="text">
              <h4 class="item-title"><?php echo "{$notif['pesan']} oleh {$notif['created_by_name']}"; ?></h4>
              <p class="item-info"></p>
            </div>
          </div>
          </p>
        <?php endforeach; ?>
      </div>
    </ul>
  </div>

  <div class="dropdown no-caret dropdown-user me-3 me-lg-4 d-flex align-items-center">
    <div id="profileImage" style="display: flex; align-items: center; cursor:pointer;">
      <img class="profile-img" src="<?= base_url('public/assets/images/profile_pict/' . session()->get('photo')) ?>" id="profileImage">
      <span class="profile-name ms-2"><?= session()->get('nama'); ?></span>
    </div>

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