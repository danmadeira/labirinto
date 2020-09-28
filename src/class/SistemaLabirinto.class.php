<?php

/**
 * Esta classe monta e exibe o labirinto.
 */
class SistemaLabirinto
{
    
    private $ia;
    private $paredes;
    
    function __construct()
    {
        $this->ia = new IALabirinto;
        $this->paredes = new ParedesLabirinto;
    }
    
    /**
     * Obtém as variáveis externas pelo método GET, se houver,
     * e compara com a posição de início.
     *
     * @param array posicao [0 => int, 1 => int]
     *        string direcao
     *
     * @return array ['posicao' => array [0 => int, 1 => int],
     *                'direcao' => string]
     */
    private function obterVariavelExterna($posicao, $direcao)
    {
        $linha = filter_input(INPUT_GET, 'linha', FILTER_VALIDATE_INT, array('options' => array('default' => $posicao[0], 'min_range' => LINHA_MINIMA, 'max_range' => LINHA_MAXIMA)));
        $coluna = filter_input(INPUT_GET, 'coluna', FILTER_VALIDATE_INT, array('options' => array('default' => $posicao[1], 'min_range' => COLUNA_MINIMA, 'max_range' => COLUNA_MAXIMA)));
        
        if ($linha != $posicao[0] or $coluna != $posicao[1]) {
            $posicao = array($linha, $coluna);
            $direcao = filter_input(INPUT_GET, 'direcao', FILTER_DEFAULT);
        }
        
        return array("posicao" => $posicao, "direcao" => $direcao);
    }
    
    /**
     * Invoca a IA e a construção das paredes.
     *
     * @param array posicao [0 => int, 1 => int]
     *        string direcao
     *
     * @return string SVG
     */
    private function montaLabirinto($posicao, $direcao)
    {
        $locfundo = $this->ia->localizarFundo($posicao, $direcao);
        $fundocurva = $this->ia->verificarFundoCurva($locfundo["posicao"], $direcao);
        $construcao = $this->paredes->construir($direcao, $locfundo, $fundocurva);
        
        return $construcao;
    }
    
    /**
     * Inicia o labirinto e invoca a montagem.
     *
     * @return string SVG
     */
    public function exibeLabirinto()
    {
        $inicio = $this->ia->localizarInicio();
        $atual = $this->obterVariavelExterna($inicio["posicao"], $inicio["direcao"]);
        
        if ($this->ia->verificarEspacoValido($atual["posicao"], $atual["direcao"])) {
            $posicao = $atual["posicao"];
            $direcao = $atual["direcao"];
        } else {
            $posicao = $inicio["posicao"];
            $direcao = $inicio["direcao"];
        }
        
        if (!$inicio["valido"]) { // falta verificar de existe fim
            $labirinto = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="640" height="480"><rect x="1" y="1" width="638" height="478" fill="none" stroke="silver" stroke-width="2" /><text x="270" y="240" style="font-family: \'Super Sans\', Helvetica, sans-serif; font-weight: bold; font-style: normal">Não há início!</text></svg>';
        } else {
            $labirinto = $this->montaLabirinto($posicao, $direcao);
        }
        
        return $labirinto;
    }
    
}

