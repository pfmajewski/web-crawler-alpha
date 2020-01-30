Web Crawler Alpha
=================


Introduction
------------

Project is build with Symfony 5.0. Docker is use to run entire application in isolation.

The application offers interaction through command line:

1. `app:crawl` that extracts data from given url and outputs in JSON format

Note:

1. Docker is configured for development environment (no memory limit, xdebug)


Installation
------------

### Requirements

1. docker
2. docker-compose

### Initial setup

Build container and install required php dependencies.

```shell script
docker-compose build
docker-compose run php composer install
```


Usage
-----

### Parse data from given url

```shell script
docker-compose run php bin/console app:craw URL
```

The command will extract product options data and will output them in JSON format. 
Data will be sorted descending by the yearly cost of the product.

Example:

```shell script
docker-compose run php bin/console app:craw  https://videx.comesconnected.com/
```

Saving to a file*:

```shell script
docker-compose run php bin/console app:craw  https://videx.comesconnected.com/ > result.json
```

*) as command runs inside container that maps volume to project directory 
the output file (`result.json`) is located in root of project directory.


Development
-----------

### Running tests

```shell script
docker-compose run php bin/phpunit
```
