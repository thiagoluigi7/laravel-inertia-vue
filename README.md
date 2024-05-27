# Running

To start this application you will need docker.

1. Start docker
2. Use the command `./vendor/bin/sail up` to start all the containers need by the application
3. Use the command `./vendor/bin/sail npm run dev` to start the frontend part of the application
4. Now just go to [localhost](http://localhost/)

This docker compose file was provided by the Laravel team so it has more services than it is used on this project.

# Stack

This project uses Laravel 11 + InertiaJs + Vue
