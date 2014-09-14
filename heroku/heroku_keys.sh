#!/bin/bash
if [ -z $TRAVIS_BUILD_DIR ] ; then
   echo "You need to specify the TRAVIS_BUILD_DIR environment variable."
   exit 1
fi

yes | heroku keys:add
heroku keys:add $TRAVIS_BUILD_DIR/ssh_pub_keys/id_rsa_odi.pub
