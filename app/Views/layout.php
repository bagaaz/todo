<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>
<body>
    <header>
        <h1 class="header_title">To-Do List</h1>
    </header>

    <main>
        <section class="app">
            <div class="app_header">
                <h2 class="app_header__title">Adicione uma tarefa</h2>
                <form class="app_header__form" action="/store" method="post">
                    <input class="app_header__input-task" type="text" name="task" id="task" placeholder="Criar cronograma de estudos para as materias da faculdade." required>
                    <button type="submit" class="app_header__submit-button"><i class="bi bi-plus"></i></button>
                </form>
            </div>
            <div class="app_body">
                <h2 class="app_body__title">Tarefas</h2>
                <ul class="app_body__list">
                    <?= $content ?>
                </ul>
            </div>
        </section>
    </main>

    <footer>
        <p class="footer_about">Desenvolvido por <a href="https://www.linkedin.com/in/bagaaz/">Gabriel Oliveira</a></p>
    </footer>
        
    <script src="/js/main.js"></script>
</body>
</html>