        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Messages</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="stripe" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Lu</th>
                      <th>E-mail</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Date</th>
                      <th>Objet</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th></th>
                      <th>Lu</th>
                      <th>E-mail</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Date</th>
                      <th>Objet</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    <?php foreach($this->app()->getData('contactList') as $contact) { ?>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td><?php if($contact->message_read == 0) { ?><i class="fas fa-circle comment-status-att"></i><?php } ?></td>
                      <td><?= $contact->email; ?></td>
                      <td><?= $contact->name; ?></td>
                      <td><?= $contact->first_name; ?></td>
                      <td><?= $contact->date; ?></td>
                      <td><a href="index.php?page=contact&action=view&contactId=<?= $contact->id; ?>" class="comment-status-waiting"><?= $contact->subject; ?></a></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                Lignes sélectionnées : <button type="button" class="btn btn-secondary">Supprimer</button>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
