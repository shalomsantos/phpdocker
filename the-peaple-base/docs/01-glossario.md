# Glossário

Estes nomes valem para o código e para a documentação.

## Tipos de página

| Termo | Significado |
|---|---|
| Section front | Página de seção ou editoria (ex.: /politica). Vitrine editorial, destaque máximo. |
| Article page | Página de matéria. Unidade de conteúdo. |
| Author page | Arquivo por autor (ex.: /autor/nome). Baixa visibilidade, acesso contextual. |
| Topic hub | Página de assunto (ex.: /tudo-sobre/stf). Agrega um tema. |

## Navegação e camadas

| Termo | Significado |
|---|---|
| Navegação primária | Menu e manchetes que a home empurra para o usuário. |
| Navegação contextual | Links que só aparecem dentro de um conteúdo (autor na matéria, chip de assunto). |
| Camada editorial | Curada por pessoas, destaque máximo: home, section front e article page. |
| Camada de taxonomia | Derivada de consulta, acesso contextual: author page, topic hub e arquivo de tag. |
| Camada utilitária | Suporte: busca, newsletter e páginas institucionais como /sobre. |

## Conceitos do sistema

| Termo | Significado |
|---|---|
| Entrada | Qualquer item de conteúdo de um tipo definido na modelagem (matéria, página, autor, seção). |
| Bloco | Unidade do corpo de uma entrada: tipo, versão e props. |
| Componente | Peça de apresentação definida por id, versão, schema de props e variações. |
| Token de estilo | Nome de uma variação visual (ex.: destaque-grande). O CMS guarda o nome; o Core traduz em estilo. |
| Template | Composição de slots com componentes aceitos por slot. |
| Slot | Posição nomeada dentro de um template, de uma lista curada ou de uma zona da home. |
| Coleção | Estrutura única com tipo (assunto, tag, série e autor) e uma listagem paginada. |
| Lista curada | Lista ordenada de entradas (manual, dinâmica ou mista) que alimenta painéis de destaque. |
| Seção | Nó da árvore de seções. Cada matéria tem uma seção canônica. |
| Intenção de rota | Tipo de página, escopo e slug que o CMS guarda. O Core compõe a URL final. |
| Manifesto de rotas | Conjunto de todas as intenções de rota, com camada, tipo de página e nível de destaque. |
| Contrato | Fronteira entre CMS e Core: leituras, eventos e schemas versionados. |
| Evento | Aviso de mudança (publicado, atualizado, despublicado, excluído, agendado e outros). |
| Outbox | Padrão em que o evento é gravado na mesma transação da mudança e despachado depois. |
| Simulador do Core | Consumidor de teste do contrato e dos eventos. Nasce na v0.0.4. |
