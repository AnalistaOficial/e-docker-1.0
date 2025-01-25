<h1 align="center">Estudo com Docker Compose  - e-docker-1.0</h1>

#Objetivo:

Este projeto utiliza o Docker Compose para configurar e gerenciar um ambiente composto por múltiplos serviços: um servidor web Nginx, um ambiente de desenvolvimento PHP, um banco de dados MySQL e uma aplicação Python. Abaixo, você encontrará as instruções para configurar e utilizar este ambiente.


## Estrutura dos Serviços

### 1. Servidor Web (Nginx)

- **Imagem:** `nginx:latest`
- **Container Name:** `container-nginx`
- **Portas:**
  - `80:80` (redireciona a porta 80 do host para a porta 80 do container)
- **Volumes:**
  - `./nginx/default.conf:/etc/nginx/conf.d/default.conf`: Define o arquivo de configuração personalizado do Nginx.

### 2. Ambiente de Desenvolvimento (PHP)

- **Imagem:** `php:3.21`
- **Container Name:** `container-php`
- **Volumes:**
  - `./php/public:/var/www/html/public`: Sincroniza o diretório local com o diretório de trabalho do container.

### 3. Banco de Dados (MySQL)

- **Imagem:** `mysql:9.2.0`
- **Container Name:** `container-mysql`
- **Portas:**
  - `3306:3306` (redireciona a porta 3306 do host para a porta 3306 do container)
- **Volumes:**
  - `./data:/var/lib/mysql`: Persistência de dados do MySQL.
- **Variáveis de Ambiente:**
  - `MYSQL_ROOT_PASSWORD: root`
  - `MYSQL_DATABASE: db_web`
  - `MYSQL_USER: user`
  - `MYSQL_PASSWORD: user`
- **Network:**
  - `mynetwork`: O container está conectado a uma rede externa chamada `mynetwork`.

### 4. Aplicação Python

- **Imagem:** `python:3.9-slim`
- **Container Name:** `python-container`
- **Volumes:**
  - `./python/src:/app`: Sincroniza o diretório local com o diretório de trabalho do container.
- **Working Directory:** `/app`
- **Network:**
  - `mynetwork`: O container está conectado à rede `mynetwork`.
- **Comando de Inicialização:**
  - `bash -c "pip install mysql-connector-python && tail -f /dev/null"`
  - Instala o pacote `mysql-connector-python` e mantém o container ativo.

## Rede

Todos os containers estão conectados a uma rede Docker externa chamada `mynetwork`. Certifique-se de que a rede foi criada antes de subir os containers:

```bash
docker network create mynetwork
```

## Configuração e Uso

### Pré-requisitos

- Docker
- Docker Compose

### Instruções

1. Clone este repositório:

   ```bash
   git clone <URL_DO_REPOSITORIO>
   cd <DIRETORIO_DO_REPOSITORIO>
   ```

2. Certifique-se de que a rede `mynetwork` está criada:

   ```bash
   docker network create mynetwork
   ```

3. Suba os serviços:

   ```bash
   docker-compose up -d
   ```

   Isso iniciará todos os containers definidos no `docker-compose.yml`.

4. Acesse os serviços:

   - **Servidor Web:** Acesse via navegador em `http://localhost`.
   - **Banco de Dados MySQL:**
     - Host: `container-mysql`
     - Porta: `3306`
     - Usuário: `user`
     - Senha: `user`
     - Banco de Dados: `db_web`

### Parar os Serviços

Para parar e remover os containers, execute:

```bash
docker-compose down
```

## Estrutura do Projeto

```plaintext
/
├── data/                  # Diretório para persistência de dados do MySQL
├── nginx/
│   └── default.conf       # Configuração personalizada do Nginx
├── php/
│   └── public/            # Código-fonte PHP
├── python/
│   └── src/               # Código-fonte Python
└── docker-compose.yml     # Configuração do Docker Compose
```

## Notas

- Certifique-se de que os diretórios de volume mencionados estão corretamente configurados no seu sistema.
- Você pode modificar o arquivo `docker-compose.yml` conforme necessário para atender aos requisitos específicos do seu projeto.

---

Pronto! O ambiente Docker Compose está configurado e pronto para uso. Caso tenha dúvidas ou problemas, sinta-se à vontade para abrir uma issue ou contribuir com melhorias. 🚀

