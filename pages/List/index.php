<?php
    require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Tarefas</title>
</head>
<body>
    <div class="container">
        <h1>Lista de Tarefas</h1>     
        <table>
            <caption>Tarefas</caption>
            <thead>
                <tr>
                    <th>Tarefa</th>
                    <th>Prioridade</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Lavar o carro</td>
                    <td>Normal</td>
                    <td class="status pendente">Pendente</td>
                    <td class="actions">
                        <button class="btn">Marcar Feita</button>
                        <button class="btn">Editar</button>
                        <button class="btn">Excluir</button>
                    </td>
                </tr>
                <tr>
                    <td>Comprar leite</td>
                    <td>Urgente</td>
                    <td class="status feita">Feita</td>
                    <td class="actions">
                        <a class="btn" href="editTask.php">Editar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p><a href="createTask.php">Criar Nova Tarefa</a></p>
    </div>
</body>
</html>
