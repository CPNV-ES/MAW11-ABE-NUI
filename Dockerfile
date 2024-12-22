# Utilise l'image officielle MariaDB comme base
FROM mariadb:10.11

# Définit le répertoire de travail
WORKDIR /var/lib/mysql

# Copie les fichiers de configuration personnalisés si nécessaires
# COPY my-custom.cnf /etc/mysql/conf.d/

# Définit les variables d'environnement pour MariaDB
ENV MYSQL_ROOT_PASSWORD=root_password
ENV MYSQL_DATABASE=my_database
ENV MYSQL_USER=my_user
ENV MYSQL_PASSWORD=my_password

# Expose le port par défaut de MariaDB
EXPOSE 3306

# Commande par défaut pour démarrer MariaDB
CMD ["mysqld"]