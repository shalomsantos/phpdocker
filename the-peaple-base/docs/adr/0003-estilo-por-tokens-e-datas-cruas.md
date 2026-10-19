# ADR 0003: Estilo por tokens e datas cruas

**Status:** Aceita
**Data:** 2026-10-19

## Contexto

O CMS não deve conhecer a apresentação. É preciso customizar estilo e formato de data sem acoplar o CMS ao CSS do Core.

## Decisão

O CMS indica o componente e a variação por **nome (token)** e guarda props; nunca guarda CSS. Datas são guardadas **cruas (ISO 8601, UTC)**; o estilo de data pode ser uma prop do componente e um padrão por seção, mas a formatação é do Core.

## Consequências

O simulador (v0.1.9) resolve tokens e formata datas para provar a separação. Nenhum campo do CMS armazena CSS ou data formatada.
