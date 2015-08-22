<?php

//Establecer el tipo de contenido
include('./data.php');

header("Content-type: image/png");

if(!function_exists('imagefillalpha')) {
	function imagefillalpha(&$image, $color)
    {
		imagefilledrectangle($image, 0, 0, imagesx($image), imagesy($image), $color);
    }
}

function hex_to_rgb($hex) {
	//Eliminamos el caracter # (en caso de que exista)
	if (0 === strpos($hex, '#')) {
		$hex = substr($hex, 1);
	} else
		if (0 === strpos($hex, '&H')) {
			$hex = substr($hex, 2);
		}

	//Obtenemos los 3 valores hexadecimales
	$cutpoint = ceil(strlen($hex) / 2) - 1;
	$rgb = explode(':', wordwrap($hex, $cutpoint, ':', $cutpoint), 3);

	//Los convertimos en decimal
	$rgb[0] = (isset ($rgb[0]) ? hexdec($rgb[0]) : 0);
	$rgb[1] = (isset ($rgb[1]) ? hexdec($rgb[1]) : 0);
	$rgb[2] = (isset ($rgb[2]) ? hexdec($rgb[2]) : 0);

	return $rgb;
}

//Valores por defecto

//Color de fondo de la imagen, por defecto es blanco.
$fondo[0] = 255;
$fondo[1] = 255;
$fondo[2] = 255;
$fondo[3] = 127;

//Color de la fuente, por defecto es negro
$color[0] = 255;
$color[1] = 144;
$color[2] = 0;

//Fuente de la imagen
//$fuente = $_GET["fuente"] ? $_GET["fuente"] : "ARIAL.TTF";
$fuente = 'Qlassik_TB.ttf';

//Ancho de la imagen
//$ancho = $_GET["ancho"] ? $_GET["ancho"] : "100";
$ancho = 480;

//Alto de la imagen
//$alto = $_GET["alto"] ? $_GET["alto"] : "100";
$alto = 30;

//Tamano de la fuente
//$tamano = $_GET["tamano"] ? $_GET["tamano"] : "12";
$tamano = 18;

//Color del fondo de la imagen
//$fondo = $_GET["fondo"] ? hex_to_rgb($_GET["fondo"]) : $fondo;

//Color de fuente de la imagen
//$color = $_GET["color"] ? hex_to_rgb($_GET["color"]) : $color;

//Si la imagen es mas ancha que alta, el texto se pone de forma horizontal, de lo contrario va de forma vertical
//$angulo = $ancho >= $alto ? 0 : 90;
$angulo = 0;


$texto = get_written_data($_GET['data']);
$slug = str_replace(' ','-',mb_strtolower($texto));
$slug = str_replace("'",'',$slug);
$slug = str_replace('ç','c',$slug);
$filename = 'dates/'.$slug.'.png';
if(!file_exists($filename)) {


	if ($ancho >= $alto) {
		$angulo = 0;
		$info = imagettfbbox($tamano, $angulo, $fuente, $texto);
		$alto_texto = abs($info[7] - $info[1]);
		$ancho_texto = abs($info[2] - $info[0]);
		$x = ($ancho - $ancho_texto) / 2;
		$y = (($alto - $alto_texto) / 2) + $alto_texto;
	} else {
		$angulo = 90;
		$info = imagettfbbox($tamano, $angulo, $fuente, $texto);
		$alto_texto = abs($info[3] - $info[1]);
		$ancho_texto = abs($info[4] - $info[2]);
		$x = (($ancho - $ancho_texto) / 2) + ($ancho_texto);
		$y = (($alto - $alto_texto) / 2) + $alto_texto;
	}

	//Creamos la imagen
	$im = imagecreatetruecolor($ancho, $alto);
	imagesavealpha($im, true);
	$trans_colour = imagecolorallocatealpha($im, 0, 0, 0, 127);
	imagefill($im, 0, 0, $trans_colour);
	//Asignamos los colores de fondo
	//$fondo = imagecolorallocatealpha($im, $fondo[0], $fondo[1], $fondo[2],$fondo[3]);
	$color = imagecolorallocate($im, $color[0], $color[1], $color[2]);

	//Color de fondo de la imagen
	//imagecolortransparent($im);

	// Agregar el texto
	
	imagettftext($im, $tamano, $angulo, $x, $y, $color, $fuente, $texto);

	// Usar imagepng() resulta en texto mas claro, en comparacion con imagejpeg()
	imagepng($im,$filename);
	imagepng($im);

	imagedestroy($im);
} else {
	$im = imagecreatefrompng($filename);
	imagealphablending($im, false);
	imagesavealpha($im, true);
	imagepng($im);

	imagedestroy($im);
}
?>
