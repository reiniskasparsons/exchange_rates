## Project setup
First of all run a command ```git submodule update --init --recursive```
to get laradock for the project. 

Then run ```cd laradock```.

When you are in the laradock folder run command ```cp env-example .env```.
This command will copy the necessary environment file for laradock.

After that run ```sudo docker-compose up -d nginx mysql```.
This will bring up a machine with nginx and mysql. For this you will have to be in sudoers group on your machine.

After running the docker instances, you can go back to root folder of project with this command ```cd ../```.

There run the command ```cp .env.example .env```. This will copy the default environment config.

Then you will need to run migrations, build css and js files and generate your app key. 
For this you will need to do that from docker workspace. Navigate to laradock folder
``` cd laradock```.
Then run the command ```sudo docker-compose exec workspace bash```. You will be connected to docker workspace and will be able to execute php commands and npm commands in terminal. 

After connecting to docker workspace bash run the command ```composer install```. This will download all framework necessary files. 

After that run the command ```php artisan key:generate```. This will generate the app key.

At this point you need to run these three commands:
    ```npm install```   
    ```npm run production``` 
    ```php artisan migrate```
Now the project is set up. To get first data you can run command
```php artisan rates:update```

## Cron

For the cron to execute every day at 4 o'clock you just need to add laravel scheduler to your crontab.

Run ```crontab -e``` choose the editor you prefer and at the end of file add this line:
```* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1```


