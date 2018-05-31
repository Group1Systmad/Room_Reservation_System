#include <SPI.h>
#include <EthernetV2_0.h>
#include <HttpClient.h>
#include <ArduinoJson.h>
#include <Keypad.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <stdio.h>
#include <DS1302.h>
#define SS    10   
#define nRST  8  
#define nPWDN 9  
#define nINT 3 
#define delayMillis 3000UL
#define delayInputMillis 30000UL
#define testMillis 10000UL
byte mac[] = {  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char fixed_mac[] = {'D','E','A','D',':','B','E','E','F',':','F','E','E','D'};
const String string_mac = "DEADBEEFFEED";
String room_mac;
String res_id;
IPAddress ip(192,168,1,119);
IPAddress gateway(192,168,1,1);
IPAddress server(192,168,1,2);
byte subnet[] = {255,255,255,0};
int serverPort = 80;
EthernetClient client;  
bool unlocked = false;
int totalCount = 0;
int redPin = 6;
int greenPin = 7;
int bluePin = 13;
int notif_buzzer = 40;
char pageAdd[128];
long thisMillis = 0;
unsigned long lastMillis = 0;
char serverName[] = "192.168.1.2";
char user[] = "admin";              // MySQL user login username
char password[] = "admin1234";        // MySQL user login password
const int ledPin = 5;      // the number of the LED pin
char path[] = "/";
// Variables will change:
int ledState = HIGH;         // the current state of the output pin
char buttonState;             // the current reading from the input pin
char lastButtonState = '0';   // the previous reading from the input pin
int initial = 0;
long lastDebounceTime = 0;  // the last time the output pin was toggled
long debounceDelay = 50;    // the debounce time; increase if the output flickers
String response;
String response_content = "";
StaticJsonBuffer<2000> jsonBuffer;
const byte ROWS = 4; 
const byte COLS = 3; 
char hexaKeys[ROWS][COLS] = {
  {'1', '2', '3'},
  {'4', '5', '6'},
  {'7', '8', '9'},
  {'*', '0', '#'}
};
const int enterButton = 22;
const int delButton = 24;
const int buzzer = 26;
const int light_bulb = 34;
int enter = 0;
int del = 0;
bool isPush = false;
String num;
String dynamic_password;
String password_test="00000";
byte rowPins[ROWS] = {49, 48, 47, 46}; 
byte colPins[COLS] = {45, 44, 43};
const int rs = 12, en = 11, d4 = 5, d5 = 4, d6 = 36, d7 = 2;
LiquidCrystal_I2C lcd(0x3F,2,1,0,4,5,6,7,3, POSITIVE);
Keypad customKeypad = Keypad(makeKeymap(hexaKeys), rowPins, colPins, ROWS, COLS);
int count=0;
int ledPinn = 33;
long previousMillis_button= 0;
long led_interval = 100;
unsigned long inputMillis = 0;
unsigned long previousInputMillis  = 0;
unsigned long elapsed = 0;
unsigned long room_start =0;
unsigned long room_end = 0;
unsigned long room_time = 0;
String start_time = "";
String end_time = "";
String start_date = "";
char actual_time[8];
char actual_date[10];

unsigned long room_elapsed = 0;
bool initialized = true;
int color[][3] = {{255,0,0},
                {0,255,0},
                {0,0,255},
                {255,255,0},
                {80,0,80},
                {0,255,255}};
                
const int kCePin   = 2;  // Chip Enable
const int kIoPin   = 3;  // Input/Output
const int kSclkPin = 4;  // Serial Clock
int solenoid = 33;

  // Create a DS1302 object.
DS1302 rtc(kCePin, kIoPin, kSclkPin);



void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  digitalWrite(ledPin, ledState);
   pinMode(SS,OUTPUT);  //Define the interfave :Dreamer MEGA X2 PORT  Gadgeteer PIN 6 use SS
  pinMode(nRST,OUTPUT);
  pinMode(nPWDN,OUTPUT);
  pinMode(nINT,INPUT);  
   pinMode(5,OUTPUT);  
  digitalWrite(nPWDN,LOW);  //enable power
  digitalWrite(nRST,LOW);  //Reset W5200
  delay(10);
  digitalWrite(nRST,HIGH);  
  delay(200);       // wait W5200 work
  // disable SD card if one in the slot
  pinMode(28,OUTPUT);
  digitalWrite(4,HIGH);
    Serial.println("Starting w5200");
  Ethernet.begin(mac,ip,gateway,subnet);
  Serial.println(Ethernet.localIP());
  delay(2000);
  Serial.println(F("Ready"));
  pinMode(29,INPUT);
    pinMode(enterButton, INPUT);
  pinMode(delButton, INPUT);
  pinMode(buzzer, OUTPUT);
  pinMode(ledPinn,OUTPUT);
  pinMode(solenoid,OUTPUT);
  pinMode(light_bulb,OUTPUT);
  pinMode(notif_buzzer,OUTPUT);
  lcd.begin(16,2);
  lcd.setBacklight(HIGH);
  lcd.setCursor(0,0);
  lcd.print("Enter Passcode:");
  lcd.setCursor(0,1);

//while(!connectToDB()){
//  Serial.println("Initially connecting..");
//}

pinMode(redPin,OUTPUT);
pinMode(greenPin,OUTPUT);
pinMode(bluePin,OUTPUT);
}

