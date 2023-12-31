@if (auth()->check())
<!doctype html>
<html lang="en">

<head> <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title> SGD | Listagem de Clientes </title>
    <style>
        .linha-reduzida td {
            padding: 0.25rem 0.5rem;
            /* Ajuste o espaçamento conforme necessário */
        }

        body {
            background: linear-gradient(to bottom, #FFBF69, #CBF3f0);
            font-family: Arial, sans-serif;
            /* Defina a fonte
desejada para o conteúdo da página */
            margin: 0;
            padding: 0;
        }

        .mensagem-sucesso {
            display: none;
            background-color: #4CAF50;
            /* Cor de fundo verde */
            color: #fff;
            /* Cor do texto branco */
            text-align: center;
            padding: 15px;
            width: 20rem;
            height: 3rem;
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform:
                translateX(-50%);
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #ff9a0e;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Efeito de fade-in na mensagem */
        .mensagem-sucesso.show {
            animation: fadein 0.5s;
        }

        @keyframes fadein {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .notify {
            display: none;
        }

        .div-menor {
            width: 100%;
            height: 100%;
            /* Defina a largura desejada */
            /* Defina a altura desejada */
        }
    </style>
</head>

<body onload="formatarDataNoInicio()">

    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="div-menor">
                        @if(session('success'))
                        <span class="alert alert-success mensagem-sucesso" id="mensagemSucesso" role="alert">
                            {{session('success')}}
                        </span>
                        <button id="notify" class="btn btn-info btn-md btn-block text-light"
                            onclick="exibirMensagemDeSucesso()">
                            <div class="w-2rem text-white text-center p-2 h1">
                                <span class="badge badge-danger h4 font-weight-bold">Notificações (Clique aqui)
                                    &#128276;</span>
                            </div>
                        </button>
                        @endif
                    </div>
                    <div class="card-header text-center">
                        <h2>
                            <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
                            <b>Listagem de Clientes </b>
                        </h2>
                    </div>
                    <table class="table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">@</th>
                                <th scope="col w-25">Registro na Api</th>
                                <th scope="col w-25">Nome de cliente</th>
                                <th scope="col w-25">Endereço de email</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Data de nascimento</th>
                                <th scope="col w-50">Data de cadastro</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $value)
                            <tr class="linha-reduzida">
                                <th scope="row">{{++$key}}</th>
                                <td>{{$value->_id ?? ''}}</td>
                                <td>{{$value->name ?? ''}}</< /td>
                                <td>{{$value->email ?? ''}}</td>
                                <td>{{$value->fix_phone ?? ''}}</td>
                                <td>{{$value->cel_phone ?? ''}}</td>
                                <td>{{$value->date_of_birth ?? ''}}</td>
                                <td id="data_criacao">{{$value->created_at ?? ''}}</td>
                                <td>
                                    <a href="{{route('customer.edit', $value->_id)}}" class="btn btn-warning">
                                        ✏️ Editar
                                    </a>
                                    <br></br>
                                    <a href="{{route('customer.show', $value->_id)}}" class="btn btn-danger">
                                        🗑️ Excluir
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>
        <script>
            function formatarDataISO8601(data) {
                data = new Date(data);
                const dia = data.getDate().toString().padStart(2, '0');
                const mes = (data.getMonth() + 1).toString().padStart(2, '0');
                const ano = data.getFullYear();
                return `${dia}/${mes}/${ano}`;
            }

            function padZero(numero) {
                return numero < 10 ? '0' + numero : numero;
            }

            function formatarDataNoInicio() {
                var input = document.getElementById("data_criacao");
                input.value = formatarDataISO8601(input.value);
            }

            function exibirMensagemDeSucesso() {
                var mensagemSucesso = document.getElementById("mensagemSucesso");
                mensagemSucesso.style.display = "block";
                setTimeout(function () {
                    mensagemSucesso.style.display = "none";
                    exibirNotify();
                }, 3000); // Esconde a mensagem após 3 segundos (3000 ms)
            }

            function exibirNotify() {
                var notify = document.getElementById("notify");
                console.log(notify);
                notify.style.display = "block";
                setTimeout(function () {
                    notify.style.display = "none";
                }, 3000); // Esconde a mensagem após 3 segundos (3000 ms)
            }
        </script>
    </body>

</html>
@else <a href="{{ route('login.index') }}" class="btn-link">Entrar</a>
@endif