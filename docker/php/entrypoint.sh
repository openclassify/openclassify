#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
else
    echo "composer. nothing to do."    
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env from env-sail"
    cp .env-sail .env
else
    echo "env file exists. nothing to do."
fi

# .env dosyasını oku ve değişkenleri tanımla
while IFS= read -r line || [[ -n "$line" ]]; do
  if [[ "$line" == "INSTALLED="* ]]; then
    installed="${line#*=}"
    installed=$(echo "$installed" | tr -d '[:space:]' | tr -d '[:punct:]')  # Boşlukları ve özel karakterleri sil
    break
  fi
done < .env

# installed değişkenini kontrol et
if [ "$installed" = "false" ]; then
    echo ".env installed is false starting installing"
    php artisan install --ready
fi

php-fpm -R