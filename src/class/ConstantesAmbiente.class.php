<?php

/**
 * Esta classe contém valores para configuração do labirinto.
 */
class ConfiguracaoAmbiente
{
    
    /**
     * A configuração será constante.
     */
    public static function defineConstantes()
    {
        $w = 1350;
        $h = 560;
        $percentuais = array(100, 80, 53.3, 35.6, 23.7, 15.8, 10.5, 7.0, 4.7, 3.1, 2.1, 1.4, 0.9);

        $maze = array(array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
                      array(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1),
                      array(1, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1),
                      array(1, 1, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1),
                      array(1, 0, 0, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 1),
                      array(1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1),
                      array(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
                      array(1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1),
                      array(1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1, 0, 3),
                      array(1, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 1),
                      array(1, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 0, 0, 1),
                      array(1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 1, 0, 1),
                      array(1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1),
                      array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1));

        $linhas = count($maze);
        $colunas = max(array_map('count', $maze));
        
        define('LARGURA_SVG', $w);
        define('ALTURA_SVG', $h);
        define('FATOR_CORRECAO', (($w - $h) / 2));
        define('PERCENTUAIS', $percentuais);
        define('LABIRINTO', $maze);
        define('LINHAS_LABIRINTO' , $linhas);
        define('COLUNAS_LABIRINTO', $colunas);
        define('LINHA_MINIMA', 1);
        define('LINHA_MAXIMA', ($linhas - 2));
        define('COLUNA_MINIMA', 1);
        define('COLUNA_MAXIMA', ($colunas - 2));
        define('CORREDOR', 0);
        define('PAREDE', 1);
        define('INICIO' , 2);
        define('FIM', 3);
        define('DIRECOES', array('N', 'S', 'E', 'W'));
        define('FORA_DE_ALCANCE', 12);
        define('CORES', array("chao" => array("B" => 'khaki', "P" => 'khaki'),
                              "teto" => array("B" => 'azure', "P" => 'azure'),
                              "parede" => array("B" => 'silver', "P" => 'silver'),
                              "curva" => array("B" => 'lavender', "P" => 'lavender'),
                              "inicio" => array("B" => 'green', "P" => 'green'),
                              "fim" => array("B" => 'black', "P" => 'black'),
                              "fora" => array("B" => 'darkkhaki', "P" => 'darkkhaki'),
                              "quadro" => array("B" => 'silver', "P" => 'none')));
    }
    
}

