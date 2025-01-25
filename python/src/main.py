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

# Consulta SQL
query = "SELECT id, first_name, last_name, email FROM Clients"

# Executando a consulta
cursor.execute(query)

# Obtendo os resultados
results = cursor.fetchall()

# Exibindo os resultados
for row in results:
    print(f"ID: {row[0]}, First Name: {row[1]}, Last Name: {row[2]}, Email: {row[3]}")

# Fechando a conexão
cursor.close()
connection.close()
