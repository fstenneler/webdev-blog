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
                        <li class="date">modifié le <?= $this->app()->getData('post')->last_modification_date; ?></li>
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
                            <span>Posté par</span>
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
                    <ol class="commentlist">

                        <?php foreach($this->app()->getData('commentList')[0] as $commentLevel1) { ?>

                            <li class="thread-alt depth-1 comment">

                                <div class="comment__avatar">
                                    <?= $commentLevel1->user_avatar_icon; ?>
                                </div>

                                <div class="comment__content">

                                    <div class="comment__info">
                                        <div class="comment__author"><?= $commentLevel1->user_nickname; ?></div>

                                        <div class="comment__meta">
                                            <div class="comment__time"><?= $commentLevel1->comment_date; ?></div>
                                            <?php if(!isset($this->app()->getData('commentList')[$commentLevel1->id])) { ?>
                                            <div class="comment__reply">
                                                <span class="comment-reply-link">Reply</span>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="comment__text">
                                        <?= $commentLevel1->content; ?>
                                    </div>

                                </div>

                                <ul class="children">

                                    <?php 
                                    if(isset($this->app()->getData('commentList')[$commentLevel1->id])) {
                                        foreach($this->app()->getData('commentList')[$commentLevel1->id] as $key => $commentLevel2) { 
                                    ?>

                                    <li class="depth-2 comment">

                                        <div class="comment__avatar">
                                            <?= $commentLevel2->user_avatar_icon; ?>
                                        </div>

                                        <div class="comment__content">

                                            <div class="comment__info">
                                                <div class="comment__author"><?= $commentLevel2->user_nickname; ?></div>

                                                <div class="comment__meta">
                                                    <div class="comment__time"><?= $commentLevel2->comment_date; ?></div>
                                                    <?php if(!isset($this->app()->getData('commentList')[$commentLevel1->id][$key + 1])) { ?>
                                                    <div class="comment__reply">
                                                        <span class="comment-reply-link" data-commentId="<?= $commentLevel1->id; ?>">Reply</span>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="comment__text">
                                                <?= $commentLevel2->content; ?>
                                            </div>

                                        </div>

                                    </li>

                                    <?php 
                                        }                                    
                                    } 
                                    ?>

                                    <li class="comment-reply-form" id="comment-reply-form-<?= $commentLevel1->id; ?>">
                                        <div class="comment__content">
                                            <div class="comment__info">
                                                <div class="comment__author">Your Reply :</div>
                                            </div>
                                            <form name="contactForm" id="contactForm" method="post" action="" autocomplete="off">
                                                <fieldset>

                                                    <div class="message form-field">
                                                        <textarea name="cMessage" id="cMessage" class="full-width" placeholder="Message*"></textarea>
                                                    </div>

                                                    <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large full-width" value="Add Comment" type="submit">

                                                </fieldset>
                                            </form> <!-- end form -->
                                        </div>
                                    </li>
                                        
                                </ul>

                            </li> <!-- end comment level 1 -->

                        <?php } ?>

                    </ol>
                    <!-- END commentlist -->           

                </div> <!-- end col-full -->
            </div> <!-- end comments -->

            <div class="row comment-respond">

                <!-- START respond -->
                <div id="respond" class="col-full">

                    <h3 class="h2">Add Comment</h3>

                    <form name="contactForm" id="contactForm" method="post" action="" autocomplete="off">
                        <fieldset>

                            <div class="message form-field">
                                <textarea name="cMessage" id="cMessage" class="full-width" placeholder="Your Message*"></textarea>
                            </div>

                            <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large full-width" value="Add Comment" type="submit">

                        </fieldset>
                    </form> <!-- end form -->

                </div>
                <!-- END respond-->

            </div> <!-- end comment-respond -->

        </div> <!-- end comments-wrap -->

    </section> <!-- end s-content -->
