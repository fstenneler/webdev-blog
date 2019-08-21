# webdev-blog
Blog PHP basé sur le pattern MVC

Instructions d'installation :

[1] Télécharger le projet

[2] Créer la base de données en important le script MySQL situé dans le dossier setup : webdev-blog.sql

[3] Éditer le fichier config.php situé dans le dossier config :

  Paramètres à modifier :
  DB_SERVER : adresse ou IP du serveur MySQL
  DB_USER : identifiant de connexion à la base de données
  DB_PASSWORD : mot de passe de connexion à la base de données
  
  Les autres paramètres sont déjà renseignés mais peuvent être modifiés en cas de besoin :
  DB_NAME : nom de la base de données
  POST_NUMBER : nombre d'articles à afficher sur une page  
  MAX_FILE_SIZE : taille maximale en octets des images à charger
  GALLERY_DIR : chemin vers le dossier des images chargées
  
[4] Copier tous les dossiers et fichiers sur le serveur distant

[5] Se connecter au site en utilisant le compte administrateur par défaut :
  
  Adresse : [URL]/index.php?page=user&action=login (ou clic sur le lien en haut à droite)
  Identifiant : admin@webdev.fr
  mot de passe : aaaaaa
  
[6] Personnaliser les coordonnées et le mot de passe du compte administrateur

[7] Accéder à l'admin pour créer les articles :
  
  Adresse : [URL]/admin/ (ou clic sur le lien dans le footer)
  
  Pour ajouter/modifier/supprimer des catégories, modifier le contenu de la table category directement dans la base de données.
