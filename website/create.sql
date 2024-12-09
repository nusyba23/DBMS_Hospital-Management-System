CREATE DATABASE Hospital;
USE Hospital;

CREATE TABLE Hospital (
    Hospital_ID INT AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    City VARCHAR(20) NOT NULL,
    Street_Num VARCHAR(5) NOT NULL,
    Street VARCHAR(20) NOT NULL,
    PRIMARY KEY Hospital_Key (Hospital_ID)
);

CREATE TABLE Department (
    Department_ID INT AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    Hospital_ID INT,
    PRIMARY KEY (Department_ID),
    FOREIGN KEY (Hospital_ID)
        REFERENCES Hospital (Hospital_ID)
        ON DELETE CASCADE
);

CREATE TABLE Doctor (
    Doctor_ID INT AUTO_INCREMENT,
    F_name VARCHAR(20) NOT NULL,
    L_name VARCHAR(20) NOT NULL,
    Gender CHAR CHECK (Gender IN ('M', 'F')),
    Type VARCHAR(20) DEFAULT 'General Practitioner',
    Department_ID INT,
    PRIMARY KEY (Doctor_ID),
    FOREIGN KEY (Department_ID)
        REFERENCES Department (Department_ID)
        ON DELETE SET NULL
);

CREATE TABLE Department_Heads(
    Doctor_ID INT,
    Department_ID INT,
    PRIMARY KEY (Doctor_ID, Department_ID),
    FOREIGN KEY (Department_ID)
        REFERENCES Department (Department_ID)
        ON DELETE CASCADE,
    FOREIGN KEY (Doctor_ID)
        REFERENCES Doctor (Doctor_ID)
        ON DELETE CASCADE
);
    
CREATE TABLE Room (
    Room_ID INT AUTO_INCREMENT,
    Department_ID INT,
    Status VARCHAR(15) NOT NULL DEFAULT 'Available',
    PRIMARY KEY (Room_ID),
    FOREIGN KEY (Department_ID)
        REFERENCES Department (Department_ID)
        ON DELETE SET NULL
);

CREATE TABLE Bed (
    Bed_ID INT AUTO_INCREMENT,
    Room_ID INT,
    PRIMARY KEY (Bed_ID),
    FOREIGN KEY (Room_ID)
        REFERENCES Room (Room_ID)
        ON DELETE SET NULL
);

CREATE TABLE Nurse (
    Nurse_ID INT AUTO_INCREMENT,
    F_name VARCHAR(20) NOT NULL,
    L_name VARCHAR(20) NOT NULL,
    Gender CHAR,
    Department_ID INT,
    PRIMARY KEY (Nurse_ID),
    FOREIGN KEY (Department_ID)
        REFERENCES Department (Department_ID)
        ON DELETE SET NULL
);

CREATE TABLE Patient (
    Patient_ID INT AUTO_INCREMENT,
    F_name VARCHAR(20) NOT NULL,
    L_name VARCHAR(20) NOT NULL,
    DOB DATE NOT NULL,
    Gender CHAR NOT NULL,
    Doctor_ID INT,
    Nurse_ID INT,
    PRIMARY KEY (Patient_ID),
    FOREIGN KEY (Doctor_ID)
        REFERENCES Doctor (Doctor_ID)
        ON DELETE SET NULL,
    FOREIGN KEY (Nurse_ID)
        REFERENCES Nurse (Nurse_ID)
        ON DELETE SET NULL
);

CREATE TABLE Patient_Bed (
    Patient_ID INT,
    Bed_ID INT,
    PRIMARY KEY (Patient_ID, Bed_ID),
    FOREIGN KEY (Patient_ID)
        REFERENCES Patient (Patient_ID)
        ON DELETE CASCADE,
    FOREIGN KEY (Bed_ID)
        REFERENCES Bed (Bed_ID)
        ON DELETE CASCADE
);

CREATE TABLE Patient_Room (
    Patient_ID INT,
    Room_ID INT,
    PRIMARY KEY (Patient_ID, Room_ID),
    FOREIGN KEY (Patient_ID)
        REFERENCES Patient (Patient_ID)
        ON DELETE CASCADE,
    FOREIGN KEY (Room_ID)
        REFERENCES Room (Room_ID)
        ON DELETE CASCADE
);

CREATE TABLE Medical_Record (
    Patient_ID INT,
    Weight_kg DECIMAL,
    PRIMARY KEY (Patient_ID),
    FOREIGN KEY (Patient_ID)
        REFERENCES Patient (Patient_ID)
        ON DELETE CASCADE
);

CREATE TABLE Immunization (
    Patient_ID INT,
    Immunization VARCHAR(20) NOT NULL,
    PRIMARY KEY (Patient_ID , Immunization),
    FOREIGN KEY (Patient_ID)
        REFERENCES Medical_Record (Patient_ID)
        ON DELETE CASCADE
);

