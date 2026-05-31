#include <SPI.h>
#include <Ethernet.h>
#include <DHT.h>

#define DHT_PIN 2
#define DHT_TYPE DHT22

DHT dht(DHT_PIN, DHT_TYPE);

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
EthernetClient client;

const char server[] = "192.168.1.10";
const int port = 8000;
const char path[] = "/api/sensor-readings";

const char deviceId[] = "ARDUINO-UNO-001";
const int roomId = 1;
const char token[] = "dev-sensor-token-ubah-ini";

void setup() {
  Serial.begin(9600);
  dht.begin();

  if (Ethernet.begin(mac) == 0) {
    Serial.println("Gagal mendapatkan IP DHCP.");
    while (true) {
      delay(1000);
    }
  }

  delay(1000);
}

void loop() {
  float temperature = dht.readTemperature();
  float humidity = dht.readHumidity();

  if (isnan(temperature) || isnan(humidity)) {
    Serial.println("Sensor DHT gagal dibaca.");
    delay(10000);
    return;
  }

  String payload = "{";
  payload += "\"device_id\":\"" + String(deviceId) + "\",";
  payload += "\"room_id\":" + String(roomId) + ",";
  payload += "\"temperature\":" + String(temperature, 2) + ",";
  payload += "\"humidity\":" + String(humidity, 2);
  payload += "}";

  if (client.connect(server, port)) {
    client.println("POST " + String(path) + " HTTP/1.1");
    client.println("Host: " + String(server));
    client.println("Authorization: Bearer " + String(token));
    client.println("Content-Type: application/json");
    client.println("Accept: application/json");
    client.print("Content-Length: ");
    client.println(payload.length());
    client.println("Connection: close");
    client.println();
    client.println(payload);

    while (client.connected()) {
      while (client.available()) {
        char c = client.read();
        Serial.write(c);
      }
    }

    client.stop();
  } else {
    Serial.println("Gagal konek ke server Laravel.");
  }

  delay(30000);
}
