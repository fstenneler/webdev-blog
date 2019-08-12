        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Gestion des articles</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="index.php?page=post&action=add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-square fa-sm text-white-50"></i> Créer un nouvel article</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="stripe" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Id</th>
                      <th>Titre</th>
                      <th>Création</th>
                      <th>Dernière modification</th>
                      <th>Utilisateur</th>
                      <th>Hero</th>
                      <th>Catégorie</th>
                      <th>Commentaires</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>Id</th>
                      <th>Titre</th>
                      <th>Création</th>
                      <th>Dernière modification</th>
                      <th>Utilisateur</th>
                      <th>Hero</th>
                      <th>Catégorie</th>
                      <th>Commentaires</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach($this->app()->getData('postList') as $post) { ?>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td><?= $post->post_id; ?></td>
                      <td><a href="index.php?page=post&action=update&postId=<?= htmlspecialchars($post->post_id); ?>"><?= $post->title; ?></a></td>
                      <td><?= $post->creation_date; ?></td>
                      <td><?= $post->last_modification_date; ?></td>
                      <td><?= $post->user_nickname; ?></td>
                      <td>
                        <?php if($post->is_hero > 0) { ?>oui<?php } ?>
                      </td>
                      <td><?= $post->category_name; ?></td>
                      <td>
                        <?php if($post->comment_number > 0) { ?>
                          <a class="postlist-comment-link" href="index.php?page=comment&action=view&postId=<?= $post->post_id; ?>"><?= $post->comment_number; ?></a>
                        <?php } else { ?>
                          <?= $post->comment_number; ?>
                        <?php } ?>
                      </td>
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
