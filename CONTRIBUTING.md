# Contributing

## New contributor

explications / bienvue

1. Pull requests
2. Project Architecture
3. More documentation

## Pull requests

1. créer branche correspondant à l'issue
2. créer une pull request de la branche vers master

(liens doc github)

## Project Architecture
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

Your domain has to be linked to this folder. This is the only folder that the public can access. It contains CSS, Javascript and media files.

### Source files

Contains the whole files of the program.

**Controller** : contains the routing files  
See [Controller](https://symfony.com/doc/current/controller.html).



**DataFixtures** : contains a file to generate a set of fake data  
See [DoctrineFixturesBundle](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html).


**Entity** : contains the Task and User objects  
See [Databases and the Doctrine ORM](https://symfony.com/doc/current/doctrine.html).

**Form** : contains the Task and User forms.  
See [Forms](https://symfony.com/doc/current/forms.html), [Form Types](https://symfony.com/doc/current/reference/forms/types.html).

**Repository** : contains the Task and User repositories.  
See [Databases and the Doctrine ORM](https://symfony.com/doc/current/doctrine.html).

**Security** : contains the security files (Authenticator, TaskVoter, AccessDeniedHandler).  
See [Security](https://symfony.com/doc/current/security.html).

**Service** : contains a service to customise the return to the previous page. It is used in few cases.  


### Template files
twig

See [Twig documentation](https://twig.symfony.com/doc/3.x/).

### Automated tests
phpunit

## More documentation

symfony 
