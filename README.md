# Composer 
Composer est un gestionnaire de librairie, de dépendances, pour PHP, il va permettre de télécharger la librairie et de l'utiliser. Symfony est un ensemble de petits composants qui peuvent être utilisés un a à un, qui, mis en cohérence, les uns avec les autres, forment un framework surpuissant. Il a pour différents avantages : il est très utilisé, comme Laravel, il y a beaucoup d'échanger sur le net, il est très simple à utiliser, sa documentation est bien faite.


## Créer une application 

## Installation 
composer create-projet symfony/website-skeleton symfony4

## Installer un serveur personnalisé pour lancer l'application 
composer require server --dev, on dit qu'on a besoin d'une libraire particulière, "server", "--dev", qu'on va utiliser uniquement quand on va développer, quand on passera en prod, il n'aura pas besoin d'installer cette librairie.

## Lancer l'application  
php bin/console server:run

## Le coeur de Symfony 

## Les 3 pilliers de Symfony 

## Les controllers
Ils permettent de gérer les traitements. 

## Doctrine 
Pour gérer l'accès aux données. 

## Twig  
Pour gérer l'affichage, les rendus.

## La logique du Controller 
Un Controller sert à écouter une adresse, qu'on apelle une route, écouter et analyser la requête HTTP que le navigateur a envoyé à la route, fabriquer une réponse HTTP, qui soit convenable et la renvoyer au navigateur afin qu'il y ait un affichage, une redirection ou un téléchargement.

## Structure des dossiers 

## Le dossier src 
Il contient l'entièreté des codes PHP de l'application. Pour créer un Controller, il faut utiliser la commande : php bin/console make::controller, la ligne de commande nous demande le nom du contrôleur (on crée une convention de nommage : toujours la première lettre en majuscules et le reste en camel case). Cela crée une classe dans le dossier "Controller", et dans le dossier template, un dossier qui porte le nom qu'on a donné au Controller, avec un premier fichier "index.html.twig" pour qu'on puisse toute de suite commencer à travailler. Dans le Controller, il y a une classe qui hérite de la classe Controller. Il y a une fonction "public" et une annotation qui explique à Symfony la fonction à appeler quand on va sur le navigateur. 

## Le dossier templates  
Il permet de gérer les fichiers d'affichage, avec Twig. 

## Les annotations
N'importe quel commentaire qui commence par un "@" est une annotation. Quand un navigateur appellera "symfony4/blog", voici la fonction que tu dois appeler, la fonction "index()", peu importe ce qu'elle fait. Le but, c'est de traiter la demande et de renvoyer une réponse. On renvoi le fait d'afficher un fichier HTML. On pas précisé que le dossier "blog" se trouve dans le dossier "template", parce que Symfony sait que tous ses templates sont dans ce dossier.

@Route("/blog", name="app_blog")

## Comment créer une page ?
Une fonction publique au sein du controller, une route qui est liée à cette fonction publique, et cette fonction publique doit absolument renvoyer une réponse, qui sera de l'affichage ou autre chose.

## Langage de rendu Twig 
C'est une librairie qui existe en-dehors de Symfony qu'on peut utiliser dans d'autres projets PHP. 

Il y a plusieurs avantages.

Simplicité 
**********
- Facilite l'écriture des affichages 
- Apporte beaucoup de fonctionnalités que le templating PHP avait du mal à apporter 

L'absence complète de PHP dans l'affichage
******************************************
- Permet d'abstraire les affichages de balise PHP 
- Plus simple pour intégrateur qui ne connait que le HTML


Les principales fonctionnalités 
*******************************
- Afficher le contenu d'une variable avec {{}} : interpolation. 
- Utiliser des commandes 

    {{% if age > 18  %}}
      <p>Tu es majeur</p>
      {{% else %}}
      <p>Tu es mineur</p>
    {{% endif %}}

Pour que tout cela fonctionne, il faut que le contrôleur, au moment ou il appelle le template Twig, fournisse des informations concerant ces variables. Pour fournir ces variables à Twig, dans la fonction "render()" du controller, il faut rajouter une deuixème paramètre qui sera un tableau avec la liste des avec la liste des variables que Twig va devoir utiliser.

