<?php

/**
 * Esta classe realiza os cálculos das coordenadas das paredes.
 */
class CoordenadasABCD
{
    
    /**
     * Calcula as coordenadas dos quatro cantos da parede do fundo.
     *
     * @param int Distância do fundo
     *
     * @return array ['a' => array ['x' => int, 'y' => int],
     *                'b' => array ['x' => int, 'y' => int],
     *                'c' => array ['x' => int, 'y' => int],
     *                'd' => array ['x' => int, 'y' => int]]
     */
    public function abcdQuadrado($i)
    {
        $quadrado = array("a" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100))),
                          "b" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100))),
                          "c" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100))),
                          "d" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100))));
        return $quadrado;
    }

    /**
     * Calcula as coordenadas dos quatro cantos da parede direita.
     *
     * @param int Distância da parede
     *
     * @return array ['a' => array ['x' => int, 'y' => int],
     *                'b' => array ['x' => int, 'y' => int],
     *                'c' => array ['x' => int, 'y' => int],
     *                'd' => array ['x' => int, 'y' => int]]
     */
    public function abcdTrapezioDireito($i)
    {
        $trapezio = array("a" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                          "b" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100))),
                          "c" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100))),
                          "d" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))));
        return $trapezio;
    }

    /**
     * Calcula as coordenadas dos quatro cantos da parede esquerda.
     *
     * @param int Distância da parede
     *
     * @return array ['a' => array ['x' => int, 'y' => int],
     *                'b' => array ['x' => int, 'y' => int],
     *                'c' => array ['x' => int, 'y' => int],
     *                'd' => array ['x' => int, 'y' => int]]
     */
    public function abcdTrapezioEsquerdo($i)
    {
        $trapezio = array("a" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100))),
                          "b" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                          "c" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                          "d" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                       "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100))));
        return $trapezio;
    }

    /**
     * Calcula as coordenadas dos quatro cantos da parede da curva direita.
     *
     * @param int Distância da parede
     *
     * @return array ['a' => array ['x' => int, 'y' => int],
     *                'b' => array ['x' => int, 'y' => int],
     *                'c' => array ['x' => int, 'y' => int],
     *                'd' => array ['x' => int, 'y' => int]]
     */
    public function abcdRetanguloDir($i)
    {
        if ($i == 0) {
            $retangulo = array("a" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "b" => array("x" => LARGURA_SVG,
                                            "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "c" => array("x" => LARGURA_SVG,
                                            "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "d" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))));
        } else {
            $retangulo = array("a" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "b" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "c" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "d" => array("x" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))));
        }
        return $retangulo;
    }

    /**
     * Calcula as coordenadas dos quatro cantos da parede da curva esquerda.
     *
     * @param int Distância da parede
     *
     * @return array ['a' => array ['x' => int, 'y' => int],
     *                'b' => array ['x' => int, 'y' => int],
     *                'c' => array ['x' => int, 'y' => int],
     *                'd' => array ['x' => int, 'y' => int]]
     */
    public function abcdRetanguloEsq($i)
    {
        if ($i == 0) {
            $retangulo = array("a" => array("x" => 1,
                                            "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "b" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "c" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "d" => array("x" => 1,
                                            "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))));
        } else {
            $retangulo = array("a" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "b" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "c" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))),
                               "d" => array("x" => round((ALTURA_SVG/2)-(ALTURA_SVG/2*PERCENTUAIS[$i]/100)+FATOR_CORRECAO),
                                            "y" => round((ALTURA_SVG/2)+(ALTURA_SVG/2*PERCENTUAIS[$i+1]/100))));
        }
        return $retangulo;
    }
    
}

