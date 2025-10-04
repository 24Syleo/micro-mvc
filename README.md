# build les images
docker compose up --build
# installer les librairies
docker compose run --rm composer install
# commandes pour les scripts
setup database : docker compose run --rm composer database
mise a jour migrations : docker compose run --rm composer migrations
