import mysql.connector
import os
from dotenv import load_dotenv

load_dotenv()

def conectar():
    host = os.getenv("HOST")
    user = os.getenv("USER")
    password = os.getenv("PASSWORD")
    database = os.getenv("DATABASE")

    if not all([host, user, password, database]):
        raise ValueError("Alguma variável de ambiente não foi carregada corretamente.")

    try:
        conexao = mysql.connector.connect(
            host=host,
            user=user,
            password=password,
            database=database
        )

        if conexao.is_connected():
            print('Conectado ao banco de dados com sucesso!')
            return conexao

    except mysql.connector.Error as err:
        print(f"Erro ao conectar ao banco de dados: {err}")
        return None

def desconectar(conexao):
    if conexao.is_connected():
        conexao.close()
        print('Conexão com o banco de dados fechada.')
