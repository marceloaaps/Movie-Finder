import conecao
import requests
import os
from dotenv import load_dotenv
from datetime import datetime

# Carregar variáveis de ambiente do arquivo .env
load_dotenv()

conexao = conecao.conectar()
if conexao:
    cursor = conexao.cursor()

    def fetch_movies_from_endpoint(endpoint, api_key):
        page = 1
        total_pages = 1
        all_movies = []
        max_pages = 500

        while page <= total_pages and page <= max_pages:
            response = requests.get(endpoint, params={'api_key': api_key, 'page': page})
            print(f"Requesting URL: {response.url}")  # Log para depuração
            if response.status_code == 200:
                data = response.json()
                movies = data.get('results', [])
                total_pages = data.get('total_pages', 1)
                all_movies.extend(movies)
                page += 1
            else:
                raise Exception(f"Failed to fetch data from TMDb API: {response.status_code}")

        return all_movies

    def update_movies_and_record():
        try:
            conexao.start_transaction()

            api_key = os.getenv("APIFILME")
            endpoints = [
                'https://api.themoviedb.org/3/movie/popular',
                'https://api.themoviedb.org/3/movie/top_rated',
                'https://api.themoviedb.org/3/movie/upcoming',
                'https://api.themoviedb.org/3/movie/now_playing'
            ]

            all_movies = []
            for endpoint in endpoints:
                movies = fetch_movies_from_endpoint(endpoint, api_key)
                all_movies.extend(movies)

            for movie in all_movies:
                release_date = movie['release_date'] if movie['release_date'] else '1900-01-01'
                cursor.execute("""
                    INSERT INTO FILMES (ID_FILME, title, ANO_LANÇAMENTO, SINOPSE, CAMINHO_POSTER)
                    VALUES (%s, %s, %s, %s, %s)
                    ON DUPLICATE KEY UPDATE
                    title=VALUES(title),
                    ANO_LANÇAMENTO=VALUES(ANO_LANÇAMENTO),
                    SINOPSE=VALUES(SINOPSE),
                    CAMINHO_POSTER=VALUES(CAMINHO_POSTER)
                """, (movie['id'], movie['title'], release_date, movie['overview'], movie['poster_path']))

            # Registrar o sucesso na tabela CONTROLE_ROTINA
            cursor.execute("""
                INSERT INTO CONTROLE_ROTINA (ID_STATUS_ROTINA, ULTIMA_ATUALIZACAO, MENSAGEM)
                VALUES (%s, %s, %s)
            """, (1, datetime.now(), 'Executado com sucesso'))

            conexao.commit()

        except Exception as e:
            conexao.rollback()

            # Registrar o erro na tabela CONTROLE_ROTINA
            cursor.execute("""
                INSERT INTO CONTROLE_ROTINA (ID_STATUS_ROTINA, ULTIMA_ATUALIZACAO, MENSAGEM)
                VALUES (%s, %s, %s)
            """, (2, datetime.now(), f'Erro ao atualizar filmes: {str(e)}'))

            conexao.commit()

    update_movies_and_record()

    cursor.close()
    conecao.desconectar(conexao)
