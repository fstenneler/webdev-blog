            <form name="cForm" id="cForm" method="post" action="">
                <fieldset>

                    <div>
                        <input name="cEmail" id="cEmail" placeholder="Your Email*" value="<?= $this->app()->getData('email'); ?>" type="email">
                    </div>

                    <div>
                        <input name="cPassword" id="cPassword" placeholder="Your Password*" value="" type="password">
                    </div>

                    <div>
                        <?= $this->app()->getData('formError'); ?>
                    </div>

                    <button type="submit">Se connecter</button>

                </fieldset>
            </form>
