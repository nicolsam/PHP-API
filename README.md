# PHP-API
Aplicação voltada na criação de uma API utilizando a linguagem PHP

## Instalação 

Clone este repositório utilizando **Git**.

```bash
git clone https://github.com/nicolsam/PHP-API.git
```

Configure o **Composer** usando
```bash
composer install
```

E por último configure as **variáveis de ambiente** nomeando o nome do arquivo **.env.example** por **.env** e substituindo as credênciais de exemplo por suas credênciais verdadeiras

## Configurando Banco de Dados

Crie um **Banco de Dados** utilizando

```sql
CREATE TABLE {NOME_BD} (
  `id` int NOT NULL PRIMARY KEY,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
```

(Opcional)

```sql
INSERT INTO {NOME_BD} (`id`, `email`, `password`, `name`) VALUES
(1, 'email@gmail.com', '123456', 'Carlos'),
(2, 'maria@email.com', '123456', 'Ana Maria');
```

## Acessando API

utilize a **URL** no navegador

```
{path}/public/index.php/api/user
```

Você também pode exibir um usuário específico utilizando seu respectivo **ID**

```
{path}/public/index.php/api/user/1
```
