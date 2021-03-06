    <!-- featured 
    ================================================== -->
    <section class="s-featured">
        <div class="row">
            <div class="col-full">

                <div class="featured-slider featured" data-aos="zoom-in">

                    <?php foreach($this->app()->getData('heroPostList') as $post) { ?>

                    <div class="featured__slide">
                        <div class="entry">

                            <div class="entry__background" style="background-image:url('<?= htmlspecialchars(GALLERY_DIR . $post->image_main); ?>');"></div>
                            
                            <div class="entry__content">
                                <span class="entry__category"><a href="<?= htmlspecialchars($post->category_url); ?>"><?= $post->category_name; ?></a></span>

                                <h1><a href="<?= htmlspecialchars($post->url); ?>" title="<?= htmlspecialchars($post->title); ?>"><?= $post->title; ?></a></h1>

                                <div class="entry__info">
                                    <span class="entry__profile-pic">
                                        <?= $post->avatar_icon; ?>
                                    </span>
                                    <ul class="entry__meta">
                                        <li><?= $post->user_nickname; ?></li>
                                        <li><?= $post->creation_date; ?></li>
                                    </ul>
                                </div>
                            </div> <!-- end entry__content -->
                            
                        </div> <!-- end entry -->
                    </div> <!-- end featured__slide -->

                    <?php } ?>                    

                </div> <!-- end featured -->

            </div> <!-- end col-full -->
        </div>
    </section> <!-- end s-featured -->


    <!-- s-content
    ================================================== -->
    <section class="s-content">
        
        <div class="row entries-wrap wide">
            <div class="entries">
                <a name="posts"></a>
                
                <?php foreach($this->app()->getData('postList') as $post) { ?>
                <article class="col-block">
                    
                    <div class="item-entry" data-aos="zoom-in">
                        <div class="item-entry__thumb">
                            <a href="<?= htmlspecialchars($post->url); ?>" class="item-entry__thumb-link">
                                <img src="<?= htmlspecialchars(GALLERY_DIR . $post->image_medium); ?>" alt="">
                            </a>
                        </div>
        
                        <div class="item-entry__text">    
                            <div class="item-entry__cat">
                                <a href="<?= htmlspecialchars($post->category_url); ?>"><?= $post->category_name; ?></a> 
                            </div>
    
                            <h1 class="item-entry__title"><a href="<?= htmlspecialchars($post->url); ?>"><?= $post->title; ?></a></h1>
                                
                            <div class="item-entry__date">
                                <a href="<?= htmlspecialchars($post->url); ?>"><?= $post->creation_date; ?></a>
                            </div>
                        </div>
                    </div> <!-- item-entry -->

                </article> <!-- end article -->
                <?php } ?>

            </div> <!-- end entries -->
        </div> <!-- end entries-wrap -->

        <div class="row pagination-wrap">
            <div class="col-full">
                <nav class="pgn" data-aos="fade-up">
                    <?php $pagination = $this->app()->getData('pagination'); ?>
                    <ul>
                        <li><a class="pgn__prev" href="<?= $pagination['previousPageUrl']; ?>">Prev</a></li>

                        <?php foreach($pagination['pageList'] as $page => $url) { ?>
                        <li><a class="pgn__num <?php if($page == $pagination['currentPage']) { ?>current<?php } ?>" href="<?= $url; ?>"><?= $page; ?></a></li>
                        <?php } ?>

                        <li><a class="pgn__next" href="<?= $pagination['nextPageUrl']; ?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </section> <!-- end s-content -->
