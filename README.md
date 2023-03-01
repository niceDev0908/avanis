# avanis
Avanis

##### Please follow the below steps to configure setup in local environment


###### **Step1** First of all setup this project in your local environment based on OS which you are using

###### **Step2** After that creating a new database using phpmyadmin and set database configuration in .env file. Enviroment(.env) file is placed in your project root directory. This is if you have any .sql file of your database.

###### Now if you have migrations inside your project directory database->migrations than simply just create a new database in phpmyadmin than setup db details in .env file and after that go to CMD and travel to your project directory and type **php artisan migrate** this command will import all of your tables for your project.

###### **Step3** Next step is to update the composer using CMD. Go to CMD and travel to your project path and type: **composer update** and press enter sometimes it takes time not to worry.

###### **Step4**  Now run artisan commands to clear cache ,view and route and configure cache
		**php artisan cache:clear**
		**php artisan view:clear**
		**php artisan route:clear**
		**php artisan config:cache**

###### **Step5** That's it. Now go to browser and type localhost/tax_junction and whatever the name you give your project.
