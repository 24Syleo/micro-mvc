# micro-mvc

## build les images

docker compose up --build

### installer les librairies

docker compose run --rm composer install

## commandes pour les scripts

### database

docker compose run --rm php php database/setup.php
ce script executera le fichier schema.sql

### migrations

docker compose run --rm php php database/migrations/run-migrations.php
ce script executera les différentes dans le dossier migrations.