CREATE TABLE Allergy (
    Patient_ID INT,
    Allergy VARCHAR(20) NOT NULL,
    PRIMARY KEY (Patient_ID , Allergy),
    FOREIGN KEY (Patient_ID)
        REFERENCES Medical_Record (Patient_ID)
        ON DELETE CASCADE
);

CREATE TABLE Medication (
    Patient_ID INT,
    Medication VARCHAR(20) NOT NULL,
    PRIMARY KEY (Patient_ID , Medication),
    FOREIGN KEY (Patient_ID)
        REFERENCES Medical_Record (Patient_ID)
        ON DELETE CASCADE
);

CREATE TABLE Treatment (
    Treatment_ID INT AUTO_INCREMENT,
    Patient_ID INT,
    type VARCHAR(20) NOT NULL,
    Doctor_ID INT,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    PRIMARY KEY (Treatment_ID),
    FOREIGN KEY (Doctor_ID)
        REFERENCES Doctor (Doctor_ID)
        ON DELETE SET NULL,
    FOREIGN KEY (Patient_ID)
        REFERENCES Patient (Patient_ID)
        ON DELETE CASCADE
);

CREATE TABLE Test_Report (
    Report_ID INT AUTO_INCREMENT,
    Test_Result VARCHAR(20),
    Test_Type VARCHAR(20),  
    Test_date DATE,
    Patient_ID INT,
    PRIMARY KEY (Report_ID),
    FOREIGN KEY (Patient_ID)
        REFERENCES Patient (Patient_ID)
        ON DELETE CASCADE
);

CREATE TABLE Physical_Treatment (
    Treatment_ID INT NOT NULL,
    Exersize_Type VARCHAR(20),
    Frequency INT,
    PRIMARY KEY (Treatment_ID),
    FOREIGN KEY (Treatment_ID)
        REFERENCES Treatment (Treatment_ID)
        ON DELETE CASCADE
);

CREATE TABLE Psychological_Treatment (
    Treatment_ID INT NOT NULL,
    Therapy_Type VARCHAR(20),
    Frequency INT,
    PRIMARY KEY (Treatment_ID),
    FOREIGN KEY (Treatment_ID)
        REFERENCES Treatment (Treatment_ID)
        ON DELETE CASCADE
);

CREATE TABLE Pharmecuetical_Treatment (
    Treatment_ID INT NOT NULL,
    Drug_name VARCHAR(20),
    Dosage VARCHAR(20),
    Frequency INT,
    PRIMARY KEY (Treatment_ID),
    FOREIGN KEY (Treatment_ID)
        REFERENCES Treatment (Treatment_ID)
        ON DELETE CASCADE
);

CREATE TABLE Doctor_Degree (
    Doctor_ID INT,
    Degree VARCHAR(50),
    PRIMARY KEY (Doctor_ID , Degree),
    FOREIGN KEY (Doctor_ID)
        REFERENCES Doctor (Doctor_ID)
        ON DELETE CASCADE
);

CREATE TABLE Doctor_Administers (
    Treatment_ID INT,
    Doctor_ID INT,
    Date DATE,
    Time TIME,
    PRIMARY KEY (Treatment_ID , Doctor_ID, Date, Time),
    FOREIGN KEY (Doctor_ID)
        REFERENCES Doctor (Doctor_ID)
        ON DELETE CASCADE,
    FOREIGN KEY (Treatment_ID)
        REFERENCES Treatment (Treatment_ID)
        ON DELETE CASCADE
);

CREATE TABLE Nurse_Administers (
    Treatment_ID INT,
    Nurse_ID INT,
    Date DATE,
    Time TIME,
    PRIMARY KEY (Treatment_ID , Nurse_ID, Date, Time),
    FOREIGN KEY (Nurse_ID)
        REFERENCES Nurse (Nurse_ID)
        ON DELETE CASCADE,
    FOREIGN KEY (Treatment_ID)
        REFERENCES Treatment (Treatment_ID)
        ON DELETE CASCADE
);

CREATE TABLE Doctor_Passwords (
    Doctor_ID INT,
    Password VARCHAR(100),
    PRIMARY KEY (Doctor_ID),
    FOREIGN KEY (Doctor_ID)
        REFERENCES Doctor (Doctor_ID)
        ON DELETE CASCADE
);
    
CREATE TABLE Nurse_Passwords (
    Nurse_ID INT,
    Password VARCHAR(100),
    PRIMARY KEY (Nurse_ID),
    FOREIGN KEY (Nurse_ID)
        REFERENCES Nurse (Nurse_ID)
        ON DELETE CASCADE
);

ALTER TABLE Doctor AUTO_INCREMENT = 2000;
ALTER TABLE Nurse AUTO_INCREMENT = 1000;
ALTER TABLE Patient AUTO_INCREMENT = 3000;
ALTER TABLE Treatment AUTO_INCREMENT = 4000;
ALTER TABLE Test_Report AUTO_INCREMENT = 5000;