 FROM php:5.6.35-apache-jessie

COPY --chown=www-data:www-data index.php /var/www/html/
COPY --chown=www-data:www-data composer.json /var/www/html/
COPY --chown=www-data:www-data .htaccess /var/www/html/
COPY --chown=www-data:www-data templates /var/www/html/templates/
COPY --chown=www-data:www-data Classes /var/www/html/Classes/
COPY --chown=www-data:www-data css /var/www/html/css/
COPY ./Docker/001-odf_ficheros.conf /etc/apache2/sites-available/
COPY ./Docker/php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y --no-install-recommends \
        curl \
        git-core \
        unzip \
        && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www/html/
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
   && php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
   && php /tmp/composer-setup.php \
   && php -r "unlink('/tmp/composer-setup.php');"

RUN php composer.phar install
RUN a2ensite 001-odf_ficheros && a2dissite 000-default && a2enmod rewrite \
   && service apache2 restart
