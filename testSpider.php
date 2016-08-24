<?php
/* 
$url = 'http://www.elespectador.com/noticias';
getUrls_Url($url);

function getUrls_Url($url){
	$html = file_get_contents($url);

 
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
	$contador = 5;
	foreach ($links as $link){
		//Extract and show the "href" attribute.
			 // echo $link->nodeValue .' :  ';
		// echo $link->getAttribute('href'), '<br>';
		if($contador == 1){
			break;
		}
		if($link->getAttribute('href')[0] == '/'){
			$arrayEnlaces[] =  $link->getAttribute('href');
			$contador--;
		}
		
		
	}	
	$array = $arrayEnlaces;
	functionRecursiva3($array);
	
}

function functionRecursiva3($array ){
	
	echo "<br>" . $array[0];
	$urlx = array_shift($array);

		$error404 = @get_headers($urlx , 1);

	
	if($error404 !== false){
		echo " OK ";
		// getUrls_Url($url)
		
	}else{
		echo " KO ";
	}
	
	if (count($array)>0){
		
		functionRecursiva3($array);
	}
	
}
// functionRecursiva3($arrayEnlaces);


/////// recursiba que mira los directorios 
listar_directorios_ruta('../../../');

function listar_directorios_ruta($ruta){ 
   // abrir un directorio y listarlo recursivo 
   if (is_dir($ruta)) { 
      if ($dh = opendir($ruta)) { 
         while (($file = readdir($dh)) !== false) { 
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
            //mostraría tanto archivos como directorios 
            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file); 
            if (is_dir($ruta . $file) && $file!="." && $file!=".."){ 
               //solo si el archivo es un directorio, distinto que "." y ".." 
               echo "<br>Directorio: $ruta$file"; 
               listar_directorios_ruta($ruta . $file . "/"); 
            } 
         } 
      closedir($dh); 
      } 
   }else 
      echo "<br>No es ruta valida"; 
}

 */
/////// recursiba que mira los directorios 
listar_directorios_ruta('../../../',2);

function listar_directorios_ruta($ruta,$depth=0){
	// abrir un directorio y listarlo recursivo 
	if (is_dir($ruta)) {
	if ($dh = opendir($ruta)) { 
		while (($file = readdir($dh)) !== false) { 
			//esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
			//mostraría tanto archivos como directorios 
			//echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file); 
				if (is_dir($ruta . $file) && $file!="." && $file!=".."){ 
			//solo si el archivo es un directorio, distinto que "." y ".." 
				echo "<br>Directorio: $ruta$file"; 
				if($depth>1)
				listar_directorios_ruta($ruta . $file . "/",($depth-1)); 
			}
		}
			closedir($dh); 
		}
	}else 
	echo "<br>No es ruta valida"; 
}


