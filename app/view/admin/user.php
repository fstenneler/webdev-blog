        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Gestion des utilisateurs</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="stripe" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Pseudo</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>E-mail</th>
                      <th>Rôle</th>
                      <th>Date d'inscription</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Pseudo</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>E-mail</th>
                      <th>Rôle</th>
                      <th>Date d'inscription</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    <?php foreach($this->app()->getData('userList') as $user) { ?>
                    <tr>
                      <td><?= $user->id; ?></td>
                      <td><a href="index.php?page=user&action=update&userId=<?= $this->esc($user->id); ?>"><?= $this->esc($user->avatarIcon); ?><?= $this->esc($user->nickname); ?></a></td>
                      <td><?= $this->esc($user->name); ?></td>
                      <td><?= $this->esc($user->first_name); ?></td>
                      <td><?= $this->esc($user->email); ?></td>
                      <td><?= $this->esc($user->role); ?></td>
                      <td><?= $this->esc($user->registration_date); ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
