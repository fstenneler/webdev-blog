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

                    <div>
                        <input name="cName" id="cName" class="full-width" placeholder="Your name*" value="Fabien Stenneler" type="text">
                    </div>

                    <div>
                        <input name="cEmail" id="cEmail" class="full-width" placeholder="Your Email*" value="fabien.stenneler@gmail.com" type="email">
                    </div>

                    <div>
                        <input name="cNickname" id="cNickname" class="full-width" placeholder="Choose a Nickname*" value="FabienS" type="email">
                    </div>

                    <div class="form-field">
                        <input name="cPassword" id="cPassword" class="full-width" placeholder="Choose a Password*" value="aaaaaa" type="password">
                    </div>

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

                    <input type="hidden" id="cAvatarColor" name="cAvatarColor" value="">

                    <?php if($this->app()->getData('formError')) { ?>
                        <div class='form-error'>
                            <?= $this->app()->getData('formError'); ?>
                        </div>
                    <?php } ?>

                    <button type="submit" class="submit btn btn--primary btn--large full-width">Valider les modifications</button>

                </fieldset>
            </form>

        </div>
    </div>

</section>