public function home()
{
    return $this->render('blog/home.html.twig', [
        'title' => 'Bienvenue ici les amis !",
        'age' => 31
    ]);
}

## path 
C'est le résultat d'une fonction, qui prend 2 paramètres, un paramètre obligatoire et un paramètre optionnel. Le paramètre obligatoire, c'est le nom de la route. Il fait appel au nom d'une route. 

<a href="{{ path('blog_show') }}" class="btn btn-primary">Lire la suite</a> Twig fait le lien entre le nom "blog_show" 
et l'adresse : @Route("/blog/12", name="blog_show").

## L'ORM de Symfony : Doctrine 
Symfony utilise un ORM (Object Relational Mapping), qui est une brique logicielle qui fait le lien entre une application et une base de données. Le but est qu'on gère au sein d'une application, par des classes, notamment, et des objets, les données, et ce que l'on fait dans l'application se reflète automatiquement dans la base de données, grâce à l'ORM. Le but est qu'on ait presque jamais à avoir à toucher à la base de données, on écrira presque jamais de SQL. On utilisera des simples objets, des classes et l'ORM se chargera de faire en sorte que les manipulations qu'on fait avec les objets, se reflète dans la base de données. Doctrine n'est pas lié à Symfony, on peut l'utiliser dans d'autres projets PHP. 
Dans Symfony, grâce à Doctrine, on peut gérer nos tables, nos lignes de nos tables, les ajouter, les supprimer, les mettre à jour, faire des sélections, etc. 

## Les entités : Entity 
On va créer des classes, qui sont des entités, qui représentent des tables.

## Manager 
Il permet de manipuler une ligne : écrire une ligne dans la base de données, mettre à jour une ligne dans la base de données, ou supprimer une ligne dans la base de données.

## Repository
C'est ce qu'il va servir à faire des sélections de données, faire des sélections SQL, sans en écrire, c'est Doctrine qui se charge du SQL, on ne fait que demander à Doctrine, en PHP, ce dont on a besoin. Entity, Manger et Repository sont des classes PHP qu'on manipule dans l'application, on ne soucie pas du SQL qui se trouve derrière. 

## Gestion des bases de données

## Les migrations 
Comme dans d'autres framework, dans Symfony, on utilise les migrations. Symfony privilégie les fichiers car c'est ce qui sera partagé entre différents développeurs. Quand on va faire un dépôt Git et que les utilisateurs vont télécharger le dépôt, ils vont télécharger les fichiers et pas une base de données et donc, la base de données doit venir des fichiers. Il faut que les fichiers expriment à quoi ressemble la base de données. Une migration est un script qui nous dit qu'il veut faire passer la base de données d'un état A à un état B. Les fichiers de migration ont un ordre, ils seront exécuté dans un certain ordre. Quand on passera les fichiers à une autre personne, il suffira de faire tourner les migrations pour avoir la même base de données que celle du projet. 

## Mettre en place une base de données  

## Créer une base de données 
Il faut configurer le fichier ".env", contenant différentes variables d'environnement. Il y a la variable "DATABASE_URL", qui est là pour expliquer à Symfony, ou se trouve la base de données. Il faut remplacer les valeurs "db_user", "db_password" et "db_name". Sous Wamp, "db_user" sera root, "db_password" sera vide, "db_name" sera le nom qu'on veut donner à la base de données. 
Ensuite, on peut demander à Doctrine, en ligne de commande d'intéragir avec MySql pour mettre en place, ce dont on a besoin. On va exécuter : php bin/console doctrine:database:create. On va créer une table, à l'aide de la commande : php bin/console make:entity, permettant de créer une entité, la ligne de commande propose de donner le nom de la classe qu'on veut. La ligne de commande crée 2 nouveaux fichiers : une entité qui représentera la table, et un Repository qui permettra de faire des sélections sur cette table. On va pouvoir, grâce à la  ligne de 
commande, créer les différentes propriétés, champs de la table. Ce sont les propriétés d'une classe mais quand Doctrine voit une propriété de classe, il le transforme en une table avec des champs. La commande demande les propriétés de la classe, il proposera de choisir le type de données pour la propriété, les types de données sont les types Doctrine et pas des types SQL. Si on veut voir tous les types, on tape "?". Le Manager va permettre de manipuler les données de la table et le Repository va permettre de faire des sélections sur les données de la table.

