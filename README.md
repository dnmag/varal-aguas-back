# Instruções para Configuração

##### Requisitos

1. PostgreSQL
2. PHP 7 ou superior
3. Composer
4. Driver do PostgreSQL para PHP



#### Docker

1 - Na pasta raiz do projeto, abra o terminal e execute os comandos abaixo para inicializar os containers:

```bash
docker-compose up -d
```

```bash
docker-compose exec php composer install
```

```bash
docker-compose exec php ./yii migrate --interactive=0
```

```bash
docker-compose exec php chmod 777 -R web/uploads/
```



#### Local

##### Resolvendo as dependências

1 - Na pasta raiz do projeto, abra o terminal e execute o comando abaixo para realizar o download das dependências:

```bash
composer install
```

##### Criação da Base de Dados, e conexão

1. Crie uma base de dados no ProstgreSQL, e dê o nome de 'varal_aguas'

2. Abra o arquivo 'config/db.php' e insira o 'host', 'username', e 'password' do seu banco

3. Na pasta raiz do projeto abra o terminal, e execute o seguinte comando: 

   ```bash
   ./yii migrate
   ```

   Haverá um pedido de confimação 'Apply the above migration? (yes|no) [no]:', basta de digitar yes.

   Caso ocorra algum erro, certifique-se que as dependências foram instaladas, e se os dados da conexão com o banco estão corretos.

##### Iniciando a API

Após ter realizado os passos anteriores, basta abrir o terminal na pasta raiz do projeto, e executar o seguinte comando:

```bash
./yii serve
```

Obs: A API será iniciada em modo dev, na porta 8080, apenas para testes.
