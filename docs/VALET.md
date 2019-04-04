# Valet Setup

While Docker offers great utility when working on teams or when trying to replicate prod environments, it can require a fair bit of overhead to get things up and running. 

For local Laravel development I often prefer Valet. This small API prototype was a perfect Valet use case, simply stand up a new Laravel app in a parked directory and we are off to the races! 

---
####To Setup the School API with Valet:

1. Configure Valet using the installation guide: https://laravel.com/docs/5.8/valet#installation

2. Clone the project: `git clone https://github.com/Pistolpete3/docker-school-api.git`

3. Link Valet to the project directory `valet link {dir}` or use `valet park`

4. The laravel application should now be running at `{dir}.test`

5. If you do not have MySQL running:

		a) install MySQL with `brew install mysql@5.7`
		b) start MySQL with `brew services start mysql@5.7`

6. Login to MySQL to create a new Database for the API e.g. `schoolAPI`

7. Ensure that Laravel's `.env` has the appropriate credentials for your MySQL instance/table

8. Run `php artisan migrate --seed` from the project root directory 

9. You should now be able to run `phpUnit` tests and interact with the API via Postman
