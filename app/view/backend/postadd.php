        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Créer un article</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">

                <form class="user">
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="articleCategory">Catégorie</label>
                            <select class="form-control form-control-user" id="articleCategory" placeholder="Catégorie">
                                <option value=""></option>
                                <option value="">Actualités</option>
                                <option value="">Tips</option>
                                <option value="">Tests</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="articleUser">Auteur</label>
                            <select class="form-control form-control-user" id="articleUser" placeholder="Auteur">
                                <option value=""></option>
                                <option value="">FabienS</option>
                                <option value="">JohnDoe</option>
                                <option value="">Seriousman</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label for="articleHero">Article à la une</label>
                            <select class="form-control form-control-user" id="articleHero" placeholder="Article à la une">
                                <option value=""></option>
                                <option value="">Oui</option>
                                <option value="">Non</option>
                            </select>
                        </div>
                    </div>
                   <div class="form-group row">
                        <div class="col-sm-12 col-lg-9">
                            <label for="articleTitle">Titre</label>
                            <input type="text" class="form-control form-control-user" id="articleTitle" placeholder="Titre" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-9">
                            <label for="articleHeader">Chapô</label>
                            <input type="text" class="form-control form-control-user" id="articleHeader" placeholder="Chapô" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-9">
                            <label for="articleContent">Contenu</label>
                            <textarea id="post-content" class="form-control form-control-user" id="articleContent" placeholder="Contenu"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="articleImageMain">Image principale</label>
                            <input type="file" class="form-control form-control-image" id="articleImageMain" placeholder="Image principale" value="Image principale">
                        </div>
                        <div class="col-lg-3">
                            <label for="articleImageMedium">Image moyenne</label>
                            <input type="file" class="form-control form-control-image" id="articleImageMedium" placeholder="Image moyenne" value="Image moyenne">
                        </div>
                        <div class="col-lg-3">
                            <label for="articleImageSmall">Image petite</label>
                            <input type="file" class="form-control form-control-image" id="articleImageSmall" placeholder="Image petite" value="Image petite">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-9">
                            <a href="login.html" class="btn btn-primary btn-user btn-block">Créer et publier l'article</a>
                        </div>
                    </div>
                </form>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
