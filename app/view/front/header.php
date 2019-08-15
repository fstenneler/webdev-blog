    <header class="s-header header">

        <div class="header__logo">
            <a class="logo" href="/">
                <img src="public/front/images/logo.svg" alt="Homepage">
            </a>
        </div> <!-- end header__logo -->

        <a class="header__search-trigger" href="#0"></a>
        <div class="header__search">

            <form role="search" method="get" class="header__search-form" action="#">
                <label>
                    <span class="hide-content">Rechercher :</span>
                    <input type="search" class="search-field" placeholder="Tapez le texte à rechercher" value="" name="s" title="Search for:" autocomplete="off">
                </label>
                <input type="submit" class="search-submit" value="Search">
            </form>

            <a href="#0" title="Close Search" class="header__overlay-close">Fermer</a>

        </div>  <!-- end header__search -->
        
        <!-- custom login modal -->
            <?php if($this->app()->user()->isAuthenticated()) { ?>
                <div class="header__sign-in-trigger header__sign-in-trigger-avatar"><?= $this->app()->getData('avatarIcon'); ?></div>
                <ul id="header__connection_modal">
                    <li class="nickname" style="background-color: <?= $this->app()->httpRequest()->getSession('user')->avatar; ?>;"><?= $this->app()->getData('user')->nickname; ?></li>
                    <li><a href="<?= $this->app()->route()->setUrl(array('page' => 'user', 'action' => 'account')); ?>">Mon compte</a></li>
                    <li><a href="<?= $this->app()->route()->setUrl(array('page' => 'user', 'action' => 'logout')); ?>">Se déconnecter</a></li>
                </ul>
            <?php } else { ?>
                <i class="header__sign-in-trigger header__sign-in-trigger-normal fas fa-sign-in-alt"></i>
                <ul id="header__connection_modal">
                    <li class="normal"><a href="<?= $this->app()->route()->setUrl(array('page' => 'user', 'action' => 'login')); ?>">Se connecter</a></li>
                    <li><a href="<?= $this->app()->route()->setUrl(array('page' => 'user', 'action' => 'signup')); ?>">S'inscrire</a></li>
                </ul>
           <?php } ?>
         <!-- end custom login modal -->

        <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>
        <nav class="header__nav-wrap">

            <h2 class="header__nav-heading h6">Navigate to</h2>

            <ul class="header__nav">
                <li class="current"><a href="<?= $this->app()->route()->setUrl(array('page' => 'home')); ?>" title="">Accueil</a></li>
                <li class="has-children">
                    <a href="#0" title="">Categories</a>
                    <ul class="sub-menu">
                        <?php foreach($this->app()->getData('categoryList') as $category) { ?>
                        <li><a href="<?= htmlspecialchars($category->url); ?>"><?= $category->name; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a href="<?= $this->app()->route()->setUrl(array('page' => 'about')); ?>" title="">&Agrave; propos</a></li>
                <li><a href="<?= $this->app()->route()->setUrl(array('page' => 'contact')); ?>" title="">Contact</a></li>
                <li><a href="<?= $this->app()->route()->setUrl(array('page' => 'cv')); ?>" title="">MON CV</a></li>
            </ul> <!-- end header__nav -->

            <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

        </nav> <!-- end header__nav-wrap -->

    </header> <!-- s-header -->
