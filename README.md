# flickr-gallery

A simple gallery web-application that queries flickr for a set of images matching a given search term.

It contains a few handy tools in addition to the gallery app, including:
* "autoloader" files are generated with ./generate-loader.sh (surprisingly this turned out to be MUCH faster than composer's autoloader)
* ./build.sh runs the above, compiles .less files and runs unit tests - Quite handy for practising TDD by running `watch -n 1 ./build.sh` You will know as soon as you break one of your tests! ;)
