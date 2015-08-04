<?php
require_once(__DIR__ . '/../src/classLoader.php');
use FlickrGallery\Controller\Gallery;
use FlickrGallery\Model\PhotoSearch;
use FlickrGallery\Model\HttpsGetWrapper;
use FlickrGallery\Model\PhotoFormatter;

$search = new PhotoSearch(
    new HttpsGetWrapper(), new PhotoFormatter
);
$gallery = new Gallery($search);
$gallery->display();
