# Laradock Setup

At the root of our project directory sits a Laradock folder. This folder contains a pre-built selection of Docker containers, that should facilitate easy local deployment. 

---

##To setup the API with Laradock do the following:

1. Install Docker locally: https://docs.docker.com/install/

2. Clone the project: `git clone https://github.com/Pistolpete3/docker-school-api.git`

3. Navigate to the root of our project directory and into `/laradock`

4. Start the default containers from a terminal window using: 
`docker-compose up -d nginx mysql phpmyadmin workspace`

5. If you would like to use a custom domain you can enter it into your local `/etc/hosts` for example:
		`127.0.0.1 schools-api.flyte`

6. Now we need to create the API database for our Laravel app
		
		a) Enter MySQL in Docker with `docker-compose exec mysql bash`
	
		b) Login to MySQL using `mysql -uroot -p`
	
		c) Create an empty db `create database schoolsApi;`
	
7. Go back to the project root directory and ensure Laravel's .env file MySQL credentials matches your docker instance. You may want edit Laradock's default MySQL version of `latest` in the .env to `5.7` in order to avoid MySQL 8.0 complexities.

		DB_CONNECTION=mysql
    	DB_HOST=mysql
    	DB_PORT=3306
    	DB_DATABASE=schoolsApi
    	DB_USERNAME=root
    	DB_PASSWORD=root

8. Now enter the Docker laravel workspace with `docker-compose exec  workspace bash`

9. Run the migrations and seeds with `php artisan migrate --seed`

10. The application should now be running at `localhost` with seed data
