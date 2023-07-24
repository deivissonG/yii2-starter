<p align="center">
   <span>
       <a href="https://github.com/yiisoft" target="_blank">
           <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
       </a>
   </span>
</p>
<h1 align="center">Yii 2 Starter</h1>

This is an open source template for developing web applications using the Yii2 framework, with additional features like Bootstrap 5, Yii2-usuario, Docker and support for a dark mode theme. The aim of this project is to provide a solid and flexible foundation for creating modern and attractive web applications.
Features Included

- Bootstrap 5
- Dark mode theme
- Docker support
- RBAC
- User management with Yii2-usuario

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      generators/         contains gii code generators
      helpers/            contains helper classes
      mail/               contains view files for e-mails
      models/             contains model classes
      messages/           contains translations for i18n as defined in config/i18n.php
      migrations/         contains database migrations
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
      widgets/            contains widgets classes



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 8.0 or Docker engine.


INSTALLATION
------------

### Install with Docker

Start the container

    docker-compose up -d
    
You can then access the application through the following URL:

    http://localhost:8000

**NOTES:** 
- Minimum required Docker engine  for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


CONFIGURATION
-------------

Copy `.env-app-example` and `.env-db-example` to `.env-app` and `.env-db` and edit the file with your database credentials.

**NOTES:**
- The default username/password for the application is `admin` / `verysecret` as defined in migration `m230723_000000_create_admin_user.php`.


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](https://codeception.com/).
By default, there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
docker exec -rm codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

###### TODO: Add instructions for running acceptance tests