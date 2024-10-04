<?php
namespace Regivaldo\Videos\Controllers\Panel\Videos;

use Regivaldo\Videos\Helpers\Template\Loader;

class Videos
{
    protected Loader $template;

    public function __construct() {
        $this->template = new Loader();
    }

    public function execute()
    {   
        $this->template->render('panel/videos', true);
    }

}