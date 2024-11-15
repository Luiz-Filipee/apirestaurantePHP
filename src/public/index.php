<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


require_once("../Router.php");
require_once("../controllers/PedidoController.php");
require_once "../controllers/MesaController.php";
require_once "../controllers/ClienteController.php";
require_once "../controllers/FuncionarioController.php";
require_once "../controllers/ItemPedidoController.php";


$router = new Router();
$mesaController = new MesaController();
$clienteController = new ClienteController();
$pedidoController = new PedidoController();
$funcionarioController = new FuncionarioController();
$itemPedidoController = new ItemPedidoController();


// ROTAS MESAS

$router->add('/mesas', function () use($mesaController)   {
    header('Content-Type: application/json');
    $mesaController->getAllMesas();
});

$router->addPost('/mesas', function () use($mesaController) {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        header('Content-Type: application/json');
        $mesaController->criaMesa($data);
        // echo json_encode([
        //     'message' => 'Mesa criada com sucesso!',
        //     'mesa' => $data
        // ]);
    } else {
        header('Content-Type: application/json', true, 400);
        // echo json_encode(['message' => 'Erro ao criar a mesa']);
    }
});

$router->addPut('/mesas/{id}', function($id) use($mesaController){
    $data = json_decode(file_get_contents(filename: 'php://input'), true);

    if ($data) {
        header('Content-Type: application/json');
        $mesaController->atualizaMesa($id, $data);
        // echo json_encode([
        //     'message' => 'Mesa atualizada com sucesso!',
        //     'mesa' => $data,
        //     'id' => $id
        // ]);
    } else {
        header('Content-Type: application/json', true, 400);
        // echo json_encode(['message' => 'Erro ao atualizar a mesa']);
    }
});

$router->addDelete('/mesas/{id}', function($id) use($mesaController){
    header(header: 'Content-Type: application/json');

    if ($id) {
        try {
            $id = (int)$id;  
            $mesaController->remove($id);
            echo json_encode(['message' => 'Mesa removida com sucesso']);
        } catch(Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['message' => 'ID da mesa inválido']);
    }
});

// ROTAS CLIENTES

$router->add('/clientes', function () use($clienteController)   {
    header('Content-Type: application/json');
    // echo json_encode(['message' => 'Página de clientes']);
    $clienteController->listarClientes();
});


$router->addPost('/clientes', function () use($clienteController) {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        header('Content-Type: application/json');
        $clienteController->criar($data);
        // echo json_encode([
        //     'message' => 'Cliente criada com sucesso!',
        //     'cliente' => $data
        // ]);
    } else {
        header('Content-Type: application/json', true, 400);
        // echo json_encode(['message' => 'Erro ao criar cliente']);
    }
});

// ROTAS FUNCIONARIOS

$router->add('/funcionarios', function () use($funcionarioController)   {
    header('Content-Type: application/json');
    // echo json_encode(['message' => 'Página de funcionarioController']);
    $funcionarioController->listaFuncionarios();
});

$router->add('/funcionarios/{nome}', function ($nome) use($funcionarioController)   {
    if($nome){
        header('Content-Type: application/json');
        $funcionarioController->buscaFuncionarioPorNome($nome);
    }else{
        header('Content-Type: application/json', true, 400);
    }
});


$router->addPost('/funcionarios', function () use($funcionarioController) {
    $data = json_decode(file_get_contents('php://input'), associative: true);

    if ($data) {
        header('Content-Type: application/json');
        $funcionarioController->criaFuncionario($data);
        // echo json_encode([
        //     'message' => 'Funcionario criada com sucesso!',
        //     'cliente' => $data
        // ]);
    } else {
        header('Content-Type: application/json', true, 400);
        // echo json_encode(['message' => 'Erro ao criar cliente']);
    }
});

// ROTAS PEDIDOS

$router->add('/pedidos', function () use($pedidoController)  {
    header('Content-Type: application/json');
    // echo json_encode(['message' => 'Página de pedidos']);
    $pedidoController->listarPedidos();
});

$router->add('/pedidos/{id}', function ($id) use($pedidoController)  {
    header('Content-Type: application/json');
    // echo json_encode(['message' => 'Página de pedidos']);
    if($id){
        $pedidoController->visualizarPedido($id);
        // echo json_encode([
        //     'message' => 'Pedido encontrado com sucesso!',
        //     'id' => $id
        // ]);
    }else{
        header('Content-Type: application/json', true, 400);
        // echo json_encode(['message' => 'Erro ao processar o pedido']);
    }
});

$router->addPost('/pedidos', function () use($pedidoController)  {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        header('Content-Type: application/json');
        $pedidoController->criaPedido($data);
        // echo json_encode([
        //     'message' => 'Pedido recebido com sucesso!',
        //     'pedido' => $data
        // ]);
    } else {
        header('Content-Type: application/json', true, 400);
        // echo json_encode(['message' => 'Erro ao processar o pedido']);
    }
});

$router->addPut('/pedidos/{id}/pronto', function($id) use($pedidoController) {
    header('Content-Type: application/json');

    if ($id) {
        try {
            $id = (int)$id;  
            $pedidoController->marcarComoPronto($id);
            echo json_encode(['message' => 'Pedido atualizado com sucesso']);
        } catch(Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['error' => 'ID inválido']);
    }
});

$router->addDelete('/pedidos/{id}', function($id) use($pedidoController) {
    header(header: 'Content-Type: application/json');

    if ($id) {
        try {
            $id = (int)$id;  
            $pedidoController->deletarPedido($id);
            echo json_encode(['message' => 'Pedido removido com sucesso']);
        } catch(Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['message' => 'ID da mesa inválido']);
    }
});

// ROTAS ITENS CARDAPIO

$router->add('/itens', function () use($itemPedidoController)  {
    header('Content-Type: application/json');
    // echo json_encode(['message' => 'Página de pedidos']);
    $itemPedidoController->listar();
});

$router->addPost('/itens', function() use($itemPedidoController) {
    $data = json_decode(file_get_contents(filename: 'php://input'), true);

    if ($data) {
        header(header: 'Content-Type: application/json');
        $itemPedidoController->criar($data);
    } else {
        header('Content-Type: application/json', true, 400);
    }
});

$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// echo "Caminho solicitado: " . $requestedPath;
$router->dispatch($requestedPath);