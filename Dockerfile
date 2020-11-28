  
FROM php:7.4

RUN apt-get update 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get install -y 
RUN apt-get install -y openjdk-11-jre-headless
RUN apt-get clean