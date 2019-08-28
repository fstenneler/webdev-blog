    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding">

        <?php if($this->app()->httpRequest()->getData('categoryId') > 0) { ?>
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="display-1 display-1--with-line-sep">Categorie : <?= $this->app()->getData('categoryName'); ?></h1>
            </div>
        </div>
        <?php } ?>

        <?php if($this->app()->httpRequest()->getData('search') != '') { ?>
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="display-1 display-1--with-line-sep">Recherche : <?= $this->app()->httpRequest()->getData('search'); ?></h1>
            </div>
        </div>
        <?php } ?>
        
        <div class="row entries-wrap add-top-padding wide">
        <div class="entries">
            <a name="posts"></a>
                
            <?php if(count($this->app()->getData('postList')) > 0) { ?>

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

            <?php } else { ?>
                <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="item-entry__title">Aucun article n'a été trouvé</h1>
                </div>
            <?php } ?>

            </div> <!-- end entries -->
        </div> <!-- end entries-wrap -->
        
        <?php if(count($this->app()->getData('postList')) > 0) { ?>
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
        <?php } ?>

    </section> <!-- end s-content -->
