/*
	#Note to self: Change some names of the constraints to shorter ones
	#Not more than 30 characters
*/


CREATE TABLE StudentModule(
	StudentNumber VARCHAR2(8),
	ModuleCode VARCHAR2(7),
		CONSTRAINT StudentModule_StudentNumberModuleCode_pk PRIMARY KEY (StudentNumber, ModuleCode)
);

CREATE TABLE StudentInfo(
	StudentNumber VARCHAR2(8),
	StudentName VARCHAR2(150),
	StudentEmail VARCHAR2(200),
	StudentPassword VARCHAR2(100),
		CONSTRAINT StudentInfo_StudentNumber_pk PRIMARY KEY (StudentNumber)
);

CREATE TABLE ModuleInfo(
	ModuleCode VARCHAR2(7),
	Description VARCHAR2(100),
		CONSTRAINT ModuleInfo_ModuleCode_pk PRIMARY KEY (ModuleCode)		
);

CREATE TABLE ExamSetup(
	ModuleCode VARCHAR2(7),
	DateExam DATE,
	ExamPaperPDF VARCHAR2(150),
		CONSTRAINT ExamSetup_ModuleCode_pk PRIMARY KEY (ModuleCode)
);

CREATE TABLE StaffInfo(
	StaffNumber VARCHAR2(10),
	StaffName VARCHAR2(150),
	StaffEmail VARCHAR2(200),
	StaffPassword VARCHAR2(100),
		CONSTRAINT StaffInfo_StaffNumber_pk PRIMARY KEY (StaffNumber)
);

CREATE TABLE ModuleLeader(
	ModuleCode VARCHAR2(7),
	StaffNumber VARCHAR2(10),
		CONSTRAINT ModuleLeader_StaffNo_ModCode_pk PRIMARY KEY (StaffNumber, ModuleCode),
		CONSTRAINT ModuleLeader_ModuleCode_fk FOREIGN KEY (ModuleCode)
			REFERENCES ExamSetup(ModuleCode)
);

CREATE TABLE ExamOutput(
	TransactionID VARCHAR2(13),
	StartTime DATE,
	UploadTime DATE,
	AnswerPaperPDF VARCHAR2(150),
	StudentNumber VARCHAR2(8),
	ModuleCode VARCHAR2(7),
		CONSTRAINT ExamOutput_TransactionID_pk PRIMARY KEY (TransactionID),
		CONSTRAINT ExamOutput_StudentNumber_fk FOREIGN KEY (StudentNumber, ModuleCode)
			REFERENCES StudentModule(StudentNumber, ModuleCode),
		CONSTRAINT ExamOutput_ModuleCode_fk FOREIGN KEY (StudentNumber, ModuleCode)
			REFERENCES StudentModule(StudentNumber, ModuleCode)
);