<?php

/**
 * Esta classe contém funções para IA.
 */
class IALabirinto
{
    
    /**
     * Localiza a coordenada da posição de início e a direção do olhar.
     *
     * @return array ['posicao' => array [0 => int, 1 => int],
     *                'direcao' => string,
     *                'valido'  => bool]
     */
    public function localizarInicio()
    {
        $posicao = array(0, 0);
        $direcao = '';
        $valido = false;
        
        for ($l = 0; $l < LINHAS_LABIRINTO; $l++) {
            for ($c = 0; $c < COLUNAS_LABIRINTO; $c++) {
                if (LABIRINTO[$l][$c] == INICIO and (($l == 0 or $c == 0) or ($l == LINHAS_LABIRINTO-1 or $c == COLUNAS_LABIRINTO-1))
                                            and !($l == 0 and $c == 0)
                                            and !($l == 0 and $c == COLUNAS_LABIRINTO-1)
                                            and !($l == LINHAS_LABIRINTO-1 and $c == 0)
                                            and !($l == LINHAS_LABIRINTO-1 and $c == COLUNAS_LABIRINTO-1)) {
                    $posicao[0] = $l;
                    $posicao[1] = $c;
                    if ($l == LINHAS_LABIRINTO-1) {
                        $direcao = 'N';
                    } elseif ($l == 0) {
                        $direcao = 'S';
                    } elseif ($c == 0) {
                        $direcao = 'E';
                    } else { // if ($c == $colunas-1) {
                        $direcao = 'W';
                    }
                    $valido = true;
                    break 2;
                }
            }
        }
        
        return array("posicao" => $posicao, "direcao" => $direcao, "valido" => $valido);
    }
    
    /**
     * Localiza a coordenada da posição do fundo e a distância do fundo.
     *
     * @param array posicao [0 => int, 1 => int]
     *        string direcao
     *
     * @return array ['posicao'   => array [0 => int, 1 => int],
     *                'distancia' => int]
     */
    public function localizarFundo($posicao, $direcao)
    {
        $l = $posicao[0];
        $c = $posicao[1];
        
        for ($i = 1; $i <= FORA_DE_ALCANCE; $i++) {
            switch ($direcao) {
                case 'N':
                    if (LABIRINTO[$l-$i][$c] == PAREDE or LABIRINTO[$l-$i][$c] == INICIO or LABIRINTO[$l-$i][$c] == FIM or $i == FORA_DE_ALCANCE) {
                        $fundo = array("posicao" => array($l-$i, $c), "distancia" => $i);
                        break 2;
                    }
                    break;
                case 'S':
                    if (LABIRINTO[$l+$i][$c] == PAREDE or LABIRINTO[$l+$i][$c] == INICIO or LABIRINTO[$l+$i][$c] == FIM or $i == FORA_DE_ALCANCE) {
                        $fundo = array("posicao" => array($l+$i, $c), "distancia" => $i);
                        break 2;
                    }
                    break;
                case 'E':
                    if (LABIRINTO[$l][$c+$i] == PAREDE or LABIRINTO[$l][$c+$i] == INICIO or LABIRINTO[$l][$c+$i] == FIM or $i == FORA_DE_ALCANCE) {
                        $fundo = array("posicao" => array($l, $c+$i), "distancia" => $i);
                        break 2;
                    }
                    break;
                case 'W':
                    if (LABIRINTO[$l][$c-$i] == PAREDE or LABIRINTO[$l][$c-$i] == INICIO or LABIRINTO[$l][$c-$i] == FIM or $i == FORA_DE_ALCANCE) {
                        $fundo = array("posicao" => array($l, $c-$i), "distancia" => $i);
                        break 2;
                    }
                    break;
            }
        }
        
        return $fundo;
    }
    
    /**
     * Verifica se o fundo está em uma curva.
     *
     * @param array posicao [0 => int, 1 => int]
     *        string direcao
     *
     * @return bool
     */
    public function verificarFundoCurva($posicao, $direcao)
    {
        $l = $posicao[0];
        $c = $posicao[1];
        $curva = false;
        
        switch ($direcao) {
            case 'N':
                if (LABIRINTO[$l+1][$c+1] != PAREDE or LABIRINTO[$l+1][$c-1] != PAREDE) {
                    $curva = true;
                }
                break;
            case 'S':
                if (LABIRINTO[$l-1][$c-1] != PAREDE or LABIRINTO[$l-1][$c+1] != PAREDE) {
                    $curva = true;
                }
                break;
            case 'E':
                if (LABIRINTO[$l+1][$c-1] != PAREDE or LABIRINTO[$l-1][$c-1] != PAREDE) {
                    $curva = true;
                }
                break;
            case 'W':
                if (LABIRINTO[$l-1][$c+1] != PAREDE or LABIRINTO[$l+1][$c+1] != PAREDE) {
                    $curva = true;
                }
                break;
        }
        
        return $curva;
    }

    /**
     * Verifica se a coordenada escolhida é um espaço no corredor,
     * e verifica se a direção existe.
     *
     * @param array posicao [0 => int, 1 => int]
     *        string direcao
     *
     * @return bool
     */
    public function verificarEspacoValido($posicao, $direcao)
    {
        $linha = $posicao[0];
        $coluna = $posicao[1];
        $valido = true;
        
        if (LABIRINTO[$linha][$coluna] != CORREDOR) {
            $valido = false;
        }
        if (!in_array($direcao, DIRECOES)) {
            $valido = false;
        }
        
        return $valido;
    }
    
}

