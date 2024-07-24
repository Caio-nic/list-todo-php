<?php
require_once '../../includes/config.php';
require_once '../../includes/functions.php';

// Verifica se o parâmetro 'id' está presente na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Verifica se o formulário foi submetido via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtenha os dados do formulário
        $nome = $_POST['nome'];
        $prioridade = $_POST['prioridade'];
        
        // Chame a função para atualizar a tarefa
        update($connect, $id, $nome, $prioridade);
        
        // Redirecione o usuário para a página de lista de tarefas ou exiba uma mensagem de sucesso
        header("Location: /");
        exit();
    }
    
    // Obtenha os detalhes da tarefa do banco de dados
    $tarefa = read($connect, $id); // Implemente a função readTarefaById para obter os dados da tarefa
    
    if (!$tarefa) {
        die("Tarefa não encontrada.");
    }
} else {
    die("Parâmetro 'id' não encontrado na URL.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="../../assets/css/editTask.css">
</head>
<body>
    <div class="container">
        <h1>Editar Tarefa</h1>       
        <form action="index.php?id=<?php echo $id; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nome">Nome da Tarefa</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($tarefa['nome']); ?>" required>
            </div>
            <div class="form-group">
                <label for="prioridade">Prioridade</label>
                <select id="prioridade" name="prioridade">
                    <option value="urgente" <?php if ($tarefa['prioridade'] == 'urgente') echo 'selected'; ?>>Urgente</option>
                    <option value="normal" <?php if ($tarefa['prioridade'] == 'normal') echo 'selected'; ?>>Normal</option>
                    <option value="tranquilo" <?php if ($tarefa['prioridade'] == 'tranquilo') echo 'selected'; ?>>Tranquilo</option>
                </select>
            </div>
            <button type="submit" class="btn">Salvar Alterações</button>
            <a href="/" class="btn btn-danger">Cancelar</a>
        </form>
        
        <p><a href="/">Voltar para Lista de Tarefas</a></p>
    </div>
</body>
</html>

