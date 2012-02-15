#!/bin/sh
BASEPATH=/var/www/wp/wp-content/coltsintheme
if [ ! -d "$BASEPATH" ]; then
    mkdir $BASEPATH;
fi
cp -fR src/* $BASEPATH; 