void loop() {
  if(unlocked != true){
    setColor(255,0,255);
  }else{
    setColor(0,255,255);
  }
thisMillis = millis();
  if(thisMillis-lastMillis > delayMillis || initialized == true){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Connecting..");
    if(initialized != true){
      lastMillis = thisMillis;
    } 
    sprintf(pageAdd,"/Room_Reservation_System/arduino_bridge.php?MAC=DEADBEEFFEED",totalCount);
    while(1){
      if(!getPage(server,serverPort,pageAdd,dynamic_password,unlocked,room_time,start_time,end_time,start_date,room_mac,res_id)){
      Serial.print(F("Fail"));
      bool value = false;
      //return value;
     }else{
      delay(1000);
      Serial.println(F("Pass"));
      initialized = false;
      char start_t[6],end_t[6],month[3],day[3],year[3],date[11];
      String temp;
      start_time.toCharArray(start_t,6);
      end_time.toCharArray(end_t,6);
      start_date.toCharArray(date,11);
      
      
      year[0] = date[2];
      year[1] = date[3];
      month[0] = date[5];
      month[1] = date[6];
      year[0] = date[2];
      year[1] = date[3];
      day[0] = date[8];
      day[1] = date[9];
     
       Serial.print("Date:");
      Serial.println(date[3]);
      Serial.print("Month:");
      Serial.println(month);
      Serial.print("Day:");
      Serial.println(day);
      Serial.print("Year:");
      Serial.println(year[1]);
      
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("ID:");
      lcd.print(res_id);
      lcd.print(" ");
      lcd.print("D:");
      lcd.print(month[0]);
      lcd.print(month[1]);
      lcd.print("/");
      lcd.print(day[0]);
      lcd.print(day[1]);
      lcd.print("/");
      lcd.print(year[0]);
      lcd.print(year[1]);
      
      lcd.setCursor(0, 1);
      lcd.print("Time:");
      lcd.print(start_t);
      lcd.print("-");
      lcd.print(end_t);
      
      bool value = true;
      num = "";
     //return value;
       break;
      }
      
    }
    
  totalCount++;
  Serial.println(totalCount,DEC);
  }
  if(thisMillis - previousMillis_button > led_interval){
      previousMillis_button = thisMillis;
      while(1){
        getInput(dynamic_password,actual_time,actual_date,room_time,room_mac,fixed_mac,res_id,start_time,end_time);
        Serial.println("Counting..");     
        previousInputMillis = millis();
        elapsed = previousInputMillis - thisMillis;
        if(unlocked != true){
            setColor(255,0,255);
          }else{
            setColor(0,255,255);
            break;
          }
        if(elapsed > delayInputMillis){
          break;
        }
      }
      Serial.println("Input Count done..");
         if(unlocked == true){
           inRoom(room_time,unlocked,server,serverPort,res_id);
         }
  }  
}


