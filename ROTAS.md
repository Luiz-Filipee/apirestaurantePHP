# Documentação da API

## Rotas

### 1. `/mesas`

#### **GET /mesas**
- **Descrição:** Retorna a lista de todas as mesas.
- **Resposta de Sucesso (200 OK):**
  ```json
  {
    "message": "Página de mesas"
  }
  
#### **POST /mesas**
- **Descrição:** Cria uma nova mesa.
- **Request Body:**
 ```json
    {
        "numero": 5,
        "cliente_id": 1
    }
  ```
- **Resposta de Sucesso (200 OK):**
  ```json
  {
    "message": "Mesa criada com sucesso"
  }
**- **Resposta de Erro (404 NOT FOUND):**
```json
  {
    "message": "Erro ao criar mesa"
  }
  ```

#### **PUT /mesas/{id}**
- **Descrição:** Atualiza uma mesa ja existente.
- **Request Body:**
 ```json
    {
        "numero": 10,
        "cliente_id": 2
    }
  ```
- **Resposta de Sucesso (201 CREATED):**
  ```json
  {
    "message": "Mesa atualizada com sucesso"
  }
- **Resposta de Erro (400 BAD REQUEST):**
```json
  {
    "message": "Erro ao atualizar mesa"
  }
  ```

#### **DELETE /mesas/{id}**
- **Descrição:** Remove uma mesa ja existente.
- **Resposta de Sucesso (200 OK):**
  ```json
  {
    "message": "Mesa removida com sucesso"
  }
- **Resposta de Erro (400 BAD REQUEST):**
```json
  {
    "message": "Erro ao remover mesa"
  }
  ```

### 2. `/pedidos`

#### **GET /pedidos**
- **Descrição:** Retorna a lista de todas as mesas.
- **Resposta de Sucesso (200 OK):**
  ```json
  {
    "message": "Página de pedidos"
  }
- **Resposta de Erro (400 BAD REQUEST):**
```json
  {
    "message": "Erro ao listar pedidos"
  }
  ```

#### **POST /pedidos**
- **Descrição:** Cria uma nova mesa.
- **Request Body:**
 ```json
  {
    "cliente_id": 1,
    "mesa_id": 1,
    "itens": [
        {
        "produto_id": 2,
        "quantidade": 1
        }
    ],
    "preco_total": 50.00,
    "status":"em andamento"
  }
  ```
- **Resposta de Sucesso (201 CREATED):**
  ```json
  {
    "message": "Pedido criado com sucesso"
  }
- **Resposta de Erro (400 BAD REQUEST):**
```json
  {
    "message": "Erro ao criar pedido"
  }
  ```

#### **PUT /pedidos/{id}**
- **Descrição:** Atualiza uma mesa ja existente.
 **Request Body:**
 ```json
  {
    "status": "finalizado",
    "preco_total": 60.00
  }
  ```
- **Resposta de Sucesso (200 OK):**
  ```json
  {
    "message": "Pedido atualizado com sucesso"
  }
- **Resposta de Erro (400 BAD REQUEST):**
```json
  {
    "message": "Erro ao atualizar pedido"
  }
  ```

#### **DELETE /pedidos/{id}**
- **Descrição:** Remove uma mesa ja existente.
- **Resposta de Sucesso (200 OK):**
  ```json
  {
    "message": "Pedido removido com sucesso"
  }
- **Resposta de Erro (404 NOT FOUND):**
```json
  {
    "message": "Erro ao remover pedido"
  }

