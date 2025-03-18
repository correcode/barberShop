Descricao de desenvolvimento APP BARBERSHOP

Banco de dados (database_barber.sql);

Usuarios: Armazenar Funcionarios (Barbeiros e Administradores)

Clientes: Cadastro de clientes.

Servicos: Tipos de servicos oferecidos.

Agendamentos: Marcacoes de horario com status (pendente, confirmado, cancelado).

Foi desenvolvido um usuarios admin padrao.


Conexao do banco de dados com Beckend (config.php)

Constantes criadas para armazenar as credenciais do banco de dados.

PDO foi usado para gerar conexao segura.

Try/Catch para capturar errros na conexao.

--
Area de Login (login.php);

Usei o session para armazenar os dados do usuario.

Usei o MD5 para criptografar as senhas dos usuarios podendo melhorar depois
com o password_hash.

Login faz:

Valida o usuario no banco de dados

Usa o session para salvar os dados

Redireciona para o painel.php apos o login.

--
Area Painel (painel.php);

Verificacao de login para acesso seguro.

Menu com opcoes: Clientes, Servicos, Agendamentos, Logout.

Exibicao de dados basicos como total de cliente, servicos e agendamentos.

--
Gerencimento de cliente (cliente.php);

Listagem de clientes cadastrados
Formulario para adicionar novos clientes.
Opcao para excluir clientes.

--
Gerenciamento de servico (servicos.php);

Listagem de servicos cadastrados.

Formulario para adicionar novos servicos.

Opcao para excluir servicos.

--
Gerenciamento de Agendamentos (agendamentos.php);

Listagem de agendamentos cadastrados.

Formulario para adicionar novos agendamentos.

Opcao para exlcuir agendamentos.

--