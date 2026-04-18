@echo off
title School Project Control Center
color 0b

echo ---------------------------------------------------------
echo [1/3] Starting Meilisearch from G:\...

start "Meilisearch Engine" cmd /k "G: && cd G:\meilisearch && meilisearch.exe --master-key=otU32XdTin_K_hIIcLol0q71Qf5Dutf31MJCgpAmbk4"

echo [2/3] Starting Laravel Server...

start "Laravel Server" cmd /k "php artisan serve"

echo [3/3] Starting Vite (NPM)...
start "Vite Dev" cmd /k "npm run dev"


start "reverb" cmd /k "php artisan reverb:start"
start "queue-worker" cmd /k "php artisan queue:work --queue=notifications,default"

echo ---------------------------------------------------------
echo All systems are booting up! 
echo Meilisearch: http://127.0.0.1:7700
echo Laravel App:  http://127.0.0.1:8000
echo ---------------------------------------------------------
start http://127.0.0.1:8000
pause