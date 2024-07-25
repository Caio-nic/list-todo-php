<?php
    require_once '../../includes/config.php';
    require_once '../../includes/functions.php';

    $status = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["nome"]) && isset($_POST["prioridade"])) {
            $nome = htmlspecialchars($_POST["nome"]);
            $prioridade = $_POST["prioridade"];

            if (create($nome, $prioridade, $connect)) {
                $status = 'success';
            } else {
                $status = 'error';
            }
        }

        header("Location: ".$_SERVER['PHP_SELF']."?status=".$status);
        exit;
    }

    $status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tarefa</title>
    <link rel="stylesheet" href="../../assets/css/createTask.css">
    <script src="../../assets/js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h1>Criar Nova Tarefa</h1>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="nome">Nome da Tarefa</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="prioridade">Prioridade</label>
                <select id="prioridade" name="prioridade">
                    <option value="tranquilo">Tranquilo</option>
                    <option value="normal">Normal</option>
                    <option value="urgente">Urgente</option>
                </select>
            </div>
            <button type="submit" class="btn">Criar Tarefa</button>
        </form>
        <p><a href="/">Voltar para Lista de Tarefas</a></p>
    </div>
    <script src="../../assets/js/alerts.js"></script> <!-- Adicione esta linha -->
</body>
</html>