## Le dossier Entity
Ce sont des classes particulières, ayant des annotations particulières, qui explique à Doctrine, il y a des champs qui sont des propriétés privées. La commande génère automatiquement des "getter" et des "setters", tout ce qu'il faut pour pouvoir travailler avec cette classe. On a créer l'entité mais la table n'existe 
pas encore dans la base de données. Il faut créer la migration qui va permettre d'analyser le code, Doctrine va regarder les entités, elle va voir pour ce qui devrait exister dans la base de données, si on se base sur cette entité, elle va regarder la base de données, elle va voir la différence entre les 2 et cela va lui permettre de dire ce qui lui manque dans la base de données, et va créer un script SQL pour amener ces tables : php bin/console make:migration, et ce travail de différence va se faire entre les classes qui existent dans l'application et les tables qui existent dans la base de données. Si Doctrine découvre qu'il y a des différences, les fichiers ont la prioriété. Doctrine va créer la migration qui va mettre à jour la base de données pour qu'elles reflètent complètements les fichiers, les classes de Symfony. La migration est versionnée, elle contient une fonction "up" qui contient du script SQL, qui va créer les tables. Si on modifie une entité, en ajoutant un champ, ou en supprimant un champ, et qu'on refait une migration, l'analyse de Doctrine va montrer qu'il va falloir aussi faire un petit script SQL pour aller modifier ou supprimer un champ dans la table.
Tout cela se fera au fur et à mesure qu'on développe une application, on aura de plus en plus de fichiers de migration. Une personne qui téléchargerait les fichiers de l'application, n'aurait plus qu'à lancer le script de migrations pour passer d'une base de données complètement vide à une base de données avec toutes les tables, à la bonne version. On lance la migration 
avec la commande : php bin/console doctrine:migrations:migrate, ce script va faire tourner toutes les migrations. Doctrine prévient qu'il va modifier la base de données.  

## Les fixtures  
C'est un script qui va créer des jeux de fausses données au sein de la base de données, c'est exxécutable à souhait, et c'est réutilisable par les autres. C'est un script qui va permettre d'insérer un jeu de fausses données au sein de la base de données. Il faut tout d'abord installer le composant de création de fixtures : 
, qui n'est pas livré avec le squelette de Symfony, avec la commande : composer require orm-fixtures --dev. Une fois installé, on peut exécuter la commande : php bin/console make:fixtures pour créer une fixture, qu'on va appeler "ArticleFixtures", qui se créer dans le dossier "DataFixtures". Le fichier fixture est une simple classe qui va recevoir le "manager", qui permet d'insérer 
En Symfony, dès qu'on utilise le nom d'une classe, il faut rajouter son "use" pour expliquer à PHP, d'où vient la classe. On va ensuite exécuter la commande : php bin/console doctrine:fixtures:load, Doctrine va prévenir que si on lance la fixture, cela va supprimer tout ce qu'il y a dans la base de données.

## Accéder aux données
On se retrouve dans un Controller pour aller exploiter les données de la base de données. Si on veut faire des sélections, on a besoin d'un "Repository", si on veut faire des manipulations, on a besoin d'un "Manager".

## Accéder au Repository depuis le Controller
On veut discuter avec Doctrine, on veut récuper un "Repository" qui gère l'entité "Article". Si on utilise la classe "Article," il faut l'importer. Le Repository connait les champs de la table, car il travaille avec l'entité. 

$repo = $this->getDoctrine()->getRepository();

