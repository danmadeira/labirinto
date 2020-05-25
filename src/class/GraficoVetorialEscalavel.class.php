<?php

class GraficoVetorialEscalavel
{
    
    public function xml10($standalone = 'no')
    {
        return '<?xml version="1.0" standalone="' . $standalone . '"?>' . PHP_EOL;
    }
    
    public function dtd()
    {
        return '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">' . PHP_EOL;
    }
    
    public function svg11($content, $width = 1366, $height = 768, $viewbox = '')
    {
        if(!empty($viewbox)) {
            $viewbox = ' viewBox="' . $viewbox . '"';
        }
        
        return '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="' . $width . '" height="' . $height . '"' . $viewbox . '>' . PHP_EOL . $content . PHP_EOL . '</svg>';
    }
    
    public function definicao($content)
    {
        return '<defs>' . $content . '</defs>';
    }
    
    public function grupo($content, $id = '', $fill = 'none', $transform = '')
    {
        if (!empty($id)) {
            $id = ' id="' . $id . '"';
        }
        if (!empty($transform)) {
            $transform = ' transform="' . $transform . '"';
        }
        
        return '<g' . $id . ' fill="' . $fill . '"' . $transform . '>' . PHP_EOL . $content . PHP_EOL . '</g>' . PHP_EOL;
    }
    
    public function texto($x, $y, $content, $style = '')
    {
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        
        return '<text x="' . $x . '" y="' . $y . '"' . $style . '>' . $content . '</text>' . PHP_EOL;
    }
    
