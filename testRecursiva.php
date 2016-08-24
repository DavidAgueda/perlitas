<?php


echo 'test si existe la pagina <br/>';
echo 'KO http://www.exampletrezafczvafgzbzddzafae4af6a5fc1ac84a.com <br/>';
$url = 'http://www.exampletrezafczvafgzbzddzafae4af6a5fc1ac84a.com';
var_dump(@get_headers($url, 1));
echo 'OK http://www.example.com <br/>';
$url = 'http://www.example.com';
var_dump(@get_headers($url, 1));

echo 'leer los enlaces de una web<br/>';
// leer los enlaces de una web
$html = file_get_contents('http://www.frikipandi.com/');
$html = file_get_contents('http://www.elespectador.com/noticias');

 
//Create a new DOM document
$dom = new DOMDocument;

//Parse the HTML. The @ is used to suppress any parsing errors
//that will be thrown if the $html string isn't valid XHTML.
@$dom->loadHTML($html);

//Get all links. You could also use any other tag name here,
//like 'img' or 'table', to extract other tags.
$links = $dom->getElementsByTagName('a');

//Iterate over the extracted links and display their URLs
$arrayEnlaces = array();
$contador = 50;
foreach ($links as $link){
    //Extract and show the "href" attribute.
         echo $link->nodeValue .' :  ';
    echo $link->getAttribute('href'), '<br>';
	if($contador == 1){
		break;
	}
	$arrayEnlaces[] = $link->getAttribute('href');
	$contador--;
	
	
}



echo 'funcionRecursiva<br/>';
/**
 * Ejemplo de función recursiva.
 *
 * Este ejemplo, se puede realizar también con un simple for, pero para este
 * ejemplo, utilizaremos una función recursiva para que se entienda su uso
 */
function funcionRecursiva($numero)
{
    # cada vez que entra en esta función, muestra el numero que se recibe
    echo "<br>".$numero;
 
    if($numero>0)
    {
        # llamamos nuevamente esta misma función pasando como valor el numero
        # recibo menos uno.
        funcionRecursiva(--$numero);
    }
}
 
# iniciamos la función recursiva...
funcionRecursiva(10);

function functionRecursiva2($array){
	echo "<br>".array_shift($array);
	
	if (count($array)>0){
		
		functionRecursiva2($array);
	}
	
}

$stack = array("naranja", "plátano", "manzana", "frambuesa");

functionRecursiva2($stack);



function functionRecursiva3($array){
	
	global $url;
	echo "<br>" . $array[0];
	$urlx = array_shift($array);
	if($urlx[0] == '/'){
		$error404 = @get_headers($url.$urlx , 1);
	}else{
		$error404 = @get_headers($urlx , 1);
	}
	
	if($error404 !== false){
		echo " OK ";
		
	}else{
		echo " KO ";
	}
	
	if (count($array)>0){
		
		functionRecursiva3($array);
	}
	
}
functionRecursiva3($arrayEnlaces);

?>