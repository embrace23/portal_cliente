import mysql.connector
from flask import Flask, request, render_template

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def buscar_voucher():
    if request.method == 'POST':
        # Obtener los datos del formulario
        nombre = request.form['nombre']
        apellido = request.form['apellido']
        plan = request.form['plan']

        # Conectar a la base de datos
        try:
            connection = mysql.connector.connect(
                host='localhost',
                user='root',
                database='gfa'
            )

            cursor = connection.cursor()

            # Ejecutar la consulta con los datos del formulario
            query = f"SELECT * FROM pax WHERE nombre='{nombre}' AND apellido='{apellido}' AND plan='{plan}'"
            cursor.execute(query)

            # Obtener los resultados
            resultados = cursor.fetchall()

            # Cerrar la conexión
            cursor.close()
            connection.close()

            # Renderizar la plantilla usuario.html con los resultados
            return render_template('usuario.html', resultados=resultados)

        except Exception as e:
            return f"Error: {e}"

    # Si es una solicitud GET, simplemente renderizar el formulario
    return render_template('usuario.html')

if __name__ == '__main__':
    app.run(debug=True)
