### build les images
docker compose up --build
### installer les librairies
docker compose run --rm composer install
## commandes pour les scripts
### database
docker compose run --rm composer database
### migrations
docker compose run --rm composer migrations
