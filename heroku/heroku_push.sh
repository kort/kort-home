#!/bin/bash
APP_NAME="kort-home"

if [[ ${TRAVIS_PHP_VERSION:0:3} != "5.4" ]] ; then
    APP_NAME="$APP_NAME"`echo ${TRAVIS_PHP_VERSION:0:3} | tr '.' '-'`
fi

echo $APP_NAME | heroku apps:destroy $APP_NAME
heroku apps:create --ssh-git $APP_NAME

if [[ $APP_NAME == "kort-home" ]] ; then
    heroku domains:add www.kort.ch --app $APP_NAME
    heroku domains:add kort.ch --app $APP_NAME
fi

git push -f heroku master
