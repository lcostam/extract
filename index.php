<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extraindo informações da Tabela de Salário</title>
</head>
<body>
    <h1>Extração de dados na TABELA DOS VALORES NOMINAIS do Salário Mínimo</h1>
<form action="script2.php" method="post">
<p>
    <label>Selecione sua opção: </label>
    <select name="opt">
        <option value="1">Todos os Salários</option>
        <option value="2">Ano de 2020</option>
        <option value="3">Salario de 2010 a 2020</option>
        <option value="4">Salario antes de 2010</option>
    </select>
</p>
<p>
    <input type=submit value="EXTRAIR">
</p>
</form> 
</body>
</html>