#!/bin/bash

source ./.env

# Mensagem inicial
echo "Iniciando deploy para $HOST ..."

# Copiar arquivos para a EC2
echo "Copiando arquivos..."
rsync -avz -e "ssh -i $SSH_KEY_PATH" --exclude='.env' --exclude='.git' --exclude='vendor' --exclude='node_modules'  ./ $USER@$HOST:$APP_PATH

# Conectar na EC2 e rodar comandos
echo "Executando comandos remotos..."
ssh -i $SSH_KEY_PATH $USER@$HOST << EOF
    cd $APP_PATH
    echo "Instalando dependências..."
    composer install --no-dev --optimize-autoloader
    npm install
    npm run build
    echo "Atualizando permissões..."
    sudo chmod 777 -R storage
    sudo chmod 777 -R bootstrap
    echo "Rodando migrations..."
    php artisan migrate --force
    echo "Limpando cache..."
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    echo "Reiniciando servidor web (nginx/php-fpm)..."
    sudo systemctl restart php8.2-fpm
    sudo systemctl restart nginx
EOF

echo "Deploy concluído com sucesso!"