void inRoom(unsigned long room_time,bool &unlocked,IPAddress ipBuf,int thisPort,String res_id){
  room_start = millis();
  unsigned long room_connect_delay = 30000;
  unsigned long room_send_delay = 30000;
  char pageAdd[128];
  char pageSend[128];
  String room_status = "OCCUPIED";
  String id_res = res_id;
  bool min_15 = false;
  bool min_10 = false;
  bool min_5 = false;
  sprintf(pageAdd,"/Room_Reservation_System/arduino_bridge.php?RID=%s",id_res.c_str());
  sprintf(pageSend,"/Room_Reservation_System/arduino_reciever.php?MAC=DEADBEEFFEED");
  lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Occupied");
    while(1){
        room_end = millis();
        room_elapsed = room_end - room_start;
        if(room_elapsed > room_time){
            break;
          }
        else if(room_elapsed >= room_connect_delay){
          //code to connect here after 10 seconds
          if(getUpdate(ipBuf,thisPort,pageAdd,room_status,res_id)){
            Serial.println("Connecting Successful");
            if(!isCancelled(room_status)){
              break;
            }
          }
          else{
            Serial.println("Connecting failed..");          
          }
        }  
          
          Serial.println("Still..");
          if(min_15==false && checkTime(room_elapsed,900000,room_time)){
            min_15 = true;
            buzz(1);
          }else if(min_10==false && checkTime(room_elapsed,600000,room_time)){
            min_10 = true;
            buzz(2);
          }else if(min_5==false && checkTime(room_elapsed,300000,room_time)){
            min_5 = true;
            buzz(3);
          }

}
    unlocked = false;
    digitalWrite(solenoid,LOW);
    delay(1000);
    digitalWrite(light_bulb,LOW);
        lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Connecting..");
      
      room_start = millis();
      while(1){
        room_end = millis();
        room_elapsed = room_end-room_start;
        if(room_elapsed >= room_send_delay){
          if(sendData(ipBuf,thisPort,pageSend)){
            Serial.println(pageSend);
            Serial.println("Connecting Successful");
            break;
          }
          else{
            Serial.println("Connecting failed..");            
            lcd.clear();
            lcd.setCursor(0, 0);
            lcd.print("Please Wait..");
           }
        }
      }
      
      
  }

bool isCancelled(String room_status){
  if(room_status == "1"){
    return true;
  }
  else{
    return false;
  }
}

void setColor(int color[3][3],int index)
{
  //#ifdef COMMON_ANODE
      int red = 255 - color[index][0];
     int green = 255 - color[index][1];
      int blue = 255 - color[index][2];
      
 // #endif
  analogWrite(redPin, red);
  analogWrite(greenPin, green);
  analogWrite(bluePin, blue);  
}

bool sendData(IPAddress ipBuf,int thisPort, char *page){
  char inChar;
    char outBuf[254];
    char value;
    int connectLoop = 0;
    String response_content;
    Serial.println(page);
    Serial.println("Attempting to send data");
    client.stop();
    
    if(client.connect(ipBuf,thisPort)==1){
      sprintf(outBuf,"GET %s HTTP/1.1",page);
      client.println(outBuf);
      Serial.println(outBuf);
    sprintf(outBuf,"Host: %s",serverName);
    client.println(outBuf);
    client.println(F("Connection: close\r\n"));
    Serial.println("Connected for Update");
    }
    else{
      Serial.println("Connection Attempt Failed");
      return false;
    }
    
     
  
  while(client.connected()){
    while(client.available()){
      inChar = client.read();
//      Serial.write(inChar);
      response_content = response_content + inChar;
      value = inChar;
      char reading = value;
      connectLoop = 0;
    }
    connectLoop++;
    if(connectLoop>15000){
      Serial.println();
      Serial.println(F("Timeout"));
      client.stop();
      return false;
    }
    delay(1);
  }
    Serial.println(response_content);
    
    
   Serial.print("Disconnecting..");
  client.stop();
  
  return true;
}



bool getUpdate(IPAddress ipBuf,int thisPort, char *page,String &room_status,String &res_id){
    char inChar;
    char outBuf[128];
    char value;
    int connectLoop = 0;
    String response_content;
    Serial.println("Attempting to connect");
    client.stop();
    
    if(client.connect(ipBuf,thisPort)==1){
      
      sprintf(outBuf,"GET %s HTTP/1.1",page);
      client.println(outBuf);
    sprintf(outBuf,"Host: %s",serverName);
    client.println(outBuf);
    client.println(F("Connection: close\r\n"));
    Serial.println("Connected for Update");
    }
    else{
      Serial.println("Connection Attempt Failed");
      return false;
    }
    
    
    while(client.connected()){
      while(client.available()){
        inChar = client.read();
        response_content = response_content + inChar;
        value = inChar;
        char reading = value;
        if(response_content.endsWith("Content-Type: application/json\r\n\r\n")){
          response_content = "";
        }
      connectLoop = 0;
    }
    connectLoop++;
    if(connectLoop>15000){
      Serial.println();
      Serial.println(F("Timeout"));
      client.stop();
      return false;
    }
    delay(1);
      }
      jsonBuffer.clear();
   JsonObject& root = jsonBuffer.parseObject(response_content);
   if(!root.success()){
     Serial.println("Parsing Failed");
     room_status = "0";
     return false;
   }else{
     String status_room = root["Status"];
     room_status = status_room;
     Serial.print("Status = ");
     Serial.println(room_status);
     jsonBuffer.clear();
   }
   
    
   Serial.print("Disconnecting..");
  client.stop();
  
  return true;
}



