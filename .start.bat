cd C:\Users\user\Desktop\coding\Projects\Final Projects\Device Inventory\V1.0.0

@echo off

set HOST=%1
set PORT=%2

if "%HOST%"=="" set HOST=127.0.0.1
if "%PORT%"=="" set PORT=8000

echo Starting server on http://%HOST%:%PORT%
php -S %HOST%:%PORT% -t public