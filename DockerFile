  
FROM composer:latest

RUN apt-get update 
RUN apt-get install -y 
RUN apt-get install -y 
RUN apt-get install -y openjdk-11-jre-headless
RUN apt-get clean