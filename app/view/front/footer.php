    <!-- s-extra
    ================================================== -->
    <section class="s-extra">

        <div class="row">

            <div class="col-seven md-six tab-full popular">
                <h3>Articles récents</h3>

                <div class="block-1-2 block-m-full popular__posts">

                    <?php foreach($this->app()->getData('popularPostList') as $post) { ?>
                    <article class="col-block popular__post">
                        <a href="<?= esc($post->url); ?>" class="popular__thumb">
                            <img src="<?= GALLERY_DIR . $post->image_small; ?>" alt="<?= esc($post->title); ?>">
                        </a>
                        <h5><?= esc($post->title); ?></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>Par</span> <?= esc($post->user_nickname); ?></span>
                            <span class="popular__date"><span>le</span> <?= esc($post->creation_date); ?></span>
                        </section>
                    </article>
                    <?php } ?>

                </div> <!-- end popular_posts -->
            </div> <!-- end popular -->

            <div class="col-four md-six tab-full end">
                <div class="row">
                    <div class="col-six md-six mob-full categories">
                        <h3>Categories</h3>
        
                        <ul class="linklist">
                            <?php foreach($this->app()->getData('categoryList') as $category) { ?>
                            <li><a href="<?= esc($category->url); ?>"><?= esc($category->name); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div> <!-- end categories -->
        
                    <div class="col-six md-six mob-full sitelinks">
                        <h3>Plan du site</h3>
        
                        <ul class="linklist">
                            <li><a href="<?= esc($this->app()->route()->setUrl(array('page' => 'home'))); ?>">Accueil</a></li>
                            <li><a href="<?= esc($this->app()->route()->setUrl(array('page' => 'about'))); ?>">Qui suis-je</a></li>
                            <li><a href="<?= esc($this->app()->route()->setUrl(array('page' => 'contact'))); ?>">Contact</a></li>
                            <li><a href="<?= esc($this->app()->route()->setUrl(array('page' => 'privacy'))); ?>">Protection des données</a></li>
                            <li><a href="<?= esc($this->app()->route()->setUrl(array('zone' => 'admin'))); ?>">Admin</a></li>
                        </ul>
                        <ul class="footer-social">
                            <li>
                                <a href="https://www.facebook.com/fabien.stenneler" target="_blank"><i class="fab fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/fabien-stenneler-755a7914/" target="_blank"><i class="fab fa-linkedin"></i></a>
                            </li>
                        </ul>

                    </div> <!-- end sitelinks -->
                </div>
            </div>
        </div> <!-- end row -->

    </section> <!-- end s-extra -->


    <!-- s-footer
    ================================================== -->
    <footer class="s-footer">

        <div class="s-footer__main">
            <div class="row">
                
                <div class="col-12 tab-full s-footer__about">
                        
                    <h4>À propos de ce site</h4>

                    <p>Fugiat quas eveniet voluptatem natus. Placeat error temporibus magnam sunt optio aliquam. Ut ut occaecati placeat at. 
                    Fuga fugit ea autem. Dignissimos voluptate repellat occaecati minima dignissimos mollitia consequatur.
                    Sit vel delectus amet officiis repudiandae est voluptatem. Tempora maxime provident nisi et fuga et enim exercitationem ipsam. Culpa error 
                    temporibus magnam est voluptatem.</p>

                </div> <!-- end s-footer__about -->

            </div>
        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">

                <div class="col-six">
                </div>

                <div class="col-six">
                    <div class="s-footer__copyright">
                        <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</span>
                    </div>
                </div>
                
            </div>
        </div> <!-- end s-footer__bottom -->

        <div class="go-top">
            <a class="smoothscroll" title="Back to Top" href="#top"></a>
        </div>

    </footer> <!-- end s-footer -->
