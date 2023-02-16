FROM php:8-apache

RUN apt-get -qq update && \
	apt-get -qq install libzip-dev && \
	docker-php-ext-install zip
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-install bcmath
RUN apt-get -qq update && \
	apt-get -qq install zlib1g-dev libicu-dev g++ && \
	docker-php-ext-install intl
RUN apt-get -qq update && \
	apt-get -qq install libmagickwand-dev && \
	pecl install imagick && \
	docker-php-ext-enable imagick

ENV PORT=8080
CMD sed -i "s/80/${PORT}/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf && \
		docker-php-entrypoint apache2-foreground

COPY --chown=www-data:www-data ./ ./
