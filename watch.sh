echo "Starting development server..."

# Install dependencies
echo "Installing composer dependencies..."
composer install

# Run migration and start the server initially
php artisan migrate
php artisan db:seed
php artisan serve --host=0.0.0.0 --port=8000 

# # Monitor file changes inside the container
# while inotifywait -r -e modify,create,delete --include "\.php$" /var/www/html; do
#     echo "Files changed. Restarting Laravel development server..."

#     # Get the PID of the process running on port 8000
#     SERVER_PID=$(lsof -t -i:8000)

#     if [ -n "$SERVER_PID" ]; then
#         echo "Stopping server with PID $SERVER_PID..."
#         kill -9 $SERVER_PID
#     else
#         echo "No process running on port 8000."
#     fi

#     # Give some time for the process to terminate
#     sleep 3

#     # Run migrations and restart the server
#     php artisan cache:clear
#     php artisan config:clear
#     php artisan route:clear    
#     php artisan migrate
#     php artisan serve --host=0.0.0.0 --port=8000 &
# done