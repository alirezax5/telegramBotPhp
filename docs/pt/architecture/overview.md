# Visão Geral do Projeto

**telegramBotPhp** é um wrapper PHP 8.1+ leve e sem dependências para a API de Bot do Telegram.

## Propósito

Expor todos os métodos da API de Bot do Telegram por meio de uma superfície PHP orientada a objetos e ergonômica, mantendo o ambiente de execução mínimo (apenas PHP + cURL — sem pacotes externos, sem framework).

## Escopo e Números

| Métrica | Valor |
|--------|-------|
| Métodos da API de Bot cobertos | **186** |
| Classes de resposta/entidade tipadas | **199** |
| Versão do PHP | >= 8.1 |
| Dependências de runtime | **0** (usa `ext-curl`, `ext-json`) |
| Estilo de dados | autoload PSR-4; decodificação `stdClass` + wrappers tipados lazy |

## Extensão da API

O wrapper mapeia cada endpoint para um **método** em `Telegram` (misturado via *traits* de domínio) e cada resposta/entidade JSON para uma classe de **tipo** sob `src/Types/`.

## Objetivos de design

1. **Completude** — manter-se em sincronia com a API de Bot oficial em `https://core.telegram.org/bots/api`.
2. **Ergonomia** — getters amigáveis (`text()`, `chatId()`, `mediaType()`) sobre os objetos brutos.
3. **Confiabilidade** — retry HTTP integrado com backoff exponencial + tratamento de `retry_after`, handle de cURL reutilizável, suporte a timeout de long polling.
4. **Zero lock-in** — sem dependências de framework; utilizável a partir de scripts de webhook ou long polling.

Consulte [folder-structure.md](folder-structure.md) para o layout de diretórios, [methods.md](methods.md) para a superfície da API e [telegram-class.md](telegram-class.md) para a classe principal.
