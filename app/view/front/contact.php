<section class="s-content s-content--top-padding s-content--narrow">

<div class="row narrow">
    <div class="col-full s-content__header">
        <h1 class="display-1 display-1--with-line-sep">Me contacter</h1>
        <p class="lead">
        Pour toute question concernant le blog, un des articles, un projet web à réaliser, vous pouvez m'envoyer un message en utilisant le formulaire ci-dessous. </p>
    </div>
</div>

<div class="row">
    <div class="col-full s-content__main">
        <p>
        <img src="public/front/images/thumbs/contact/contact-1000.jpg" 
             srcset="public/front/images/thumbs/contact/contact-2000.jpg 2000w, 
             public/front/images/thumbs/contact/contact-1000.jpg 1000w, 
             public/front/images/thumbs/contact/contact-500.jpg 500w" 
             sizes="(max-width: 2000px) 100vw, 2000px" alt="">
        </p>

        <h2>Formulaire de contact</h2>

        <p>
        Veuillez renseigner vos coordonnées ainsi que votre message, je vous apporterai une réponse sous 48h.
        </p>


        <a name="form"></a>
        <h4>Envoyer un nouveau message</h4>

        <?php $form = $this->app()->getData('form'); ?>

        <?php if($form->getSuccess()) { ?>
                    <div class='form-success'>
                        Le message a bien été envoyé
                    </div>
                <?php 
                    $form->setSuccess(false);
                } ?>

        <form name="cForm" id="cForm" class="contact-form" method="post" action="#form">
            <fieldset>

                <div>
                    <input name="name" id="cName" class="full-width" placeholder="Votre nom*" value="<?= htmlspecialchars($form->formBuilder()->getField('name')->getValue()); ?>" type="text">
                    <?php if($form->formBuilder()->getField('name')->getError() !== null && $form->isSubmited()) { ?>
                        <div class="error"><?= $form->formBuilder()->getField('name')->getError(); ?></div>
                    <?php } ?>
                </div>

                <div class="form-field">
                    <input name="email" id="cEmail" class="full-width" placeholder="Votre adresse e-mail*" value="<?= htmlspecialchars($form->formBuilder()->getField('email')->getValue()); ?>" type="email">
                    <?php if($form->formBuilder()->getField('email')->getError() !== null && $form->isSubmited()) { ?>
                        <div class="error"><?= $form->formBuilder()->getField('email')->getError(); ?></div>
                    <?php } ?>
                </div>

                <div class="form-field">
                    <input name="subject" id="cEmail" class="full-width" placeholder="Objet*" value="<?= htmlspecialchars($form->formBuilder()->getField('subject')->getValue()); ?>" type="text">
                    <?php if($form->formBuilder()->getField('subject')->getError() !== null && $form->isSubmited()) { ?>
                        <div class="error"><?= $form->formBuilder()->getField('subject')->getError(); ?></div>
                    <?php } ?>
                </div>

                <div class="message form-field">
                    <textarea name="message" id="cMessage" class="full-width" placeholder="Votre message*"><?= $form->formBuilder()->getField('message')->getValue(); ?></textarea>
                    <?php if($form->formBuilder()->getField('message')->getError() !== null && $form->isSubmited()) { ?>
                        <div class="error"><?= $form->formBuilder()->getField('message')->getError(); ?></div>
                    <?php } ?>
                </div>

                <div class="message form-field form-privacy-consent">
                    <input type="checkbox" id="checkbox-privacy-consent"><span class="privacy-consent">En soumettant ce formulaire, j'accepte que les informations saisies soient enregistrées et utilisées dans le cadre de la relation qui découle de cette demande.</span>
                    <?php if($form->formBuilder()->getField('privacy_consent_date')->getError() !== null && $form->isSubmited()) { ?>
                        <div class="error"><?= $form->formBuilder()->getField('privacy_consent_date')->getError(); ?></div>
                    <?php } ?>
                </div>

                <input type="hidden" id="privacy_consent_date" name="privacy_consent_date" value="">
                <input type="submit" name="submit" class="submit btn btn--primary btn--large full-width" value="Envoyer le message">

            </fieldset>
        </form>

    </div> <!-- s-content__main -->
</div> <!-- end row -->

</section> <!-- end s-content -->
