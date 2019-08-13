<section class="s-content s-content--top-padding s-content--narrow">

    <div class="row narrow">
        <div class="col-full s-content__header">
            <h1 class="display-1 display-1--with-line-sep">Modifier mon compte</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-full s-content__main">

            <form name="cForm" id="cForm" class="contact-form" method="post" action="">
                <fieldset>

                    <?= $this->app()->getData('form')->generateHtmlField($this->app()->getData('form')->formBuilder()->getField('first_name')); ?>
                    <?= $this->app()->getData('form')->generateHtmlField($this->app()->getData('form')->formBuilder()->getField('name')); ?>
                    <?= $this->app()->getData('form')->generateHtmlField($this->app()->getData('form')->formBuilder()->getField('email')); ?>
                    <?= $this->app()->getData('form')->generateHtmlField($this->app()->getData('form')->formBuilder()->getField('nickname')); ?>
                    <?= $this->app()->getData('form')->generateHtmlField($this->app()->getData('form')->formBuilder()->getField('password')); ?>

                    <div class="form-color-picker-title">Choissez une couleur pour votre avatar*</div>

                    <ul class="form-color-picker">
                        <li data-color="#A93226" style="background-color: #A93226;"></li>
                        <li data-color="#CB4335" style="background-color: #CB4335;"></li>
                        <li data-color="#884EA0" style="background-color: #884EA0;"></li>
                        <li data-color="#7D3C98" style="background-color: #7D3C98;"></li>
                        <li data-color="#2471A3" style="background-color: #2471A3;"></li>
                        <li data-color="#2E86C1" style="background-color: #2E86C1;"></li>
                        <li data-color="#17A589" style="background-color: #17A589;"></li>
                        <li data-color="#138D75" style="background-color: #138D75;"></li>
                        <li data-color="#229954" style="background-color: #229954;"></li>
                        <li data-color="#28B463" style="background-color: #28B463;"></li>
                        <li data-color="#D4AC0D" style="background-color: #D4AC0D;"></li>
                        <li data-color="#D68910" style="background-color: #D68910;"></li>
                        <li data-color="#CA6F1E" style="background-color: #CA6F1E;"></li>
                        <li data-color="#BA4A00" style="background-color: #BA4A00;"></li>
                        <li data-color="#D0D3D4" style="background-color: #D0D3D4;"></li>
                        <li data-color="#A6ACAF" style="background-color: #A6ACAF;"></li>
                        <li data-color="#839192" style="background-color: #839192;"></li>
                        <li data-color="#707B7C" style="background-color: #707B7C;"></li>
                        <li data-color="#2E4053" style="background-color: #2E4053;"></li>
                        <li data-color="#273746" style="background-color: #273746;"></li>
                    </ul>

                    <input type="hidden" id="cAvatarColor" name="avatar" value="<?= $this->app()->getData('form')->formBuilder()->getField('avatar')->getValue(); ?>">

                    <?php if($this->app()->getData('form')->formBuilder()->getField('avatar')->getError() !== null && $this->app()->getData('form')->isSubmited()) { ?>
                        <div class="error"><?= $this->app()->getData('form')->formBuilder()->getField('avatar')->getError(); ?></div>
                    <?php } ?>

                    <input type="hidden" name="page" value="user">
                    <input type="hidden" name="action" value="account">
                    

                    <?php if($this->app()->getData('formError')) { ?>
                        <div class='form-error'>
                            <?= $this->app()->getData('formError'); ?>
                        </div>
                    <?php } ?>

                    <?php if($this->app()->getData('form')->getSuccess()) { ?>
                        <div class='form-success'>
                            Les modifications ont bien été enregistrées
                        </div>
                    <?php 
                        $this->app()->getData('form')->setSuccess(false);
                    } ?>
                    

                    <button type="submit" class="submit btn btn--primary btn--large full-width" name="submit">Valider les modifications</button>

                </fieldset>
            </form>

        </div>
    </div>

</section>
