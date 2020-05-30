<?php

/**
 * Uma classe para construir os elementos gráficos do SVG versão 1.1, na gramática XML.
 * Cada função retorna um elemento SVG, container ou gráfico, com os respectivos atributos.
 */
class GraficoVetorialEscalavel
{
    
    public function xml10($standalone = 'no', $encoding = 'UTF-8')
    {
        if (!empty($standalone)) {
            $standalone = ' standalone="' . $standalone . '"';
        }
        if (!empty($encoding)) {
            $encoding = ' encoding="' . $encoding . '"';
        }
        
        return '<?xml version="1.0"' . $encoding . $standalone . '?>' . PHP_EOL;
    }
    
    public function dtd()
    {
        return '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">' . PHP_EOL;
    }
    
    // x = "<coordinate>"
    // y = "<coordinate>"
    // width = "<length>"
    // height = "<length>"
    // viewBox = "<min-x> <min-y> <width> <height>"
    // preserveAspectRatio="none | xMinYMin | xMidYMin | xMaxYMin
    //                           | xMinYMid | xMidYMid | xMaxYMid
    //                           | xMinYMax | xMidYMax | xMaxYMax
    //                      meet | slice"
    // version = "<number>"
    // baseProfile = profile-name
    // contentScriptType = "content-type"
    // contentStyleType = "content-type" 
    // zoomAndPan = "disable | magnify"
    public function svg11($content, $width = 1366, $height = 768, $viewbox = '', $preserveaspectratio = '')
    {
        if (!empty($viewbox)) {
            $viewbox = ' viewBox="' . $viewbox . '"';
        }
        if (!empty($preserveaspectratio)) {
            $preserveaspectratio = ' preserveAspectRatio="' . $preserveaspectratio . '"';
        }
        
        return '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="' . $width . '" height="' . $height . '"' . $viewbox . $preserveaspectratio . '>' . PHP_EOL . $content . PHP_EOL . '</svg>';
    }
    
    public function titulo($content)
    {
        return '<title>' . $content . '</title>' . PHP_EOL;
    }
    
    public function descricao($content)
    {
        return '<desc>' . $content . '</desc>' . PHP_EOL;
    }
    
