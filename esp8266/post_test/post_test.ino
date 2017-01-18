#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>

const char* ssid     = "ColgateDeEsta";
const char* password = "M1_c0N7r4S3n14";

const char* host = "192.168.0.104";//servidor en maquina virtual
const int httpPort = 80;
const String url = "http://" + String(host) + ":" + httpPort + "/sist_riego/index.php/Interact/registrar";

String configuracion;

void setup() {
  Serial.begin(115200);
  delay(10);

  // Nos conectamos a nuestro wifi

  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  String mac=String(ESP.getChipId(),HEX);
  Serial.printf(" ESP8266 Chip id = %08X\n", ESP.getChipId());
  configuracion="command=start&id=" + mac + "&ssid=" ;
  configuracion.concat(ssid);
  configuracion+="&pass=" + String(password) + "&ip=" + WiFi.localIP().toString();
}

void loop() {
  delay(2000);
  HTTPClient http;    //Declare object of class HTTPClient
  http.begin(url);//Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");  //Specify content-type header
  Serial.println(url);

  int httpCode = http.POST(configuracion);   //Send the request
  String payload = http.getString();//Get the response payload
  Serial.println("Enviando: " + configuracion );

  http.end();  //Close connection
  Serial.println("closing connection");

  if(httpCode==200){//exito
    Serial.println(payload);
  }
  else{
    Serial.println("ERROR: codigo (" + String(httpCode) + ") " + String(payload));
  }

  /*Serial.println("Envio mensaje de prueba");
  String data = "command=prueba&mensaje=" + String(random(0,100));
  send_request(data);*/
}


/*String send_request(String data){
  HTTPClient http;    //Declare object of class HTTPClient
  http.begin(url);//Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");  //Specify content-type header
  Serial.println(url);

  int httpCode = http.POST(data);   //Send the request
  String payload = http.getString();//Get the response payload
  Serial.println("Enviando: " + data );

  http.end();  //Close connection
  Serial.println("closing connection");

  if(httpCode==200){//exito
    return payload;
  }
  else{
    return "ERROR: codigo (" + String(httpCode) + ") " + String(payload);
  }
}*/
