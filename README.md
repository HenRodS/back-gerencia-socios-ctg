# 📊 Sistema de Gestao CTG Raizes da (Backend)

OBS: Foram mantidos os Endpoints/MVC anteriores para ter algo com que se basear. Conforme forem criando os Endpoints de verdade, removam os antigos (Que sao de outro projeto)

## ⚙️ Configuração do Ambiente

### 1. Clone o repositório

```bash
git clone <url-do-repositorio>
cd <nome-do-projeto>
```

---

### 2. Configurar o banco de dados

Acesse o MySQL:

```bash
mysql -u root -p
```

Crie o banco:

```sql
CREATE DATABASE ctg;
```

---

### 3. Criar usuário

```sql
CREATE USER 'ctg_user'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON ctg.* TO 'ctg_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

### 4. Importar o banco

```bash
mysql -u ctg_user -p ctg < src/Database/schema.sql
```

---

## ▶️ Executando o projeto

Na raiz do projeto:

```bash
php -S localhost:8000
```

---

## 🌐 Endpoints

| Rota                              | Método  | Descrição                                                    |
| --------------------------------- | ------- | ------------------------------------------------------------ |
| `/api/socios`                     | GET     | Mostra a lista com todos os socios.                          |
| `/api/socios?nome=nome`           | GET     | Busca 1 socio por nome.                                      |
| `/api/socios/:id`                 | GET     | Busca 1 socio por id.                                        |
| `/api/socios`                     | POST    | Adiciona o socio.                                            |
| `/api/socios/:id`                 | PUT     | Atualiza os dados do socio especifico (por id).              |
| `/api/socios/:id`                 | DELETE  | Deleta um socio.                                             |
| `/api/pagamentos`                 | GET     | Mostra a lista com todos os pagamentos.                      |
| `/api/pagamentos/:id`             | GET     | Busca 1 socio por id'                                        |
| `/api/pagamentos`                 | POST    | Adiciona um pagamento.                                       |
| `/api/pagamentos/:id`             | PUT     | Atualiza os dados do pagamento especifico (por id)'          |
| `/api/pagamentos/:id`             | DELETE  | Deleta um pagamento'                                         |
| `/api/mensalidades`               | GET     | Mostra a lista com todas as mensalidades.                    |
| `/api/mensalidades/:id`           | GET     | Busca 1 mensalidade por id.'                                 |
| `/api/mensalidades`               | POST    | Adiciona uma mensalidade.                                    |
| `/api/mensalidades/:id`           | PUT     | Atualiza os dados da mensalidade especifica (por id)'        |
| `/api/mensalidades/:id`           | DELETE  | Deleta uma mensalidade.'                                     |
| `/api/relatorios/socios`          | GET     | Mostra o numero total de socios.                             |
| `/api/relatorios/financeiro`      | GET     | Mostra o valor total pago e o valor total de mensalidades'   |
---

## 🧪 Testando

Use ferramentas como:

* Postman
* Insomnia

Exemplo:

```
GET http://localhost:8000/api/socios/1
```

Outro metodo:

Instale a extensão "REST Client" no VScode, e execute os testes com os arquivos http

---

## 👨‍💻 Autores

Projeto desenvolvido em grupo para fins acadêmicos.