## Affichage dans Twig 
Dans l'entité, les variables sont en "private", mais Twig essaye d'accéder à "article.title", il n'y arrivera pas, il va alors essayer "article.getTitle()", 
il va essayer plusieurs choses et à chaque fois que quelque chose rate, il essaye autre chose, et si il n'arrive à rien, il affichera une erreur, mais ici ce 
n'est pas le cas. L'interopolation de Twig permet d'afficher le contenu d'une variable mais se limite aux données primitives : chaînes de caratères, booléens, nombres. "created_at" est un objet complexe, c'est un "dateTime", qui ne possède pas de méthode "toString", c'est impossible pour Twig de le trouver. On peut utiliser un filtre. Twig affiche les balises HTML, venant de la db, on va donc utiliser un autre "pipe", "raw", qui va afficher le contenu brut. 

## Filtres 
Twig permet, en plaçant un symbole de "pipe", de dire qu'on va afficher la donnée mais en la formattant d'une certaine façon. Twig à un certain nombre de filtres.
Il a notamment un filtre qui permet de formatter une date, qui prend en paramètre le format de date que l'on veut. Symfony, grâce à l'injection de dépendance, comprend que, quand il appelle une fonction, si elle a un "Repository" en paramètre, c'est un indice qu'on lui a donné, il saura qu'il a besoin de la classe de ce "Repository". On aura donc plus besoin de déclarer le "Repository" au sein de la fonction. 

## L'injection de dépendances

## Le Service Container 
Tout ce qui est contenu dans Symfony est géré par Symfony. Symfony se charge d'instancier les Controller, il instancie des classes et utilise des fonctions. 
Dans le Service Container, Symfony à la possibilité de nous donner ce dont on a besoin quand on lui dit. Quand une fonction à besoin de quelque chose pour fonctionner, c'est une dépendance. Si on a une dépendance, on peut demander à Symfony de nous la fournir. Symfony est capable d'examiner une fonction et de voir si il a besoin de quelque chose pour fonctionner. On peut passer en paramètre un Repository, au sein d'une fonction, il faut lui spécifier lequel, il faudra l'inclure. 

## Le ParamConverter 
C'est une brique logicielle : il voit une route qui va contenir un identifiant, il sait que la fonction à besoin d'un article, il va aller chercher l'article qui a cet identifiant. Symfony comprend que dans la fonction "show", on lui passe un article, au début il ne sait pas quel article passer, et il se rend compte dans la route qu'on parle d'un identifiant. Il va donc chercher l'article qui a cet identifiant. Grâce à l'injection de dépendances, on a des fonctions plus courtes, plus propres, on ne doit pas instancier de classes, le Service Container sait comment fonctionne l'application et quand on lui demande de passer des choses, il nous les passe, on va beaucoup plus vite et c'est beaucoup plus clair.

## Les formulaires  
On va créer un formulaire qui permettra de créer un article et en modifier un. On va utiliser le composant "Forms" de Symfony. 

