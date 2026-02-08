## INSTALLATION DE SYMFONY

### DOCKER
````
docker compose build
docker compose up

````

### CHOWN SYMFONY
````
sudo chown 1000:1000 -R symfony/
````

### Installer symfony dans le dossier symfony
````
docker exec -it php_sf_project bash
````

Dans le container www/symfony taper:
````
composer create-project symfony/skeleton:"8.0.*" .
composer require webapp
````

### Connection de ma db dans phpStorm
````
port: 27017
user: m2i
password: test1234
database admin
````

### Connection de mongo avec symfony
````
https://www.doctrine-project.org/projects/doctrine-mongodb-bundle/en/latest/installation.html#install-the-bundle-with-symfony-flex
ou
https://www.mongodb.com/docs/drivers/php-frameworks/symfony/
````

### DOC SYMFONY multi DB
````
https://symfony.com/doc/current/doctrine/multiple_entity_managers.html
````

### UTILISER UNE BOITE MAIL mailhop avec docker
## configuration symfony
````
dans mon .env
MAILER_DNS=smtp://mailhog:1025
````