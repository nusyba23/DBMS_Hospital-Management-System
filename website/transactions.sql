/*InsertTemplate.php = Inserts a new doctor's details (F_name, L_name, Gender) into the Doctor table*/
     
    $sql = "INSERT INTO Doctor(F_name, L_name, Gender)
	        VALUES('{$_POST["F_name"]}','{$_POST["L_name"]}', '{$_POST["Gender"]}')";

     /*addAllergy.php = Inserts an allergy associated with a specific patient into a dynamic table ($Table).*/
    $sql = "INSERT INTO {$Table}(Allergy, Patient_ID)
                    VALUES('{$Name}','{$Patient_ID}')";
     
     
    /*addBed.php = Inserts a new bed assigned to a specific room (Room_ID) into the Bed table.*/
        $sql = "INSERT INTO Bed (Room_ID)
        VALUES({$_SESSION["Room_ID"]})";
     
     
    /*addDegree.php = Adds a degree associated with a specific doctor (Doctor_ID) into the Doctor_Degree table.*/
        $sql = "INSERT INTO Doctor_Degree (Degree, Doctor_ID)
                    VALUES('{$Degree}',{$Doctor_ID})";
     
     
    /*addDepartment.php =Adds a new department (Name, Hospital_ID) to the Department table.
                        Retrieves the most recently added department details.
                        Assigns a doctor as the head of the newly created department. */
       $sql = "INSERT INTO Department(Name, Hospital_ID)
                    VALUES('{$Name}','{$Hospital_ID}')";

    $sql_get = "SELECT * FROM Department
                        WHERE Department_ID = (SELECT MAX(Department_ID)
                                                FROM Department)";
    $sql = "INSERT INTO Department_Heads(Department_ID, Doctor_ID)
                    VALUES('{$D_ID}','{$Head_Doctor_ID}')"
        
     /*addDoctor.php = Inserts a new doctor's details with or without specifying their type and department into the Doctor table.*/
       $sql;
        
                $sql = "INSERT INTO Doctor(F_name, L_name, Gender, Department_ID)
                        VALUES('{$F_name}','{$L_name}', '{$Gender}', {$Department_ID})";
            }
            else{
                $sql = "INSERT INTO Doctor(F_name, L_name, Gender, Type, Department_ID)
                        VALUES('{$F_name}','{$L_name}', '{$Gender}', '{$Type}',{$Department_ID})";
            }
     
     
     /*addHospital.php = Adds a new hospital with its details (Name, City, Street, Street_Num) to the Hospital table.*/
          $sql = "INSERT INTO Hospital(Name, City, Street, Street_Num)
                    VALUES('{$Name}','{$City}','{$Street}','{$Street_Num}')";
     
     /*addImmunization.php = Adds immunization details for a specific patient to the Immunization table.
*/
       //sql statement
            $sql = "INSERT INTO Immunization(Immunization, Patient_ID)
                    VALUES('{$Name}','{$Patient_ID}')";

    /*addMedication = Adds a medication record for a specific patient to a dynamic table ($Table).*/
     $sql = "INSERT INTO {$Table}(Medication, Patient_ID)
                    VALUES('{$Name}','{$Patient_ID}')";

    /*addNurse.php = Inserts a new nurse's details (F_name, L_name, Gender, Department_ID) into the Nurse table.*/
       $sql = "INSERT INTO Nurse(F_name, L_name, Gender, Department_ID)
                    VALUES('{$F_name}','{$L_name}', '{$Gender}', '{$Department_ID}')";

    /*addPatient.php = Adds a new patient's details (F_name, L_name, Gender, DOB) to the Patient table.
                    Retrieves the most recently added patient record.*/
     $sql = "INSERT INTO Patient(F_name, L_name, Gender, DOB)
                        VALUES('{$F_name}','{$L_name}', '{$Gender}', '{$DOB}')";
     $sql_get = "SELECT * FROM Patient
                        WHERE Patient_ID = (SELECT MAX(Patient_ID)
                                            FROM Patient)";

    /*addRoom.php =Adds a new room associated with a specific department (Department_ID) to the Room table.*/
     $sql = "INSERT INTO Room (Department_ID)
    VALUES({$_SESSION["Department_ID"]})";

    /*addTest.php = Inserts test report details (Test_Type, Test_Result, Test_date, Patient_ID) into the Test_Report table.*/
    $sql = "INSERT INTO Test_Report(Test_Type, Test_Result, Test_date, Patient_ID)
                    VALUES('{$Test_Type}','{$Test_Result}','{$Test_date}',{$Patient_ID})";
    /*assignBed.php = Deletes existing bed assignments for a patient.
                        Assigns a new bed to the patient.
                    Updates the patient's room assignment based on their bed assignment.*/
       //sql statement to delete old
            $sql = "DELETE FROM {$Table} WHERE Patient_ID = {$Patient_ID}";
            include("database.php");
          
            
            //sql statement to add current
            $sql = "INSERT INTO {$Table}(Bed_ID, Patient_ID)
                    VALUES({$Bed_ID},{$Patient_ID})";
        //sql statement to delete old
            $sql = "DELETE FROM Patient_Room WHERE Patient_ID = {$Patient_ID}";
            include("database.php");
           
            $sql = "INSERT INTO Patient_Room (Room_ID, Patient_ID)
                    VALUES((SELECT Room_ID FROM Bed WHERE Bed_ID = {$Bed_ID}),{$Patient_ID})";

    /*assignDoctor = Updates the doctor assigned to a specific patient in a dynamic table ($Table).*/
    $sql = "UPDATE {$Table} SET Doctor_ID = {$Doctor_ID} WHERE Patient_ID = {$Patient_ID}";
            include("database.php");
          
    /*assignNurse = Updates the nurse assigned to a specific patient in a dynamic table ($Table).*/
       $sql = "UPDATE {$Table} SET Nurse_ID = {$Nurse_ID} WHERE Patient_ID = {$Patient_ID}";
            include("database.php");
           
    /*createPassword =Adds a password for a specific nurse (Nurse_ID) to the Nurse_Passwords table.*/
    $sql = "INSERT INTO Nurse_Passwords(Nurse_ID, Password)
                        VALUES('{$Nurse_ID}','{$Password}')";
    /*deletePatient.php =Deletes a patient record from the Patient table based on their ID.*/
    $sql = "DELETE FROM Patient WHERE Patient_ID = {$_SESSION["Patient_ID"]}";

    /*Departmentdash.php = Fetches the hospital name based on the current hospital session ID.
Fetches the department name based on the current department session ID.
Retrieves details of department heads and doctors in the current department.
Retrieves patients assigned to rooms in the current department.
Retrieves all rooms in the current department.
*/
     $sql = "SELECT Name FROM Hospital
            WHERE Hospital_ID = {$_SESSION["Hospital_ID"]}";
     $sql = "SELECT Name FROM Department
            WHERE Department_ID = {$_SESSION["Department_ID"]}";
     $sql = "SELECT L_name, F_name, Type FROM Doctor
            WHERE Doctor_ID IN
            (SELECT (Doctor_ID) FROM Department_Heads 
            WHERE Department_ID = {$_SESSION["Department_ID"]})";
    $sql = "SELECT L_name, F_name, Type FROM Doctor
        WHERE Department_ID = {$_SESSION["Department_ID"]}";
    $sql = "SELECT L_name, F_name FROM Nurse
        WHERE Department_ID = {$_SESSION["Department_ID"]}";
    $sql = "SELECT * FROM Patient 
        WHERE Patient_ID IN
        (SELECT (Patient_ID)
        FROM Patient_Room
        WHERE Room_ID IN
        (SELECT (Room_ID) FROM Room 
        WHERE Department_ID = {$_SESSION["Department_ID"]}))";
    $sql = "SELECT * FROM Room 
        WHERE Department_ID = {$_SESSION["Department_ID"]}";


    /*displayHospitals.php = Retrieves all hospital details from the Hospital table.*/
    $sql = "SELECT * FROM Hospital";

    /*displayPatient.php = Retrieves all patient details from the Patient table.*/
     $sql = "SELECT * FROM Patient";

    /*displayRooms&beds.php =  = Joins Room and Bed tables to display room IDs, bed IDs, and room status.*/
    $sql = "SELECT Room.Room_ID, Bed.Bed_ID, Room.status FROM Room INNER JOIN Bed ON Room.Room_ID = Bed.Room_ID";

    /*displayTreatment.php = Retrieves treatment details based on the session's treatment ID from the Pharmaceutical_Treatment, Psychological_Treatment, or Physical_Treatment tables.*/
    $sql = "SELECT * FROM Pharmecuetical_Treatment 
            WHERE Treatment_ID = {$_SESSION["Treatment_ID"]}";
     $sql = "SELECT * FROM Psychological_Treatment 
            WHERE Treatment_ID = {$_SESSION["Treatment_ID"]}";
     $sql = "SELECT * FROM Physical_Treatment 
            WHERE Treatment_ID = {$_SESSION["Treatment_ID"]}";
    /*header.php = Fetches the degrees associated with the logged-in doctor (Doctor_ID) from the Doctor_Degree table.*/
       $sql = "SELECT Degree
            FROM Doctor_Degree
            WHERE Doctor_ID = {$_SESSION["ID"]}"
    /*hospitalDash.php = Retrieves hospital details and its departments based on the session's hospital ID.*/
     $sql = "SELECT Name FROM Hospital
            WHERE Hospital_ID = {$_SESSION["Hospital_ID"]}";
      $sql = "SELECT * FROM Department 
            WHERE Hospital_ID = {$_SESSION["Hospital_ID"]}";
    
    
    /*myPatients.php = Fetches all patients associated with the logged-in nurse or doctor based on their session ID.*/
     $sql = "SELECT * FROM Patient 
            WHERE Patient_ID IN
					        ((SELECT (Patient_ID) FROM Patient 
					        WHERE Nurse_ID = {$_SESSION["ID"]})
                            UNION
                            (SELECT (Patient_ID) FROM Patient 
					        WHERE Doctor_ID = {$_SESSION["ID"]}))";
    /*myTreatments.php = Retrieves treatment details for the current patient based on the session's patient ID*/
     $sql = "SELECT * FROM Treatment 
            WHERE Patient_ID = {$_SESSION["Patient_ID"]}";
    /*patientDash.php = Retrieves a patient's details, medical records, allergies, immunizations, medications, test reports, and room/bed assignments based on their patient ID.*/
    $sql = "SELECT * FROM Patient
            WHERE Patient_ID = {$PID}";
     $sql = "SELECT * FROM Medical_Record
            WHERE Patient_ID = {$PID}";
     $sql = "SELECT * FROM Allergy
            WHERE Patient_ID = {$PID}";
     $sql = "SELECT * FROM Immunization
            WHERE Patient_ID = {$PID}";
     $sql = "SELECT * FROM Medication
            WHERE Patient_ID = {$PID}";
    $sql = "SELECT * FROM Test_Report
            WHERE Patient_ID = {$PID}";
     $sql = "SELECT * FROM Patient_Bed
            WHERE Patient_ID = {$PID}";
     $sql = "SELECT * FROM Patient_Room
            WHERE Patient_ID = {$PID}";
    /*roomDash.php = Retrieves hospital and department names based on the session's IDs.
Retrieves patient bed assignments for a specific room.*/
       $sql = "SELECT Name FROM Hospital
            WHERE Hospital_ID = {$_SESSION["Hospital_ID"]}";
         $sql = "SELECT Name FROM Department
            WHERE Department_ID = {$_SESSION["Department_ID"]}";
             $sql = "SELECT * FROM Patient_Bed
            WHERE Bed_ID IN
            (SELECT (Bed_ID) FROM Bed
            WHERE Room_ID = {$_SESSION["Room_ID"]})";
    
    /*treatmentPharmaceutical.php = Inserts treatment details into the Treatment table.
Adds pharmaceutical treatment details (Drug_name, Frequency, Dosage) to the Pharmaceutical_Treatment table.*/
     $sql = "INSERT INTO Treatment(Date, Doctor_ID, Patient_ID, Time, type)
                    VALUES({$Date},{$Doctor_ID},{$Patient_ID},{$Time},'{$type}')";
    $sql = "INSERT INTO Pharmecuetical_Treatment(Treatment_ID, Drug_name, Frequency, Dosage)
            VALUES({$Treatment_ID},'{$Drug_name}',{$Frequency}, {$Dosage})";


    /*treatmentPhysical.php = Inserts treatment details into the Treatment table.
Adds physical treatment details (Exercise_Type, Frequency) to the Physical_Treatment table.*/
    $sql = "INSERT INTO Treatment(Date, Doctor_ID, Patient_ID, Time, type)
                    VALUES({$Date},{$Doctor_ID},{$Patient_ID},{$Time},'{$type}')";
    
    $sql = "INSERT INTO Physical_Treatment(Treatment_ID, Exersize_Type, Frequency)
            VALUES({$Treatment_ID},'{$Exersize_Type}',{$Frequency})";
    
    /*treatmentPsychological.php = Inserts treatment details into the Treatment table.
Adds psychological treatment details (Therapy_Type, Frequency) to the Psychological_Treatment table.*/
      $sql = "INSERT INTO Treatment(Date, Doctor_ID, Patient_ID, Time, type)
                    VALUES({$Date},{$Doctor_ID},{$Patient_ID},{$Time},'{$type}')";

      $sql = "INSERT INTO Psychological_Treatment(Treatment_ID, Therapy_Type, Frequency)
            VALUES({$Treatment_ID},'{$Therapy_Type}',{$Frequency})";
    /*updateStatus.php = Updates the status of a specific room (Room_ID) in the Room table.*/
  $sql = "UPDATE Room
                    SET Status = '{$Status}'
                    WHERE Room_ID = {$_SESSION["Room_ID"]}";
   