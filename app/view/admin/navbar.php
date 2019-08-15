<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon">
     <i class="fas fa-toolbox"></i>  
  </div>
  <div class="sidebar-brand-text mx-3">WebDev<br />Blog admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<!-- Nav Item - Liste des articles -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapsePost">
    <i class="fas fa-blog"></i>
    <span>Articles</span>
  </a>
  <div id="collapsePost" class="collapse" aria-labelledby="headingPost" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Gestion des articles :</h6>
      <a class="collapse-item" href="index.php?page=post">Liste des articles</a>
      <a class="collapse-item" href="index.php?page=post&action=add">Créer un article</a>
    </div>
  </div>
</li>

<!-- Nav Item - Utilisateurs -->
<li class="nav-item">
  <a class="nav-link" href="index.php?page=user">
    <i class="fas fa-user-cog"></i>
    <span>Utilisateurs</span></a>
</li>

<!-- Nav Item - Commentaires -->
<li class="nav-item">
  <a class="nav-link" href="index.php?page=comment">
    <i class="fas fa-comments"></i>
    <span>Commentaires</span></a>
</li>

<!-- Nav Item - Messages -->
<li class="nav-item">
  <a class="nav-link" href="index.php?page=contact">
    <i class="fas fa-envelope"></i>
    <span>Messages</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
