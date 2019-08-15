        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Créer un article</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">

            <?php $form = $this->app()->getData('form'); ?>

            <form class="user" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?= MAX_FILE_SIZE; ?>" />
                    <div class="form-group row">
                        <div class="col-xl-4">
                            <label for="articleCategory">Catégorie</label>
                            <select name='category_id' class="form-control form-control-user" id="articleCategory" placeholder="Catégorie">
                                <option value=""></option>
                                <?php foreach($this->app()->getData('categoryList') as $category) { ?>
                                <option value="<?= $category->id; ?>"<?php if($form->formBuilder()->getField('category_id')->getValue() == $category->id) { echo " selected"; } ?>><?= $category->name; ?></option>
                                <?php } ?>
                            </select>
                            <?php if($form->formBuilder()->getField('category_id')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('category_id')->getError(); ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-xl-3">
                            <label for="articleUser">Auteur</label>
                            <select name='user_id' class="form-control form-control-user" id="articleUser" placeholder="Auteur">
                                <option value=""></option>
                                <?php foreach($this->app()->getData('userList') as $user) { ?>
                                <option value="<?= $user->id; ?>"<?php if( $form->formBuilder()->getField('user_id')->getValue() == $user->id) { echo " selected"; } ?>><?= $user->nickname; ?></option>
                                <?php } ?>
                            </select>
                            <?php if($form->formBuilder()->getField('user_id')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('user_id')->getError(); ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-xl-2">
                            <label for="articleHero">Article à la une</label>
                            <select name='is_hero' class="form-control form-control-user" id="articleHero" placeholder="Article à la une">
                                <option value="0"<?php if( $form->formBuilder()->getField('is_hero')->getValue() == 0) { echo " selected"; } ?>>Non</option>
                                <option value="1"<?php if( $form->formBuilder()->getField('is_hero')->getValue() == 1) { echo " selected"; } ?>>Oui</option>
                            </select>
                        </div>
                    </div>
                   <div class="form-group row">
                        <div class="col-sm-12 col-xl-9">
                            <label for="articleTitle">Titre</label>
                            <input name='title' type="text" class="form-control form-control-user" id="articleTitle" placeholder="Titre" value="<?= htmlspecialchars($form->formBuilder()->getField('title')->getValue()); ?>">
                            <?php if($form->formBuilder()->getField('title')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('title')->getError(); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xl-9">
                            <label for="articleHeader">Chapô</label>
                            <input name='header' type="text" class="form-control form-control-user" id="articleHeader" placeholder="Chapô" value="<?= htmlspecialchars($form->formBuilder()->getField('header')->getValue()); ?>">
                            <?php if($form->formBuilder()->getField('header')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('header')->getError(); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xl-9">
                            <label for="articleContent">Contenu</label>
                            <textarea name='content' id="post-content" class="form-control form-control-user" id="articleContent" placeholder="Contenu"><?= $form->formBuilder()->getField('content')->getValue(); ?></textarea>
                            <?php if($form->formBuilder()->getField('content')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('content')->getError(); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xl-3">
                            <label class="form-control-image-label" for="articleImageMain">Image principale</label>
                            <?php if($form->formBuilder()->getField('image_main')->getValue() !== '') { ?>
                                <img class="form-control-image-thumb" src="<?= htmlspecialchars(GALLERY_DIR . $form->formBuilder()->getField('image_main')->getValue()); ?>" alt="<?= htmlspecialchars($form->formBuilder()->getField('title')->getValue()); ?>" />
                            <?php } ?>
                            <input name='image_main' type="file" class="form-control form-control-image" id="articleImageMain" placeholder="Image principale" value="Image principale">
                            <?php if($form->formBuilder()->getField('image_main')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('image_main')->getError(); ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-xl-3">
                            <label class="form-control-image-label" for="articleImageMedium">Image moyenne</label>
                            <?php if($form->formBuilder()->getField('image_medium')->getValue() !== '') { ?>
                                <img class="form-control-image-thumb" src="<?= htmlspecialchars(GALLERY_DIR . $form->formBuilder()->getField('image_medium')->getValue()); ?>" alt="<?= htmlspecialchars($form->formBuilder()->getField('title')->getValue()); ?>" />
                            <?php } ?>
                            <input name='image_medium' type="file" class="form-control form-control-image" id="articleImageMedium" placeholder="Image moyenne" value="Image moyenne">
                            <?php if($form->formBuilder()->getField('image_medium')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('image_medium')->getError(); ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-xl-3">
                            <label class="form-control-image-label" for="articleImageSmall">Image petite</label>
                            <?php if($form->formBuilder()->getField('image_small')->getValue() !== '') { ?>
                                <img class="form-control-image-thumb" src="<?= htmlspecialchars(GALLERY_DIR . $form->formBuilder()->getField('image_small')->getValue()); ?>" alt="<?= htmlspecialchars($form->formBuilder()->getField('title')->getValue()); ?>" />
                            <?php } ?>
                            <input name='image_small' type="file" class="form-control form-control-image" id="articleImageSmall" placeholder="Image petite" value="Image petite">
                            <?php if($form->formBuilder()->getField('image_small')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('image_small')->getError(); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xl-9">
                            <input name='submit' type="submit" class="btn btn-primary btn-user btn-block" value="Enregistrer les modifications">
                        </div>
                    </div>
                </form>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
