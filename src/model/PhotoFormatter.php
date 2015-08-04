<?php namespace FlickrGallery\Model;

class PhotoFormatter
{
    public function getUrl(Array $photo)
    {
        $farm = $photo['farm'];
        $id = $photo['id'];
        $server = $photo['server'];
        $secret = $photo['secret'];
        return "https://farm{$farm}.staticflickr.com/{$server}/{$id}_{$secret}";
    }

    public function format(Array $photos)
    {
        $formatted = array();
        foreach ($photos as $photo) {
            $url = $this->getUrl($photo);
            $formatted[] = array(
                'thumbnail' => $url . '_q.jpg',
                'big_url' => $url . '.jpg'
            );
        }
        return $formatted;
    }

}
