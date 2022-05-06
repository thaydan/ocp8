[![Codacy Badge](https://app.codacy.com/project/badge/Grade/87ed5cd1f6844b6c8d39524e994ed358)](https://www.codacy.com/gh/thaydan/ocp8-dev/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=thaydan/ocp8-dev&amp;utm_campaign=Badge_Grade)

# ocp8

ToDo & Co is an application to manage your daily tasks.

## Requierements
- PHP 8.0.17
- MariaDB 10.5.15

## Installation

1. Copy the repository  
2. Complete the .env file (you need to set the database URL)
3. Install dependencies  
```bash
  composer install
```
4. Create database
```bash
  php bin/console doctrine:database:create
```
5. Update database schema
```bash
  php bin/console doctrine:database:update --force
```
6. Load the fixtures to install the demo data

```bash
php bin/console doctrine:fixtures:load
```

**Demo accounts included in fixtures**  
  
&nbsp; | Email | Password
--- | --- | ---
Admin | `admin@admin.com`  j | `admin`  
User | `user@user.com` | `user`  

## Contributing
To contribute to the project, see the [contributing documentation](/CONTRIBUTING.md).
