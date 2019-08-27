    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding s-content--narrow">

        <article class="row entry format-standard">

            <div class="entry__media col-full">
                <div class="entry__post-thumb">
                    <img src="<?= $this->esc(GALLERY_DIR . $this->app()->getData('post')->image_main); ?>" alt="<?= $this->esc($this->app()->getData('post')->title); ?>">
                </div>
            </div>

            <div class="entry__header col-full">
                <h1 class="entry__header-title display-1">
                <?= $this->esc($this->app()->getData('post')->title); ?>
                </h1>
                <ul class="entry__header-meta">
                    <li class="date"><?= $this->esc($this->app()->getData('post')->creation_date); ?></li>
                    <li class="byline">par <?= $this->esc($this->app()->getData('post')->user_nickname); ?></li>
                    <?php if($this->app()->getData('post')->last_modification_date !== null && $this->app()->getData('post')->last_modification_date !== $this->app()->getData('post')->creation_date) { ?>
                        <li class="date">modifié le <?= $this->esc($this->app()->getData('post')->last_modification_date); ?></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-full entry__main">
                
                <?= $this->esc($this->app()->getData('post')->content); ?>

                <div class="entry__taxonomies">
                    <div class="entry__cat">
                        <h5>Posted In: </h5>
                        <span class="entry__tax-list">
                            <a href="<?= $this->esc($this->app()->getData('post')->category_url); ?>"><?= $this->esc($this->app()->getData('post')->category_name); ?></a>
                        </span>
                    </div> <!-- end entry__cat -->
                </div> <!-- end s-content__taxonomies -->

                <div class="entry__author">
                    <div class="entry__author-icon"><?= $this->esc($this->app()->getData('post')->avatar_icon); ?></div>

                    <div class="entry__author-about">
                        <h5 class="entry__author-name">
                            <span>Posté par</span>
                            <?= $this->esc($this->app()->getData('post')->user_nickname); ?>
                        </h5>

                        <div class="entry__author-desc">
                            <?= $this->app()->getData('post')->user_description; ?>
                        </div>
                    </div>
                </div>

            </div> <!-- s-entry__main -->

        </article> <!-- end entry/article -->



        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="col-full">

                    <h3 class="h2"><?= $this->esc($this->app()->getData('CommentNumberText')); ?></h3>
                    <a name='#comments'></a>

                    <!-- START commentlist -->
                    <?php 
                    if(count($this->app()->getData('commentList')) > 0) { 
                        $commentList = $this->app()->getData('commentList');
                    ?>

                    <!-- liste des commentaires -->
                    <ol class="commentlist">

                        <?php foreach($commentList[0] as $commentLevel1) { ?>
                            

                            <!-- bloc commentaire level 1 (index 0) -->
                            <li class="thread-alt depth-1 comment">
                                
                                <!-- commentaire -->
                                <div class="comment__avatar">
                                    <?= $this->esc($commentLevel1->user_avatar_icon); ?>
                                </div>

                                <div class="comment__content">

                                    <div class="comment__info">
                                        <div class="comment__author"><?= $this->esc($commentLevel1->user_nickname); ?></div>

                                        <div class="comment__meta">
                                            <div class="comment__time"><?= $this->esc($commentLevel1->date); ?></div>
                                            <?php if(!isset($commentList[$commentLevel1->id])) { ?>
                                            <div class="comment__reply">
                                                <span class="comment-reply-link" data-comment-id="<?= $this->esc($commentLevel1->id); ?>">Répondre</span>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="comment__text">
                                        <?= $this->esc($commentLevel1->content); ?>
                                    </div>

                                    <?php if($commentLevel1->status === 'Attente' && $commentLevel1->user_id === $this->app()->httpRequest()->getSession('user')->id) { ?>
                                        <i class="comment-waiting-validation">Commentaire en attente de validation</i>
                                    <?php } ?>

                                </div>
                                <!-- fin commentaire -->

                                <!-- liste des réponses au commentaire -->
                                <ul class="children">

                                    <?php 
                                    if(isset($commentList[$commentLevel1->id])) {
                                        foreach($commentList[$commentLevel1->id] as $key => $commentLevel2) { 
                                    ?>

                                    <!-- réponse au commentaire -->
                                    <li class="depth-2 comment">

                                        <div class="comment__avatar">
                                            <?= $this->esc($commentLevel2->user_avatar_icon); ?>
                                        </div>

                                        <div class="comment__content">

                                            <div class="comment__info">
                                                <div class="comment__author"><?= $this->esc($commentLevel2->user_nickname); ?></div>

                                                <div class="comment__meta">
                                                    <div class="comment__time"><?= $this->esc($commentLevel2->date); ?></div>
                                                    <?php if(!isset($commentList[$commentLevel1->id][$key + 1])) { ?>
                                                    <div class="comment__reply">
                                                        <span class="comment-reply-link" data-comment-id="<?= $this->esc($commentLevel1->id); ?>">Répondre</span>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="comment__text">
                                                <?= $this->esc($commentLevel2->content); ?>
                                            </div>

                                            <?php if($commentLevel2->status === 'Attente' && $commentLevel2->user_id === $this->app()->httpRequest()->getSession('user')->id) { ?>
                                                <i class="comment-waiting-validation">Commentaire en attente de validation</i>
                                            <?php } ?>

                                        </div>

                                    </li>
                                    <!-- fin réponse -->

                                    <?php 
                                        }                                    
                                    } 
                                    ?>

                                    <!-- formulaire de réponse au commentaire -->
                                    <li class="comment-reply-form" id="comment-reply-form-<?= $this->esc($commentLevel1->id); ?>">
                                        <div class="comment__content">
                                            <div class="comment__info">
                                                <div class="comment__author">Votre réponse :</div>
                                            </div>

                                            <?php if($this->app()->user()->isAuthenticated()) { ?>
                                            <form name="contactForm" method="post" action="#comments" autocomplete="off">
                                                <fieldset>

                                                    <div class="message form-field">
                                                        <textarea name="content" class="full-width" placeholder="Message*" required></textarea>
                                                    </div>
                                                    <input name="parent_comment_id" value="<?= $this->esc($commentLevel1->id); ?>" type="hidden">
                                                    <input name="submit" class="btn btn--primary btn-wide btn--large full-width" value="Répondre" type="submit">

                                                </fieldset>
                                            </form>
                                            <?php } else { ?>
                                                <div class="message-comment-connected-reply">Vous devez être <a href="<?= $this->esc($this->app()->route()->setUrl(array('page' => 'user', 'action' => 'login'))); ?>">connecté</a> pour répondre.</div>
                                            <?php } ?>
                                        </div>
                                    </li>
                                    <!-- fin formulaire de réponse au commentaire -->
                                        
                                </ul>
                                <!-- fin liste des réponses -->

                            </li>
                            <!-- fin bloc commentaire level 1 (index 0) -->

                        <?php } ?>

                    </ol>
                    <!-- fin liste des commentaires -->

                    <?php } ?>

                    <?php if($this->app()->getData('formError')) { ?>
                        <div class='form-error'>
                            <?= $this->esc($this->app()->getData('formError')); ?>
                        </div>
                    <?php } ?>

                </div> <!-- end col-full -->
            </div> <!-- end comments -->
                    


            <div class="row comment-respond">

                <!-- Ajouter un nouveau commentaire -->
                
                <div id="respond" class="col-full">

                    <h3 class="h2">Laisser un commentaire</h3>
                    
                    <?php if($this->app()->user()->isAuthenticated()) { ?>
                    <form name="contactForm" id="contactForm" method="post" action="#comments" autocomplete="off">
                        <fieldset>

                            <div class="message form-field">
                                <textarea name="content" id="cMessage" class="full-width" placeholder="Message*" required></textarea>
                            </div>
                            <input name="parent_comment_id" value="0" type="hidden">
                            <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large full-width" value="Laisser un commentaire" type="submit">

                        </fieldset>
                    </form> <!-- end form -->
                    <?php } else { ?>
                        <div class="message-comment-connected">Vous devez être <a href="<?= $this->esc($this->app()->route()->setUrl(array('page' => 'user', 'action' => 'login'))); ?>">connecté</a> pour laisser un commentaire.</div>
                    <?php } ?>
                </div>
                
                <!-- Fin ajouter un nouveau commentaire-->

            </div> <!-- end comment-respond -->

        </div> <!-- end comments-wrap -->

    </section> <!-- end s-content -->
