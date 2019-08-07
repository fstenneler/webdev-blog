        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Gestion des utilisateurs</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="index.php?page=user&action=add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-square fa-sm text-white-50"></i> Ajouter un utilisateur</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="stripe" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Pseudo</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>E-mail</th>
                      <th>Rôle</th>
                      <th>Avatar</th>
                      <th>Date d'inscription</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>Pseudo</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>E-mail</th>
                      <th>Rôle</th>
                      <th>Avatar</th>
                      <th>Date d'inscription</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td><a href="index.php?page=user&action=update&userId=1">FabienS</a></td>
                      <td>Stenneler</td>
                      <td>Fabien</td>
                      <td>fabien.stenneler@gmail.com</td>
                      <td>Administrateur</td>
                      <td><div class="avatar-icon" style="background-color: #7D3C98;">F</div></td>
                      <td>2019-07-09</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td><a href="index.php?page=user&action=update&userId=1">FabienS</a></td>
                      <td>Stenneler</td>
                      <td>Fabien</td>
                      <td>fabien.stenneler@gmail.com</td>
                      <td>Administrateur</td>
                      <td><div class="avatar-icon" style="background-color: #7D3C98;">F</div></td>
                      <td>2019-07-09</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td><a href="index.php?page=user&action=update&userId=1">FabienS</a></td>
                      <td>Stenneler</td>
                      <td>Fabien</td>
                      <td>fabien.stenneler@gmail.com</td>
                      <td>Administrateur</td>
                      <td><div class="avatar-icon" style="background-color: #7D3C98;">F</div></td>
                      <td>2019-07-09</td>
                    </tr>
                  </tbody>
                </table>
                Lignes sélectionnées : <button type="button" class="btn btn-secondary">Supprimer</button>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
