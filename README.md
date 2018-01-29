## FuelPHP

* Version: 1.8
* [Website](http://fuelphp.com/)
* [Release Documentation](http://docs.fuelphp.com)
* [Release API browser](http://api.fuelphp.com)
* [Development branch Documentation](http://dev-docs.fuelphp.com)
* [Development branch API browser](http://dev-api.fuelphp.com)
* [Support Forum](http://fuelphp.com/forums) for comments, discussion and community support

## Description

FuelPHP is a fast, lightweight PHP 5.3+ framework. In an age where frameworks are a dime a dozen, We believe that FuelPHP will stand out in the crowd.  It will do this by combining all the things you love about the great frameworks out there, while getting rid of the bad.

FuelPHP is fully PHP 7 compatible.

## Docker

```bash
$ docker-compose build
$ docker-compose up
$ php composer.phar install
```

### Create database 'ebdb'

### Run seed
```bash
docker-compose exec web php oil refine migrate -all
```


## Using Gulp for create JS an CSS

### Install nodejs and bower localy (on mac)
```bash
$ brew install node
$ npm install -g bower
```

### Install packages (run localy in root project directory)
```bash
$ npm install
$ bower install
```

### Run Gulp (watch task)
```bash
$ gulp
```

You also can use live reload server. Install extension for Chrome


## Development

### WEB Access url
HTTP: http://localhost:8080

### DB Access
DB: localhost:3340

### Mail Catcher url
HTTP: http://localhost:1080
