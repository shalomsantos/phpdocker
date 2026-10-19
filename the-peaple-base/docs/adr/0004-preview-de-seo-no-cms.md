# ADR 0004: Preview de SEO no CMS

**Status:** Aceita
**Data:** 2026-10-19

## Contexto

Os estruturadores de busca (meta tags finais, JSON-LD, sitemap) fazem mais sentido no Core. Mesmo assim, o editor se beneficia de ver como a matéria aparece na busca.

## Decisão

O CMS guarda os campos de SEO como dado e oferece um **preview** de resultado de busca e de cartão de compartilhamento, calculado só a partir dos campos, com avisos de tamanho (v0.0.3). Meta tags finais, canonical, JSON-LD, Open Graph, sitemap, robots e hreflang ficam no Core.

## Consequências

O preview é auxílio de edição, não a saída final. Se o Core mudar a forma de montar o título, o preview pode divergir levemente.
