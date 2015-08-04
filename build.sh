#!/bin/bash
./generate-loader.sh
lessc src/view/less/gallery.less --clean-css="--s1 --advanced --compatibility=ie8" > www/css/gallery.css
phpunit
