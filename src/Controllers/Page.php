<?php

namespace Example\Controllers;

use Http\Response;
use Example\Template\FrontendRenderer;
use Example\Page\PageReader;
use Example\Page\InvalidPageException;

class Page
{
  private $response;
  private $FrontendRenderer;
  private $pageReader;

  public function __construct(Response $response,FrontendRenderer $FrontendRenderer,PageReader $pageReader)
  {
    $this->response = $response;
    $this->FrontendRenderer = $FrontendRenderer;
    $this->pageReader = $pageReader;
  }
  public function show($params)
  {
    $slug = $params['slug'];
    try {
        $data['content'] = $this->pageReader->readBySlug($slug);
    } catch (InvalidPageException $e) {
        $this->response->setStatusCode(404);
        return $this->response->setContent('404 - Page not found');
    }

    $html = $this->FrontendRenderer->render('Page', $data);
    $this->response->setContent($html);
  }
}

?>
