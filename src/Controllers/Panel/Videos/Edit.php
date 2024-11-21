<?php
namespace Regivaldo\Videos\Controllers\Panel\Videos;

use Regivaldo\Videos\Helpers\Template\Loader;

class Edit
{
    protected Loader $template;

    public function __construct() {
        $this->template = new Loader();
    }

    public function execute()
    {   
        $this->template->render('panel/videosEdit', true);
    }

}