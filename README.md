
# Discount Code Generator

### Uruchomienie projektu:

- sklonuj repozytorium
- uruchom composer install
- skopiuj config z env.example o nazwij go .env
- wygeneruj klucz: php artisan key:generate
- w przypadku problemów z przekierowaniami należy dodać ścieżkę do folderu public projektu do VirtualHost'a
- aby wykonać testy wykonaj komendę:  ./vendor/bin/phpunit

### Uruchomienie komendy do generowania kodów:

- php artisan generate-discount-codes
- podaj argumenty o które jesteś proszony
