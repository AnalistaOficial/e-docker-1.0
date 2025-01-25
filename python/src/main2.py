import mysql.connector

# Configuração de conexão
host = "container-mysql"
port = "3306"
database = "db_web"
user = "user"
password = "user"

# Conectando ao banco de dados MySQL
connection = mysql.connector.connect(
    host=host,
    port=port,
    database=database,
    user=user,
    password=password
)

# Criando um cursor para executar consultas
cursor = connection.cursor()

# Criando a tabela Clients se não existir
create_table_query = """
CREATE TABLE IF NOT EXISTS Clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100)
);
"""
try:
    cursor.execute(create_table_query)
    print("Tabela 'Clients' verificada/criada com sucesso.")
except mysql.connector.Error as err:
    print(f"Erro ao criar a tabela: {err}")

# Inserindo 5 linhas fictícias na tabela Clients
insert_query = """
INSERT INTO Clients (first_name, last_name, email) 
VALUES 
    ('John', 'Doe', 'john.doe@example.com'),
    ('Jane', 'Smith', 'jane.smith@example.com'),
    ('Alice', 'Johnson', 'alice.johnson@example.com'),
    ('Bob', 'Brown', 'bob.brown@example.com'),
    ('Charlie', 'Davis', 'charlie.davis@example.com');
"""
try:
    cursor.execute(insert_query)
    connection.commit()
    print("5 linhas inseridas com sucesso na tabela Clients.")
except mysql.connector.Error as err:
    print(f"Erro ao inserir dados: {err}")

# Consulta SQL para recuperar os dados
query = "SELECT id, first_name, last_name, email FROM Clients"

# Executando a consulta
cursor.execute(query)

# Obtendo os resultados
results = cursor.fetchall()

# Exibindo os resultados
print("\nResultados da consulta:")
for row in results:
    print(f"ID: {row[0]}, First Name: {row[1]}, Last Name: {row[2]}, Email: {row[3]}")

# Fechando a conexão
cursor.close()
connection.close()
