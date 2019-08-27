# webdev-blog
### Blog PHP basé sur le pattern MVC

Version en ligne du projet [ici](http://webdev-blog.orlinstreet.rocks/).

[![SymfonyInsight](https://insight.symfony.com/projects/d48cdb25-7152-4066-a9a5-1f88b3d2679d/big.svg)](https://insight.symfony.com/projects/d48cdb25-7152-4066-a9a5-1f88b3d2679d)

## Instructions d'installation :

### Télécharger le projet :

#### Soit depuis l'url :  
https://github.com/fstenneler/webdev-blog/archive/master.zip

#### Ou directement dans Git :

    git clone https://github.com/fstenneler/webdev-blog.git

### Créer la base de données en important le script MySQL situé dans le dossier setup :

[https://github.com/fstenneler/webdev-blog/blob/master/setup/webdev-blog.sql](https://github.com/fstenneler/webdev-blog/blob/master/setup/webdev-blog.sql)

### Éditer le fichier config.php situé dans le dossier config :

    define('DB_SERVER', '');
    define('DB_USER','');
    define('DB_PASSWORD','');
    define('DB_NAME','webdev-blog');
    define('POST_NUMBER', 8);
    define('MAX_FILE_SIZE', 500000);
    define('GALLERY_DIR', '/public/front/images/gallery/');
    
 #### Paramètres à modifier :  
  * DB_SERVER : adresse ou IP du serveur MySQL  
  * DB_USER : identifiant de connexion à la base de données  
  * DB_PASSWORD : mot de passe de connexion à la base de données
  
 #### Les autres paramètres sont déjà renseignés mais peuvent être modifiés en cas de besoin :  
  * DB_NAME : nom de la base de données  
  * POST_NUMBER : nombre d'articles à afficher sur une page  
  * MAX_FILE_SIZE : taille maximale en octets des images à charger  
  * GALLERY_DIR : chemin vers le dossier des images chargées  
  
### Téléverser tous les dossiers et fichiers sur le serveur distant

### Se connecter en utilisant le compte administrateur par défaut

  * Identifiant : admin@webdev.fr  
  * mot de passe : admin  
  
### Personnaliser le compte administrateur

(Rubrique mon compte)

### Accéder à l'admin pour gérer le site et créer les articles :
  
(Ciquer sur le lien Admin dans le footer du site)
