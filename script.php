<?php
require 'vendor/autoload.php';
$opt = $_POST["opt"];
echo $opt;
$client = new GuzzleHttp\Client();
$salarios = array();
$url = 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm';

$res = $client->request('GET', $url);

// Send an asynchronous request.
$request = new \GuzzleHttp\Psr7\Request('GET', $url);
$promise = $client->sendAsync($request)->then(function ($response) {
  
    $html = (string)$response->getBody();
    $domDoc = new DOMDocument();
    $domHtml  = @$domDoc->loadHTML($html);
   

    $tables = $domDoc->getElementsByTagName('table');
 

  //get all rows from the table
  $rows = $tables->item(0)->getElementsByTagName('tr');

  // loop over the table rows
  foreach ($rows as $key => $row)
  {
   // get each column by tag name
      $columns = $row->getElementsByTagName('td');
      if ($key>0) {
       
        $salarios[$key]['vigencia'] = $columns->item(0)->nodeValue;
        $salarios[$key]['salario'] = $columns->item(1)->nodeValue;
      }
      

    }
   // echo $salarios;
   

});
$promise->wait();



print_r($salarios);


?>