bool getPage(IPAddress ipBuf,int thisPort,char *page,String &dynamic_pass,bool &unlocked,
unsigned long &room_time,String &start_time,String &end_time,String &start_date,String &room_mac,String &res_id){
  char inChar;
  char outBuf[128];
  char value;
  Serial.print(F("connecting..."));
  
  if(client.connect(ipBuf,thisPort)==1){
    Serial.println(F("Connected"));
    sprintf(outBuf,"GET %s HTTP/1.1",page);
    client.println(outBuf);
    sprintf(outBuf,"Host: %s",serverName);
    client.println(outBuf);
    client.println(F("Connection: close\r\n"));
  }
  else{
    Serial.println(F("failed"));
    return false;
  }
  
  int connectLoop = 0;
  
  while(client.connected()){
    while(client.available()){
      inChar = client.read();
//      Serial.write(inChar);
      response_content = response_content + inChar;
      value = inChar;
      char reading = value;
      if(response_content.endsWith("Content-Type: application/json\r\n\r\n")){
        response_content = "";
      }
      connectLoop = 0;
    }
    connectLoop++;
    if(connectLoop>15000){
      Serial.println();
      Serial.println(F("Timeout"));
      client.stop();
      return false;
    }
    delay(1);
  }
  
  JsonObject& root = jsonBuffer.parseObject(response_content);

  if (!root.success())
{
  Serial.print("parseObject(");
  Serial.print(response_content);
  Serial.println(") failed");
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Not Reserved");
  jsonBuffer.clear();
  client.stop();
  return false;
}else{
  String json_value = root["u_code"];
  String time_room = root["time_millis"];
  String time_start = root["time_in"];
  String time_end = root["time_out"];
  String date_start = root["date"];
  String mac_room = root["mac_address"];
  String id_res = root["id"];
  room_time = atol(time_room.c_str());
  room_mac = mac_room;
  start_time = time_start;
  end_time = time_end;
  start_date = date_start; 
  res_id = id_res;
   dynamic_pass = json_value;
   Serial.print("Passcode = ");
   Serial.println(dynamic_pass);
      Serial.print("Reservation ID = ");
   Serial.println(res_id);
   jsonBuffer.clear();
  }

  Serial.println();
  Serial.println(F("disconnecting.."));
  client.stop();
  
  return true;
}

bool getInput(String dynamic_password,char *actual_time,char *actual_date,unsigned long &room_time,String room_mac,char *fixed_mac,String res_id,String start_time,String end_time){
char key = customKeypad.getKey();
char start_t[6],end_t[6];
int count;
start_time.toCharArray(start_t,6);      
end_time.toCharArray(end_t,6); 
//  while (key != '#')
//{
  switch (key)
  {
    case NO_KEY:
    //Serial.println("NONE");
    count++;
    if(count>=1000){
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("ID:");
      lcd.print(res_id);
      lcd.setCursor(0, 1);
      lcd.print("Time:");
      lcd.print(start_t);
      lcd.print("-");
      lcd.print(end_t);
      count = 0;
    }
      break;
    case '0': case '1': case '2': case '3': case '4':
    case '5': case '6': case '7': case '8': case '9':
    if(num == ""){lcd.clear();
    lcd.setCursor(0, 0);
      lcd.print("Enter Passcode:");
      lcd.setCursor(0, 1);  
}
    
      
    tone(notif_buzzer,5000);
        delay(100);
        noTone(notif_buzzer);
        delay(100);
    lcd.print(key);
    count++;
    if (count==6)
    {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Enter Passcode:");
      lcd.setCursor(0, 1);
      lcd.print(key);
      num="";
      count=1;
    }
      num = num + key;
      break;
  }
  //key = customKeypad.getKey();
  enter = digitalRead(enterButton);
    del = digitalRead(delButton);
      if(del == HIGH){
        tone(notif_buzzer,5000);
        delay(100);
        noTone(notif_buzzer);
        delay(100);
        num = "";
        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("Enter Passcode:");
        lcd.setCursor(0, 1);
        count=0; 
  }  
 else if(enter == HIGH){
        tone(notif_buzzer,5000);
        delay(100);
        noTone(notif_buzzer);
        delay(100);
        //Serial.print("Actual Date = ");
        //Serial.println(actual_date);
        if(num==dynamic_password && verifySched(start_time,end_time,start_date,actual_time,actual_date,room_time,room_mac,fixed_mac)){
          lcd.clear();
          lcd.print("Access Granted!");
          delay(1500);
          unlocked = true;
          digitalWrite(solenoid,HIGH);
          digitalWrite(light_bulb,HIGH);
          return true;
        }
        else{
          lcd.clear();
          lcd.print("Access Denied!");
          Serial.println(dynamic_password);
          delay(1500);
          unlocked = false;
          return false;
        }
  }
  else{
    return false;
    }

         return false;
//}
}
void setColor(int red, int green, int blue)
{
  //#ifdef COMMON_ANODE
    red = 255 - red;
    green = 255 - green;
    blue = 255 - blue;
 // #endif
   
  analogWrite(redPin, red);
  analogWrite(greenPin, green);
  analogWrite(bluePin, blue);  
}

