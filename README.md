## Description

FuelPHP (master 1.8) PHP 7.1

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

### Install japanese font for PDF output

Font family name is 'jgothic'
File path is 'public/assets/fonts/fonts-japanese-gothic.ttf'

```bash
docker-compose exec web php oil refine loadfont
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
