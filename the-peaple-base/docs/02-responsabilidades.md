# Divisão de responsabilidades

O The peaple guarda **dados e intenções**; o ThePeapleCore transforma isso em **apresentação**.

| Tema | The peaple (CMS) | ThePeapleCore |
|---|---|---|
| SEO | Guarda os campos (título, descrição, imagem social, noindex, canonical opcional) e mostra ao editor um preview de busca e de cartão de compartilhamento, calculado só a partir dos campos, com avisos de tamanho. | Monta as meta tags finais, canonical, dados estruturados (JSON-LD), Open Graph, sitemap, robots e hreflang. O preview do CMS é auxílio de edição, não a saída final. |
| Estilo e componentes (CSS) | Indica qual componente e qual variação usar, por nome (tokens), com props. Nunca guarda CSS. | Interpreta o nome e monta o componente com o estilo correspondente. |
| Datas | Guarda a data crua (ISO 8601, UTC) e, quando fizer sentido, o estilo de data como prop do componente. | Formata para exibição (relativa, extensa, curta) conforme idioma e fuso. |
| Destaque e manchete | Guarda a lista curada: ordem dos itens, nome semântico do slot e vigência. | Decide a posição, o painel e o layout em que cada slot aparece. |
| URLs | Guarda a intenção de rota (tipo, escopo e slug), a árvore de seções e o histórico de slugs. | Valida a seção, compõe a URL final, resolve conflitos e aplica redirecionamentos (301). |
| Cache e paginação | Nada. Entrega a listagem paginada de forma estável e emite eventos de publicação. | Define política de cache por camada, pagina e invalida a partir dos eventos. |

## Cardinalidades da alfa

- Cada matéria pertence a **uma seção canônica** e a **um autor**.
- Assunto se relaciona com matéria em **N:N**.
- Coautoria e matéria em mais de uma seção ficam fora da alfa.
