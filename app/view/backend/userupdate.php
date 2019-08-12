        <?php $user = $this->app()->getData('userList'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Modification d'un utilisateur</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Utilisateur : [<?= $user->id; ?>] <?= $user->nickname; ?></h6>
            </div>
            <div class="card-body">

                <form class="user">
                  <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="userRole">Rôle</label>
                            <select class="form-control form-control-user" id="userRole" placeholder="Rôle">
                                <option value="Administrateur"<?php if($user->role === 'Administrateur') { echo " selected"; } ?>>Administrateur</option>
                                <option value="Visiteur"<?php if($user->role === 'Visiteur') { echo " selected"; } ?>>Visiteur</option>
                            </select>
                        </div>
                   </div>
                   <div class="form-group row">
                        <div class="col-sm-12 col-lg-4">
                            <label for="userNickname">Pseudo</label>
                            <input type="text" class="form-control form-control-user" id="userNickname" placeholder="Pseudo" value="<?= htmlspecialchars($user->nickname); ?>">
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <label for="userNickname">E-mail</label>
                            <input type="text" class="form-control form-control-user" id="userNickname" placeholder="E-mail" value="<?= htmlspecialchars($user->email); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-4">
                            <label for="userFirstname">Prénom</label>
                            <input type="text" class="form-control form-control-user" id="userFirstname" placeholder="Prénom" value="<?= htmlspecialchars($user->first_name); ?>">
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <label for="userName">Nom</label>
                            <input type="text" class="form-control form-control-user" id="userName" placeholder="Nom" value="<?= htmlspecialchars($user->name); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-9">
                            <label for="userDescription">Description</label>
                            <textarea class="form-control form-control-user" id="userDescription" placeholder="Description" style="height: 15em;"><?= $user->description; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-9">
                            <a href="login.html" class="btn btn-primary btn-user btn-block">Enregistrer les modifications</a>
                        </div>
                    </div>
                </form>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        
