#include <SPI.h>
#include <MFRC522.h>
#include <WiFiNINA.h>

// Configuración del lector RFID
constexpr uint8_t RST_PIN = 9;
constexpr uint8_t SS_PIN = 10;
MFRC522 mfrc522(SS_PIN, RST_PIN);

// Configuración WiFi
const char* ssid = "asd";
const char* password = "asd";

void setup() {
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();

  // Conexión WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Conectando al WiFi...");
  }
  Serial.println("Conectado al WiFi");
}

void loop() {
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    String cardID = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardID += String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : "") + String(mfrc522.uid.uidByte[i], HEX);
    }
    cardID.toUpperCase();

    Serial.print("ID de la Tarjeta: ");
    Serial.println(cardID);

    // Realizar la petición GET
    WiFiClient client;
    const char* host = "bellidel.eu";
    int port = 8090;

    if (client.connect(host, port)) {
      Serial.println("Conectado al servidor");
      // GET
      client.println("GET /end_rent/" + cardID + "/9167ed47-cb8d-460c-1b58-d967c0e8e0f1/ HTTP/1.1");
      client.println("Host: " + String(host));
      client.println("Connection: close");
      client.println();

      while (client.connected()) {
        String line = client.readStringUntil('\n');
        if (line == "\r") {
          Serial.println("Headers recibidos, cuerpo a continuación:");
          break;
        }
      }

      while(client.available()){
        String line = client.readStringUntil('\n');
        Serial.println(line);
      }

      client.stop();
    } else {
      Serial.println("Fallo en la conexión con el servidor");
    }

    mfrc522.PICC_HaltA();
  }
}