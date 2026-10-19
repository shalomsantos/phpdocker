# Roadmap até a versão alfa

Cada versão é um micro-sistema com escopo fechado. A spec completa de cada uma está em `modulos/`.

## Etapa 1: Fundação (v0.0.x)

| Versão | Micro-sistema |
|---|---|
| [v0.0.1](modulos/v0.0.1-identidade-e-acesso.md) | Identidade e Acesso |
| [v0.0.2](modulos/v0.0.2-modelagem-de-conteudo.md) | Modelagem de Conteúdo |
| [v0.0.3](modulos/v0.0.3-gestao-de-conteudo.md) | Gestão de Conteúdo |
| [v0.0.4](modulos/v0.0.4-contrato-de-leitura-e-simulador-do-core.md) | Contrato de Leitura e Simulador do Core |
| [v0.0.5](modulos/v0.0.5-fluxo-editorial.md) | Fluxo Editorial |
| [v0.0.6](modulos/v0.0.6-eventos-de-publicacao.md) | Eventos de Publicação |
| [v0.0.7](modulos/v0.0.7-biblioteca-de-midia.md) | Biblioteca de Mídia |
| [v0.0.8](modulos/v0.0.8-auditoria.md) | Auditoria |
| [v0.0.9](modulos/v0.0.9-painel-admin.md) | Painel Admin (fechamento da Etapa 1) |

## Etapa 2: Sinais do Core (v0.1.x)

A ordem segue o que o site precisa primeiro: seções, componentes e templates, home, autor e rotas.
Assuntos, coleções e curadoria vêm depois, e a home já nasce usando listas dinâmicas até a curadoria chegar.

| Versão | Micro-sistema |
|---|---|
| [v0.1.0](modulos/v0.1.0-secoes-e-sites.md) | Seções e Sites |
| [v0.1.1](modulos/v0.1.1-registro-de-componentes.md) | Registro de Componentes |
| [v0.1.2](modulos/v0.1.2-templates-de-pagina.md) | Templates de Página (interna de notícia) |
| [v0.1.3](modulos/v0.1.3-evolucao-de-componentes.md) | Evolução de Componentes |
| [v0.1.4](modulos/v0.1.4-home-por-secao.md) | Home por Seção |
| [v0.1.5](modulos/v0.1.5-autor-e-rotas-especiais.md) | Autor e Rotas Especiais |
| [v0.1.6](modulos/v0.1.6-colecoes-por-tipo.md) | Coleções por Tipo |
| [v0.1.7](modulos/v0.1.7-curadoria-e-destaques.md) | Curadoria e Destaques |
| [v0.1.8](modulos/v0.1.8-contrato-de-leitura-v2-e-eventos-v2.md) | Contrato de Leitura v2 e Eventos v2 |
| [v0.1.9](modulos/v0.1.9-simulador-v2-preview-e-fechamento-alfa.md) | Simulador v2, Preview e Fechamento Alfa |

## Sinais do Core e versões

| Sinal | Versões |
|---|---|
| Listagem de assunto (#tag), com painel de destaque | v0.1.6, v0.1.7, v0.1.8 |
| Interna de notícia com templates de design | v0.1.1, v0.1.2, v0.1.3 |
| Home com seções e sites segregados | v0.1.0, v0.1.4, v0.1.7 |
| URLs menos esperadas (/autor) | v0.1.5 |

## Critérios da versão alfa

- Os quatro sinais são demonstrados ponta a ponta no simulador
- Um componente novo pode ser adicionado e usado sem alterar o núcleo do CMS
- A mudança de schema de um componente em uso é migrada e reportada
- Seção, sub-seção, matéria, autor, coleção e página especial não colidem em rota, e os prefixos reservados são respeitados
- Cada rota do manifesto informa sua camada, seu tipo de página e seu nível de destaque
- Toda publicação gera evento com as dependências afetadas
- O CMS não armazena CSS nem datas formatadas: apenas nomes de estilo e datas cruas
- O editor tem preview de SEO, e os estruturadores de busca ficam no Core
- Contrato v2 documentado e coberto por testes
- Permissões por papel e por seção verificadas no servidor

## Fora do escopo da alfa

- ThePeapleCore (rotas finais, renderização, SEO final, cache, busca e feeds)
- Coautoria e matéria em mais de uma seção
- Multilíngue, comentários de leitores, analytics e importação/exportação
- Colaboração em tempo real no editor
