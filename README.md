# 🛰️ RFID-Based Smart Attendance System (IoT + PHP + MySQL)

This project is a **Smart IoT-Based RFID Attendance System** that automates student or employee attendance using **NodeMCU ESP8266**, **RFID RC522**, and a **PHP + MySQL backend** (hosted on XAMPP).  
The system provides real-time attendance tracking, verification, and feedback using an **LCD display, buzzer, and LEDs**.

---

## ⚙️ Overview

In this project, each user is assigned a unique RFID card. When scanned on the RFID reader, the **NodeMCU** reads the card’s UID and sends it via Wi-Fi to a **local PHP web server** hosted on XAMPP.  
The PHP backend verifies the card in the **MySQL database**, records the attendance, and sends back an appropriate message such as “Attendance Recorded” or “Already Marked”.

---

## 🎯 **Key Features**

✅ Contactless and fast attendance marking  
✅ Real-time communication between hardware and web server  
✅ Automatic data entry into MySQL database  
✅ LCD + Buzzer + LED feedback system  
✅ Prevents duplicate attendance  
✅ Easy to manage and view attendance via a web dashboard  

---

## 🧩 **Hardware Components Used**

| Component | Description |
|------------|-------------|
| **NodeMCU ESP8266** | Wi-Fi-enabled microcontroller used for IoT communication |
| **RFID RC522 Reader** | Reads the unique UID of RFID cards via radio frequency |
| **RFID Tags/Cards** | Unique IDs assigned to users (students/employees) |
| **16x2 LCD Display (I2C)** | Displays system messages and attendance status |
| **Buzzer** | Audio feedback for valid or invalid scans |
| **LEDs (Green & Red)** | Visual indication for success or error |
| **Jumper Wires & Breadboard** | Circuit connections and prototyping |

---

## 🗂️ **Software Requirements**

- **Arduino IDE** → For programming NodeMCU  
- **XAMPP** → Local PHP + MySQL Server  
- **PHP & MySQL** → Backend scripting and database  
- **VS Code / Sublime / Notepad++** → To edit web code  
- **Browser (Chrome/Edge)** → For accessing the web dashboard  

---

## 🧠 **Working of the System**

1. Each user scans their RFID card on the RFID reader connected to NodeMCU.  
   The card’s UID is detected using SPI communication.  
2. NodeMCU connects to Wi-Fi and sends the UID to the PHP server hosted in XAMPP.  
3. The PHP script checks the MySQL database:
   - If the UID exists, attendance is recorded.  
   - If already marked, a duplicate message is sent.  
   - If unknown, an error message is displayed.  
4. The LCD displays feedback messages such as:
   - “Attendance Recorded” ✅  
   - “Already Marked” ⚠️  
   - “Unknown Card” ❌  
5. Buzzer and LEDs provide instant physical feedback for user confirmation.  

---

## 🗃️ **Folder Structure**

RFID-Attendance-System/
┣ 📁 assets/ → CSS, JS, and image files for frontend styling
┣ 📁 dashboard/ → Admin panel and backend management pages
┣ 📄 config.php → Database connection setup
┣ 📄 database.sql → MySQL database file
┣ 📄 index.php → Main login/landing page
┣ 📄 login.php → User authentication page
┣ 📄 logout.php → Logout handler
┣ 📄 reset_password.php → Password reset module
┗ 📄 verify_login.php → Verifies user credentials


---

## 🌐 **Web Dashboard Features**

The **dashboard** folder includes an admin interface for managing attendance data:
- View attendance records  
- Add or remove users  
- Export attendance reports (CSV/PDF)  
- Real-time status of students/employees  

The dashboard is designed using **HTML, CSS, Bootstrap, and PHP**.

---

## 💾 **Database Configuration**

1. Open **phpMyAdmin** → Create a new database named `rfid_attendance`.  
2. Import the file `database.sql`.  
3. The table `attendance` will store:
   - `id` (Auto Increment)
   - `card_uid`
   - `name`
   - `timestamp`

---

## 🔌 **Circuit Connections**

| RFID RC522 Pin | NodeMCU Pin |
|----------------|-------------|
| VCC | 3.3V |
| RST | D3 |
| GND | GND |
| MISO | D6 |
| MOSI | D7 |
| SCK | D5 |
| SDA (SS) | D4 |

| LCD I2C Pin | NodeMCU Pin |
|--------------|-------------|
| VCC | 3.3V / 5V |
| GND | GND |
| SDA | D2 |
| SCL | D1 |

| Other Components | NodeMCU Pin |
|------------------|-------------|
| Buzzer | D8 |
| Green LED | D0 |
| Red LED | D1 |

---

## 🚀 **Setup and Execution**

1. Install **XAMPP** and move the `RFID-Attendance-System` folder to:
2. Start **Apache** and **MySQL** in XAMPP Control Panel.  
3. Open browser → Visit:
http://localhost/RFID-Attendance-System/
4. Open **Arduino IDE**, load your NodeMCU code, and update:

```cpp
const char* host = "";  // Your Laptop IP 

5. Upload code to NodeMCU.
6. Connect both NodeMCU and Laptop to the same Wi-Fi network.
7. Scan RFID cards — attendance will be stored in your database automatically! ✅

🖥️ Output Display

LCD shows:

“Attendance Recorded”

“Already Marked”

“Unknown Card”

Buzzer and LEDs give instant feedback.

Web dashboard displays date, time, and user details of each scan.

📷 Prototype Image

🧩 Applications

Educational Institutes

Offices and Companies

Libraries and Labs

Hostels and Restricted Areas


👨‍💻 Author

Darpan Yaduvanshi
🎓 MCA (AI & ML) — Chandigarh University
💻 IoT and Machine Learning Enthusiast
📧 darpanyaduvanshi11@gmail.com

🔗 GitHub Profile

🏁 Conclusion

This project demonstrates the integration of IoT (NodeMCU) and Web Technologies (PHP, MySQL) to create a fully automated, smart, and contactless attendance system.
It provides a real-time, accurate, and scalable solution suitable for educational and corporate environments.