void convCharTime(char *time_t, int *time_int_t){
    for (int i=0;i<8;i++){
    switch(time_t[i]){
    case '0':
      time_int_t[i] = 0;
      break;
    case '1':
      time_int_t[i] = 1;
      break;
    case '2':
      time_int_t[i] = 2;
      break;
    case '3':
      time_int_t[i] = 3;
      break;
    case '4':
      time_int_t[i] = 4;
      break;
    case '5':
      time_int_t[i] = 5;
      break;
    case '6':
      time_int_t[i] = 6;
      break;
    case '7':
      time_int_t[i] = 7;
      break;
    case '8':
      time_int_t[i] = 8;
      break;
    case '9':
      time_int_t[i] = 9;
      break;
    default:
      time_int_t[i] = 0;
      break;
    }
    }
}

void convToNum(int *int_time, int *num_time){
  num_time[0] = (int_time[0]*10) + int_time[1];
  num_time[1] = (int_time[3]*10) + int_time[4];
  num_time[2] = (int_time[6]*10) + int_time[7];
}



boolean compareTimes(int *s_time,int *e_time,int *a_time){
  if(a_time[0] >= s_time[0] && a_time[0] < e_time[0]){
    return true;
  }
  else if(a_time[0]==s_time[0] && a_time[0] == e_time[0]){
    if(a_time[1]>=s_time[1] && a_time[1] < e_time[1]){
      return true;  
    }
    else{
      return false;
    }
  }
  else{
    return false;
  }
}

