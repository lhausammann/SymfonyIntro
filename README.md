# SymfonyIntro
Introduction to the Symfony Framework

## Docker setup

Run the Apache + PHP 8.4 container:

```zsh
docker compose up --build
```

App URL:

- http://localhost:8123

Container path mapping:

- Host project folder `./` is mounted to `/app` in the container.

## Composer in container

Use Composer to install the project dependencies inside the container. This ensures that the correct PHP version and extensions are used.

```zsh
docker compose up --build -d
docker exec -it symfony-app bash
composer install
```


Use the console to check the version
```zsh
bin/console --version
```

## Setup Twig & routes
Create a new controller:
```zsh
bin/console make:controller ExampleController
```



