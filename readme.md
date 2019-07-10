<p align="center">
   <img src="https://laravel.com/assets/img/components/logo-laravel.svg">
</p>
<p align="center">
   <img src="https://www.docker.com/sites/default/files/social/docker_facebook_share.png">
</p>

## What is Docker?
- Docker is a tool designed to make it easier to create, deploy, and run applications by using containers. Containers allow a developer to package up an application with all of the parts it needs, such as libraries and other dependencies, and ship it all out as one package.

## Why Using Docker?
- Simple answer is because : 
    - docker is easy to use.
    - will work on any enviroment.
    - easy to maintain.
    - isolated, dependencies or settings within a container will not affect any installations or configurations on your computer.

## Getting Started
- Before starting you need to have these tools installed **Docker Desktop** and **Git**.

## Installing Docker
- Register at [Docker Website](https://hub.docker.com/signup).
- Download Docker Desktop [For Mac](https://hub.docker.com/editions/community/docker-ce-desktop-mac).
- Download Docker Desktop [For Windows](https://hub.docker.com/editions/community/docker-ce-desktop-windows).
- Download Docker Desktop [For Linux](https://hub.docker.com/search?q=&type=edition&offering=enterprise&operating_system=linux).
- Install as usual.

## Installing Git
- Downlod [Git](https://git-scm.com/downloads) and install.

## Set up WebServer using Docker
1. Open git bash.
    -
    <img src="https://i.ibb.co/fvn79k2/git-bsh.png">
    
2. Git clone [smart_certificate](https://github.com/itsdakmar/smart_certificate.git)
    - 
        ```
        git clone https://github.com/itsdakmar/smart_certificate.git
        ```
3. Enter project directory and update git submodule
    - 
        ```
        cd smart_certificate
        git submodule update 
        ```
4. Enter Laradock Directory and copy env file
   - 
        ```
        cd laradock
        cp env-example .env
        ```
5. Then, run docker-compose 
   - 
        ```
        docker-compose up -d nginx mysql phpmyadmin
        ```
   - Smart certificate will be using nginx as web server , mysql as database and phpmyadmin for database management.
   - For first time compose up will took some time. Because docker need to download images from [Docker Hub](https://hub.docker.com/)
   
6. After docker finish up download all images. You need to ssh into docker container that we just created to run composer and migration.
   -
        ```
       docker-compose exec workspace bash
        ```
   - Now Your inside docker container. just run composer install and migration as usual.
   
        ```
       php composer install
       php artisan migrate --seed
       php artisan key:generate
       npm install
        ```
   - Done.
 
 ## System Url
   <table>
    <tr>
       <td>Project Url</td>
       <td>http://localhost</td>
    </tr> 
    <tr>
       <td>PhpMyAdmin</td>
       <td>http://localhost:8080</td>
    </tr> 
   </table>
   
   ## References
   - [Docker Docs](https://docs.docker.com/)
   - [Laradock Docs](https://laradock.io/documentation/)
   - [Laravel Docs](https://laravel.com/docs/5.8)
   
