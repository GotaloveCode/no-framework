<?php

namespace Example\Controllers;

use Http\Request;
use Http\Response;
use PDO;
use Example\Template\FrontendRenderer;

class Homepage
{
  private $request;
  private $response;
  private $pdo;
  private $FrontendRenderer;

  public function __construct(Request $request, Response $response,PDO $pdo,FrontendRenderer $FrontendRenderer)
  {
      $this->request = $request;
      $this->response = $response;
      $this->pdo = $pdo;
      $this->FrontendRenderer = $FrontendRenderer;
  }

  public function show()
  {
    $email = $this->request->getParameter('email', 'martin.iriga@masterpiecenet.co.ke');
    $stmt = $this->pdo->prepare("SELECT fullnames FROM user WHERE email=?");
    $stmt->execute(array($email));
    $rows = $stmt->rowCount();
    $name = array('name'=> 'stranger');
    if($rows>0)
    {
      $name = array('name'=> $stmt->fetchcolumn());
    }
    $data = $name;
    // $data = [
    // 'name' => $this->request->getParameter('name', 'stranger')
    // ];
    $html = $this->FrontendRenderer->render('Homepage', $data);
    $this->response->setContent($html);
  }
}
?>
