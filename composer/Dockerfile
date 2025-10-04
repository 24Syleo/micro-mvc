FROM composer

# Dossier de travail (c'est là que le volume sera monté)
WORKDIR /app

# Définit composer comme entrypoint pour que les arguments passés au conteneur
# deviennent des arguments de la commande `composer`.
ENTRYPOINT ["composer"]
# Par défaut, affiche la version si aucun argument n'est fourni
CMD ["--version"]