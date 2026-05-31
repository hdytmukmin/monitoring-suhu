# Arsitektur Monitoring Suhu

## Modul utama

- Dashboard membaca `temperature_readings` terbaru dan agregasi harian.
- API sensor menerima payload Arduino melalui `POST /api/sensor-readings`.
- `TemperatureMonitoringService` memvalidasi device, menyimpan reading, menentukan status suhu, dan membuat log notifikasi.
- `SendTemperatureAlert` mengirim notifikasi lewat queue agar request sensor tetap cepat.
- `NotificationSenderService` memisahkan adapter Telegram dan WhatsApp dari logika monitoring.

## Status suhu

- `normal`: suhu di bawah `warning_temperature`.
- `warning`: suhu sama dengan atau melewati `warning_temperature`.
- `danger`: suhu sama dengan atau melewati `danger_temperature`.

## Keamanan awal

- Token device disimpan sebagai SHA-256 hash, bukan plain text.
- Endpoint API memakai Bearer token dan rate limiter `sensor-readings`.
- Payload sensor divalidasi dengan Form Request.
- Relasi device dan room diverifikasi agar device tidak bisa mengirim data untuk ruangan lain.

## Performa awal

- `temperature_readings` punya indeks gabungan `room_id + recorded_at` dan `device_id + recorded_at`.
- Query dashboard membatasi histori terbaru ke 20 baris.
- Pengiriman notifikasi memakai queue dan cooldown per room/channel/recipient.