    public function definicao($content, $presentation = '', $class = '', $style = '', $transform = '')
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<defs' . $attributes . $class . $style . $transform . '>' . $content . '</defs>';
    }
    
    public function grupo($content, $id = '', $presentation = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($id)) {
            $id = ' id="' . $id . '"';
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<g' . $id . $attributes . $class . $style . $transform . '>' . PHP_EOL . $content . PHP_EOL . '</g>' . PHP_EOL;
    }
    
    // viewBox = "<min-x> <min-y> <width> <height>"
    // preserveAspectRatio="none | xMinYMin | xMidYMin | xMaxYMin
    //                           | xMinYMid | xMidYMid | xMaxYMid
    //                           | xMinYMax | xMidYMax | xMaxYMax
    //                      meet | slice"
    public function simbolo($content, $id = '', $presentation = '', $class = '', $style = '', $preserveaspectratio = '', $viewbox = '')
    {
        if (!empty($id)) {
            $id = ' id="' . $id . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        if (!empty($preserveaspectratio)) {
            $preserveaspectratio = ' preserveAspectRatio="' . $preserveaspectratio . '"';
        }
        if (!empty($viewbox)) {
            $viewbox = ' viewBox="' . $viewbox . '"';
        }
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<symbol' . $id . $attributes . $class . $style . $preserveaspectratio . $viewbox . '>' . PHP_EOL . $content . PHP_EOL . '</symbol>' . PHP_EOL;
    }
    
    // x = "<coordinate>"
    // y = "<coordinate>"
    // width = "<length>"
    // height = "<length>"
    // xlink:href = "<iri>"
    public function uso($xlinkhref, $x = '', $y = '', $width = '', $height = '', $presentation = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($x)) {
            $x = ' x="' . $x . '"';
        }
        if (!empty($y)) {
            $y = ' y="' . $y . '"';
        }
        if (!empty($width)) {
            $width = ' width="' . $width . '"';
        }
        if (!empty($height)) {
            $height = ' height="' . $height . '"';
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<use xlink:href="' . $xlinkhref . '"' . $x . $y . $width . $height . $attributes . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    // d = "path data"
    // pathLength = "<number>"
    public function caminho($d, $id = '', $pathlength = '', $presentation = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($id)) {
            $id = ' id="' . $id . '"';
        }
        if (!empty($pathlength)) {
            $pathlength = ' pathLength="' . $pathlength . '"';
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<path' . $id . ' d="' . $d . '"' . $pathlength . $attributes . $class . $style . $transform . ' />';
    }
    
    // <color> = white = rgb(255,255,255) = rgb(100%,100%,100%) = #fff = #ffffff
    // <color> = black blue brown coral cyan gold grey green indigo lavender lime
    //           magenta maroon navy olive orange orchid tomato pink purple red
    //           salmon silver violet white yellow
    // text-anchor = "start | middle | end | inherit"
    // fill = "<paint>"
    // fill-rule = "nonzero | evenodd | inherit"
    // fill-opacity = "<opacity-value> | inherit"
    // stroke = "<paint>"
    // stroke-width = "<percentage> | <length> | inherit"
    // stroke-linecap = "butt | round | square | inherit"
    // stroke-linejoin = "miter | round | bevel | inherit"
    // stroke-miterlimit = "<miterlimit> | inherit"
    // stroke-dasharray = "none | <dasharray> | inherit"
    // stroke-dashoffset = "<percentage> | <length> | inherit"
    // stroke-opacity = "<opacity-value> | inherit"
    // stop-opacity = "<opacity-value> | inherit"
    // opacity = "<opacity-value> | inherit>
    // color = "<color> | inherit"
    // stop-color = "currentColor | <color> <icccolor> | inherit"
    // font-family = "<family-name>"
    // font-style = "normal | italic | oblique | inherit"
    // font-variant = "normal | small-caps | inherit"
    // font-weight = "normal | bold | bolder | lighter | 100 | 200 | 300 | 400 | 500 | 600 | 700 | 800 | 900 | inherit"
    // font-stretch = "normal | wider | narrower | ultra-condensed | extra-condensed | condensed | semi-condensed | semi-expanded | expanded | extra-expanded | ultra-expanded | inherit"
    // font-size = "<absolute-size> | <relative-size> | <length> | <percentage> | inherit"
    // font-size-adjust = "<number> | none | inherit"
    // font = "[ [ <'font-style'> || <'font-variant'> || <'font-weight'> ]? <'font-size'> [ / <'line-height'> ]? <'font-family'> ] | caption | icon | menu | message-box | small-caption | status-bar | inherit"
    // kerning = "auto | <length> | inherit"
    // letter-spacing = "normal | <length> | inherit"
    // word-spacing = "normal | <length> | inherit"
    // text-decoration = "none | [ underline || overline || line-through || blink ] | inherit"
    private function obterAtributosApresentacao($presentation)
    {
        $attributes = '';
        if (!empty($presentation) and is_array($presentation)) {
            if (array_key_exists("text-anchor", $presentation)) {
                $attributes .= ' text-anchor="' . $presentation["text-anchor"] . '"';
            }
            if (array_key_exists("fill", $presentation)) {
                $attributes .= ' fill="' . $presentation["fill"] . '"';
            }
            if (array_key_exists("fill-rule", $presentation)) {
                $attributes .= ' fill-rule="' . $presentation["fill-rule"] . '"';
            }
            if (array_key_exists("fill-opacity", $presentation)) {
                $attributes .= ' fill-opacity="' . $presentation["fill-opacity"] . '"';
            }
            if (array_key_exists("stroke", $presentation)) {
                $attributes .= ' stroke="' . $presentation["stroke"] . '"';
            }
            if (array_key_exists("stroke-width", $presentation)) {
                $attributes .= ' stroke-width="' . $presentation["stroke-width"] . '"';
            }
            if (array_key_exists("stroke-linecap", $presentation)) {
                $attributes .= ' stroke-linecap="' . $presentation["stroke-linecap"] . '"';
            }
            if (array_key_exists("stroke-linejoin", $presentation)) {
                $attributes .= ' stroke-linejoin="' . $presentation["stroke-linejoin"] . '"';
            }
            if (array_key_exists("stroke-miterlimit", $presentation)) {
                $attributes .= ' stroke-miterlimit="' . $presentation["stroke-miterlimit"] . '"';
            }
            if (array_key_exists("stroke-dasharray", $presentation)) {
                $attributes .= ' stroke-dasharray="' . $presentation["stroke-dasharray"] . '"';
            }
            if (array_key_exists("stroke-dashoffset", $presentation)) {
                $attributes .= ' stroke-dashoffset="' . $presentation["stroke-dashoffset"] . '"';
            }
            if (array_key_exists("stroke-opacity", $presentation)) {
                $attributes .= ' stroke-opacity="' . $presentation["stroke-opacity"] . '"';
            }
            if (array_key_exists("stop-opacity", $presentation)) {
                $attributes .= ' stop-opacity="' . $presentation["stop-opacity"] . '"';
            }
            if (array_key_exists("opacity", $presentation)) {
                $attributes .= ' opacity="' . $presentation["opacity"] . '"';
            }
            if (array_key_exists("stop-color", $presentation)) {
                $attributes .= ' stop-color="' . $presentation["stop-color"] . '"';
            }
            if (array_key_exists("color", $presentation)) {
                $attributes .= ' color="' . $presentation["color"] . '"';
            }
            if (array_key_exists("font-family", $presentation)) {
                $attributes .= ' font-family="' . $presentation["font-family"] . '"';
            }
            if (array_key_exists("font-style", $presentation)) {
                $attributes .= ' font-style="' . $presentation["font-style"] . '"';
            }
            if (array_key_exists("font-variant", $presentation)) {
                $attributes .= ' font-variant="' . $presentation["font-variant"] . '"';
            }
            if (array_key_exists("font-weight", $presentation)) {
                $attributes .= ' font-weight="' . $presentation["font-weight"] . '"';
            }
            if (array_key_exists("font-stretch", $presentation)) {
                $attributes .= ' font-stretch="' . $presentation["font-stretch"] . '"';
            }
            if (array_key_exists("font-size", $presentation)) {
                $attributes .= ' font-size="' . $presentation["font-size"] . '"';
            }
            if (array_key_exists("font-size-adjust", $presentation)) {
                $attributes .= ' font-size-adjust="' . $presentation["font-size-adjust"] . '"';
            }
            if (array_key_exists("font", $presentation)) {
                $attributes .= ' font="' . $presentation["font"] . '"';
            }
            if (array_key_exists("kerning", $presentation)) {
                $attributes .= ' kerning="' . $presentation["kerning"] . '"';
            }
            if (array_key_exists("letter-spacing", $presentation)) {
                $attributes .= ' letter-spacing="' . $presentation["letter-spacing"] . '"';
            }
            if (array_key_exists("word-spacing", $presentation)) {
                $attributes .= ' word-spacing="' . $presentation["word-spacing"] . '"';
            }
            if (array_key_exists("text-decoration", $presentation)) {
                $attributes .= ' text-decoration="' . $presentation["text-decoration"] . '"';
            }
        }
        
        return $attributes;
    }
    
    // x = "<list-of-coordinates>"
    // y = "<list-of-coordinates>"
    // dx = "<list-of-lengths>"
    // dy = "<list-of-lengths>"
    // rotate = "<list-of-numbers>"
    // textLength = "<length>"
    // lengthAdjust = "spacing | spacingAndGlyphs"
    public function texto($x, $y, $content, $dx, $dy, $rotate = '', $textlength = '', $lengthadjust = '', $presentation = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($dx)) {
            $dx = ' dx="' . $dx . '"';
        }
        if (!empty($dy)) {
            $dy = ' dy="' . $dy . '"';
        }
        if (!empty($rotate)) {
            $rotate = ' rotate="' . $rotate . '"';
        }
        if (!empty($textlength)) {
            $textlength = ' textLength="' . $textlength . '"';
        }
        if (!empty($lengthadjust)) {
            $lengthadjust = ' lengthAdjust="' . $lengthadjust . '"';
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<text x="' . $x . '" y="' . $y . '"' . $dx . $dy . $rotate . $textlength . $lengthadjust . $attributes . $class . $style . $transform . '>' . $content . '</text>' . PHP_EOL;
    }
    
    // x = "<list-of-coordinates>"
    // y = "<list-of-coordinates>"
    // dx = "<list-of-lengths>"
    // dy = "<list-of-lengths>"
    // rotate = "<list-of-numbers>"
    // textLength = "<length>"
    // lengthAdjust = "spacing|spacingAndGlyphs"
    public function textoAjustado($content, $x = '', $y = '', $dx = '', $dy = '', $rotate = '', $textlength = '', $lengthadjust = '', $presentation = '', $class = '', $style = '')
    {
        if (!empty($x)) {
            $x = ' x="' . $x . '"';
        }
        if (!empty($y)) {
            $y = ' y="' . $y . '"';
        }
        if (!empty($dx)) {
            $dx = ' dx="' . $dx . '"';
        }
        if (!empty($dy)) {
            $dy = ' dy="' . $dy . '"';
        }
        if (!empty($rotate)) {
            $rotate = ' rotate="' . $rotate . '"';
        }
        if (!empty($textlength)) {
            $textlength = ' textLength="' . $textlength . '"';
        }
        if (!empty($lengthadjust)) {
            $lengthadjust = ' lengthAdjust="' . $lengthadjust . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<tspan' . $x . $y . $dx . $dy . $rotate . $textlength . $lengthadjust . $attributes . $class . $style . '>' . $content . '</tspan>';
    }
    
    // xlink:href = "<iri>"
    // startOffset = "<length>"
    // method = "align | stretch"
    // spacing = "auto | exact"
    public function textoCaminho($content, $xlinkhref = '', $startoffset = '', $method = '', $spacing = '', $presentation = '', $class = '', $style = '')
    {
        if (!empty($xlinkhref)) {
            $xlinkhref = ' xlink:href="' . $xlinkhref . '"';
        }
        if (!empty($startoffset)) {
            $startoffset = ' startOffset="' . $startoffset . '"';
        }
        if (!empty($method)) {
            $method = ' method="' . $method . '"';
        }
        if (!empty($spacing)) {
            $spacing = ' spacing="' . $spacing . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<textPath' . $xlinkhref . $startoffset . $method . $spacing . $attributes . $class . $style . '>' . $content . '</textPath>' . PHP_EOL;
    }
    
    // x = "<coordinate>"
    // y = "<coordinate>"
    // width = "<length>"
    // height = "<length>"
    // rx = "<length>"
    // ry = "<length>"
    public function retangulo($x = '', $y = '', $width = '', $height = '', $rx = '', $ry = '', $presentation = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($x)) {
            $x = ' x="' . $x . '"';
        }
        if (!empty($y)) {
            $y = ' y="' . $y . '"';
        }
        if (!empty($width)) {
            $width = ' width="' . $width . '"';
        }
        if (!empty($height)) {
            $height = ' height="' . $height . '"';
        }
        if (!empty($rx)) {
            $rx = ' rx="' . $rx . '"';
        }
        if (!empty($ry)) {
            $ry = ' ry="' . $ry . '"';
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<rect' . $x . $y . $width . $height . $rx . $ry . $attributes . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    // cx = "<coordinate>"
    // cy = "<coordinate>"
    // r = "<length>"
    public function circulo($cx = '', $cy = '', $r = '', $presentation = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($cx)) {
            $cx = ' cx="' . $cx . '"';
        }
        if (!empty($cy)) {
            $cy = ' cy="' . $cy . '"';
        }
        if (!empty($r)) {
            $r = ' r="' . $r . '"';
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<circle' . $cx . $cy . $r . $attributes . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    // cx = "<coordinate>"
    // cy = "<coordinate>"
    // rx = "<length>"
    // ry = "<length>"
    public function elipse($cx = '', $cy = '', $rx = '', $ry = '', $presentation = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($cx)) {
            $cx = ' cx="' . $cx . '"';
        }
        if (!empty($cy)) {
            $cy = ' cy="' . $cy . '"';
        }
        if (!empty($rx)) {
            $rx = ' rx="' . $rx . '"';
        }
        if (!empty($ry)) {
            $ry = ' ry="' . $ry . '"';
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<ellipse' . $cx . $cy . $rx . $ry . $attributes . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    // x1 = "<coordinate>"
    // y1 = "<coordinate>"
    // x2 = "<coordinate>"
    // y2 = "<coordinate>"
    public function linha($x1 = '', $y1 = '', $x2 = '', $y2 = '', $presentation = '', $class = '', $style = '', $transform = '')
    {
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
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        if (!empty($transform)) {
            $transform = ' transform="' . $transform . '"';
        }
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<line' . $x1 . $y1 . $x2 . $y2 . $attributes . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    // points = "<list-of-points>"
    public function polilinha($points, $presentation = '', $class = '', $style = '', $transform = '')
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<polyline points="' . $points . '"' . $attributes . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    // points = "<list-of-points>"
    public function poligono($points, $presentation = '', $class = '', $style = '', $transform = '')
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<polygon points="' . $points . '"' . $attributes . $class . $style . $transform . ' />' . PHP_EOL;
    }
    
    // x = "<coordinate>"
    // y = "<coordinate>"
    // width = "<length>"
    // height = "<length>"
    // xlink:href = "<iri>"
    // preserveAspectRatio= none | xMinYMin | xMidYMin | xMaxYMin
    //                           | xMinYMid | xMidYMid (the default) | xMaxYMid
    //                           | xMinYMax | xMidYMax | xMaxYMax
    //                      meet | slice
    public function imagem($xlinkhref, $x = '', $y = '', $width = '', $height = '', $preserveaspectratio = '', $presentation = '', $class = '', $style = '', $transform = '')
    {
        if (!empty($x)) {
            $x = ' x="' . $x . '"';
        }
        if (!empty($y)) {
            $y = ' y="' . $y . '"';
        }
        if (!empty($width)) {
            $width = ' width="' . $width . '"';
        }
        if (!empty($height)) {
            $height = ' height="' . $height . '"';
        }
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
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        return '<image' . $x . $y . $width . $height . '" xlink:href="' . $xlinkhref . '"' . $preserveaspectratio . $attributes . $class . $style . $transform . '></image>' . PHP_EOL;
    }
    
    // $stops = array(array("offset" => '50%', "stop-color" => 'red', "stop-opacity" => '1'));
    // x1 = "<coordinate>"
    // y1 = "<coordinate>"
    // x2 = "<coordinate>"
    // y2 = "<coordinate>"
    // gradientUnits = "userSpaceOnUse | objectBoundingBox"
    // gradientTransform = "<transform-list>"
    // spreadMethod = "pad | reflect | repeat"
    // xlink:href = "<iri>"
    public function gradienteLinear($stops, $id = '', $x1 = '', $y1 = '', $x2 = '', $y2 = '', $gradientunits = '', $gradienttransform = '', $spreadmethod = '', $xlinkhref = '', $presentation = '', $class = '', $style = '')
    {
        if (!empty($id)) {
            $id = ' id="' . $id . '"';
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
        if (!empty($gradientunits)) {
            $gradientunits = ' gradientUnits="' . $gradientunits . '"';
        }
        if (!empty($gradienttransform)) {
            $gradienttransform = ' gradientTransform="' . $gradienttransform . '"';
        }
        if (!empty($spreadmethod)) {
            $spreadmethod = ' spreadMethod="' . $spreadmethod . '"';
        }
        if (!empty($xlinkhref)) {
            $xlinkhref = ' xlink:href = "' . $xlinkhref . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        $paradas = '';
        foreach ($stops as $stop) {
            $paradas .= '<stop offset="' . $stop["offset"] . '" stop-color="' . $stop["stop-color"] . '" stop-opacity="' . $stop["stop-opacity"] . '" />';
        }
        
        return '<linearGradient' . $id . $x1 . $y1 . $x2 . $y2 . $gradientunits . $gradienttransform . $spreadmethod . $xlinkhref . $attributes . $class . $style . '>' . $paradas . '</linearGradient>' . PHP_EOL;
    }
    
    // $stops = array(array("offset" => '50%', "stop-color" => 'red', "stop-opacity" => '1'));
    // cx = "<coordinate>"
    // cy = "<coordinate>"
    // r = "<length>"
    // fx = "<coordinate>"
    // fy = "<coordinate>"
    // gradientUnits = "userSpaceOnUse | objectBoundingBox"
    // gradientTransform = "<transform-list>"
    // spreadMethod = "pad | reflect | repeat"
    // xlink:href = "<iri>"
    public function gradienteRadial($stops, $id = '', $cx = '', $cy = '', $r = '', $fx = '', $fy = '', $gradientunits = '', $gradienttransform = '', $spreadmethod = '', $xlinkhref = '', $presentation = '', $class = '', $style = '')
    {
        if (!empty($id)) {
            $id = ' id="' . $id . '"';
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
        if (!empty($gradientunits)) {
            $gradientunits = ' gradientUnits="' . $gradientunits . '"';
        }
        if (!empty($gradienttransform)) {
            $gradienttransform = ' gradientTransform="' . $gradienttransform . '"';
        }
        if (!empty($spreadmethod)) {
            $spreadmethod = ' spreadMethod="' . $spreadmethod . '"';
        }
        if (!empty($xlinkhref)) {
            $xlinkhref = ' xlink:href = "' . $xlinkhref . '"';
        }
        if (!empty($class)) {
            $class = ' class="' . $class . '"';
        }
        if (!empty($style)) {
            $style = ' style="' . $style . '"';
        }
        $attributes = $this->obterAtributosApresentacao($presentation);
        
        $paradas = '';
        foreach ($stops as $stop) {
            $paradas .= '<stop offset="' . $stop["offset"] . '" stop-color="' . $stop["stop-color"] . '" stop-opacity="' . $stop["stop-opacity"] . '" />';
        }
        
        return '<radialGradient' . $id . $cx . $cy . $r . $fx . $fy . $gradientunits . $gradienttransform . $spreadmethod . $xlinkhref . $attributes . $class . $style . '>' . $paradas . '</radialGradient>' . PHP_EOL;
    }
    
}

