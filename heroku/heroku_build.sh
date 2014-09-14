#!/bin/bash
if [ -z $BUILD_DIR -a -z $SOURCE_DIR ] ; then
   echo "You need to specify the BUILD_DIR and SOURCE_DIR environment variable."
   exit 1
fi

mkdir $BUILD_DIR

echo "Heroku build... copying files from $SOURCE_DIR to $BUILD_DIR"
cp -r $SOURCE_DIR/php $BUILD_DIR
cp -r $SOURCE_DIR/lib $BUILD_DIR
cp -r $SOURCE_DIR/vendor $BUILD_DIR
cp -r $SOURCE_DIR/resources $BUILD_DIR
cp -r $SOURCE_DIR/presentation $BUILD_DIR
cp -r $SOURCE_DIR/gispunkt $BUILD_DIR
cp -r $SOURCE_DIR/idw $BUILD_DIR
cp -r $SOURCE_DIR/fossgis $BUILD_DIR
cp -r $SOURCE_DIR/offline $BUILD_DIR
cp -r $SOURCE_DIR/siemens $BUILD_DIR
cp -r $SOURCE_DIR/swisscom $BUILD_DIR
cp -r $SOURCE_DIR/akzente $BUILD_DIR
cp -r $SOURCE_DIR/itg $BUILD_DIR
cp -r $SOURCE_DIR/webteam $BUILD_DIR
cp -r $SOURCE_DIR/proposals $BUILD_DIR
cp -r $SOURCE_DIR/*.php $BUILD_DIR
cp -r $SOURCE_DIR/*.html $BUILD_DIR
cp -r $SOURCE_DIR/*.pdf $BUILD_DIR
cp -r $SOURCE_DIR/.htaccess $BUILD_DIR

