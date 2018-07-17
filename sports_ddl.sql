DROP   DATABASE IF EXISTS SportsTeam;
CREATE DATABASE           SportsTeam;


--Role based access users
  DROP   USER IF EXISTS 'Observer'@'localhost';
  CREATE USER           'Observer'@'localhost' IDENTIFIED BY 'Password1';

  DROP   USER IF EXISTS 'Users'@'localhost';
  CREATE USER           'Users'@'localhost' IDENTIFIED BY 'Password2';

  DROP   USER IF EXISTS 'Executive Manager'@'localhost';
  CREATE USER           'Executive Manager'@'localhost' IDENTIFIED BY 'Password3';
  


--Database administration users
  DROP USER IF EXISTS 'admin'@'localhost';
  Create USER 'admin'@'localhost' IDENTIFIED BY 'Password4';
  
  GRANT ALL PRIVILEGES ON SportsTeam.* TO 'admin'@'localhost'; 
USE SportsTeam;



CREATE TABLE Roles
(
  ID_Role        TINYINT UNSIGNED   AUTO_INCREMENT   PRIMARY KEY,
  roleName       VARCHAR(30)        NOT NULL   UNIQUE   COMMENT 'Must match Database Users'
);

GRANT select, insert, delete, update ON Roles TO 'Executive Manager'@'localhost';
GRANT select  ON Roles TO 'Users'@'localhost';
GRANT select  ON Roles TO 'Observer'@'localhost';

INSERT INTO Roles VALUES 
 (1, 'Observer'),
 (2, 'Users'),
 (3, 'Executive Manager');






CREATE TABLE UserLogin
(
    ID            INTEGER          UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name_First    VARCHAR(100),
    Name_Last     VARCHAR(150)     NOT NULL,
    Email         VARCHAR(250),
    UserName      VARCHAR(100)     UNIQUE,
    Password      CHAR(60),
    Role          TINYINT UNSIGNED NOT NULL DEFAULT 1,
    ts            TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (Role) REFERENCES Roles(ID_Role) ON DELETE CASCADE
);

GRANT select, update ON UserLogin TO 'Observer'@'localhost';
GRANT select, update ON UserLogin TO 'Users'@'localhost';
GRANT select, insert, delete, update ON UserLogin TO 'Executive Manager'@'localhost';






CREATE TABLE LeagueTeamCoach
(  ID            INTEGER UNSIGNED NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  Name_First    VARCHAR(100),
  Name_Last     VARCHAR(150)      NOT NULL,
  Email         VARCHAR(150)
);


GRANT         Select                 ON LeagueTeamCoach TO 'Observer'         @'localhost';
GRANT Insert, Select, Update, Delete ON LeagueTeamCoach TO 'Users'            @'localhost';
GRANT Insert, Select, Update, Delete ON LeagueTeamCoach TO 'Executive Manager'@'localhost';


INSERT INTO LeagueTeamCoach VALUES
('1','Dead','Pool','Dp@gmail.com'),
('2','Bat','Man','Bm@gmail.com'),
('3','Dare','Devil','Dd@gmail.com'),
('4','Hulk','Hogan','Hh@gmail.com'),
('5','Cerci','Lannister','Cl@gmail.com'),
('6','Morgan','Freeman','Mf@gmail.com'),
('7','Joker','Slob','Js@gmail.com'),
('8','Vin','Diesel','Vd@gmail.com');



CREATE TABLE LeagueTeam
( TeamID      INTEGER UNSIGNED NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  TeamName    VARCHAR(100)
);

GRANT         Select                 ON LeagueTeam TO 'Observer'         @'localhost';
GRANT Insert, Select, Update, Delete ON LeagueTeam TO 'Users'            @'localhost';
GRANT Insert, Select, Update, Delete ON LeagueTeam TO 'Executive Manager'@'localhost';


