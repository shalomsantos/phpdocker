# ADR 0005: Coleções por tipo e curadoria

**Status:** Aceita (roadmap v2)
**Data:** 2026-10-19

## Contexto

No handoff, "coleção" é um agrupador por tipo (autor, assunto, tag, série). No roadmap original, "coleção" era a lista curada do painel de destaque. Os nomes colidiam.

## Decisão

**Coleção** passa a ser a estrutura por tipo com listagem única (v0.1.6); o autor é um tipo da mesma estrutura e mantém a sua rota. A lista curada do painel passa a se chamar **lista curada**, em "Curadoria e Destaques" (v0.1.7).

## Consequências

Novos tipos (ex.: série) entram sem reescrever a listagem. Listagens de autor e assunto reaproveitam a mesma consulta paginada.
