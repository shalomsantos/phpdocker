# Visão

## O que estamos construindo

- **The peaple** é o CMS: guarda, valida e organiza os dados e os entrega ao Core.
- **ThePeapleCore** é o backend acoplado que estrutura os dados e prepara a apresentação.

Este repositório trata do The peaple. O Core aparece como destinatário de sinais e como um
**Simulador do Core** que valida cada envio.

## Princípio

O The peaple guarda **dados e intenções**. O ThePeapleCore transforma isso em **apresentação**
(rotas finais, layout, estilo, formatação de datas, SEO final, cache).

## Etapas

- **Etapa 1: Fundação (v0.0.x).** Acesso, modelagem, conteúdo, contrato de leitura, fluxo editorial, eventos, mídia, auditoria, painel.
- **Etapa 2: Sinais do Core (v0.1.x).** Seções, componentes, templates, home, autor e rotas especiais, coleções por tipo, curadoria, contrato v2.
- Ao concluir a v0.1.9 temos a **versão alfa** do The peaple.

## Sinais que o Core vai receber

1. Listagem de um assunto (#tag), com painel de destaque e componentes individuais
2. Interna de notícia com templates que nascem de um design (componentes customizáveis: o CMS adapta o conteúdo ou o programador adapta o editor)
3. Home com seções e sites segregados (/politica, /politica/alexandre-de-moraes)
4. URLs menos esperadas (/autor)

## Agnóstico de tecnologia

Linguagem, banco de dados e ferramentas ainda não foram escolhidos (ver ADR 0001).
