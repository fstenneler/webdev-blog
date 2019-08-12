        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Objet : <?= $this->app()->getData('contactList')->subject; ?></h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                Envoyé le <?= $this->app()->getData('contactList')->date; ?><br />
                Par <?= $this->app()->getData('contactList')->first_name; ?> <?= $this->app()->getData('contactList')->name; ?> [<?= $this->app()->getData('contactList')->email; ?>]</h6>
            </div>
            <div class="card-body"><?= $this->app()->getData('contactList')->message; ?></div>
          </div>

        </div>
        <!-- /.container-fluid -->

        
