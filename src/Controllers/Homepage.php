<?php

namespace Example\Controllers;

use Http\Request;
use Http\Response;
use Example\Template\FrontendRenderer;

class Homepage
{
  private $request;
  private $response;
  private $FrontendRenderer;

  public function __construct(Request $request, Response $response, FrontendRenderer $FrontendRenderer)
  {
      $this->request = $request;
      $this->response = $response;
      $this->FrontendRenderer = $FrontendRenderer;
  }

  public function show()
  {
    $data = [
    'name' => $this->request->getParameter('name', 'stranger')
    ];
    $html = $this->FrontendRenderer->render('Homepage', $data);
    $this->response->setContent($html);
  }
}
?>
