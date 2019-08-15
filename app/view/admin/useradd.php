        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Ajout d'un utilisateur</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">

                <form class="user">
                  <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="userRole">Rôle</label>
                            <select class="form-control form-control-user" id="userRole" placeholder="Rôle">
                                <option value=""></option>
                                <option value="">Administrateur</option>
                                <option value="">Visiteur</option>
                            </select>
                        </div>
                   </div>
                   <div class="form-group row">
                        <div class="col-sm-12 col-lg-4">
                            <label for="userNickname">Pseudo</label>
                            <input type="text" class="form-control form-control-user" id="userNickname" placeholder="Pseudo" value="">
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <label for="userNickname">E-mail</label>
                            <input type="text" class="form-control form-control-user" id="userNickname" placeholder="E-mail" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-4">
                            <label for="userFirstname">Prénom</label>
                            <input type="text" class="form-control form-control-user" id="userFirstname" placeholder="Prénom" value="">
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <label for="userName">Nom</label>
                            <input type="text" class="form-control form-control-user" id="userName" placeholder="Nom" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-8">
                            <label for="userName">Avatar</label>
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
                          <input type="hidden" id="userAvatar" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-8">
                            <label for="userDescription">Description</label>
                            <textarea class="form-control form-control-user" id="userDescription" placeholder="Description" style="height: 15em;"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-8">
                            <a href="login.html" class="btn btn-primary btn-user btn-block">Ajouter l'utilisateur</a>
                        </div>
                    </div>
                </form>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        
