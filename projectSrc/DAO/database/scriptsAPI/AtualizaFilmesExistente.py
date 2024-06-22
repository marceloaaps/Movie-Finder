import conecao
import requests
import os
from dotenv import load_dotenv
from datetime import datetime
import threading

load_dotenv()

conexao = conecao.conectar()
if conexao:
    cursor = conexao.cursor()

    def fetch_movies_from_endpoint(endpoint, api_key, movies_data):
        page = 1
        total_pages = 1
        max_pages = 500  

        while page <= total_pages and page <= max_pages:
            response = requests.get(endpoint, params={'api_key': api_key, 'page': page})
            print(f"Requesting URL: {response.url}")  # Log para depuração
            if response.status_code == 200:
                data = response.json()
                movies = data.get('results', [])
                total_pages = data.get('total_pages', 1)
                for movie in movies:
                    movies_data[movie['id']] = movie
                print(f"Página buscada {page} de {total_pages} para {endpoint}")
                page += 1
            else:
                raise Exception(f"Falha ao buscar dados da API TMDB: {response.status_code}")

    def fetch_movie_details(movie_id, api_key, movies_data):
        try:
            response = requests.get(f'https://api.themoviedb.org/3/movie/{movie_id}', params={'api_key': api_key, 'append_to_response': 'credits'})
            if response.status_code == 200:
                movie_details = response.json()
                movies_data[movie_id] = movie_details
            else:
                raise Exception(f"Falha ao buscar detalhes do filme ID {movie_id} na API TMDB: {response.status_code}")
        except Exception as e:
            print(f"Erro ao buscar detalhes do filme ID {movie_id}: {str(e)}")

    def update_movies_and_record(movies_data):
        try:
            conexao.start_transaction()

            for movie_id, movie_details in movies_data.items():
                try:
                    print(f"Atualizando filme ID: {movie_id}")

                    release_date = movie_details['release_date'] if movie_details.get('release_date') else '1900-01-01'
                    cursor.execute("""
                        UPDATE FILMES
                        SET TITLE=%s, ANO_LANCAMENTO=%s, SINOPSE=%s, CAMINHO_POSTER=%s
                        WHERE ID_FILME=%s
                    """, (movie_details['title'], release_date, movie_details['overview'], movie_details['poster_path'], movie_id))

                    for genre in movie_details['genres']:
                        cursor.execute("""
                            INSERT INTO GENEROS (ID_GENERO, DS_NOME)
                            VALUES (%s, %s)
                            ON DUPLICATE KEY UPDATE
                            DS_NOME=VALUES(DS_NOME)
                        """, (genre['id'], genre['name']))
                        cursor.execute("""
                            INSERT INTO FILME_GENERO (ID_FILME, ID_GENERO)
                            VALUES (%s, %s)
                            ON DUPLICATE KEY UPDATE
                            ID_GENERO=VALUES(ID_GENERO)
                        """, (movie_id, genre['id']))

                    for actor in movie_details['credits']['cast']:
                        cursor.execute("""
                            INSERT INTO ATORES (ID_ATOR, NOME)
                            VALUES (%s, %s)
                            ON DUPLICATE KEY UPDATE
                            NOME=VALUES(NOME)
                        """, (actor['id'], actor['name']))
                        cursor.execute("""
                            INSERT INTO FILME_ATOR (ID_FILME, ID_ATOR)
                            VALUES (%s, %s)
                            ON DUPLICATE KEY UPDATE
                            ID_ATOR=VALUES(ID_ATOR)
                        """, (movie_id, actor['id']))

                    for crew_member in movie_details['credits']['crew']:
                        if crew_member['job'] == 'Director':
                            cursor.execute("""
                                INSERT INTO DIRETORES (ID_DIRETOR, NOME)
                                VALUES (%s, %s)
                                ON DUPLICATE KEY UPDATE
                                NOME=VALUES(NOME)
                            """, (crew_member['id'], crew_member['name']))
                            cursor.execute("""
                                INSERT INTO FILME_DIRETOR (ID_FILME, ID_DIRETOR)
                                VALUES (%s, %s)
                                ON DUPLICATE KEY UPDATE
                                ID_DIRETOR=VALUES(ID_DIRETOR)
                            """, (movie_id, crew_member['id']))

                except Exception as e:
                    print(f"Erro ao atualizar filme ID {movie_id}: {str(e)}")
                    cursor.execute("""
                        INSERT INTO CONTROLE_ROTINA (ID_STATUS_ROTINA, ULTIMA_ATUALIZACAO, MENSAGEM)
                        VALUES (%s, %s, %s)
                    """, (2, datetime.now(), f'Erro ao atualizar filme ID {movie_id}: {str(e)}'))

            cursor.execute("""
                INSERT INTO CONTROLE_ROTINA (ID_STATUS_ROTINA, ULTIMA_ATUALIZACAO, MENSAGEM)
                VALUES (%s, %s, %s)
            """, (1, datetime.now(), 'Executado com sucesso'))

            conexao.commit()
            print("Atualização concluída com sucesso.")

        except Exception as e:
            conexao.rollback()
            print(f"Erro ocorrido: {str(e)}")

            cursor.execute("""
                INSERT INTO CONTROLE_ROTINA (ID_STATUS_ROTINA, ULTIMA_ATUALIZACAO, MENSAGEM)
                VALUES (%s, %s, %s)
            """, (2, datetime.now(), f'Erro ao atualizar filmes: {str(e)}'))

            conexao.commit()

    def fetch_and_update_movies(endpoints, api_key):
        movies_data = {}

        threads = []
        for endpoint in endpoints:
            thread = threading.Thread(target=fetch_movies_from_endpoint, args=(endpoint, api_key, movies_data))
            threads.append(thread)
            thread.start()

        for thread in threads:
            thread.join()

        update_threads = []
        for movie_id in movies_data.keys():
            thread = threading.Thread(target=fetch_movie_details, args=(movie_id, api_key, movies_data))
            update_threads.append(thread)
            thread.start()

        for thread in update_threads:
            thread.join()

        update_movies_and_record(movies_data)

    try:
        api_key = os.getenv("APIFILME")
        endpoints = [
            'https://api.themoviedb.org/3/movie/popular',
            'https://api.themoviedb.org/3/movie/top_rated',
            'https://api.themoviedb.org/3/movie/upcoming',
            'https://api.themoviedb.org/3/movie/now_playing'
        ]

        fetch_and_update_movies(endpoints, api_key)

        cursor.execute("""
            INSERT INTO CONTROLE_ROTINA (ID_STATUS_ROTINA, ULTIMA_ATUALIZACAO, MENSAGEM)
            VALUES (%s, %s, %s)
        """, (1, datetime.now(), 'Executado com sucesso'))

        conexao.commit()

    except Exception as e:
        conexao.rollback()
        print(f"Erro ocorrido: {str(e)}")

        cursor.execute("""
            INSERT INTO CONTROLE_ROTINA (ID_STATUS_ROTINA, ULTIMA_ATUALIZACAO, MENSAGEM)
            VALUES (%s, %s, %s)
        """, (2, datetime.now(), f'Erro ao atualizar filmes: {str(e)}'))

        conexao.commit()

    cursor.close()
    conecao.desconectar(conexao)