    // <color> = white = rgb(255,255,255) = rgb(100%,100%,100%) = #fff = #ffffff
    // <color> = black blue brown coral cyan gold grey green indigo lavender lime
    //           magenta maroon navy olive orange orchid tomato pink purple red
    //           salmon silver violet white yellow
    // fill= none | <color> | inherit
    // stroke= none | <color> | inherit
    // stroke-width= <percentage> | <length> | inherit
    // stroke-linecap= butt | round | square | inherit
    // stroke-linejoin= miter | round | bevel | inherit
    public function retangulo($x, $y, $width, $height, $rx = '', $ry = '', $fill = 'none', $stroke = 'black', $strokewidth = '', $strokelinecap = '', $strokelinejoin = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($rx)) {
            $rx = ' rx="' . $rx . '"';
        }
        if (!empty($ry)) {
            $ry = ' ry="' . $ry . '"';
        }
        if (!empty($strokewidth)) {
            $strokewidth = ' stroke-width="' . $strokewidth . '"';
        }
        if (!empty($strokelinecap)) {
            $strokelinecap = ' stroke-linecap="' . $strokelinecap . '"';
        }
        if (!empty($strokelinejoin)) {
            $strokelinejoin = ' stroke-linejoin="' . $strokelinejoin . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        if (!empty($transform)) {
            $transform = ' transform="' . $transform . '"';
        }
        
        return '<rect x="' . $x . '" y="' . $y . '" width="' . $width . '" height="' . $height . '"' . $rx . $ry . ' fill="' . $fill . '" stroke="' . $stroke . '"' . $strokewidth . $strokelinecap . $strokelinejoin . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    public function circulo($cx, $cy, $r, $fill = 'none', $stroke = 'black', $strokewidth = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($strokewidth)) {
            $strokewidth = ' stroke-width="' . $strokewidth . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        if (!empty($transform)) {
            $transform = ' transform="' . $transform . '"';
        }
        
        return '<circle cx="' . $cx . '" cy="' . $cy . '" r="' . $r . '" fill="' . $fill . '" stroke="' . $stroke . '"' . $strokewidth . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    public function elipse($cx, $cy, $rx, $ry, $fill = 'none', $stroke = 'black', $strokewidth = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($strokewidth)) {
            $strokewidth = ' stroke-width="' . $strokewidth . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        if (!empty($transform)) {
            $transform = ' transform="' . $transform . '"';
        }
        
        return '<ellipse cx="' . $cx . '" cy="' . $cy . '" rx="' . $rx . '" ry="' . $ry . '" fill="' . $fill . '" stroke="' . $stroke . '"' . $strokewidth . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    public function linha($x1, $y1, $x2, $y2, $strokewidth, $class = '', $style = '', $transform = '')
    {
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        if (!empty($transform)) {
            $transform = ' transform="' . $transform . '"';
        }
        
        return '<line x1="' . $x1 . '" y1="' . $y1 . '" x2="' . $x2 . '" y2="' . $y2 . '" stroke-width="' . $strokewidth . '"' . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    public function polilinha($points, $fill = 'none', $stroke = 'black', $strokewidth = '1', $strokelinecap = '', $strokelinejoin = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($strokelinecap)) {
            $strokelinecap = ' stroke-linecap="' . $strokelinecap . '"';
        }
        if (!empty($strokelinejoin)) {
            $strokelinejoin = ' stroke-linejoin="' . $strokelinejoin . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        if (!empty($transform)) {
            $transform = ' transform="' . $transform . '"';
        }
        
        return '<polyline points="' . $points . '" fill="' . $fill . '" stroke="' . $stroke . '" stroke-width="' . $strokewidth . '"' . $strokelinecap . $strokelinejoin . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    public function poligono($points, $fill = 'none', $stroke = 'black', $strokewidth = '1', $strokelinecap = '', $strokelinejoin = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($strokelinecap)) {
            $strokelinecap = ' stroke-linecap="' . $strokelinecap . '"';
        }
        if (!empty($strokelinejoin)) {
            $strokelinejoin = ' stroke-linejoin="' . $strokelinejoin . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        if (!empty($transform)) {
            $transform = ' transform="' . $transform . '"';
        }
        
        return '<polygon points="' . $points . '" fill="' . $fill . '" stroke="' . $stroke . '" stroke-width="' . $strokewidth . '"' . $strokelinecap . $strokelinejoin . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    // x="200" y="200" width="100px" height="100px" xlink:href="myimage.png"
    // preserveAspectRatio= none | xMinYMin | xMidYMin | xMaxYMin
    //                           | xMinYMid | xMidYMid (the default) | xMaxYMid
    //                           | xMinYMax | xMidYMax | xMaxYMax
    //                      meet | slice
    public function imagem($x, $y, $width, $height, $xlinkhref, $preserveaspectratio = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($preserveaspectratio)) {
            $preserveaspectratio = ' preserveAspectRatio="' . $preserveaspectratio . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        if (!empty($transform)) {
            $transform = ' transform="' . $transform . '"';
        }
        
        return '<image x="' . $x . '" y="' . $y . '" width="' . $width . '" height="' . $height . '" xlink:href="' . $xlinkhref . '"' . $preserveaspectratio . $class . $style . $transform . '></image>' . PHP_EOL;
    }
    
    // $stops = array(array("offset" => '50%', "stop-color" => 'red', "stop-opacity" => '1'));
    // gradientUnits = "userSpaceOnUse | objectBoundingBox"
    // spreadMethod = "pad | reflect | repeat"
    public function gradienteLinear($stops, $id = '', $gradientunits = '', $gradienttransform = '', $x1 = '', $y1 = '', $x2 = '', $y2 = '', $spreadmethod = '', $class = '', $style = '')
    {
        if (!empty($id)) {
            $id = ' id="' . $id . '"';
        }
        if (!empty($gradientunits)) {
            $gradientunits = ' gradientUnits="' . $gradientunits . '"';
        }
        if (!empty($gradienttransform)) {
            $gradienttransform = ' gradientTransform="' . $gradienttransform . '"';
        }
        if (!empty($x1)) {
            $x1 = ' x1="' . $x1 . '"';
        }
        if (!empty($y1)) {
            $y1 = ' y1="' . $y1 . '"';
        }
        if (!empty($x2)) {
            $x2 = ' x2="' . $x2 . '"';
        }
        if (!empty($y2)) {
            $y2 = ' y2="' . $y2 . '"';
        }
        if (!empty($spreadmethod)) {
            $spreadmethod = ' spreadMethod="' . $spreadmethod . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        
        $paradas = '';
        foreach ($stops as $stop) {
            $paradas .= '<stop offset="' . $stop["offset"] . '" stop-color="' . $stop["stop-color"] . '" stop-opacity="' . $stop["stop-opacity"] . '" />';
        }
        
        return '<linearGradient' . $id . $gradientunits . $gradienttransform . $x1 . $y1 . $x2 . $y2 . $spreadmethod . '>' . $paradas . '</linearGradient>' . PHP_EOL;
    }
    
    // $stops = array(array("offset" => '50%', "stop-color" => 'red', "stop-opacity" => '1'));
    // gradientUnits = "userSpaceOnUse | objectBoundingBox"
    // spreadMethod = "pad | reflect | repeat"
    public function gradienteRadial($stops, $id = '', $gradientunits = '', $gradienttransform = '', $cx = '', $cy = '', $r = '', $fx = '', $fy = '', $spreadmethod = '', $class = '', $style = '')
    {
        if (!empty($id)) {
            $id = ' id="' . $id . '"';
        }
        if (!empty($gradientunits)) {
            $gradientunits = ' gradientUnits="' . $gradientunits . '"';
        }
        if (!empty($gradienttransform)) {
            $gradienttransform = ' gradientTransform="' . $gradienttransform . '"';
        }
        if (!empty($cx)) {
            $cx = ' cx="' . $cx . '"';
        }
        if (!empty($cy)) {
            $cy = ' cy="' . $cy . '"';
        }
        if (!empty($r)) {
            $r = ' r="' . $r . '"';
        }
        if (!empty($fx)) {
            $fx = ' fx="' . $fx . '"';
        }
        if (!empty($fy)) {
            $fy = ' fy="' . $fy . '"';
        }
        if (!empty($spreadmethod)) {
            $spreadmethod = ' spreadMethod="' . $spreadmethod . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        
        $paradas = '';
        foreach ($stops as $stop) {
            $paradas .= '<stop offset="' . $stop["offset"] . '" stop-color="' . $stop["stop-color"] . '" stop-opacity="' . $stop["stop-opacity"] . '" />';
        }
        
        return '<radialGradient' . $id . $gradientunits . $gradienttransform . $cx . $cy . $r . $fx . $fy . $spreadmethod . '>' . $paradas . '</radialGradient>' . PHP_EOL;
    }
    
}

