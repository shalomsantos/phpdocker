# ADR 0002: Destaque: ordem no CMS, posição no Core

**Status:** Aceita (roadmap v2)
**Data:** 2026-10-19

## Contexto

O handoff de arquitetura sugere que o CMS só marque o destaque e o Core decida a posição e o painel. O roadmap original deixava o editor ordenar slots.

## Decisão

Meio-termo: o CMS guarda a ordem dos itens e o **nome semântico do slot** (ex.: principal, secundários), mais vigência. **A posição, o painel e o layout são decididos pelo Core.**

## Consequências

A lista curada (v0.1.7) não carrega informação de layout. O Core mapeia nome de slot para posição.
