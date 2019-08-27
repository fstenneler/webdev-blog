        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Consulter les commentaires</h1>
        

          <!-- DataTales Example -->
          <?php $commentList = $this->app()->getData('commentList'); ?>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Article : <?= $this->esc($commentList[0][0]->post_title); ?></h6>
            </div>
            <div class="card-body">

                <?php foreach($commentList[0] as $commentLevel1) { ?>

                  <div class="comment-view-level-1">
                      <div class="comment-view-author"><?= $this->esc($commentLevel1->user_nickname); ?></div>
                      <div class="comment-view-date"><?= $this->esc($commentLevel1->date); ?></div>
                      <div class="comment-view-comment"><?= $this->esc($commentLevel1->content); ?></div>
                      <?php if($commentLevel1->status === 'Attente') { ?>
                        <form class="comment-view-choice" method="post" action="">
                          <input type="hidden" name="status" value="">
                          <input type="hidden" name="id" value="<?= $this->esc($commentLevel1->id); ?>">
                          <input type="submit" name="submit" value="Valider" class="btn btn-success submit-button"><input type="submit" name="submit" value="Refuser" class="btn btn-danger submit-button">
                        </form>
                      <?php } elseif($commentLevel1->status === 'Validé') { ?>
                        <div class='comment-status-validated'>Commentaire validé</div>
                      <?php } elseif($commentLevel1->status === 'Refusé') { ?>
                        <div class='comment-status-refused'>Commentaire refusé</div>
                      <?php } ?>
                  </div>

                  <?php 
                    if(isset($commentList[$commentLevel1->id])) {
                      foreach($commentList[$commentLevel1->id] as $key => $commentLevel2) { 
                  ?>
                  <div class="comment-view-level-2">
                      <div class="comment-view-author"><?= $this->esc($commentLevel2->user_nickname); ?></div>
                      <div class="comment-view-date"><?= $this->esc($commentLevel2->date); ?></div>
                      <div class="comment-view-comment"><?= $this->esc($commentLevel2->content); ?></div>
                      <?php if($commentLevel2->status === 'Attente') { ?>
                        <form class="comment-view-choice" method="post" action="">
                          <input type="hidden" name="status" value="">
                          <input type="hidden" name="id" value="<?= $this->esc($commentLevel2->id); ?>">
                          <input type="submit" name="submit" value="Valider" class="btn btn-success submit-button"><input type="submit" name="submit" value="Refuser" class="btn btn-danger submit-button">
                        </form>
                      <?php } elseif($commentLevel2->status === 'Validé') { ?>
                        <div class='comment-status-validated'>Commentaire validé</div>
                      <?php } elseif($commentLevel2->status === 'Refusé') { ?>
                        <div class='comment-status-refused'>Commentaire refusé</div>
                      <?php } ?>
                  </div>

                 <?php 
                      }
                    }
                  }
                  ?>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        
