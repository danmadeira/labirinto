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
     * Gera o XML SVG completo.
     *
     * @param string SVG
     *
     * @return string SVG
     */
    public function imagem($conteudo)
    {
        return $this->svg->dtd() . $this->svg->svg11($conteudo, LARGURA_SVG, ALTURA_SVG);
    }
    
    /**
     * Gera a moldura da imagem SVG.
     *
     * @return string SVG
     */
    public function quadro()
    {
        return $this->svg->retangulo(1, 1, (LARGURA_SVG-2), (ALTURA_SVG-2), '', '', CORES["quadro"]["P"], CORES["quadro"]["B"], 2);
    }
    
    /**
     * Gera o teto do corredor em SVG.
     *
     * @return string SVG
     */
    public function teto()
    {
        $h = ALTURA_SVG / 2 + 1;
        
        return $this->svg->retangulo(1, 1, LARGURA_SVG, $h, '', '', CORES["teto"]["P"], CORES["teto"]["B"], 1);
    }
    
    /**
     * Gera o chão do corredor em SVG.
     *
     * @return string SVG
     */
    public function chao()
    {
        $y = ALTURA_SVG / 2 + 1;
        $h = ALTURA_SVG / 2 + 1;
        
        return $this->svg->retangulo(1, $y, LARGURA_SVG, $h, '', '', CORES["chao"]["P"], CORES["chao"]["B"], 1);
    }
    
    /**
     * Gera a parede do fundo do corredor.
     *
     * @param array posicao [0 => int, 1 => int]
     *        int distancia
     *        bool fundocurva
     *
     * @return string SVG
     */
    public function fundo($posicao, $distancia, $fundocurva)
    {
        $l = $posicao[0];
        $c = $posicao[1];
        $valor = LABIRINTO[$l][$c];
        
        return $this->quadradoFundo($distancia, $fundocurva, $valor);
    }
    
    /**
     * Gera todas as paredes direitas do corredor.
     *
     * @param array fundo [0 => int, 1 => int]
     *        int distancia
     *        string direcao
     *
     * @return string SVG
     */
    public function direita($fundo, $distancia, $direcao)
    {
        $l = $fundo[0];
        $c = $fundo[1];
        $parede = '';
        
        for ($i = 1; $i <= $distancia; $i++) {
            switch ($direcao) {
                case 'N':
                    if (LABIRINTO[$l+$i][$c+1] == PAREDE) {
                        $parede .= $this->trapezioDireito($i, $distancia);
                    } else {
                        $parede .= $this->retanguloDireito($i, $distancia);
                    }
                    break;
                case 'S':
                    if (LABIRINTO[$l-$i][$c-1] == PAREDE) {
                        $parede .= $this->trapezioDireito($i, $distancia);
                    } else {
                        $parede .= $this->retanguloDireito($i, $distancia);
                    }
                    break;
                case 'E':
                    if (LABIRINTO[$l+1][$c-$i] == PAREDE) {
                        $parede .= $this->trapezioDireito($i, $distancia);
                    } else {
                        $parede .= $this->retanguloDireito($i, $distancia);
                    }
                    break;
                case 'W':
                    if (LABIRINTO[$l-1][$c+$i] == PAREDE) {
                        $parede .= $this->trapezioDireito($i, $distancia);
                    } else {
                        $parede .= $this->retanguloDireito($i, $distancia);
                    }
                    break;
            }
        }
        
        return $parede;
    }

    /**
     * Gera todas as paredes esquerdas do corredor.
     *
     * @param array fundo [0 => int, 1 => int]
     *        int distancia
     *        string direcao
     *
     * @return string SVG
     */
    public function esquerda($fundo, $distancia, $direcao)
    {
        $l = $fundo[0];
        $c = $fundo[1];
        $parede = '';
        
        for ($i = 1; $i <= $distancia; $i++) {
            switch ($direcao) {
                case 'N':
                    if (LABIRINTO[$l+$i][$c-1] == PAREDE) {
                        $parede .= $this->trapezioEsquerdo($i, $distancia);
                    } else {
                        $parede .= $this->retanguloEsquerdo($i, $distancia);
                    }
                    break;
                case 'S':
                    if (LABIRINTO[$l-$i][$c+1] == PAREDE) {
                        $parede .= $this->trapezioEsquerdo($i, $distancia);
                    } else {
                        $parede .= $this->retanguloEsquerdo($i, $distancia);
                    }
                    break;
                case 'E':
                    if (LABIRINTO[$l-1][$c-$i] == PAREDE) {
                        $parede .= $this->trapezioEsquerdo($i, $distancia);
                    } else {
                        $parede .= $this->retanguloEsquerdo($i, $distancia);
                    }
                    break;
                case 'W':
                    if (LABIRINTO[$l+1][$c+$i] == PAREDE) {
                        $parede .= $this->trapezioEsquerdo($i, $distancia);
                    } else {
                        $parede .= $this->retanguloEsquerdo($i, $distancia);
                    }
                    break;
            }
        }
        
        return $parede;
    }
    
    /**
     * Gera o poligono SVG do fundo do corredor.
     *
     * @param int distancia
     *        bool fundocurva
     *        int valor
     *
     * @return string SVG
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
        
        return $this->svg->poligono($pontos, $preenchimento, $borda, 2, '', 'bevel');
    }
    
    /**
     * Gera o poligono SVG de uma parede direita profunda.
     *
     * @param int i
     *        int distancia
     *
     * @return string SVG
     */
    private function trapezioDireito($i, $distancia)
    {
        if ($i == $distancia) {
            $ef = PHP_EOL . LARGURA_SVG . ',1 ' . LARGURA_SVG . ',' . ALTURA_SVG;
        } else {
            $ef = '';
        }
        
        $trapezio = $this->coord->abcdTrapezioDireito($distancia-$i);
        
        $pontos = $trapezio["a"]["x"] . ',' . $trapezio["a"]["y"] . ' ' .
                  $trapezio["b"]["x"] . ',' . $trapezio["b"]["y"] . $ef . ' ' .
                  $trapezio["c"]["x"] . ',' . $trapezio["c"]["y"] . ' ' .
                  $trapezio["d"]["x"] . ',' . $trapezio["d"]["y"];
        
        return $this->svg->poligono($pontos, CORES["parede"]["P"], CORES["parede"]["B"], 2, '', 'bevel');
    }
    
    /**
     * Gera o poligono SVG de uma parede da curva direita.
     *
     * @param int i
     *        int distancia
     *
     * @return string SVG
     */
    private function retanguloDireito($i, $distancia)
    {
        $retangulo = $this->coord->abcdRetanguloDir($distancia-$i);
        
        $pontos = $retangulo["a"]["x"] . ',' . $retangulo["a"]["y"] . ' ' .
                  $retangulo["b"]["x"] . ',' . $retangulo["b"]["y"] . ' ' .
                  $retangulo["c"]["x"] . ',' . $retangulo["c"]["y"] . ' ' .
                  $retangulo["d"]["x"] . ',' . $retangulo["d"]["y"];
        
        return $this->svg->poligono($pontos, CORES["curva"]["P"], CORES["curva"]["B"], 2, '', 'bevel');
    }

    /**
     * Gera o poligono SVG de uma parede esquerda profunda.
     *
     * @param int i
     *        int distancia
     *
     * @return string SVG
     */
    private function trapezioEsquerdo($i, $distancia)
    {
        if ($i == $distancia) {
            $ef = PHP_EOL . ' 0,' . ALTURA_SVG . ' 0,0';
        } else {
            $ef = '';
        }
        
        $trapezio = $this->coord->abcdTrapezioEsquerdo($distancia-$i);
        
        $pontos = $trapezio["a"]["x"] . ',' . $trapezio["a"]["y"] . ' ' .
                  $trapezio["b"]["x"] . ',' . $trapezio["b"]["y"] . ' ' .
                  $trapezio["c"]["x"] . ',' . $trapezio["c"]["y"] . ' ' .
                  $trapezio["d"]["x"] . ',' . $trapezio["d"]["y"] . $ef;
        
        return $this->svg->poligono($pontos, CORES["parede"]["P"], CORES["parede"]["B"], 2, '', 'bevel');
    }
    
    /**
     * Gera o poligono SVG de uma parede da curva esquerda.
     *
     * @param int i
     *        int distancia
     *
     * @return string SVG
     */
    private function retanguloEsquerdo($i, $distancia)
    {
        $retangulo = $this->coord->abcdRetanguloEsq($distancia-$i);
        
        $pontos = $retangulo["a"]["x"] . ',' . $retangulo["a"]["y"] . ' ' .
                  $retangulo["b"]["x"] . ',' . $retangulo["b"]["y"] . ' ' .
                  $retangulo["c"]["x"] . ',' . $retangulo["c"]["y"] . ' ' .
                  $retangulo["d"]["x"] . ',' . $retangulo["d"]["y"];
        
        return $this->svg->poligono($pontos, CORES["curva"]["P"], CORES["curva"]["B"], 2, '', 'bevel');
    }

}

