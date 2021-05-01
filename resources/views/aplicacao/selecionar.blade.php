<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}} - Selecione A Aplicação</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-12 mb-5 text-center">
                <h1>Escolha a sua aplicação preferida:</h1>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card mx-auto" style="width: 18rem;">
                    <img height="160" class="card-img-top" src="https://www.upinside.com.br/tim.php?src=uploads/courses/2018/09/bootstrap-builder-1536168891.jpg&w=600" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title">Bootstrap</h5>
                        <p class="card-text">Aplicação desenvolvida com Laravel no back-end e Bootstrap no front-end.</p>
                        <a href="/bootstrap/clientes" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card mx-auto" style="width: 18rem;">
                    <img height="160" class="card-img-top" src="https://miro.medium.com/max/4000/1*XH9l-6x9SUlmGxPlZFaoIA.jpeg" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title">Vue.js</h5>
                        <p class="card-text">Aplicação desenvolvida com Laravel no back-end e vue no front-end.</p>
                        <a href="/vue/clientes" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>