<?php
# About
# ----------------------------------------------------------
define ('APP_NAME'        , 'Ailuj');
define ('APP_VERSION'     , '0.0.1'); 
define ('APP_DESCRIPTION' , 'Generate .pov files to render Quaternion Julia Fractals');
define ('APP_AUTHOR'      , 'Yorick "twisted" Terweijden');
define ('APP_DATE'        , 'Tuesday, January 16 2007');
define ('APP_LICENSE'     , 'GPLv2');

# ----------------------------------------------------------
# Shape of the fractal
$fractal_ConstC        =	'-1,0.2,0,0';
$fractal_SLICEDIST     =	'0.1';
$fractal_max_iteration =	9;
$fractal_precision     =	800;

# ----------------------------------------------------------
# Camera position
$camera_angle          =	60;
$camera_look_at        =	'-0.2,0,0';

# ----------------------------------------------------------
# Appareance
$bg_color              =	'0,0,0';
$fractal_texture       =	'T_Brass_5C';
$fractal_rotate        =	'y*360*clock';



echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head xml:lang="en">
		<title dir="ltr" xml:lang="en">BASTARDOPERATORFROMHELL.org - <?=APP_NAME?> v<?=APP_VERSION?></title>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<style type="text/css">
		span {width: 100px; display: inline-table;}
		input {display: inline-table;}
		fieldset#povForm {width: 480px;}
		</style>
	</head>
<body>
<?
# Declare variables
# ------------------------------------------------------------
$errors = NULL;

# ------------------------------------------------------------
# Process Form

# If the form is povForm
if (array_key_exists ('povForm' , $_REQUEST)) {

  # Check errors
  if (! array_key_exists ('fractal_ConstC1' , $_REQUEST)) $errors['fractal_ConstC1'] = "ConstC is required";

  # If $errors is still NULL
  if (is_null ($errors)) {
     die (pov ($_REQUEST));
  }
}
# Display Form cuz it aint ready yet.
else {
	
# ------------------------------------------------------------
# Process the errors to screen
 if (! is_null ($errors)) { ?>
<dl class="errors">
  <dt>Errors</dt>
  <dd>
    <ul>
      <? foreach ( $errors as $key => $value ) { ?>
      <li> <?=$key?> : <?=$value?> </li>
      <? } ?>
    </ul>
   </dd>
</dl>
<? }

# ------------------------------------------------------------
# Proper XHTML Form 
?>
<form id="povForm" name="povForm" action="index.php" method="post">
  <fieldset id="povForm">
  <legend><strong><?=APP_NAME?></strong> v<?=APP_VERSION?></legend>
	Author: <?=APP_AUTHOR?><br /> 
	Description: <?=APP_DESCRIPTION?>
  <input type="hidden" name="povForm" value="TRUE" />
  <fieldset>
  <legend>Fractal:</legend>
    <label>
      <span>ConstC:</span>
      <input type="text" size="4" name="fractal_ConstC1" />,
      <input type="text" size="4" name="fractal_ConstC2" />,
      <input type="text" size="4" name="fractal_ConstC3" />,
      <input type="text" size="4" name="fractal_ConstC4" />
    </label><br />
    <label>
      <span>SLICEDIST:</span>
      <input type="text" size="4" name="fractal_SLICEDIST" />
    </label><br />
    <label>
      <span>Max Iteration:</span>
      <input type="text" size="4" name="fractal_max_iteration" />
    </label><br />
    <label>
      <span>Slice:</span>
      <input type="text" size="4" name="fractal_slice1" />,
      <input type="text" size="4" name="fractal_slice2" />,
      <input type="text" size="4" name="fractal_slice3" />,
      <input type="text" size="4" name="fractal_slice4" />
    </label><br />
    <label>
      <span>Precision:</span>
      <input type="text" size="4" name="fractal_precision" />
    </label><br />
  </fieldset>
  <fieldset>
  <legend>Camera:</legend>
    <label>
      <span>Angle:</span>
      <input type="text" size="4" name="camera_angle" />
    </label><br />
    <label>
      <span>Look At:</span>
      <input type="text" size="4" name="camera_look_at1" />,
      <input type="text" size="4" name="camera_look_at2" />,
      <input type="text" size="4" name="camera_look_at3" />
    </label><br />
  </fieldset>
  <fieldset>
  <legend>Appereance:</legend>
    <label>
      <span>BG Color:</span>
      <input type="text" size="4" name="bg_color1" />,
      <input type="text" size="4" name="bg_color2" />,
      <input type="text" size="4" name="bg_color3" />
    </label><br />
    <label>
      <span>Light Color:</span>
      <input type="text" size="4" name="light_color1" />,
      <input type="text" size="4" name="light_color2" />,
      <input type="text" size="4" name="light_color3" />
    </label><br />
    <label>
      <span>Texture:</span>
      <input type="text" name="fractal_texture" />
    </label><br />
    <label>
      <span>Rotate:</span>
      <input type="text" size="4" name="fractal_rotate1" />*
      <input type="text" size="4" name="fractal_rotate2" />*
      <input type="text" size="4" name="fractal_rotate3" />
    </label><br />
  </fieldset>
  <div class="buttons">
    <input type="submit" name="submit" value="Submit!" />
  </div>
  </fieldset>
</form>
<?
}

