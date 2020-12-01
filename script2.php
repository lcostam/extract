<?php
require 'vendor/autoload.php';

$opt = $_POST["opt"];


$client = new GuzzleHttp\Client();
$salarios = array();
$url = 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm';

$res = $client->request('GET', $url);


$html = (string)$res->getBody();
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
    $vigencia = $columns->item(0)->nodeValue;
    $salario = $columns->item(1)->nodeValue;
   
    if ($key>0) {
      $salarios[$key]['vigencia'] =  $vigencia;
      $salarios[$key]['salario'] = $salario;
      
    }
  }
  

  if($opt==1){
    print_r($salarios);
  }else if($opt==2){
    $salfilter = array_filter($salarios, function($sal) {
    
      return intval(explode('.', $sal['vigencia'])[2]) ==2020;
    });

    var_dump($salfilter);
  }else if($opt==3){
    $salfilter = array_filter($salarios, function($sal) {
    
      return intval(explode('.', $sal['vigencia'])[2])>=2010 &&  intval(explode('.', $sal['vigencia'])[2])<=2020;
    });

    var_dump($salfilter);
  }else{
    $salfilter = array_filter($salarios, function($sal) {
    
      return intval(explode('.', $sal['vigencia'])[2])<2010;
    });

    var_dump($salfilter);
  }

?>