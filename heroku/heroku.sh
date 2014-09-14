#!/bin/bash
if [[ $TRAVIS_SECURE_ENV_VARS == "false" ]] ; then
    DEPLOY="false"
fi

echo "=> on branch $TRAVIS_BRANCH"
if [[ $TRAVIS_BRANCH != "master" ]] ; then
    DEPLOY="false"
fi


if [[ $DEPLOY == "true" ]] ; then
    if [ -z $BUILD_DIR -a -z $TRAVIS_BUILD_DIR ] ; then
       echo "You need to specify the BUILD_DIR and TRAVIS_BUILD_DIR environment variable."
       exit 1
    fi

    export SOURCE_DIR=$TRAVIS_BUILD_DIR

    yes | ruby $TRAVIS_BUILD_DIR/heroku/heroku_prepare.rb
    bash $TRAVIS_BUILD_DIR/heroku/heroku_keys.sh
    bash $TRAVIS_BUILD_DIR/heroku/heroku_build.sh
    cd $BUILD_DIR
    bash $TRAVIS_BUILD_DIR/heroku/heroku_add.sh >/dev/null
    bash $TRAVIS_BUILD_DIR/heroku/heroku_push.sh
else
    echo "Omitting deployment to heroku"
fi
