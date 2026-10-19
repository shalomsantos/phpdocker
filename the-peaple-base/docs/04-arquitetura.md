# Arquitetura

Diretrizes derivadas do que foi debatido. Onde estiver marcado **[validar]**, é proposta ainda não confirmada.

## Fronteira CMS e Core

- O Core nunca lê o armazenamento do CMS. Tudo passa pelo **contrato** (`contrato/`): leituras e eventos.
- Todo payload carrega a versão do schema e a versão do contrato.
- O simulador (`core/simulador/`) é o único consumidor do contrato até o Core real existir.

## Módulos

- Cada micro-sistema (versão) é um módulo em `cms/`, com interface pública explícita.
- Um módulo só depende de módulos de versões anteriores (ver "Depende de" em cada spec).
- **[validar]** Monolito modular: um só deploy, com fronteiras explícitas entre módulos e entre CMS e Core, de modo que separar depois não exija reescrita.

## Dados

- Datas e horas em formato cru (ISO 8601, UTC). Nunca formatadas no CMS.
- Corpo de matéria em blocos estruturados (tipo, versão, props). Nunca HTML.
- Schema de conteúdo versionado; cada entrada registra a versão que usa.
- Taxonomias com id estável e slug separado.
- Slug guardado como segmento mais escopo. Escopo global na Etapa 1; por seção a partir da v0.1.0.
- Seção e autor são tipos de conteúdo, não campos soltos.

## Eventos

- Padrão outbox: o evento é gravado na mesma transação da mudança e despachado depois.
- Entrega com nova tentativa; o evento tem id próprio para o consumidor deduplicar.
- A partir da v0.1.8, o evento informa as dependências afetadas (quais listagens e homes mudam).

## Preview e rascunho

- Rascunho só é legível pelo contrato com token de preview.
- O preview de SEO do editor usa apenas os campos da entrada.

## Estilo e componentes

- O CMS declara componentes e variações por nome (tokens) e guarda props. O Core traduz em estilo.
- Mudança de schema de componente: compatível não exige migração; incompatível exige adaptador de migração ou ajuste do editor pelo programador.

## Rotas

- O CMS guarda a intenção de rota; o Core compõe a URL final.
- Sub-seção e matéria dividem o mesmo espaço de slugs dentro de uma seção.
- Prefixos reservados (ex.: autor, tudo-sobre, tag, busca, newsletter, sobre) nunca podem virar slug de seção.
- O contrato expõe a árvore de seções para o Core validar a seção antes de resolver a rota.
