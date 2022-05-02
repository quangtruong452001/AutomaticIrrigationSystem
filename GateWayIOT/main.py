import serial.tools.list_ports
import random
import time as t
from datetime import datetime
import sys
from Adafruit_IO import MQTTClient
from firebase import firebase

## Setup database
firebaseConfig = {
  "apiKey": "AIzaSyAgh3icLjYueGiU_fet05PD7gjVYu_9lYQ",
  "authDomain": "aisystems-3bb97.firebaseapp.com",
  "databaseURL": "https://aisystems-3bb97-default-rtdb.asia-southeast1.firebasedatabase.app",
  "projectId": "aisystems-3bb97",
  "storageBucket": "aisystems-3bb97.appspot.com",
  "messagingSenderId": "788791733348",
  "appId": "1:788791733348:web:e6d006ccaae733ad1cc371",
  "measurementId": "G-SQDWM341PD"
}
fire = firebase.FirebaseApplication(
    'https://aisystems-3bb97-default-rtdb.asia-southeast1.firebasedatabase.app', None
)

AIO_FEED_ID = ["mulproject", "mp-pump"]
AIO_USERNAME = "QuangCS"
AIO_KEY = "aio_scPV40Lf1azOgQG11I9e5ium9h8z"

class ScheObject:
    def __init__(self, date, time):
        self.date = date
        self.time = time

def connected(client):
    print("Ket noi thanh cong...")
    for feed in AIO_FEED_ID:
        client.subscribe(feed)

def subscribe(client, username, mid, granted_qos):
    print("Subscribe thanh cong...")

def disconected(client):
    print("Ngat ket noi...")
    sys.exit(1)

def message(client, feed_id, payload):
    print("Nhan du lieu " + payload)
    if isMicrobitConnected:
        ser.write((str(payload) + "#").encode())
    # dau "#" de mach microbit nhan biet duoc ki tu ket thuc cua du lieu
def getPort():
    ports = serial.tools.list_ports.comports()
    N = len(ports)
    commPort = "None"
    for i in range(0, N):
        port = ports[i]
        strPort = str(port)
        if "USB Serial Device" in strPort: ##Can be changed later
            splitPort = strPort.split(" ")
            commPort = splitPort[0]
    return commPort

def processData(data):
    data = data.replace("!", "")
    data = data.replace("#", "")

    splitData = data.split(":") # ID:TEMP:<nhiet do>
    if splitData[1] == "DOAMDAT": #nhiet do
        client.publish("mp-mois", splitData[2])

        time_hhmmss = time.strftime('%H:%M:%S')
        date_yyyymmdd = time.strftime('%Y/%m/%d')
        new_data = {
            "date": date_yyyymmdd,
            "minutes": 0,
            "moisturemin": splitData[2],
            "start": time_hhmmss
        }
        # result = fire.post('/irrigations', new_data)
        fire.post('/irrigations', new_data)
        #print(result)

    elif splitData[1] == "DOSANG": #anh sang
        client.publish("mp-light", splitData[2])

        fire.post('/light', splitData[2])


#last = ""
def control(lastID, typeOfD):
    #global last
    #if(lastID != last):
        #last = lastID
    newPath = "/" + typeOfD + "/" + lastID
    newSignal = fire.get(newPath, None)
    if(typeOfD == "light_sensor"):
        print("Led ...", newSignal)
        client.publish("mulproject", newSignal)
    if(typeOfD == "pump"):
        print("Pump ...", newSignal)
        client.publish("mp-pump", newSignal)


mess = ""
def readSerial():
    bytesToRead = ser.inWaiting()
    if(bytesToRead > 0):
        global mess
        mess = mess + ser.read(bytesToRead).decode("UTF-8")
        while ("#" in mess) and ("!" in mess):
            start = mess.find("!")
            end = mess.find("#")
            processData(mess[start:end + 1])
            if(end == len(mess)):
                mess = ""
            else:
                mess = mess[end + 1:]


isMicrobitConnected = False
if getPort() != "None":
    ser = serial.Serial(port = getPort(), baudrate = 115200)
    isMicrobitConnected = True

client = MQTTClient(AIO_USERNAME, AIO_KEY)

client.on_connect = connected
client.on_disconnect = disconected
client.on_message = message
client.on_subscribe = subscribe

client.connect()
client.loop_background()

scheduleList = []
checkScheduleId = ''

CheckLed = ""
CheckPump = ""

while True:

    # Control light_sesor and pump

    light_SensorControlID = list(fire.get('/light_sensor', None))[-1]
    pumpControlID = list(fire.get('/pump', None))[-1]

    if (CheckLed != light_SensorControlID):
        CheckLed = light_SensorControlID
        control(light_SensorControlID, "light_sensor")
    if (CheckPump != pumpControlID):
        CheckPump = pumpControlID
        control(pumpControlID, "pump")

    if isMicrobitConnected:
        readSerial()
    t.sleep(1)
    # Schedule
    ScheduleID = list(fire.get('/schedule', None))[-1]

    if (checkScheduleId != ScheduleID):
        checkScheduleId = ScheduleID
        date = datetime.strptime(fire.get('/schedule/' + ScheduleID + '/date', None), '%Y-%m-%d').date()
        time = datetime.strptime(fire.get('/schedule/' + ScheduleID + '/start', None), '%H:%M').time()
        print(time)
        scheduleList.append(ScheObject(date, time))

    if not scheduleList:
        continue
    elif(scheduleList[0].date < datetime.now().date()):
        scheduleList.pop(0)
    elif(scheduleList[0].date == datetime.now().date()  ):
        if(scheduleList[0].time < datetime.strptime(t.strftime("%H:%M"), '%H:%M').time()  ):
           
            scheduleList.pop(0)

        elif(scheduleList[0].time == datetime.strptime(t.strftime("%H:%M"), '%H:%M').time() ):
            #flagSchedule = True
            print("Pump ...", 3)
            client.publish("mp-pump", 3)
            scheduleList.pop(0)


