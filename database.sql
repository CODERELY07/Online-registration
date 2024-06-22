--database name 
informations

--CREATE TABLE
CREATE TABLE trainees(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    srn_number INT(10) NOT NULL,
    mode VARCHAR(11) NOT NULL,
	firstname VARCHAR(100) NOT NULL,
    middlename VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    suffix VARCHAR(100) NOT NULL,
    addrss VARCHAR(255) NOT NULL,
    gender VARCHAR(50) NOT NULL,
    position VARCHAR(100) NOT NULL,
    birth DATE NOT NULL,
    stat VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL,
    place VARCHAR(255) NOT NULL,
    contact VARCHAR(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

--create position table
CREATE TABLE positionList(
	id INT AUTO_INCREMENT PRIMARY KEY,
    position VARCHAR(255) NOT NULL
)
--insert in positionList table
INSERT INTO positionList (position) VALUES
('4th Engineer'),
('2nd Cook'),
('2nd Engineer'),
('2nd Mate'),
('2nd Officer'),
('3E'),
('3rd Engineer'),
('3rd Officer'),
('AB'),
('Assistant Chef'),
('Bosun'),
('Captain'),
('Chief Cook'),
('Chief Engineer'),
('Chief Mate'),
('Chief Officer'),
('Cook'),
('Crew'),
('Deck Cadet'),
('Deck Hand'),
('Electrical'),
('Engine Cadet'),
('ETO'),
('Fitter'),
('Galley Utility'),
('Hotel Utility'),
('Junior Officer'),
('Master Mariner'),
('Messman'),
('OIC-EW'),
('OIC-NW'),
('Oiler'),
('OS'),
('Ratings'),
('Security Officer'),
('Senior Barkeeper'),
('Shore Excursionist'),
('Steward'),
('Store Keeper'),
('Waiter'),
('Welder');

-- ITO YONG BAGO MIKE PASTE MO LANG TO
--courseCategories Table
CREATE TABLE coursecategories(
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
);
--Create courses table
Create TABLE courses(
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    category_id INT,
    FOREIGN KEY(category_id) REFERENCES courseCategories(category_id)
);
--Create schedule table
CREATE TABLE schedules(
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    batch VARCHAR(255) NOT NULL,
    batch_date VARCHAR(255) NOT NULL,
    batch_time VARCHAR(255) NOT NULL,
    branch VARCHAR(100) NOT NULL,
    mode VARCHAR(50) NOT NULL,
    slots INT(255) NOT NULL, 
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
)
Create TABLE course_requirments(
    course_requirments_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    course_requirments_name VARCHAR(255) NOT NULL,
    FOREIGN KEY(course_id) REFERENCES courses(course_id)
);

--Insert data into coursecategories
INSERT INTO CourseCategories (category_name) VALUES
('Distance Learning Course'),
('Facility Rental'),
('Furuno FEA'),
('JRC');

--Insert data into courses
INSERT INTO courses (course_name, category_id) VALUES
('Advance Fire Fighting', 1),
('Refresher on Advance Fire Fighting', 1),
('CP', 2),
('OFF', 2),
('PPG', 2),
('Furuno Fea Online', 3),
('JRC1',4),
('JRC2',4),
('JRC3',4);

--Insert data into schedule
INSERT INTO schedules(course_id,batch,batch_date,batch_time,branch,mode,slots)VALUES
(1,'Batch 1','Jun 25,2024 - Jun 25, 2024', '07:00 - 14:00', 'Naga','Blended',3),
(3,'Batch 2','Jun 26,2024 - Jun 26, 2024', '07:00 - 14:00', 'Naga','Online',3);

--Insert data into course_requirments
INSERT INTO course_requirments (course_requirments_name,course_id) 
VALUES 
    ('Medical First Aid Training Certificate', 1),
    ('COVID-19 Vaccination Card', 1),
    ('COVID-19 Vaccination Card', 2)

