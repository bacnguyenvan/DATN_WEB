//----------------------------------------Include the NodeMCU ESP8266 Library
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
//----------------------------------------

#include "DHT.h" 
#define DHTTYPE DHT11 
#define LEDonBoard 2  

//----------------------------------------
const char* ssid = "P 16";
const char* password = "20192019ha";
//----------------------------------------
String getData ,Link;
int duration = 0 ;
const int DHTPin = 2; // D4
DHT dht(DHTPin, DHTTYPE); 


const long interval = (0.1*60)*1000; // 0.3p * 60 (s)
unsigned long previousMili = 0 ;

void setup(void){
  Serial.begin(115200);
  delay(500);
  dht.begin();  
  delay(500);
  
  WiFi.begin(ssid, password); 
  Serial.println("");

  //----------------------------------------Wait for connection
  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
   
    delay(250);
    //----------------------------------------
  }

  Serial.println("");
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  

  Serial.println("HTTP server started");
}

//----------------------------------------Loop
void loop(){

   HTTPClient http; 

    unsigned long currentMili = millis();
    if(currentMili - previousMili >= interval){
        previousMili = currentMili;

        getData = "?temperature=" + String(dht.readTemperature()) + "&humidity=" + String(dht.readHumidity()); 
        Serial.println(getData) ;
      
        Link = "http://192.168.1.13/do_an_tot_nghiep/admin/readTemperature.php" + getData;
        Serial.println(Link) ;
        http.begin(Link);

        http.GET();
    }
   
    

}
//
