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
                      <th>Lu</th>
                      <th>Objet</th>
                      <th>E-mail</th>
                      <th>Nom</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Lu</th>
                      <th>Objet</th>
                      <th>E-mail</th>
                      <th>Nom</th>
                      <th>Date</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    <?php foreach($this->app()->getData('contactList') as $contact) { ?>
                    <tr>
                      <td><?php if($contact->message_read == 0) { ?><i class="fas fa-circle comment-status-att"></i><?php } ?></td>
                      <td><a href="index.php?page=contact&action=view&contactId=<?= htmlspecialchars($contact->id); ?>" class="comment-status-waiting"><?= htmlspecialchars($contact->subject); ?></a></td>
                      <td><?= htmlspecialchars($contact->email); ?></td>
                      <td><?= htmlspecialchars($contact->name); ?></td>
                      <td><?= htmlspecialchars($contact->date); ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
