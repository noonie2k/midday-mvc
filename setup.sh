#!/bin/bash

library_path=$1
if [ -z "$library_path" ]; then library_path="vendor/midday-mvc"; fi

# App Paths
mkdir -p app/{config,controllers,views/{layouts,scripts},public/{css,img,js}}
cp -r ${library_path}/app/views/layouts/* app/views/layouts/
cp -r ${library_path}/app/views/scripts/* app/views/scripts/
cp -r ${library_path}/app/controllers/* app/controllers/

# Library Paths
if [ -z library ]; then mkdir library; fi
rm -rf library/Midday && ln -s ${library_path}/library/Midday library/Midday

# Root Paths
rm -f index.php && ln -s ${library_path}/index.php .
rm -f .htaccess && ln -s ${library_path}/.htaccess .
