How to Start this App in your computer:

0. Make sure you have the following:
```md
docker
docker-compose
test
```
1. INITIATE BACKEND
```powershell
docker-compose up -d
```
Database user and password can be found in :
phalcon-backend/app/config/config.php
```sql
--Create Database
CREATE DATABASE IF NOT EXISTS phalconApp;
--Create Table
CREATE OR REPLACE TABLE Patients (
 id INT NOT NULL AUTO_INCREMENT,
 name CHAR(10), sex CHAR(10), 
 religion CHAR(10), phone CHAR(10),
 address CHAR(10), nik CHAR(10),
 PRIMARY KEY (id)
);
DROP TABLE Patients; --optional
--Seed Dummy Data
INSERT INTO Patients (id, name, sex, religion, phone, address, nik)
values
	(NULL,'Raditya Zulkarnaen','L','Islam','0812312312','Babakan Sari, Bandung','1231891112'),
	(NULL,'Putri Ayu Mamad','P','Islam','0813215612','Kemang, Jakarta','9772812112'),
	(NULL,'Lola Salamanca','L','Christian','0877121292','Bangli, Bali','9877220302');
```
2. RUN FRONTEND
```powershell
cd vue-frontend
npm install
npm run dev
```

