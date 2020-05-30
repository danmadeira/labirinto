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
        $percentuais = ConfiguracaoAmbiente::gerarEscalaPerspectiva(1.45, 13);

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
                              "fora" => array("B" => 'rgb(224,226,196)', "P" => 'rgb(224,226,196)'),
                              "quadro" => array("B" => 'silver', "P" => 'none')));
    }
    
    private static function gerarEscalaPerspectiva($fator, $limite)
    {
        $percentuais = array(0 => 100);
        for ($i = 1; $i < $limite; $i++) {
            $percentuais[$i] = $percentuais[$i-1] / $fator;
        }
        return $percentuais;
    }
    
}

