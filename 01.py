import sys

def chatbot(arg1, arg2):
    # Saludo inicial si ambos argumentos están vacíos
    if not arg1 and not arg2:
        print("Hola usuario, ¿en qué puedo ayudarte hoy?")
    else:
        print(f"Hola {arg1} {arg2}, ¿en qué puedo ayudarte hoy?")

    # Aquí podríamos añadir más interacciones basadas en el mensaje
    while True:
        user_input = input(f"{arg1} {arg2}: ")  # El chatbot espera una entrada del usuario

        # Responder según el mensaje
        if 'precio' in user_input.lower():
            # Ejemplo de respuesta: Precio de un producto
            print("El precio del producto es $25.00")
        elif 'cantidad' in user_input.lower():
            # Ejemplo de respuesta: Cantidad en stock
            print("Tenemos 10 unidades en stock.")
        elif 'adiós' in user_input.lower() or 'salir' in user_input.lower():
            # Salir del chatbot
            print("Adiós, que tengas un buen día.")
            break
        else:
            print("Lo siento, no entiendo esa pregunta. ¿Te gustaría preguntar algo más?")

if __name__ == "__main__":

    # Verificar que se han pasado dos argumentos
    if len(sys.argv) != 3:
        print("Error: Se requieren dos argumentos.")
        sys.exit(1)

    # Obtener los argumentos desde la línea de comandos
    arg1 = sys.argv[1]  # Primer argumento (nombres)
    arg2 = sys.argv[2]  # Segundo argumento (apellidos)

    # Iniciar el chatbot
    chatbot(arg1, arg2)
