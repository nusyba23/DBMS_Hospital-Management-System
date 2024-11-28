INSERT INTO Hospital (Name, City, Street_Num, Street) VALUES
('St. Mary\'s Hospital', 'New York', '123', '5th Ave'),
('Grace Memorial Hospital', 'Los Angeles', '456', 'Sunset Blvd'),
('City Health Center', 'Chicago', '789', 'Lake Shore Dr');

INSERT INTO Department (Name, Hospital_ID) VALUES
('Cardiology', 1),
('Neurology', 1),
('Pediatrics', 2),
('Orthopedics', 3),
('Emergency', 2);

INSERT INTO Doctor (F_name, L_name, Gender, Type, Department_ID) VALUES
('John', 'Doe', 'M', 'Cardiologist', 1),
('Jane', 'Smith', 'F', 'Neurologist', 2),
('Michael', 'Johnson', 'M', 'Pediatrician', 3),
('Sara', 'Williams', 'F', 'General Practitioner', 1),
('Robert', 'Brown', 'M', 'Orthopedic Surgeon', 4);

INSERT INTO Department_Heads (Doctor_ID, Department_ID) VALUES
(2001, 1),
(2002, 2),
(2003, 3),
(2004, 4),
(2000, 5);

INSERT INTO Room (Department_ID, status) VALUES
(1, 'Available'),
(2, 'Occupied'),
(3, 'Available'),
(4, 'Available'),
(5, 'Occupied');

INSERT INTO Bed (Room_ID) VALUES
(1),
(1),
(2),
(3),
(4);

INSERT INTO Nurse (F_name, L_name, Gender, Department_ID) VALUES
('Emily', 'Davis', 'F', 1),
('David', 'Miller', 'M', 2),
('Olivia', 'Wilson', 'F', 3),
('James', 'Moore', 'M', 4),
('Sophia', 'Taylor', 'F', 5);

INSERT INTO Patient (F_name, L_name, DOB, Gender, Room_ID, Doctor_ID, Nurse_ID, Bed_ID) VALUES
('Anna', 'Clark', '1990-05-15', 'F', 1, 2001, 1001, 1),
('Luke', 'Martin', '1985-02-23', 'M', 2, 2002, 1002, 2),
('Emma', 'Walker', '2000-07-01', 'F', 3, 2003, 1003, 3),
('Ethan', 'Young', '1978-11-12', 'M', 4, 2004, 1004, 4),
('Mia', 'Harris', '1995-10-30', 'F', 5, 2000, 1000, 5);

INSERT INTO Medical_Record (Patient_ID, Wieght_kg) VALUES
(3000, 70.5),
(3001, 80.0),
(3002, 55.3),
(3003, 85.0),
(3004, 60.0);

INSERT INTO Immunization (Patient_ID, Immunization) VALUES
(3000, 'Hepatitis B'),
(3001, 'Influenza'),
(3002, 'Measles'),
(3003, 'Polio'),
(3004, 'Hepatitis A');

INSERT INTO Allergy (Patient_ID, Allergy) VALUES
(3000, 'Penicillin'),
(3001, 'Dust'),
(3002, 'Pollen'),
(3003, 'Peanuts'),
(3004, 'Shellfish');

INSERT INTO Medication (Patient_ID, Medication) VALUES
(3000, 'Aspirin'),
(3001, 'Amoxicillin'),
(3002, 'Ibuprofen'),
(3003, 'Paracetamol'),
(3004, 'Antihistamine');

INSERT INTO Treatment (Patient_ID, type, Doctor_ID, Date, Time) VALUES
(3000, 'Surgery', 2001, '2024-11-15', '09:00:00'),
(3001, 'Physical Therapy', 2002, '2024-11-16', '10:00:00'),
(3002, 'Consultation', 2003, '2024-11-17', '14:00:00'),
(3003, 'Emergency Care', 2004, '2024-11-18', '16:00:00'),
(3004, 'Routine Checkup', 2000, '2024-11-19', '11:00:00');

INSERT INTO Test_Report (Test_Result, Test_Tpye, Test_date, Patient_ID) VALUES
('Positive', 'X-Ray', '2024-11-14', 3000),
('Negative', 'MRI', '2024-11-13', 3001),
('Normal', 'Blood Test', '2024-11-12', 3002),
('Positive', 'CT Scan', '2024-11-11', 3003),
('Negative', 'Ultrasound', '2024-11-10', 3004);