boolean verifySched(String start_time,String end_time,String start_date,char *actual_time,char 
*actual_date,unsigned long &room_time,String room_mac,char *fixed_mac){
  char start_t[9],end_t[9],actual_t[9],start_d[10];
  char mac_address_array[15];
int start_int_t[8],end_int_t[8],actual_int_t[8],actual_int_date[8];
int start_num[3],end_num[3],actual_num[3];
  bool isSame = false;
  start_time.toCharArray(start_t,9);
  room_mac.toCharArray(mac_address_array,15);
  end_time.toCharArray(end_t,9);
  start_date.toCharArray(start_d,11);
  Time t = rtc.time();
  char buff[8];
  sprintf(buff,"%02d:%02d:00", t.hr,t.min);
  actual_time = buff;
   char bufferr[10];
  sprintf(bufferr,"%04d-%02d-%02d", t.yr, t.mon, t.date);
  actual_date = bufferr;  
   boolean mac_add_same = false;
   
   Serial.println("RESERVED MAC = ");
   for(int i=0;i<14;i++){
     Serial.print(mac_address_array[i]);
   }
   Serial.println();
   Serial.println("ACTUAL MAC = ");
   for(int i=0;i<14;i++){
     Serial.print(fixed_mac[i]);
   } 
   for(int i=0;i<14;i++){
     if(mac_address_array[i] != fixed_mac[i]){
       Serial.println("MAC ADD IS NOT THE SAME");
       mac_add_same=  false;
       break;
     }
     else{
          Serial.println("MAC ADD IS SAME");
       mac_add_same = true;
     }
   }
   
  for(int i=0;i<10;i++){
    if(start_date[i]!=actual_date[i]){
      Serial.println(i);
      isSame = false;
      return false;
       break;
    }
    else{
      isSame = true;
       Serial.println("Testing po ito");
    }
  } 
  Serial.print("isSame =");
  Serial.println(isSame);
  Serial.print("mac_add_same =");
  Serial.println(mac_add_same);
  Serial.println();
  if(isSame && mac_add_same){
    Serial.println("Date is same");
    convCharTime(start_t,start_int_t);
    convToNum(start_int_t, start_num);
    convCharTime(end_t,end_int_t);
    convToNum(end_int_t, end_num);
    convCharTime(actual_time,actual_int_t);
    convToNum(actual_int_t, actual_num);
   for(int k=0;k<3;k++){
    Serial.print(start_num[k]);
    Serial.print(":");
  } 
    Serial.println();
   for(int k=0;k<3;k++){
    Serial.print(end_num[k]);
    Serial.print(":");
  } 
      Serial.println();
   for(int k=0;k<3;k++){
    Serial.print(actual_num[k]);
    Serial.print(":");
  }
    if(compareTimes(start_num,end_num,actual_num)){
      Serial.println("Mark 1");
      room_time = getMillis(room_time,end_num[0],end_num[1],end_num[2],actual_num[0],actual_num[1],actual_num[2]);
      Serial.print("Time Remaining: ");
      Serial.println(room_time);
      return true;
    }else{
      Serial.println("False");
      return false;
    }
  }
  else{
    return false;
  }
   
}
String dayAsString(const Time::Day day) {
  switch (day) {
    case Time::kSunday: return "Sunday";
    case Time::kMonday: return "Monday";
    case Time::kTuesday: return "Tuesday";
    case Time::kWednesday: return "Wednesday";
    case Time::kThursday: return "Thursday";
    case Time::kFriday: return "Friday";
    case Time::kSaturday: return "Saturday";
  }
  return "(unknown day)";
}

//void printTime(char *actual_time,char *actual_date) {
//  Time t = rtc.time();
//  const String day = dayAsString(t.day);
//  char buf[50];
//  snprintf(buf, sizeof(buf), "%s %04d-%02d-%02d %02d:%02d:%02d",
//           day.c_str(),
//           t.yr, t.mon, t.date,
//           t.hr, t.min, t.sec);
//  char buff[8];
//  sprintf(buff,"%02d:%02d:00", t.hr,t.min);
//  actual_time = buff;
//   char bufferr[10];
//  sprintf(bufferr,"%04d-%02d-%02d", t.yr, t.mon, t.date);
//  actual_date = bufferr;
//  
//}


unsigned long getMillis(unsigned long &room_time,int end_hour,int end_minute,int end_seconds,int actual_hour,int actual_minute,int actual_seconds){
  unsigned long end_h_millis,end_m_millis,end_s_millis,end_millis;
  unsigned long actual_h_millis,actual_m_millis,actual_s_millis,actual_millis;
  end_h_millis = end_hour * 3600000;
  end_m_millis = end_minute * 60000;
  end_s_millis = end_seconds * 1000;
  end_millis = end_h_millis + end_m_millis + end_s_millis;  
  actual_h_millis = actual_hour * 3600000;
  actual_m_millis = actual_minute * 60000;
  actual_s_millis = actual_seconds * 1000;
  actual_millis = actual_h_millis + actual_m_millis + actual_s_millis;    
  
  room_time = end_millis- actual_millis;
  
  return room_time;
}

void buzz(int times){
  for(int i=0;i<times;i++){
    digitalWrite(notif_buzzer,HIGH);
    delay(1000);
    digitalWrite(notif_buzzer,LOW);
    delay(1000);
  }  
}

bool checkTime(unsigned long current_time,unsigned long time_interval,unsigned long room_time){
  Serial.print("Current Millis = ");
    Serial.println(current_time);
    Serial.print("Time Interval = ");
    Serial.println(time_interval);
    Serial.print("Room Time = ");
    Serial.println(room_time);
    unsigned long time_diff;
    time_diff = room_time-current_time;
    Serial.print("Time Diff = ");
    Serial.println(time_diff);
  if(time_diff<=time_interval){
    return true;
  }
  else{
    return false;
  }
}
