        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Commentaires</h1>
        

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
                      <th>Date</th>
                      <th>Commentaire</th>
                      <th>Utilisateur</th>
                      <th>Article</th>
                      <th>Statut</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>Date</th>
                      <th>Commentaire</th>
                      <th>Utilisateur</th>
                      <th>Article</th>
                      <th>Statut</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    <?php 
                    foreach($this->app()->getData('commentList') as $commentGroup) {
                      foreach($commentGroup as $comment) {
                      ?>

                    <tr>
                      <td><?php if($comment->status === 'Attente') { echo '<i class="fas fa-circle comment-status-att"></i>'; } ?></td>
                      <td><?= $this->esc($comment->date); ?></td>
                      <td><a href="index.php?page=comment&action=view&postId=<?= $this->esc($comment->post_id); ?>"<?php if($comment->status === 'Attente') { echo ' class="comment-status-att"'; } ?>><?= $this->esc(substr($comment->content,0,50)); ?> ...</a></td>
                      <td><a href="index.php?page=user&action=update&userId=<?= $this->esc($comment->user_id); ?>"><?= $this->esc($comment->user_avatar_icon); ?><?= $this->esc($comment->user_nickname); ?></a></td>
                      <td><a href="index.php?page=post&action=update&postId=<?= $this->esc($comment->post_id); ?>"><?= $this->esc($comment->post_title); ?></a></td>
                      <td><a href="" class="comment-status-<?= $this->esc(strtolower(substr($comment->status,0,3))); ?>"><?= $this->esc($comment->status); ?></a></td>
                    </tr>

                    <?php
                      }            
                    }
                    ?>
                  </tbody>
                </table>
                Lignes sélectionnées : <button type="button" class="btn btn-secondary">Supprimer</button>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
