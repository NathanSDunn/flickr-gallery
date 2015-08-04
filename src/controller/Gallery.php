<?php namespace FlickrGallery\Controller;

class Gallery
{

    protected $search;

    public function __construct(\FlickrGallery\Model\PhotoSearch $search)
    {
        $this->search = $search;
    }

    private function getPage()
    {
        $page = (int) filter_input(INPUT_GET, 'page');
        if ($page === 0) {
            $page = 1;
        }
        return $page;
    }

    private function getKeyword()
    {
        $keyword = filter_input(INPUT_GET, 'keyword');
        if ($keyword === null) {
            $keyword = 'cats';
        }
        return $keyword;
    }

    private function processRequest()
    {
        $data = array();
        //input
        $data['keyword'] = $keyword = $this->getKeyword();
        $data['curr_page'] = $curr_page = $this->getPage();

        //rpc
        $results = $this->search->search($keyword, $curr_page);

        //formatting
        $data['photos'] = $results->getPhotos();
        $data['total_pages'] = $total_pages = $results->getPages();
        $data['pagination'] = $results->getPagination();

        return $data;
    }

    public function display()
    {
        echo $this->render('ShowImages.php', $this->processRequest());
    }

    public function render($template, Array $data)
    {
        extract($data);
        ob_start();
        include __DIR__ . '/../view/' . $template;
        return ob_get_clean();
    }

}
