        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Consulter les commentaires</h1>
        

          <!-- DataTales Example -->
          <?php $commentList = $this->app()->getData('commentList'); ?>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Article : <?= $commentList[0][0]->post_title; ?></h6>
            </div>
            <div class="card-body">

                <?php foreach($commentList[0] as $commentLevel1) { ?>

                  <div class="comment-view-level-1">
                      <div class="comment-view-author"><?= $commentLevel1->user_nickname; ?></div>
                      <div class="comment-view-date"><?= $commentLevel1->date; ?></div>
                      <div class="comment-view-comment"><?= $commentLevel1->content; ?></div>
                      <?php if($commentLevel1->status === 'Attente') { ?>
                      <div class="comment-view-choice"><button type="button" class="btn btn-success">Valider</button><button type="button" class="btn btn-danger">Refuser</button></div>
                      <?php } ?>
                  </div>

                  <?php 
                    if(isset($commentList[$commentLevel1->id])) {
                      foreach($commentList[$commentLevel1->id] as $key => $commentLevel2) { 
                  ?>
                  <div class="comment-view-level-2">
                      <div class="comment-view-author"><?= $commentLevel2->user_nickname; ?></div>
                      <div class="comment-view-date"><?= $commentLevel2->date; ?></div>
                      <div class="comment-view-comment"><?= $commentLevel2->content; ?></div>
                      <?php if($commentLevel2->status === 'Attente') { ?>
                      <div class="comment-view-choice"><button type="button" class="btn btn-success">Valider</button><button type="button" class="btn btn-danger">Refuser</button></div>
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

        
