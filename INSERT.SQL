INSERT INTO Hospital (Name, City, Street_Num, Street)
VALUES 
('Central Hospital', 'Springfield', '123', 'Main St'),
('East Side Clinic', 'Shelbyville', '456', 'Elm St'),
('St. Mary's Hospital', 'New York', '123', 'South Ave'),
('Grace Memorial Hospital', 'Los Angeles', '456', 'Sunset Blvd'),
('City Health Center', 'Chicago', '789', 'Lake Shore Dr');

INSERT INTO Department (Name, Hospital_ID)
VALUES 
('Cardiology', 1),
('Pediatrics', 2),
('Neurology', 2),
('Orthopedics', 3),
('Emergency', 2);

INSERT INTO Doctor (F_name, L_name, Gender, Type, Department_ID)
VALUES 
('Michael', 'Clark', 'M', 'Surgeon', 4),
('Laura', 'Adams', 'F', 'Dermatologist', 1),
('Ryan', 'Lee', 'M', 'Oncologist', 5),
('Megan', 'Taylor', 'F', 'Psychiatrist', 3),
('Daniel', 'Thomas', 'M', 'Cardiologist', 1);

INSERT INTO Nurse (F_name, L_name, Gender, Department_ID)
VALUES 
('Lily', 'Evans', 'F', 2),
('Mark', 'Hall', 'M', 4),
('Emma', 'Watson', 'F', 1),
('Oliver', 'Stone', 'M', 5),
('Sophia', 'Jones', 'F', 3);

INSERT INTO Room (Department_ID, Status)
VALUES 
(1, 'Occupied'),
(2, 'Available'),
(3, 'Available'),
(4, 'Occupied'),
(5, 'Available');

INSERT INTO Bed (Room_ID)
VALUES 
(4),
(5),
(6),
(7),
(8);

INSERT INTO Department_Heads (Doctor_ID, Department_ID) VALUES
(2001, 1),
(2002, 2),
(2003, 3),
(2004, 4);

INSERT INTO Patient (F_name, L_name, DOB, Gender, Room_ID, Doctor_ID, Nurse_ID, Patient_ID, Bed_ID)
VALUES 
('Emily', 'Brown', '1990-05-20', 'F', 1, 2000, 1000, 3000, 1),
('James', 'Green', '1985-12-10', 'M', 2, 2001, 1001, 3001, 2),
('Anna', 'Clark', '1990-05-15', 'F', 1, 2001, 1001, 3002, 1),
('Luke', 'Martin', '1985-02-23', 'M', 2, 2002, 1002, 3003, 2),
('Emma', 'Walker', '2000-07-01', 'F', 3, 2003, 1003, 3004, 3),
('Ethan', 'Young', '1978-11-12', 'M', 4, 2004, 1004, 3005, 4),
('Mia', 'Harris', '1995-10-30', 'F', 5, 2000, 1000, 3006, 5);

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

INSERT INTO Treatment (Patient_ID, Type, Doctor_ID, Date, Time)
VALUES 
(3000, 'Surgery', 2001, '2024-11-15', '09:00:00'),
(3001, 'Physical Therapy', 2002, '2024-11-16', '10:00:00'),
(3002, 'Consultation', 2003, '2024-11-17', '14:00:00'),
(3003, 'Emergency Care', 2004, '2024-11-18', '16:00:00'),
(3004, 'Routine Checkup', 2000, '2024-11-19', '11:00:00'),
(3005, 'Physical Therapy', 2002, '2024-11-16', '10:00:00'),
(3006, 'Psychological Therapy', 2003, '2024-11-16', '10:00:00');

INSERT INTO Physical_Treatment (Treatment_ID, Exersize_Type, Frequency)
VALUES 
(4003, 'Stretching', 'Twice a day'),
(4004, 'Walking', 'Daily');

INSERT INTO Psychological_Treatment (Treatment_ID, Therapy_Type, Frequency)
VALUES 
(4005, 'CBT', 'Weekly'),
(4006, 'Support Group', 'Monthly');

INSERT INTO Pharmaceutical_Treatment (Treatment_ID, Drug_name, Dosage, Frequency)
VALUES 
(4003, 'Paracetamol', '500mg', 'Every 6 hours'),
(4004, 'Ibuprofen', '200mg', 'Twice daily');

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


