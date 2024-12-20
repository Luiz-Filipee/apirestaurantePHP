# Kato Gestão

Kato Gestão é um sistema web de gerenciamento de um restaurante desenvolvido para realizar a gestão de pedidos, e mesas de um restaurente. Será um aplicativo web utilizado em um table pelos garçons do estabelecimento. Cada mesa poderá ser atribuida a um cliente já cadastrado e a partir disso, um pedido pode ser feito a cozina.

## Funcionalidades

  # CRUD Mesa
    - **Adicionar Mesa:** O usuário pode cadastrar um nova mesa inserindo nome do cliente, nome do garçom e status da mesa.
    - **Editar Mesa:** O usuário pode atualizar as informações de um mesa existente.
    - **Deletar Mesa:** O usuário pode excluir um mesa da lista.
    - **Listar Mesa:** Todos as mesas cadastradas são exibidos em uma lista interativa, permitindo fácil visualização e gerenciamento.
  # CRUD Pedidos
    - **Adicionar Pedido:** O usuário pode cadastrar um novo pedido nome do cliente, nome do garçom, itens do pedido.
    - **Editar Pedido:** O usuário pode atualizar as informações(como status do pedido) de um Pedido existente.
    - **Deletar Pedido:** O usuário pode excluir um Pedido da lista.
    - **Listar Pedido:** Todos os Pedidos cadastrados são exibidos em uma card com uma lista interativa.

## Estrutura do Projeto

- `app/`
  - `src/`
      - **teste**: 
    - `models/`
      - **Cliente**: Entidade para representar clientes.
      - **Funcionario**: Entidade para representar funcionarios.
      - **ItemPedido**: Entidade para representar itens do pedido.
      - **Mesa**: Entidade para representar mesas.
      - **Pedido**: Entidade para respresentar pedido.
    - `controllers/`
      - **ClienteController**: Classe de controler dos clientes.
      - **FuncionarioController**: Classe de controler dos funcionarios.
      - **ItemPedidoController**: Classe de controler de itens do pedido.
      - **MesaController**: Classe de controller de mesa.
      - **PedidoController**: classe de controller de pedido.
    - `repositories/`
      - **ClienteRepository**: Classe de repository dos clientes.
      - **FuncionarioRepository**: Classe de repository dos funcionarios.
      - **ItemPedidoRepository**: Classe de repository dos itens dos pedidos.
      - **MesaRepository**: Classe de repository das mesas.
      - **PedidoRepository**: Classe de repository dos pedidos.
    - `tests/`
      - **MesaControllerTest**: Classe de testes de mesas. 
    - `config/`
    - **api_db.sql**: Arquivos de tabelas do DB.
    - **db.php**: Arquivo de configuraçao do banco de dados.
  - **php.xml**: Arquivo de configuração de testes do phpunit.
  - **composer.json**: Arquivo de configuração de dependências do composer.
 
## Estrutura do Projeto
    - **Php:** Back-End.
    - **Angular:** Front-end.

![dg](https://github.com/user-attachments/assets/d647da3b-5732-481f-b456-02622fa41bec)
![er](https://github.com/user-attachments/assets/7a58b1d9-a18d-4cf1-9571-c79a21750737)

## Tecnologias utilizada
  #PHP: Back-End.
  #Angular: Front-End.

## Instalação

1. Clone este repositório:
   ```bash
   git clone https://github.com/seu-usuario/restaurantephpapi.git
   cd restaurantephpapi

2. Instale as dependecias do composer na raiz do projeto
   ```bash
   composer install

3. Rode o servidor no terminal
   ```bash
   php -S localhost:8000
