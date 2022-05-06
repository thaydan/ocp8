# Contributing

Welcome to the guide for conbributing.  

Before to contribute, you need to keep in mind the follow points :
- Use PSR-12 standard
- Keep a code with low duplication
- Use Codacy to help you grow the code quality
- The technical debt must be the low as possible
- Keep 

#### Table of content

1. [Pull requests](#pull-requests)
2. [Project Architecture](#architecture)
3. [More documentation](#more)

## <a name="pull-requests"></a>Pull requests

For a better version management, it is recommended to 

1. Create issues for each modification that must be made
2. Create a branch corresponding to the issue you want to process
3. Make a pull request from the branch to master to publish the changes

More about proposing changes with pull requests : [Documentation Github](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests)

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
    ├── templates                   # Template files
    ├── tests                       # Automated tests
    └── README.md

### Configuration files (config)
You can configure the behavior of the application and the libraries with these files. These files use the YAML language.

See [Configuring Symfony](https://symfony.com/doc/current/configuration.html).

### Public files (public)

This is the folder to which the root server should be linked. This is the only folder that must be publicly accessible. It contains CSS, Javascript and media files.

### Source files (src)

Contains the whole files of the program.

| Folder           | Details                                                                                                                                                                                          |
|------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| src/Controller   | Contains the routing files and the actions of the program<br>See [Controller](https://symfony.com/doc/current/controller.html).                                            |
| src/DataFixtures | Contains a file to generate a set of fake data<br>See [DoctrineFixturesBundle](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html).                                           |
| src/Entity       | Contains all data persisted in the database (currently the Task and User objects)<br>See [Databases and the Doctrine ORM](https://symfony.com/doc/current/doctrine.html). |
| src/Form         | Contains all the forms (currently the Task and User forms).<br>See [Forms](https://symfony.com/doc/current/forms.html), [Form Types](https://symfony.com/doc/current/reference/forms/types.html).            |
| src/Repository   | Contains all the repositories (currently the Task and User repositories).<br>See [Databases and the Doctrine ORM](https://symfony.com/doc/current/doctrine.html).                                                   |
| src/Security     | Contains the security files (Authenticator, TaskVoter, AccessDeniedHandler).<br>See [Security](https://symfony.com/doc/current/security.html) and [Custom Authenticator](https://symfony.com/doc/current/security/custom_authenticator.html)                        |

### Template files (templates)
It is in this folder that all page templates are stored.  
The template engine used is Twig. The page templates are therefore in .twig format.

See [Twig documentation](https://twig.symfony.com/doc/3.x/).

### Automated tests (tests)

It contains all the unit and functional tests.  

To maintain code quality, it is important to set up unit and functional tests, and to maintain a test coverage of over 70%.  

To run tests, you need to use PHPUnit.

See [Symfony Testing](https://symfony.com/doc/current/testing.html) and [PHPUnit Documentation](https://phpunit.readthedocs.io/en/stable/index.html).

(METTRE TOUS LES PREREQUIS DE LA CONSIGNE)

## <a name="more"></a>More documentation

symfony 
