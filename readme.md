<p align="center">
   <img src="https://laravel.com/assets/img/components/logo-laravel.svg">
   <img src="https://www.docker.com/sites/default/files/social/docker_facebook_share.png">
</p>

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
1. Open Git
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


