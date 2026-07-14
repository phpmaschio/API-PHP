# API-PHP

API simples em PHP puro (sem framework), com um mini-MVC caseiro (`Router` → `Controller` → `Model` → PDO). Projeto de faculdade: expõe dados de Pokémon via JSON e um módulo básico de produtos.

## Stack

- PHP 8+ com PDO (`pdo_mysql`)
- MySQL/MariaDB
- Apache com `mod_rewrite` (usa `.htaccess` pra URLs amigáveis)

## Configuração

Nada de credencial hardcoded — tudo vem de variável de ambiente, com fallback pra valores de dev local (ver `config/config.php`):

| Variável | Padrão (dev) | Descrição |
|---|---|---|
| `DB_HOST` | `localhost` | host do MySQL |
| `DB_NAME` | `api` | nome do banco |
| `DB_USER` | `root` | usuário do banco |
| `DB_PASS` | *(vazio)* | senha do banco |
| `API_TOKEN` | `123456` | token exigido no header `AUTH` das rotas `/pokemon/*` |
| `APP_BASE_URL` | detectado do host | base URL da aplicação |
| `APP_DEBUG` | `0` | `1` habilita `display_errors` |

Banco precisa das tabelas `tab_pokemon` (`numero`, `nome`, `tipo`, `tipo2`) e `tab_produtos` (`id`, `nome`) — não tem dump/migration no repo, criar manualmente.

## Rodando local

Precisa de Apache+PHP+MySQL (ex: XAMPP/WAMP) ou Docker. Aponta o document root pra raiz do projeto. Sem `mod_rewrite`/`AllowOverride All`, usa as rotas via `?route=` direto (ex: `index.php?route=pokemon/lista`).

## Rotas

| Rota | Método | Auth | Descrição |
|---|---|---|---|
| `/` | GET | não | página inicial |
| `/produtos` | GET | sim | lista produtos |
| `/pokemon/lista` | GET | sim | lista todos os pokémons |
| `/pokemon/get?numero=N` | GET | sim | busca pokémon por número (int) |
| `/pokemon/search?search=termo` | GET | sim | busca por nome/tipo (LIKE no SQL) |
| `/pokemon/tipo` | GET | sim | lista tipos distintos |
| `/404` | — | não | página/erro não encontrado |

Rotas autenticadas exigem o header `AUTH: <token>` (valor de `API_TOKEN`). Resposta padrão em JSON:

```json
{"status": true, "titulo": "...", "dados": [...], "versao": "v1"}
```

## Segurança

- Credenciais e token vêm de env var, nunca hardcoded no código versionado.
- Erros de banco/exceções não vazam detalhe pro client — logados via `error_log`, resposta genérica.
- Comparação de token via `hash_equals` (constant-time).
- Consultas parametrizadas via PDO (sem concatenação de SQL).
