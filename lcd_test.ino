/*
  LiquidCrystal Library - display() and noDisplay()

 Demonstrates the use a 16x2 LCD display.  The LiquidCrystal
 library works with all LCD displays that are compatible with the
 Hitachi HD44780 driver. There are many of them out there, and you
 can usually tell them by the 16-pin interface.

 This sketch prints "Hello World!" to the LCD and uses the
 display() and noDisplay() functions to turn on and off
 the display.

 The circuit:
 * LCD RS pin to digital pin 12
 * LCD Enable pin to digital pin 11
 * LCD D4 pin to digital pin 5
 * LCD D5 pin to digital pin 4
 * LCD D6 pin to digital pin 3
 * LCD D7 pin to digital pin 2
 * LCD R/W pin to ground
 * 10K resistor:
 * ends to +5V and ground
 * wiper to LCD VO pin (pin 3)

 Library originally added 18 Apr 2008
 by David A. Mellis
 library modified 5 Jul 2009
 by Limor Fried (http://www.ladyada.net)
 example added 9 Jul 2009
 by Tom Igoe
 modified 22 Nov 2010
 by Tom Igoe
 modified 7 Nov 2016
 by Arturo Guadalupi

 This example code is in the public domain.

 http://www.arduino.cc/en/Tutorial/LiquidCrystalDisplay

*/

// include the library code:
#include <Keypad.h>
#include <LiquidCrystal.h>

// initialize the library by associating any needed LCD interface pin
// with the arduino pin number it is connected to
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
int enter = 0;
int del = 0;
byte rowPins[ROWS] = {49, 48, 47, 46}; 
byte colPins[COLS] = {45, 44, 43};
const int rs = 12, en = 11, d4 = 5, d5 = 4, d6 = 3, d7 = 2;
LiquidCrystal lcd(rs, en, d4, d5, d6, d7);
Keypad customKeypad = Keypad(makeKeymap(hexaKeys), rowPins, colPins, ROWS, COLS);
int count=0;
void setup() {
  pinMode(enterButton, INPUT);
  pinMode(delButton, INPUT);
  pinMode(buzzer, OUTPUT);
  // set up the LCD's number of columns and rows:

  lcd.begin(16, 2);
  // Print a message to the LCD.
  lcd.setCursor(0, 0);
  lcd.print("Enter Passcode:");
  lcd.setCursor(0, 1);
}

void loop() {

char key = customKeypad.getKey();
  
  if (key != NO_KEY)
  {
    tone(buzzer,5000);
        delay(100);
        noTone(buzzer);
        delay(100);
    lcd.print(key);
    count++;
    if (count==6)
    {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Enter Passcode:");
      lcd.setCursor(0, 1);
      count=0;
    }
     
    }
    enter = digitalRead(enterButton);
    del = digitalRead(delButton);
    if(count==5){
      if(del == HIGH){
        lcd.setCursor(4,1);
        lcd.print(" ");
        lcd.setCursor(4,1);
        count = count-1;
      }
    }
    if(count==4){
      if(del == HIGH){
        lcd.setCursor(3,1);
        lcd.print(" ");
        lcd.setCursor(3,1);
        count = count-1;
      }
    }
    if(count==3){
      if(del == HIGH){
        lcd.setCursor(2,1);
        lcd.print(" ");
        lcd.setCursor(2,1);
        count = count-1;
      }
    }
    if(count==2){
      if(del == HIGH){
        lcd.setCursor(1,1);
        lcd.print(" ");
        lcd.setCursor(1,1);
        count = count-1;
      }
    }
    if(count==1){
      if(del == HIGH){
        lcd.setCursor(0,1);
        lcd.print(" ");
        lcd.setCursor(0,1);
        count = count-1;
      }
    }                
      else if(enter == HIGH){
        tone(buzzer,5000);
        delay(100);
        noTone(buzzer);
        delay(100);
        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("Enter Passcode:");
        lcd.setCursor(0, 1);
        count=0; 
  }
}
