<?php

/**
 * Esta classe constrói as paredes do labirinto.
 */
class ParedesLabirinto
{
    
    private $svg;
    private $coord;
    
    function __construct()
    {
        $this->svg = new GraficoVetorialEscalavel;
        $this->coord = new CoordenadasABCD;
    }
    
    /**
     * Constrói cada parte do cenário.
     * 
     * @param string direcao
     * @param array ['posicao' => array [0 => int, 1 => int], 'distancia' => int]
     * @param bool fundocurva
     * 
     * @return string SVG
     */
    public function construir($direcao, $locfundo, $fundocurva)
    {
        $this->svg->iniciar(LARGURA_SVG, ALTURA_SVG, true, '1.1', '', false, '', '', '', true);
        
        $this->teto();
        $this->chao();
        $this->fundo($locfundo["posicao"], $locfundo["distancia"], $fundocurva);
        $this->direita($locfundo["posicao"], $locfundo["distancia"], $direcao);
        $this->esquerda($locfundo["posicao"], $locfundo["distancia"], $direcao);
        $this->quadro();
        
        return $this->svg->obter();
        
    }
    
    /**
     * Gera a moldura da imagem SVG.
     */
    private function quadro()
    {
        $this->svg->retangulo(1, 1, (LARGURA_SVG-2), (ALTURA_SVG-2), '', '', array("fill" => CORES["quadro"]["P"], "stroke" => CORES["quadro"]["B"], "stroke-width" => 2));
    }
    
    /**
     * Gera o teto do corredor em SVG.
     */
    private function teto()
    {
        $h = ALTURA_SVG / 2 + 1;
        
        $this->svg->retangulo(1, 1, LARGURA_SVG, $h, '', '', array("fill" => CORES["teto"]["P"], "stroke" => CORES["teto"]["B"], "stroke-width" => 1));
    }
    
    /**
     * Gera o chão do corredor em SVG.
     */
    private function chao()
    {
        $y = ALTURA_SVG / 2 + 1;
        $h = ALTURA_SVG / 2 + 1;
        
        $this->svg->retangulo(1, $y, LARGURA_SVG, $h, '', '', array("fill" => CORES["chao"]["P"], "stroke" => CORES["chao"]["B"], "stroke-width" => 1));
    }
    
    /**
     * Gera a parede do fundo do corredor.
     *
     * @param array posicao [0 => int, 1 => int]
     *        int distancia
     *        bool fundocurva
     */
    private function fundo($posicao, $distancia, $fundocurva)
    {
        $l = $posicao[0];
        $c = $posicao[1];
        $valor = LABIRINTO[$l][$c];
        
        $this->quadradoFundo($distancia, $fundocurva, $valor);
    }
    
    /**
     * Gera todas as paredes direitas do corredor.
     *
     * @param array fundo [0 => int, 1 => int]
     *        int distancia
     *        string direcao
     */
    private function direita($fundo, $distancia, $direcao)
    {
        $l = $fundo[0];
        $c = $fundo[1];
        
        for ($i = 1; $i <= $distancia; $i++) {
            switch ($direcao) {
                case 'N':
                    if (LABIRINTO[$l+$i][$c+1] == PAREDE) {
                        $this->trapezioDireito($i, $distancia);
                    } else {
                        $this->retanguloDireito($i, $distancia);
                    }
                    break;
                case 'S':
                    if (LABIRINTO[$l-$i][$c-1] == PAREDE) {
                        $this->trapezioDireito($i, $distancia);
                    } else {
                        $this->retanguloDireito($i, $distancia);
                    }
                    break;
                case 'E':
                    if (LABIRINTO[$l+1][$c-$i] == PAREDE) {
                        $this->trapezioDireito($i, $distancia);
                    } else {
                        $this->retanguloDireito($i, $distancia);
                    }
                    break;
                case 'W':
                    if (LABIRINTO[$l-1][$c+$i] == PAREDE) {
                        $this->trapezioDireito($i, $distancia);
                    } else {
                        $this->retanguloDireito($i, $distancia);
                    }
                    break;
            }
        }
    }

    /**
     * Gera todas as paredes esquerdas do corredor.
     *
     * @param array fundo [0 => int, 1 => int]
     *        int distancia
     *        string direcao
     */
    private function esquerda($fundo, $distancia, $direcao)
    {
        $l = $fundo[0];
        $c = $fundo[1];
        
        for ($i = 1; $i <= $distancia; $i++) {
            switch ($direcao) {
                case 'N':
                    if (LABIRINTO[$l+$i][$c-1] == PAREDE) {
                        $this->trapezioEsquerdo($i, $distancia);
                    } else {
                        $this->retanguloEsquerdo($i, $distancia);
                    }
                    break;
                case 'S':
                    if (LABIRINTO[$l-$i][$c+1] == PAREDE) {
                        $this->trapezioEsquerdo($i, $distancia);
                    } else {
                        $this->retanguloEsquerdo($i, $distancia);
                    }
                    break;
                case 'E':
                    if (LABIRINTO[$l-1][$c-$i] == PAREDE) {
                        $this->trapezioEsquerdo($i, $distancia);
                    } else {
                        $this->retanguloEsquerdo($i, $distancia);
                    }
                    break;
                case 'W':
                    if (LABIRINTO[$l+1][$c+$i] == PAREDE) {
                        $this->trapezioEsquerdo($i, $distancia);
                    } else {
                        $this->retanguloEsquerdo($i, $distancia);
                    }
                    break;
            }
        }
    }
    
