## Installation

> Before anything, you need to make sure you have Docker properly setup in your environment. For that, refer to the official documentation for both [Docker](https://docs.docker.com/) and [Docker Compose](https://docs.docker.com/compose/). Also, if you're developing on Mac or Windows – *yeah, maybe that's the case* –, make sure you have [Docker Machine](https://docs.docker.com/machine/) properly setup.

> This project depends on having [jwilder/nginx-proxy](https://github.com/jwilder/nginx-proxy) running. This is a reverse proxy container that will allow having multiple projects running on port 80.

Clone this project into the local directory structure
```bash
git clone https://github.com/shahvaibhav2205/bluestarsports-symfony-app.git <new-directory-name>
```

Cd into the directory.

Run composer to get all the dependencies up and running.
```bash
composer install
```

Build and run the containers:
```bash
docker-compose up -d --build
```

This application will be accessed by port 81. You can update you `/etc/hosts` with: 
```
127.0.0.1   symfony.app
```
To run the application go to: symfony.app:81

Add this schema to the database, configure the database crendentials properly.
```bash
mysql -u dbuser -pdbpass -D dbname -h 127.0.0.1 < db.sql
```


Once that's done, you should be able to access the application on the IP that docker (or Docker Machine, or at symfony.dev:81) is running at.
