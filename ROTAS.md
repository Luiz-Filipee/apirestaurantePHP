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

#### **PUT /mesas**
- **Descrição:** Atualiza uma mesa ja existente.
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

#### **DELETE /mesas**
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

#### **PUT /pedidos**
- **Descrição:** Atualiza uma mesa ja existente.
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

#### **DELETE /pedidos**
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

