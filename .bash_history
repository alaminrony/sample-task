docker-compose exec app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
exit
composer install
COMPOSER_PROCESS_TIMEOUT=600 composer install
php artisan key:generate
ls -l /var/www/resources/views/welcome.blade.php
touch /var/www/resources/views/welcome.blade.php
php artisan migrate:fresh --seed
exit
ls
ls -a
exit
php artisan migrate:fresh seed
php artisan migrate:fresh --seed
exit
php artisan make:controller EventController -m
php artisan make:model Event
php artisan make:model EventDetails
php artisan make:migration create_events_table
php artisan make:migration create_event_details_table
php artisan migrate:fresh --seed
php artisan migrate:fresh --seed
exit
php artisan optimize:clear
clear
php artisan cache:clear
exit
php artisan optimize:clear
php artisan optimize:clear
php artisan optimize:clear
php artisan make:controller SeatLockController
php artisan make:controller TicketBookingController
exit
php artisan make:migration create_ticket_table
php artisan migrate:fresh --seed
php artisan make:model Ticket
git status
php artisan optimize:clear
exit
