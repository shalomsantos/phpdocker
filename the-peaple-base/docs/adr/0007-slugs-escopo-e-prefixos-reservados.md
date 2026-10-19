# ADR 0007: Slugs: escopo e prefixos reservados

**Status:** Aceita (roadmap v2)
**Data:** 2026-10-19

## Contexto

`/{secao}/{slug}` pode conflitar com sub-seções, com `/autor/{slug}` e com `/tudo-sobre/{slug}`.

## Decisão

O slug tem **escopo de seção**. Sub-seção e matéria dividem o mesmo espaço de slugs dentro da seção. Há uma lista de **prefixos reservados** (ex.: autor, tudo-sobre, tag, busca, newsletter, sobre). O contrato expõe a árvore de seções para o Core validar a seção antes de resolver a rota.

## Consequências

O cadastro recusa colisão. Mover ou renomear seção preserva o histórico de caminhos, e a troca de slug gera registro de redirecionamento (o Core aplica o 301).
