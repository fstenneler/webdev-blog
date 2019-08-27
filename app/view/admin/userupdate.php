        <?php $user = $this->app()->getData('userList'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Modification d'un utilisateur</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Utilisateur : [<?= esc($user->id); ?>] <?= esc($user->nickname); ?></h6>
            </div>
            <div class="card-body">

                <?php $form = $this->app()->getData('form'); ?>

                <form class="user" method="post" action="">
                  <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="userRole">Rôle</label>
                            <select name="role" class="form-control form-control-user" id="userRole" placeholder="Rôle">
                                <option></option>
                                <option value="Administrateur"<?php if($form->formBuilder()->getField('role')->getValue() === 'Administrateur') { echo " selected"; } ?>>Administrateur</option>
                                <option value="Visiteur"<?php if($form->formBuilder()->getField('role')->getValue() === 'Visiteur') { echo " selected"; } ?>>Visiteur</option>
                            </select>
                            <?php if($form->formBuilder()->getField('role')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= esc($form->formBuilder()->getField('role')->getError()); ?></div>
                            <?php } ?>
                        </div>
                   </div>
                   <div class="form-group row">
                        <div class="col-sm-12 col-lg-4">
                            <label for="userNickname">Pseudo</label>
                            <input name="nickname" type="text" class="form-control form-control-user" id="userNickname" placeholder="Pseudo" value="<?= esc($form->formBuilder()->getField('nickname')->getValue()); ?>">
                            <?php if($form->formBuilder()->getField('nickname')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= esc($form->formBuilder()->getField('nickname')->getError()); ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <label for="userNickname">E-mail</label>
                            <input name="email" type="text" class="form-control form-control-user" id="userNickname" placeholder="E-mail" value="<?= esc($form->formBuilder()->getField('email')->getValue()); ?>">
                            <?php if($form->formBuilder()->getField('email')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= esc($form->formBuilder()->getField('email')->getError()); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-4">
                            <label for="userFirstname">Prénom</label>
                            <input name="first_name" type="text" class="form-control form-control-user" id="userFirstname" placeholder="Prénom" value="<?= htmlspecialchars($form->formBuilder()->getField('first_name')->getValue()); ?>">
                            <?php if($form->formBuilder()->getField('first_name')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('first_name')->getError(); ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <label for="userName">Nom</label>
                            <input name="name" type="text" class="form-control form-control-user" id="userName" placeholder="Nom" value="<?= htmlspecialchars($form->formBuilder()->getField('name')->getValue()); ?>">
                            <?php if($form->formBuilder()->getField('name')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= $form->formBuilder()->getField('name')->getError(); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-9">
                            <label for="userDescription">Description</label>
                            <textarea name="description" class="form-control form-control-user" id="userDescription" placeholder="Description" style="height: 15em;"><?= $form->formBuilder()->getField('description')->getValue(); ?></textarea>
                            <?php if($form->formBuilder()->getField('description')->getError() !== null && $form->isSubmited()) { ?>
                                <div class="form-control-error"><?= esc($form->formBuilder()->getField('description')->getError()); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-9">
                            <input name='submit' type="submit" class="btn btn-primary btn-user btn-block" value="Enregistrer les modifications">
                        </div>
                    </div>
                </form>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        
