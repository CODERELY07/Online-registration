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

