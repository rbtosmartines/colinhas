# -*- encoding: utf-8 -*-

import mysql.connector
import datetime

connection = mysql.connector.connect(
  host="localhost",
  port="3308",
  user="root",
  password="beta2020",
  database="test"
)

cursor = connection.cursor()

sql = "SELECT DISTINCT(Categoria) FROM test.tienda_transacoes"

cursor.execute(sql)
results = cursor.fetchall()

for result in results:
  x = result[0]
  val = (x,)
  sql = "SELECT COUNT(*) AS qtd FROM tienda.d_categorias WHERE categoria = %s"
  cursor.execute(sql, val)
  result = cursor.fetchone()
  qtd = result[0]
  if qtd == 0: 
    sql = "INSERT INTO tienda.d_categorias (categoria) VALUES (%s)"
    cursor.execute(sql, val)

connection.commit()

cursor.close()
connection.close()