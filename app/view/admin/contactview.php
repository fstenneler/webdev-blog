        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Objet : <?= htmlspecialchars($this->app()->getData('contactList')->subject); ?></h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                Envoyé le <?= htmlspecialchars($this->app()->getData('contactList')->date); ?><br />
                Par <?= htmlspecialchars($this->app()->getData('contactList')->name); ?> [<?= htmlspecialchars($this->app()->getData('contactList')->email); ?>]</h6>
                <?php if($this->app()->getData('contactList')->message_read === 0) { ?>
                <form method="post" action="">
                  <input name="submit" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="margin-top: 1rem;" value="Marquer comme lu">
                </form>
                <?php } ?>
            </div>
            <div class="card-body"><?= htmlspecialchars($this->app()->getData('contactList')->message); ?></div>
          </div>

        </div>
        <!-- /.container-fluid -->

        