# ----------------------------------------------------------
# POV file
function pov ($arrayPovData) {
	
	$file = date(YdmHi);
	echo "<br />Gonna touch $file and then open it for read and write";
	
	#echo $povdata;
	return "ok";
$povdata = '
#include "golds.inc"
#include "metals.inc"
#include "finish.inc"

#declare VP = <-2,1.5,1.5>;
#declare VU = <0,1,0>;
#declare VD = vnormalize(<0,0,0> - VP);
#declare VR = vcross(VU,VD);
#declare ConstC = <'.$arrayPovData['fractal_ConstC1'].','.$arrayPovData['fractal_ConstC2'].','.$arrayPovData['fractal_ConstC3'].','.$arrayPovData['fractal_ConstC4'].'>;
#declare SLICEDIST = '. $arrayPovData['fractal_SLICEDIST'] .';

camera {
   location VP
   up y
   right x
   angle '. $arrayPovData['camera_angle'] .'
   sky VU
   look_at <'.$arrayPovData['camera_look_at1'].','.$arrayPovData['camera_look_at2'].','.$arrayPovData['camera_look_at3'].'>
}

global_settings {
   ambient_light
   rgb <1,1,1>
}

background {
   color rgb <'.$arrayPovData['bg_color1'].','.$arrayPovData['bg_color2'].','.$arrayPovData['bg_color3'].'>
}

light_source {
   VP + VU + 2*VR
   color rgb <'.$arrayPovData['light_color1'].','.$arrayPovData['light_color2'].','.$arrayPovData['light_color3'].'>
}
light_source {
   VP - VR
   color rgb <'.$arrayPovData['light_color1'].','.$arrayPovData['light_color2'].','.$arrayPovData['light_color3'].'>
}

julia_fractal {
   ConstC
   quaternion
   sqr
   max_iteration '. $arrayPovData['fractal_max_iteration'] .'
   precision '. $arrayPovData['fractal_precision'] .'
   slice <'. $arrayPovData['fractal_slice1'] .','. $arrayPovData['fractal_slice2'] .','. $arrayPovData['fractal_slice3'] .','. $arrayPovData['fractal_slice4'] .'> SLICEDIST
   texture { '. $arrayPovData['fractal_texture'] .' }
   rotate '.$arrayPovData['fractal_rotate1'].'*'.$arrayPovData['fractal_rotate2'].'*'.$arrayPovData['fractal_rotate3'].'
}';
}


# ----------------------------------------------------------
# Show source
if (array_key_exists ('show_source', $_REQUEST)) { ?>
<div style="background: #ccc; padding: 10px; margin: 0 10 0 50px;">
<? show_source('index.php'); ?>
</div>
<? } ?>
</body>
</html>