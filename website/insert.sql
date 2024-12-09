INSERT INTO Hospital (Name, City, Street_Num, Street)
VALUES 
('Central Hospital', 'Springfield', '123', 'Main St'),
('East Side Clinic', 'Shelbyville', '456', 'Elm St'),
('St. Marys Hospital', 'New York', '123', 'South Ave'),
('Grace Memorial Hospital', 'Los Angeles', '456', 'Sunset Blvd'),
('City Health Center', 'Chicago', '789', 'Lake Shore Dr');

INSERT INTO Department (Name, Hospital_ID)
VALUES 
('Cardiology', 1),
('Pediatrics', 2),
('Neurology', 3),
('Orthopedics', 4),
('Emergency', 5);

INSERT INTO Doctor (F_name, L_name, Gender, Type, Department_ID)
VALUES 
('Michael', 'Clark', 'M', 'Surgeon', 1),
('Laura', 'Adams', 'F', 'Dermatologist', 2),
('Ryan', 'Lee', 'M', 'Oncologist', 3),
('Megan', 'Taylor', 'F', 'Psychiatrist', 4),
('Daniel', 'Thomas', 'M', 'Cardiologist', 5);

INSERT INTO Nurse (F_name, L_name, Gender, Department_ID)
VALUES 
('Lily', 'Evans', 'F', 2),
('Mark', 'Hall', 'M',  4),
('Emma', 'Watson', 'F',  1),
('Oliver', 'Stone', 'M',  5),
('Sophia', 'Jones', 'F',  3);

INSERT INTO Room (Department_ID, Status) 
VALUES 
(1, 'Occupied'),
(2, 'Available'),
(3, 'Available'),
(4, 'Occupied'),
(5, 'Available');

INSERT INTO Bed (Room_ID)
VALUES 
(1), 
(2), 
(3), 
(4), 
(5);

INSERT INTO Department_Heads (Doctor_ID, Department_ID) 
VALUES
(2000, 5),
(2001, 1),
(2002, 2),
(2003, 3),
(2004, 4);


INSERT INTO Patient (F_name, L_name, DOB, Gender, Doctor_ID, Nurse_ID)
VALUES 
('Emily', 'Brown', '1990-05-20', 'F', 2000, 1000),
('James', 'Green', '1985-12-10', 'M', 2001, 1001),
('Anna', 'Clark', '1990-05-15', 'F', 2001, 1001),
('Luke', 'Martin', '1985-02-23', 'M', 2002, 1002),
('Emma', 'Walker', '2000-07-01', 'F', 2003, 1003),
('Ethan', 'Young', '1978-11-12', 'M', 2004, 1004),
('Mia', 'Harris', '1995-10-30', 'F', 2000, 1000);

INSERT INTO Medical_Record (Patient_ID, Weight_kg)
VALUES 
(3000, 70.5),
(3001, 80.0),
(3002, 55.3),
(3003, 85.0),
(3004, 60.0),
(3005, 65.0),
(3006, 67.3);

INSERT INTO Immunization (Patient_ID, Immunization)
VALUES 
(3000, 'Hepatitis B'),
(3001, 'Influenza'),
(3002, 'Measles'),
(3003, 'Polio'),
(3004, 'Hepatitis A'),
(3005, 'HPV'),
(3006, 'Influenza');

INSERT INTO Allergy (Patient_ID, Allergy)
VALUES 
(3000, 'Penicillin'),
(3001, 'Dust'),
(3002, 'Pollen'),
(3003, 'Peanuts'),
(3004, 'Shellfish'),
(3005, 'None'),
(3006, 'Penicillin');

INSERT INTO Doctor_Degree (Doctor_ID, Degree) 
VALUES 
(2000, 'MD'),
(2001, 'PhD'),
(2002, 'MBBS'),
(2003, 'MBBS'),
(2004, 'PHD');

INSERT INTO Test_Report (Test_Result, Test_Type, Test_date, Patient_ID) 
VALUES
('Positive', 'X-Ray', '2024-11-14', 3000),
('Negative', 'MRI', '2024-11-13', 3001),
('Normal', 'Blood Test', '2024-11-12', 3002),
('Positive', 'CT Scan', '2024-11-11', 3003),
('Negative', 'Ultrasound', '2024-11-10', 3004),
('Positive', 'Vitamin Test', '2024-11-10', 3005),
('Negative', 'Blood Test', '2024-11-10', 3006);

INSERT INTO Medication (Patient_ID, Medication) 
VALUES
(3000, 'Aspirin'),
(3001, 'Amoxicillin'),
(3002, 'Ibuprofen'),
(3003, 'Paracetamol'),
(3004, 'Antihistamine'),
(3005, 'Aspirin'),
(3006, 'Ibuprofen');

INSERT INTO Doctor_Passwords (Doctor_ID, Password) 
VALUES 
(2000, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW'),
(2001, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW'),
(2002, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW'),
(2003, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW'),
(2004, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW');

INSERT INTO Nurse_Passwords (Nurse_ID, Password) 
VALUES 
(1000, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW'),
(1001, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW'),
(1002, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW'),
(1003, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW'),
(1004, '$2y$10$fMU5eifPY1iv5RG4YIE1z.USsFw2D.VB4TNAy6eDGiBhqsi11mRpW');

