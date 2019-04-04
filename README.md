# School Product API

This repository contains a simple API structure to facilitate basic school and product behaviors. 

The API has been built using Laravel and can be deployed using any standard Laravel deployment process, my default in this case was [Valet](docs/VALET.md). I have also included a simple Laradock container to facilitate automated deployment through [Docker](docs/LARADOCK.md). I would recommend deploying locally using one of three methods (this could also be done using Vagrant, etc):
    
    1. Valet
        a. Install php, Composer, Laravel, MySQL, and Valet locally
        b. Setup MySQL, create an empty schema titled schools-api, edit the project .env
        c. Run migrations and seeders
        d. Configure Valet by linking it to the Laravel application
        e. Serve the application using valet
        
    2. PHP Server
        a. Install php, Composer, Laravel, and MySQL locally 
        b. Setup MySQL, create an empty schema titled schools-api, edit the project .env
        c. Run migrations and seeders
        d. Serve the laravel application using php -S with desired settings
         
    3. Docker
        a. Install Docker
        b. Use the included Laradock container to stand-up a web server
        c. Configure the MySQL instance within the container and edit the project .env if necessary
        d. Run migrations and seeders
    
I will provide additional detail on methods [1](docs/VALET.md) and [3](docs/LARADOCK.md) elsewhere in the documentation. 

Production deployment would ideally be done using a Docker instance with a Jenkins build pipeline (or similar). I have not taken this project through to a full Jenkins build or tar ball state, simply due to time constraints. 

---

# Postman Collection and Documentation

I have provided brief API documentation in the form of a Postman collection. This postman collection can be found in two places:

1. JSON form at the root of the project directory: `School Product API.postman_collection.json` 
    
2. Hosted at this URL: https://documenter.getpostman.com/view/7148741/S1EH42Jc#474d4000-866c-4a41-a6a3-e54c6b5a0830

