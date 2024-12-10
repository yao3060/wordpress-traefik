FROM composer:2.7.7 as composer

# # copy source code to image
COPY ./src /app
RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader --apcu-autoloader -vvv

# @see https://gitlab.com/itconsultis/docker-wordpress
FROM registry.gitlab.com/itconsultis/docker-wordpress:8.3-apache

# source code
COPY ./src /var/www/html

# copy composer source code
COPY --from=composer /app/vendor /var/www/html/vendor
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN /usr/bin/composer dump-autoload

# set ownership of /var/www/html to www-data
RUN chown -R www-data:www-data /var/www/html

# copy our wp-config-sample.php file that uses getenv() to retrieve environment variables
COPY ./.docker/wp-config-sample.php /wp-config-sample.php

# copy start and init scripts to image
COPY ./.docker/start /start
COPY ./.docker/init /init

USER www-data

# run start script on container startup
CMD ["/start"]
