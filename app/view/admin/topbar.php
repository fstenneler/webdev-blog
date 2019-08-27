<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
<div class="logo-website" ><span class='admin text-gray-800'>Admin</span><span class="blue">web</span>dev.fr</div>
</div>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
  <li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-search fa-fw"></i>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
      <form class="form-inline mr-auto w-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </li>

  <!-- Nav Item - Alerts -->
  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-bell fa-fw"></i>
      <!-- Counter - Alerts -->
      <span class="badge badge-danger badge-counter"><?= $this->esc($this->app()->getData('CommentNumber')); ?></span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
      Nouveaux commentaires
      </h6>

      <?php 
      $nb = 0;
      foreach($this->app()->getData('commentList') as $commentGroup) { 
        foreach($commentGroup as $comment) {
          $nb ++;
      ?>

      <a class="dropdown-item d-flex align-items-center" href="index.php?page=comment&action=view&postId=<?= $this->esc($comment->post_id); ?>">
        <div class="mr-3">
        <?= $this->esc($comment->user_avatar_icon); ?>
        </div>
        <div>
          <div class="small text-gray-500"><?= $this->esc($comment->date); ?></div>
          <?= $this->esc(substr($comment->content,0,50)); ?>...
        </div>
      </a>

      <?php 
          if($nb > 8) {
            break;
          }
        }
      } 
      ?> 
      <a class="dropdown-item text-center small text-gray-500" href="index.php?page=comment">Voir tous les commentaires</a>
    </div>
  </li>

  <!-- Nav Item - Messages -->
  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-envelope fa-fw"></i>
      <!-- Counter - Messages -->
      <span class="badge badge-danger badge-counter"><?= $this->esc(count($this->app()->getData('contactList'))); ?></span>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
      <h6 class="dropdown-header">
        Nouveaux messages
      </h6>

      <?php foreach($this->app()->getData('contactList') as $contact) { ?>

      <a class="dropdown-item d-flex align-items-center" href="index.php?page=contact&action=view&contactId=<?= $this->esc($contact->id); ?>">
        <div class="font-weight-bold">
          <div class="text-truncate"><?= $this->esc($contact->subject); ?></div>
          <div class="small text-gray-500"><?= $this->esc($contact->name); ?> · <?= $this->esc($contact->date); ?></div>
        </div>
      </a>

      <?php } ?>

      <a class="dropdown-item text-center small text-gray-500" href="index.php?page=contact">Voir tous les messages</a>
    </div>
  </li>

  <div class="topbar-divider d-none d-sm-block"></div>

  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?= $this->app()->getData('avatarIcon'); ?>
      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->app()->httpRequest()->getSession('user')->nickname; ?></span>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="index.php?page=user&action=update&userId=1">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Profil
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
      </a>
    </div>
  </li>

</ul>

</nav>
