<?php
require_once("../Router.php");
// require_once("../repositories/FuncionarioRepository.php");
// require_once("../repositories/MesaRepository.php.php");
// require_once("../repositories/PedidoRepository.php.php");
// require_once("../controllers/PedidoController.php");

$router = new Router();
// $funcionarioRepository = new FuncionarioRepository();
// $pedidoRepository = new PedidoRepository();
// $mesaRepository = new MesaRepository();
// $pedidoController = new PedidoController($pedidoRepository, $mesaRepository, $funcionarioRepository);

$router->add('/mesas', function ()   {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Página de mesas']);
    // $controller = new MesaController();
    // $controller->getAllMesas();
});

$router->addPost('/mesas', function () {
    $data = json_decode(file_get_contents('php://input'), true);
    // $controller = new MesaController();

    if ($data) {
        header('Content-Type: application/json');
        // $controller->criaMesa($data);
        echo json_encode([
            'message' => 'Mesa criada com sucesso!',
            'mesa' => $data
        ]);
    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['message' => 'Erro ao criar a mesa']);
    }
});

$router->addPut('/mesas/{id}', function($id){
    $data = json_decode(file_get_contents(filename: 'php://input'), true);
    // $controller = new MesaController();

    if ($data) {
        header('Content-Type: application/json');
        // $controller->atualizaMesa($id, $data);
        echo json_encode([
            'message' => 'Mesa atualizada com sucesso!',
            'mesa' => $data,
            'id' => $id
        ]);
    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['message' => 'Erro ao atualizar a mesa']);
    }
});

$router->addDelete('/mesas/{id}', function($id){
    // $controller = new MesaController();

    if ($id) {
        header('Content-Type: application/json');
        echo json_encode([
            'message' => 'Mesa removida com sucesso!',
            'id' => $id
        ]);
    }else{
        header('Content-Type: application/json', true, 400);
        echo json_encode(['message' => 'Erro ao remover a mesa']);
    }
});

// $router->add('/pedidos', function () use($pedidoController) {
//     header('Content-Type: application/json');
//     echo json_encode(['message' => 'Página de pedidos']);
//     $pedidoController->listarPedidos();
// });

// $router->addPost('/pedidos', function () use($pedidoController) {
//     $data = json_decode(file_get_contents('php://input'), true);

//     if ($data) {
//         header('Content-Type: application/json');
//         $pedidoController->criaPedido($data);
//         echo json_encode([
//             'message' => 'Pedido recebido com sucesso!',
//             'pedido' => $data
//         ]);
//     } else {
//         header('Content-Type: application/json', true, 400);
//         echo json_encode(['message' => 'Erro ao processar o pedido']);
//     }
// });

// $router->addPut('/pedidos', function($id) use($pedidoController){
//     $data = json_decode(file_get_contents(filename: 'php://input'), true);

//     if ($data) {
//         header(header: 'Content-Type: application/json');
//         $pedidoController->atualizarPedido($id, $data);
//         echo json_encode([
//             'message' => 'Mesa atualizada com sucesso!',
//             'mesa' => $data
//         ]);
//     } else {
//         header('Content-Type: application/json', true, 400);
//         echo json_encode(['message' => 'Erro ao atualizar pedido']);
//     }
// });

// $router->addDelete('/pedidos', function($id) use($pedidoController){
//     $data = json_decode(file_get_contents(filename: 'php://input'), true);

//     if($data){
//         header('Content-Type: application/json');
//         $pedidoController->deletarPedido($id);
//         echo json_encode([
//             'message' => 'pedido atualizado com sucesso!',
//             'pedido' => $data
//         ]);
//     }else{
//         header('Content-Type: application/json', true, 400);
//         echo json_encode(['message' => 'Erro ao remover o pedido']);
//     }
// });

$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
echo "Caminho solicitado: " . $requestedPath;
$router->dispatch($requestedPath);