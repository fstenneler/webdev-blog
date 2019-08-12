        
        <?php $post = $this->app()->getData('postList'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Modification d'un article</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">[<?= $post->post_id; ?>] <?= $post->title; ?></h6>
            </div>
            <div class="card-body">

                <form class="user">
                    <div class="form-group row">
                        <div class="col-xl-4">
                            <label for="articleCategory">Catégorie</label>
                            <select class="form-control form-control-user" id="articleCategory" placeholder="Catégorie">
                                <option value=""></option>
                                <?php foreach($this->app()->getData('categoryList') as $category) { ?>
                                <option value="<?= $category->id; ?>"<?php if( $post->category_id === $category->id) { echo " selected"; } ?>><?= $category->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xl-3">
                            <label for="articleUser">Auteur</label>
                            <select class="form-control form-control-user" id="articleUser" placeholder="Auteur">
                                <option value=""></option>
                                <?php foreach($this->app()->getData('userList') as $user) { ?>
                                <option value="<?= $user->id; ?>"<?php if( $post->user_id === $user->id) { echo " selected"; } ?>><?= $user->nickname; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xl-2">
                            <label for="articleHero">Article à la une</label>
                            <select class="form-control form-control-user" id="articleHero" placeholder="Article à la une">
                                <option value="0"<?php if( $post->is_hero === 0) { echo " selected"; } ?>>Non</option>
                                <option value="1"<?php if( $post->is_hero === 1) { echo " selected"; } ?>>Oui</option>
                            </select>
                        </div>
                    </div>
                   <div class="form-group row">
                        <div class="col-sm-12 col-xl-9">
                            <label for="articleTitle">Titre</label>
                            <input type="text" class="form-control form-control-user" id="articleTitle" placeholder="Titre" value="<?= htmlspecialchars($post->title); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xl-9">
                            <label for="articleHeader">Chapô</label>
                            <input type="text" class="form-control form-control-user" id="articleHeader" placeholder="Chapô" value="<?= htmlspecialchars($post->header); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xl-9">
                            <label for="articleContent">Contenu</label>
                            <textarea id="post-content" class="form-control form-control-user" id="articleContent" placeholder="Contenu"><?= $post->content; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xl-3">
                            <label class="form-control-image-label" for="articleImageMain">Image principale</label>
                            <?php if($post->image_main !== null) { ?>
                                <img class="form-control-image-thumb" src="/public/frontend/images/gallery/<?= $post->image_main; ?>" alt="<?= htmlspecialchars($post->title); ?>" />
                            <?php } ?>
                            <input type="file" class="form-control form-control-image" id="articleImageMain" placeholder="Image principale" value="Image principale">
                        </div>
                        <div class="col-xl-3">
                            <label class="form-control-image-label" for="articleImageMedium">Image moyenne</label>
                            <?php if($post->image_medium !== null) { ?>
                                <img class="form-control-image-thumb" src="/public/frontend/images/gallery/<?= $post->image_medium; ?>" alt="<?= htmlspecialchars($post->title); ?>" />
                            <?php } ?>
                            <input type="file" class="form-control form-control-image" id="articleImageMedium" placeholder="Image moyenne" value="Image moyenne">
                        </div>
                        <div class="col-xl-3">
                            <label class="form-control-image-label" for="articleImageSmall">Image petite</label>
                            <?php if($post->image_small !== null) { ?>
                                <img class="form-control-image-thumb" src="/public/frontend/images/gallery/<?= $post->image_small; ?>" alt="<?= htmlspecialchars($post->title); ?>" />
                            <?php } ?>
                            <input type="file" class="form-control form-control-image" id="articleImageSmall" placeholder="Image petite" value="Image petite">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xl-9">
                            <a href="login.html" class="btn btn-primary btn-user btn-block">Enregistrer les modifications</a>
                        </div>
                    </div>
                </form>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
