# Contributing

Welcome to the guide for conbributing.  

Before to contribute, you need to keep in mind the follow points :
- Use PSR-12 standard
- Keep a code with low duplication
- Use Codacy to help you to grow the code quality
- The technical debt must be the lower

#### Table of content

1. [Pull requests](#pull-requests)
2. [Project Architecture](#architecture)
3. [More documentation](#more)

## <a name="pull-requests"></a>Pull requests

1. créer branche correspondant à l'issue
2. créer une pull request de la branche vers master

(liens doc github)

## <a name="architecture"></a>Project Architecture
This is the project architecture. Just below, you can find the details of each folder.

    .
    ├── config                      # Configuration files
    ├── public                      # Public files
    ├── src                         # Source files
    │   ├── Controller              
    │   ├── DataFixtures         
    │   ├── Entity              
    │   ├── Form         
    │   ├── Repository         
    │   ├── Security
    |   └── Service           
    ├── templates                   # Template files
    ├── tests                       # Automated tests
    └── README.md

### Configuration files
You can configure the behavior of the application and the libraries with these files. These files use YAML language.

More information : [Configuring Symfony](https://symfony.com/doc/current/configuration.html)

### Public files

(ROOT SERVER) to be linked to this folder. This is the only folder should be the only one to be publicly accessible. It contains CSS, Javascript and media files.

### Source files

Contains the whole files of the program.

**Controller** : contains the routing files and the actions of the program (CHECKER DOC SYMFONY)  
See [Controller](https://symfony.com/doc/current/controller.html).



**DataFixtures** : contains a file to generate a set of fake data  
See [DoctrineFixturesBundle](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html).


**Entity** : contains (l'ensemble des donénes persistées en base de données) (in this case the Task and User objects)  
See [Databases and the Doctrine ORM](https://symfony.com/doc/current/doctrine.html).

**Form** : contains (IDEM ENTITY) the Task and User forms.  
See [Forms](https://symfony.com/doc/current/forms.html), [Form Types](https://symfony.com/doc/current/reference/forms/types.html).

**Repository** : contains (IDEM ENTITY) the Task and User repositories.  
See [Databases and the Doctrine ORM](https://symfony.com/doc/current/doctrine.html).

**Security** : contains the security files (Authenticator, TaskVoter, AccessDeniedHandler).  
See [Security](https://symfony.com/doc/current/security.html).
(LIEN AUTHENTIFICATION)

**Service** : contains a service to customise the return to the previous page. It is used in few cases.  


### Template files
ensemble des templates
twig

See [Twig documentation](https://twig.symfony.com/doc/3.x/).

### Automated tests
ensemble des tests
more than 70% 
phpunit

(METTRE TOUS LES PREREQUIS DE LA CONSIGNE)

## <a name="more"></a>More documentation

symfony 