    /**
     * Gera o poligono SVG do fundo do corredor.
     *
     * @param int distancia
     *        bool fundocurva
     *        int valor
     */
    private function quadradoFundo($distancia, $fundocurva, $valor)
    {
        if ($distancia == FORA_DE_ALCANCE) {
            $preenchimento = CORES["fora"]["P"];
            $borda = CORES["fora"]["B"];
        } elseif ($valor == INICIO) {
            $preenchimento = CORES["inicio"]["P"];
            $borda = CORES["inicio"]["B"];
        } elseif ($valor == FIM) {
            $preenchimento = CORES["fim"]["P"];
            $borda = CORES["fim"]["B"];
        } elseif ($fundocurva) {
            $preenchimento = CORES["curva"]["P"];
            $borda = CORES["curva"]["B"];
        } else {
            $preenchimento = CORES["parede"]["P"];
            $borda = CORES["parede"]["B"];
        }
        
        $quadrado = $this->coord->abcdQuadrado($distancia);
        
        $pontos = $quadrado["a"]["x"] . ',' . $quadrado["a"]["y"] . ' ' .
                  $quadrado["b"]["x"] . ',' . $quadrado["b"]["y"] . ' ' .
                  $quadrado["c"]["x"] . ',' . $quadrado["c"]["y"] . ' ' .
                  $quadrado["d"]["x"] . ',' . $quadrado["d"]["y"];
        
        $this->svg->poligono($pontos, array("fill" => $preenchimento, "stroke" => $borda, "stroke-width" => 2, "stroke-linejoin" => 'bevel'));
    }
    
    /**
     * Gera o poligono SVG de uma parede direita profunda.
     *
     * @param int i
     *        int distancia
     */
    private function trapezioDireito($i, $distancia)
    {
        if ($i == $distancia) {
            $ef = ' ' . LARGURA_SVG . ',1 ' . LARGURA_SVG . ',' . ALTURA_SVG;
        } else {
            $ef = '';
        }
        
        $trapezio = $this->coord->abcdTrapezioDireito($distancia-$i);
        
        $pontos = $trapezio["a"]["x"] . ',' . $trapezio["a"]["y"] . ' ' .
                  $trapezio["b"]["x"] . ',' . $trapezio["b"]["y"] . $ef . ' ' .
                  $trapezio["c"]["x"] . ',' . $trapezio["c"]["y"] . ' ' .
                  $trapezio["d"]["x"] . ',' . $trapezio["d"]["y"];
        
        $this->svg->poligono($pontos, array("fill" => CORES["parede"]["P"], "stroke" => CORES["parede"]["B"], "stroke-width" => 2, "stroke-linejoin" => 'bevel'));
    }
    
    /**
     * Gera o poligono SVG de uma parede da curva direita.
     *
     * @param int i
     *        int distancia
     */
    private function retanguloDireito($i, $distancia)
    {
        $retangulo = $this->coord->abcdRetanguloDir($distancia-$i);
        
        $pontos = $retangulo["a"]["x"] . ',' . $retangulo["a"]["y"] . ' ' .
                  $retangulo["b"]["x"] . ',' . $retangulo["b"]["y"] . ' ' .
                  $retangulo["c"]["x"] . ',' . $retangulo["c"]["y"] . ' ' .
                  $retangulo["d"]["x"] . ',' . $retangulo["d"]["y"];
        
        $this->svg->poligono($pontos, array("fill" => CORES["curva"]["P"], "stroke" => CORES["curva"]["B"], "stroke-width" => 2, "stroke-linejoin" => 'bevel'));
    }

    /**
     * Gera o poligono SVG de uma parede esquerda profunda.
     *
     * @param int i
     *        int distancia
     */
    private function trapezioEsquerdo($i, $distancia)
    {
        if ($i == $distancia) {
            $ef = ' 0,' . ALTURA_SVG . ' 0,0';
        } else {
            $ef = '';
        }
        
        $trapezio = $this->coord->abcdTrapezioEsquerdo($distancia-$i);
        
        $pontos = $trapezio["a"]["x"] . ',' . $trapezio["a"]["y"] . ' ' .
                  $trapezio["b"]["x"] . ',' . $trapezio["b"]["y"] . ' ' .
                  $trapezio["c"]["x"] . ',' . $trapezio["c"]["y"] . ' ' .
                  $trapezio["d"]["x"] . ',' . $trapezio["d"]["y"] . $ef;
        
        $this->svg->poligono($pontos, array("fill" => CORES["parede"]["P"], "stroke" => CORES["parede"]["B"], "stroke-width" => 2, "stroke-linejoin" => 'bevel'));
    }
    
    /**
     * Gera o poligono SVG de uma parede da curva esquerda.
     *
     * @param int i
     *        int distancia
     */
    private function retanguloEsquerdo($i, $distancia)
    {
        $retangulo = $this->coord->abcdRetanguloEsq($distancia-$i);
        
        $pontos = $retangulo["a"]["x"] . ',' . $retangulo["a"]["y"] . ' ' .
                  $retangulo["b"]["x"] . ',' . $retangulo["b"]["y"] . ' ' .
                  $retangulo["c"]["x"] . ',' . $retangulo["c"]["y"] . ' ' .
                  $retangulo["d"]["x"] . ',' . $retangulo["d"]["y"];
        
        $this->svg->poligono($pontos, array("fill" => CORES["curva"]["P"], "stroke" => CORES["curva"]["B"], "stroke-width" => 2, "stroke-linejoin" => 'bevel'));
    }

}