INSERT INTO LeagueTeam VALUES
('1','CSUF Titans'),
('2','UCI AntEaters'),
('3','CSULB Wildcats'),
('4','UCR GreenHornets'),
('5','UCSD Bees'),
('6','UCLA Bruins'),
('7','CSUSB Wolfs'),
('8','CSULA Eagles');






CREATE TABLE GP_Team
(
GameRound INTEGER UNSIGNED NOT NULL,

TeamID_A  INTEGER UNSIGNED NOT NULL,
TeamAPoints   VARCHAR(100),

TeamID_B INTEGER UNSIGNED NOT NULL,
TeamBPoints VARCHAR(100),

DateTracker CHAR(10),
Months   VARCHAR(100),
Days     VARCHAR(100),
Years    CHAR(10),

FOREIGN KEY (TeamID_A) REFERENCES LeagueTeam(TeamID) ON DELETE CASCADE,
FOREIGN KEY (TeamID_B) REFERENCES LeagueTeam(TeamID) ON DELETE CASCADE
);

INSERT INTO GP_Team VALUES
('1','1','50','2','20','1','SAT','7th','2018'),
('1','3','35','4','40','2','SUN','8th','2018'),
('1','5','70','6','20','3','SAT','14th','2018'),
('1','7','55','8','25','4','SUN','15th','2018'),
('2','1','70','4','35','5','SAT','21st','2018'),
('2','6','50','7','30','6','SUN','22nd','2018'),
('3','1','20','6','15','7','FRI','27th','2018');

GRANT         Select                 ON GP_Team TO 'Observer'         @'localhost';
GRANT Insert, Select, Update, Delete ON GP_Team TO 'Users'            @'localhost';
GRANT Insert, Select, Update, Delete ON GP_Team TO 'Executive Manager'@'localhost';








CREATE TABLE TeamRoster
( ID            INTEGER UNSIGNED  NOT NULL    AUTO_INCREMENT  PRIMARY KEY,
  Name_First    VARCHAR(100),
  Name_Last     VARCHAR(150)      NOT NULL,
  Street        VARCHAR(250),
  City          VARCHAR(100),
  State         VARCHAR(100),
  Country       VARCHAR(100),
  ZipCode       CHAR(10),

  CHECK (ZipCode REGEXP '(?!0{5})(?!9{5})\\d{5}(-(?!0{4})(?!9{4})\\d{4})?'),
  
  INDEX  (Name_Last),
  UNIQUE (Name_Last, Name_First)
);

GRANT         Select                 ON TeamRoster TO 'Observer'         @'localhost';
GRANT Insert, Select, Update, Delete ON TeamRoster TO 'Users'            @'localhost';
GRANT Insert, Select, Update, Delete ON TeamRoster TO 'Executive Manager'@'localhost';


