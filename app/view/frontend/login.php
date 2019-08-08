<section class="s-content s-content--top-padding s-content--narrow">

    <div class="row narrow">
        <div class="col-full s-content__header">
            <h1 class="display-1 display-1--with-line-sep">Identification</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-full s-content__main">

            <form name="cForm" id="cForm" class="contact-form" method="post" action="">
                <fieldset>

                    <div>
                        <input name="cEmail" id="cEmail" class="full-width" placeholder="Your Email*" value="<?= htmlspecialchars($this->app()->getData('email')); ?>" type="email">
                    </div>

                    <div class="form-field">
                        <input name="cPassword" id="cPassword" class="full-width" placeholder="Your Password*" value="" type="password">
                    </div>

                    <div class='form-error'>
                        <?= $this->app()->getData('formError'); ?>
                    </div>

                    <button type="submit" class="submit btn btn--primary btn--large full-width">Se connecter</button>

                </fieldset>
            </form>

            <div class='existing-account'>Pas encore inscrit ? <a href="/index.php?page=signup">Cliquez ici</a> pour créer un nouveau compte</div>

        </div>
    </div>

</section>
