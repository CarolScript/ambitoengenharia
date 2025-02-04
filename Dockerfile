# Use uma imagem PHP com Apache
FROM php:8.0-apache

# Copia todos os arquivos para o diretório padrão do Apache
COPY . /var/www/html/

# Habilita mod_rewrite se necessário (opcional)
RUN a2enmod rewrite

# Expor a porta 80
EXPOSE 80