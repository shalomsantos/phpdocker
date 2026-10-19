# The peaple (CMS) + ThePeapleCore (backend de apresentação)

O The peaple guarda dados e intenções. O ThePeapleCore transforma isso em apresentação.
Este repositório contém o The peaple e um Simulador do Core. O Core real vem depois.

## Leia antes de agir

1. `docs/status.md` (onde estamos e o próximo passo)
2. `docs/02-responsabilidades.md` e `docs/01-glossario.md`
3. A spec da versão em andamento, em `docs/modulos/`
4. `docs/04-arquitetura.md` e os ADRs em `docs/adr/` quando a tarefa tocar neles

## Escopo

- A versão em andamento está em `docs/status.md`. Implemente só ela.
- Não implemente nem "deixe pronto" nada de versões futuras.
- Fora do escopo do The peaple: renderização, layout, formatação, SEO final, cache, busca e feeds. Isso é do Core.

## Regras inegociáveis

- O CMS nunca guarda CSS nem data formatada. Só nomes de estilo (tokens) e data crua (ISO 8601, UTC).
- O Core nunca lê o armazenamento do CMS. Só pelo contrato (`contrato/`).
- Mudou payload, leitura ou evento? Suba a versão do contrato e documente.
- Corpo de matéria é bloco estruturado (tipo, versão, props), nunca HTML.
- Permissões passam pela função única do módulo de identidade. Não duplique.
- Cada matéria tem uma seção canônica e um autor; assunto é N:N com matéria.
- Slug tem escopo de seção; sub-seção e matéria dividem o mesmo espaço; prefixos reservados são recusados.
- Use os nomes do glossário no código e na documentação.
- Nenhuma dependência nova sem ADR.

## Stack

Ainda não decidida (ver `docs/adr/0001-escolha-da-stack.md`). Não escolha linguagem, banco,
framework nem biblioteca por conta própria: proponha 2 ou 3 opções com prós e contras e espere a decisão.

## Como trabalhar

1. Leia a spec da versão e proponha um plano curto antes de codar.
2. Passos pequenos, com testes derivados do "Pronto quando".
3. Se algo for ambíguo ou estiver fora da spec, pergunte. Não invente.
4. Ao terminar, atualize `docs/status.md`.

## Evite

- Adiantar funcionalidades de versões seguintes
- Refatorações amplas fora do escopo pedido
- Apagar ou enfraquecer testes para fazer algo passar
- Duplicar lógica de permissão, slug ou validação
- Colocar regra de apresentação dentro do CMS
- Segredos no código ou no repositório

## Definição de pronto

- Os critérios de "Pronto quando" da spec têm testes e passam
- Contrato atualizado e versionado, se mudou
- `docs/status.md` atualizado
- Decisão nova relevante virou ADR
