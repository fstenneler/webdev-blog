    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding s-content--narrow">

        <article class="row entry format-standard">

            <div class="entry__media col-full">
                <div class="entry__post-thumb">
                    <img src="public/frontend/images/gallery/<?= htmlspecialchars($this->app()->getData('post')->image_main); ?>" alt="<?= htmlspecialchars($this->app()->getData('post')->title); ?>">
                </div>
            </div>

            <div class="entry__header col-full">
                <h1 class="entry__header-title display-1">
                <?= $this->app()->getData('post')->title; ?>
                </h1>
                <ul class="entry__header-meta">
                    <li class="date"><?= $this->app()->getData('post')->creation_date; ?></li>
                    <li class="byline">par <?= $this->app()->getData('post')->user_nickname; ?></li>
                    <?php if($this->app()->getData('post')->last_modification_date !== null) { ?>
                        <li class="date">modifiÃ© le <?= $this->app()->getData('post')->last_modification_date; ?></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-full entry__main">
                
                <?= $this->app()->getData('post')->content; ?>

                <div class="entry__taxonomies">
                    <div class="entry__cat">
                        <h5>Posted In: </h5>
                        <span class="entry__tax-list">
                            <a href="<?= $this->app()->getData('post')->category_url; ?>"><?= $this->app()->getData('post')->category_name; ?></a>
                        </span>
                    </div> <!-- end entry__cat -->
                </div> <!-- end s-content__taxonomies -->

                <div class="entry__author">
                    <div class="entry__author-icon"><?= $this->app()->getData('post')->avatar_icon; ?></div>

                    <div class="entry__author-about">
                        <h5 class="entry__author-name">
                            <span>PostÃ© par</span>
                            <?= $this->app()->getData('post')->user_nickname; ?>
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

                    <h3 class="h2"><?= $this->app()->getData('CommentNumberText'); ?></h3>

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
                                    <?= $commentLevel1->user_avatar_icon; ?>
                                </div>

                                <div class="comment__content">

                                    <div class="comment__info">
                                        <div class="comment__author"><?= $commentLevel1->user_nickname; ?></div>

                                        <div class="comment__meta">
                                            <div class="comment__time"><?= $commentLevel1->comment_date; ?></div>
                                            <?php if(!isset($commentList[$commentLevel1->id])) { ?>
                                            <div class="comment__reply">
                                                <span class="comment-reply-link" data-comment-id="<?= $commentLevel1->id; ?>">Répondre</span>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="comment__text">
                                        <?= $commentLevel1->content; ?>
                                    </div>

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
                                            <?= $commentLevel2->user_avatar_icon; ?>
                                        </div>

                                        <div class="comment__content">

                                            <div class="comment__info">
                                                <div class="comment__author"><?= $commentLevel2->user_nickname; ?></div>

                                                <div class="comment__meta">
                                                    <div class="comment__time"><?= $commentLevel2->comment_date; ?></div>
                                                    <?php if(!isset($commentList[$commentLevel1->id][$key + 1])) { ?>
                                                    <div class="comment__reply">
                                                        <span class="comment-reply-link" data-comment-id="<?= $commentLevel1->id; ?>">Répondre</span>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="comment__text">
                                                <?= $commentLevel2->content; ?>
                                            </div>

                                        </div>

                                    </li>
                                    <!-- fin réponse -->

                                    <?php 
                                        }                                    
                                    } 
                                    ?>

                                    <!-- formulaire de réponse au commentaire -->
                                    <li class="comment-reply-form" id="comment-reply-form-<?= $commentLevel1->id; ?>">
                                        <div class="comment__content">
                                            <div class="comment__info">
                                                <div class="comment__author">Votre réponse :</div>
                                            </div>

                                            <?php if($this->app()->user()->isAuthenticated()) { ?>
                                            <form name="contactForm" method="post" action="" autocomplete="off">
                                                <fieldset>

                                                    <div class="message form-field">
                                                        <textarea name="cMessage" class="full-width" placeholder="Message*"></textarea>
                                                    </div>

                                                    <input name="submit" class="btn btn--primary btn-wide btn--large full-width" value="Répondre" type="submit">

                                                </fieldset>
                                            </form>
                                            <?php } else { ?>
                                                <div class="message-comment-connected-reply">Vous devez être <a href="/index.php?page=login">connecté</a> pour répondre.</div>
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

                </div> <!-- end col-full -->
            </div> <!-- end comments -->

            <div class="row comment-respond">

                <!-- Ajouter un nouveau commentaire -->
                
                <div id="respond" class="col-full">

                    <h3 class="h2">Laisser un commentaire</h3>
                    
                    <?php if($this->app()->user()->isAuthenticated()) { ?>
                    <form name="contactForm" id="contactForm" method="post" action="" autocomplete="off">
                        <fieldset>

                            <div class="message form-field">
                                <textarea name="cMessage" id="cMessage" class="full-width" placeholder="Message*"></textarea>
                            </div>

                            <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large full-width" value="Laisser un commentaire" type="submit">

                        </fieldset>
                    </form> <!-- end form -->
                    <?php } else { ?>
                        <div class="message-comment-connected">Vous devez être <a href="/index.php?page=login">connecté</a> pour laisser un commentaire.</div>
                    <?php } ?>
                </div>
                
                <!-- Fin ajouter un nouveau commentaire-->

            </div> <!-- end comment-respond -->

        </div> <!-- end comments-wrap -->

    </section> <!-- end s-content -->