INSERT INTO TeamRoster VALUES 
('100', 'Donald',               'Duck',    '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('101', 'Daisy',                'Duck',    '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('102', 'Mickey',               'Mouse',   '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('103', 'Pluto',                'Dog',     '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),

('104', 'Joe',               'Luck',    '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('105', 'Jason',                'Sparks',    '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('106', 'Mickey',               'Johnson',   '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('107', 'Phil',                'Pooper',     '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),

('108', 'Patrick',               'Smith',    '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('109', 'Will',                'Smith',    '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('110', 'Mike',               'Tran',   '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('111', 'Sandeep',                'Rademi',     '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),

('112', 'Captian',               'America',    '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('113', 'Connie',                'Sparks',    '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('114', 'Mark',               'Zuckerberg',   '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('115', 'Steve',                'Jobs',     '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),

('116', 'William',               'Miller',    '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('117', 'Troy',                'Stephens',    '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('118', 'Bob',               'Martin',   '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('119', 'Steve',                'Jackson',     '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),

('120', 'Fred',               'Douglas',    '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('121', 'Jessie',                'Eisenberg',    '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('122', 'Jon',               'Stewart',   '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('123', 'Joe',                'Wilson',     '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),

('124', 'Micheal',               'Jackson',    '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('125', 'Jennifer',                'Smith',    '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('126', 'Vanessa',               'Lopez',   '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('127', 'Mario',                'Cart',     '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),

('128', 'Scrooge',              'McDuck',  '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('129', 'Louie',                'Duck',    '1110 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('130', 'Phooey',               'Duck',    '1-1 Maihama Urayasu',     'Chiba Prefecture',   'Disney Tokyo',  'Japan',   NULL),
('131', 'Della',                'Duck',    '77700 Boulevard du Parc', 'Coupvray',           'Disney Paris',  'France',  NULL);






CREATE TABLE Statistics
(
  ID                INTEGER    UNSIGNED  NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  Player            INTEGER    UNSIGNED  NOT NULL,
  PlayingTimeMin    TINYINT(2) UNSIGNED  DEFAULT 0 COMMENT 'Two 20-minute halves',
  PlayingTimeSec    TINYINT(2) UNSIGNED  DEFAULT 0,
  Points            TINYINT    UNSIGNED  DEFAULT 0,
  Assists           TINYINT    UNSIGNED  DEFAULT 0,
  Rebounds          TINYINT    UNSIGNED  DEFAULT 0,
  TotalGames        INTEGER    UNSIGNED  NOT NULL,

  FOREIGN KEY (Player) REFERENCES TeamRoster(ID) ON DELETE CASCADE,

  CHECK((PlayingTimeMin < 40 AND PlayingTimeSec < 60) OR 
        (PlayingTimeMin = 40 AND PlayingTimeSec = 0 ))
);

GRANT         Select                 ON Statistics TO 'Observer'         @'localhost';
GRANT Insert, Select, Update, Delete ON Statistics TO 'Users'            @'localhost';
GRANT Insert, Select, Update, Delete ON Statistics TO 'Executive Manager'@'localhost';

INSERT INTO Statistics VALUES
('10', '100', '35', '12', '40', '11', '21','3'),
('11', '101', '13', '22', '50', '01', '03','3'),
('12', '102', '10', '00', '10', '02', '04','3'),
('13', '103', '29', '47', '40', '09', '08','3'),

('14', '104', '35', '12', '5', '11', '21','1'),
('15', '105', '13', '22', '7', '01', '03','1'),
('16', '106', '10', '00', '3', '02', '04','1'),
('17', '107', '29', '47', '5', '09', '08','1'),

('18', '108', '35', '12', '18', '11', '21','1'),
('19', '109', '13', '22', '12', '01', '03','1'),
('20', '110', '10', '00', '3', '02', '04','1'),
('21', '111', '29', '47', '2', '09', '08','1'),

('22', '112', '35', '12', '30', '11', '21','2'),
('23', '113', '13', '22', '15', '01', '03','2'),
('24', '114', '10', '00', '20', '02', '04','2'),
('25', '115', '29', '47', '10', '09', '08','2'),

('26', '116', '35', '12', '5', '11', '21','1'),
('27', '117', '13', '22', '5', '01', '03','1'),
('28', '118', '10', '00', '8', '02', '04','1'),
('29', '119', '29', '47', '2', '09', '08','1'),

('30', '120', '35', '12', '20', '11', '21','3'),
('31', '121', '13', '22', '30', '01', '03','3'),
('32', '122', '10', '00', '30', '02', '04','3'),
('33', '123', '29', '47', '55', '09', '08','3'),

('34', '124', '35', '12', '15', '11', '21','2'),
('35', '125', '13', '22', '15', '01', '03','2'),
('36', '126', '10', '00', '30', '02', '04','2'),
('37', '127', '29', '47', '25', '09', '08','2'),

('38', '128', '35', '12', '5', '11', '21','1'),
('39', '129', '13', '22', '10', '01', '03','1'),
('40', '130', '10', '00', '5', '02', '04','1'),
('41', '131', '29', '47', '5', '09', '08','1');