## Créer une page 
Si on veut créer une page, il faut une fonction "public" dans un Controller, attaché à une route (l'adresse à laquelle on pourra appeler cette fonctionnallité), cette fonction doit retourner une réponse.  

@Route("/blog/{id}", name="blog_show")
 
De cette manière, Symfony va croire que "new" est un id. Pour résoudre cela, on doit soit préciser que l'id est un entier, soit changer l'ordre des routes en 
faisant remonter la fonction. Comme ça, Symfony, lorsqu'il parcourera les routes, verra la route new avant.  

@Route("/blog/new", name="blog_create")

## Définition du formulaire
On va utiliser l'objet Request, qui représente une requête HTTP entrante, elle encapsule toutes les informations relatives à une requête HTTP spécifique, comme les paramètres, les en-têtes, les cookies, les données de formulaire, etc. 

## Bonne pratique de Symfony 

## Utilisation du composant de formulaire de Symfony

## article vide, prêt à être remplit 
## $article = new Article(); 

## Création d'un formulaire lié à l'article
C'est un objet, il va prendre toutes les données, il est bindé à l'article (objet avec des méthodes, ce n'est pas du HTML).

$form = $this->createFormBuilder($article)
    Configuration du formulaire : lui donner les champs qu'on veut traiter
    **********************************************************************
    ->add('title')
    ->add('content')
    ->add('image')
    Résultat final 
    **************
    ->getForm();   

return $this->render('blog/create.html.twig', [
    Méthode de l'objet Form, qui représente l'affichage du formulaire
    *****************************************************************
    'formArticle' => $form->createView()
]);

On demande à créer un FormBuilder, on le configurer, et on demande à la fin, de nous donner le formulaire qu'on a construit. Ce n'est pas un formulaire HTML, c'est un objet complexe, avec des méthodes. Si on veut afficher le formulaire, il va falloir passer par des méthodes particulières. On va passer le formulaire à Twig pour l'afficher, on ne lui passer pas "$form", on veut lui passer une variable qui soit facile à afficher, on va passer un tableau qui contiendra les différentes informations qu'on veut lui passer, et on passera le résultat de la fonction "createView" du formulaire, qui va créer un petit objet qui représente l'affichage du formulaire. On va utiliser la fonction form() de Twig, et on lui passe un formulaire, pour afficher le formulaire. On aura la même chose que le HTML, sans placeholder. Symfony est capable, comme il est lié à une entité, d'aller voir l'entité et de se rendre compte de quels types sont les champs et afficher les champs appropriés, mais on peut utiliser nos propres volontés, en utilisant un deuxième paramètre.

## Affichage du formulaire complet 
{{ form(formArticle)}}

## Affichage des parties du formulaire 
{{ form_start(formArticle) }}

  <div class="form-group">
    <label for="">Titre</label>
    {{ form_widget(formArticle.title) }}
  </div>

On aura quand même tous les champs, à partir du "form_end", si on n'a pas affiché nos champs comme on le souhaite, il affichera tout les champs
qui n'ont pas étés affichés. Il tient en mémoire un registre des champs qui ont étés affichés par rapport aux champs du formulaire globale. 

{{ form_end(formArticle) }}

## Les templates Twig 
Les moteurs de rendu Twig permettent la possibilité, en une seule ligne, de faire en sorte que le formulaire Boostrap fonctionne.

<div class="form-group">
  <label for="">Titre</label>
  {{ form_widget(formArticle.title) }}
</div>

<div class="form-group">
  <label for="">Contenu</label>
  {{ form_widget(formArticle.content) }}
</div>

<div class="form-group">
  <label for="">Image</label>
  {{ form_widget(formArticle.image) }}
</div>

serait simplifié en : {{ form_widget(formArticle) }} 

Il existe des templates Twig pour les formulaires, on peut aussi les créer nous même.  

Il faut copier cette ligne dans "config/packages/twig.yaml" : form_themes: ['bootstrap_5_horizontal_layout.html.twig'].

C'est préférable de créer nous-même notre bouton dans le Twig.

## Mauvaise pratique 
if($request->request->count() > 0){
    // Création d'article 
    $article = new Article();
    $article->setTitle($request->request->get('title'))
            ->setContent($request->request->get('content'))
            ->setImage($request->request->get('image'))
            ->setCreatedAt(new \DateTime());
    
    $manager->persist($article);
    $manager->flush();

    return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
} 

C'est un objet, il va prendre toutes les données, il est bindé à l'article (objet avec des méthodes, ce n'est pas du HTML)      
       
$form = $this->createFormBuilder($article)
    // Configuration du formulaire : lui donner les champs qu'on veut traiter
    ->add('title', TextType::class, [
        // Option
        'attr' => [
            'placeholder' => "Titre de l'article",
            // 'class' => 'form-control'
        ]
    ])
    ->add('content', TextareaType::class, [
        'attr' => [
            'placeholder' => "Contenu de l'article",
            // 'class' => 'form-control'
        ]
    ])
    ->add('image', TextType::class, [
        'attr' => [
            'placeholder' => "Image de l'article",
            // 'class' => 'form-control'
        ]
    ])
    
    ->add('save', SubmitType::class, [
        'label' =>  'Enregistrer'
    ])
    ->add('save', SubmitType::class, [
        'label' =>  'Enregistrer'
    ])
    ->add('title')
    ->add('content')
    ->add('image')            
    // Résultat final 
    ->getForm();  

## Définir une seule fonction pour l'ajout et l'édition  
La fonction pourra être appelée par 2 adresses différentes.

@Route("/blog/new", name="blog_create")
@Route("/blog/{id}/edit", name="blog_edit")

## Le paramconverter
Convertit un paramètre en une entité. 

On va l'utiliser pour donner en paramètre un article, au lieu de l'id d'article. 

public function form(Article $article, Request $request, ObjectManager $manager)
{
    // Bonne pratique de Symfony 

    Si on va à l'url "/blog/12/edit", le formulaire est remplit avec l'article 12 mais si on va sur "/blog/new", on aura une erreur car on a demandé de passer l'article 
    qui correspond éventuellement à la route "@Route("/blog/{id}/edit", name="blog_edit")", mais comme on est pas sur cette route là, on n'a pas d'identifiant, on ne sait pas 
    aller chercher d'article. On va alors définir l'article à null pour lui dire que parfois l'article peut être null et faire une condition.

    // Utilisation du composant de formulaire de Symfony
    //  $article = new Article(); // article vide, prêt à être remplit 


    // Création d'un formulaire lié à l'article     
    $form = $this->createFormBuilder($article)
        ->add('title')
        ->add('content')
        ->add('image')    
        ->getForm();  

    // Analyse de la requête HTTP passée en paramètre, si ça a été soumis ou pas
    $form->handleRequest($request);

    // Si le formulaire est soumis, on enregistre l'article (méthode de la classe Form)
    if($form->isSubmitted() && $form->isValid()) {
        // Ajout de la date de création qui est nulle à la soumission
        $article->setCreatedAt(new \DateTime());

        // Persister l'article 
        $manager->persist($article);

        // Exécuter la requête 
        $manager->flush();

        // Redirection vers la page de l'article qui vient d'être créé
        return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
    }        

    return $this->render('blog/create.html.twig', [
        // Méthode de l'objet Form, qui représente l'affichage du formulaire
        'formArticle' => $form->createView()
    ]);
}

## La validation sur les entités
La validation, en Symfony, se fait directement sur le modèle, sur l'entité. La validation monte du modèle vers le formulaire, et c'est grâce au modèle que le formulaire va savoir faire des validations particulières. Pour modifier les messages de validation : minMessage.

## Les relations entre entités Doctrine
Une entité est une table, dans la base de données, qu'on peut gérer directement. Si on veut créer une nouvelle table "Catégorie", elle doit être liée à la table "article": un article doit faire partie d'une catégorie et une catégorie peut avoir un ou plusieurs articles à l'intérieur d'elle-même, c'est un relation "ONE TO MANY". On va donc créer une nouvelle entité en ligne de commande : php bin/console mak Dans la classe "Article", un champ "category" a été ajouté, il représente une relation "ManyToOne" vers "Category" : plusieurs articles vers une seule catégorie. Cette relation est inversée au sein des catégories par le champs "articles" 
(inversedBy). Quand on travaille sur un article, on a accès à sa catégorie et c'est pareil pour la classe "Category", qui a été créée automatiquement, qui a une relation "OneToMany" vers des articles, "$articles" : une catégorie vers plusieurs
articles, et au sein des articles, c'est la propriété "category", qui est le lien inverse (mappedBy).   

## Fixtures et Faker 

## Créer des jeux de fausses données 
Les fixtures sont des fichiers de scripts, dans lesquels on crée des jeux de fausses données et on les insère dans la base de données. 

## Faker 
Faker est une librairie, il existe dans a peu près tous les languages, qui va permettre de créer des fausses données convainquantes

## Installation 
composer require fzaninotto/faker 

## L'authentification
Comment s'inscrire et se connecter. On va faire en sorte qu'on ne puisse pas laisser un commentaire si on est pas connecté. On va donc faire en sorte qu'on puisse se connecter, il faut une authentification d'un utilisateur pour qu'il puisse laisser un commentaire. Pour ça, il faut mettre 
en place le composant de sécurité. 

## Le composant Security 
Un des composants les plus complexe, c'est un outil pour faire l'authentification. Il offre notamment les firewalls, on peut en avoir plusieurs dans une application, 
qui explique les points d'entrée, comment on va protéger les différentes parties de l'application. On peut avoir des parties qui ne sont pas protégées et des parties protégées. Les Providers permettent de savfoir ou sont les données des utilisateurs. Pour sécuriser les données, Symfony propose d'utiliser les encodeurs : quel algorithme d'encodage on va utiliser, quel algorithme de hachage on va utiliser pour les mots de passe. On peut le faire dans le composant Security. Pour 
retrouver le fichier de configuration du package "Security", on va dans le dossier "config". Pour retrouver le fichier de configuration du package "security", il faut 
aller le dossier "packages", il y a le fichier "security.yaml". On y retrouve les firewalls : le firewall "dev", qu'on gère pour le développement pour laisser accès à la bare de développement, on veut qu'il n'y a pas de sécurité là-dessus, ce sont des fichiers qui servent à la barre de développement. Le firewall "main", n'a pas comme le firewall "dev", un "pattern" qui définit la partie de l'application concernée, "main" définit que c'est tout le reste de l'application qui est sous le firewall "main" et on a le droit d'y arriver en tant qu'anonyme, c'est ce qui fait que quand on va sur le site, on a l'impression qu'on est logué, on a simplement définit qu'on est connecté en tant qu'anonyme. On pourrait créer autant de firewall qu'on veut, qui match avec le pattern sur différentes parties de l'application. On va créer une entité utilisateur qui va les stocker, le but est de créer un 
entrepôt d'utilisateurs qui va les stocker dans la base de données, pour pouvoir les utiliser pour se connecter.

## L'entité User
On crée une entité User, avec un migration afin de créer une table User, on va enregistrer des utilisateurs, et donc créer un formulaire d'inscription. 

## Le formulaire d'inscription 
On crée un formulaire d'inscription en ligne de commande avec la CLI. On va créer aussi un SecurityController. Quand on crée un formulaire, c'est bien de pouvoir dire à quel objet on relie les champs du formulaire. 

## On crée un Controller SecurityController
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    @Route("/inscription", name="security_registration")
   
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User(); 

        // Instanciation du formulaire : on donne le nom de la classe qui contient le formulaire, qui permet de le construire
        // et on relie les champs du formulaire aux champs de l'utilisateur.
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        // Si le formulaire est fournis et que tous les champs sont valides
        if($form->isSubmitted() && $form->isValid()){
            // Préparation à la sauvegarde
            $manager->persist($user);
            // Sauvegarde
            $manager->flush();
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

on crée le fichier de vue. Il faudra dire, dans le Controller, que la fonction registration à besoin de la requête HTTP, pour pouvoir l'analyser et en retirer les informations qui sont ressorties, et on a aussi besoin de l'Object Manager de Doctrine, qui va permettre d'enregistrer l'utilisateur en base 
de données. 

## Hasher les mots de passe 
Il faut revenir dans le fichier "securtiy.yaml", de "config/packages", et on va déclarer un encoder, qui va s'adresser à une entité particulière. On va décrire quel algorithme utiliser. Dans le SecurityController, on dit que si tout est valide dans le formulaire, avant de persister, on va crypter le mot de passe. On va utiliser une classe, dans la fonction "registration", qui est faite par Symfony, permettent d'encoder les mots de passe de l'utilisateur : UserPassworEncodeInferface, qu'on définit sur un paramètre "$encoder". Il faut que l'entité "User" implémente "UserInterface" et implémenter les fonctions de cette interface non présentes dans l'entité "User". 

## Utilisateurs uniques 
On mettre en place le fait que l'adresse email soit unique. On va utiliser une contrainte dans l'entité "User". On va utiliser un contrainte, au niveau de l'entité, "UniqueEntity" et ajouter le namespace. C'est une fonction qui va prendre plusieurs paramètres. 

## Formulaire de login 
Il faut expliquer à Symfony qu'on va utiliser un formulaire de login pour se connecter. Il faut d'abord dire à Syfmony où se trouvent les utilisateurs. On définir un provider, "in_database", qui se base sur une entité.