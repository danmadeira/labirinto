## Modelo SVG para labirinto 3D

Script em PHP para construção de um ambiente em três dimensões de um labirinto fornecido por uma matriz bidimensional.

:point_right: É somente uma exibição estática dos ambientes pelos corredores do labirinto, em uma imagem gerada no formato SVG.

O script aceita variáveis externas pelo método GET para definir uma posição e direção dentro do labirinto. Ex.:

index.php?linha=12&coluna=7&direcao=N

:eyes: Este script utiliza a classe publicada em [Construção de elementos SVG](https://github.com/danmadeira/construcao-elementos-svg)

### Exemplo da imagem gerada:

![Labirinto](img/labirinto.svg?raw=true)
