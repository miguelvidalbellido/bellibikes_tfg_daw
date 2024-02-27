#!/bin/bash
clear

# Función para configurar Git
configure_git() {
    git config user.name "$1"
    git config user.email "$2"
    echo "Git configurado para $1 <$2>"
}

# Carga las variables de entorno desde .env
export $(egrep -v '^#' .env | xargs)

# Función para hacer commit y push
git_add_commit_push() {
    read -p "Ingrese el mensaje del commit: " commit_message
    read -p "Ingrese la rama para el push: " branch_name
    git add .
    git commit -m "$commit_message"
    git push origin "$branch_name"
}

# Menú principal
while true; do
    clear
    echo "Seleccione una opción:"
    echo "1) Seleccionar Miguel"
    echo "2) Seleccionar Johan"
    echo "3) Git add, commit y push"
    echo "4) Salir"
    read -p "Opción: " option

    case $option in
        1)
            configure_git "$USER_MIGUEL_NAME" "$USER_MIGUEL_EMAIL"
            ;;
        2)
            configure_git "$USER_JOHAN_NAME" "$USER_JOHAN_EMAIL"
            ;;
        3)
            git_add_commit_push
            ;;
        4)
            echo "Saliendo..."
            exit 0
            ;;
        *)
            echo "Opción inválida. Por favor, intente nuevamente."
            ;;
    esac
done
