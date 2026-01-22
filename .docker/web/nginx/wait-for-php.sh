#!/bin/sh

set -e  # Exit on error

# Wait until PHP-FPM is ready to accept connections
while ! nc -z weather_service_php 9000; do
    echo "Waiting for PHP-FPM to start..."
    sleep 1
done
