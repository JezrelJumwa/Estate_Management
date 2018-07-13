DROP TABLE IF EXISTS systemusers;
CREATE TABLE IF NOT EXISTS systemusers (
  SystemUserId int(11) NOT NULL AUTO_INCREMENT,
  FirstName varchar(100) NOT NULL,
  LastName varchar(100) NOT NULL,
  OtherName varchar(100) NOT NULL,
  IdNumber int(11) NOT NULL,
  Gender varchar(100) NOT NULL,
  PRIMARY KEY (SystemUserId)
)

DROP TABLE IF EXISTS systemroles;
CREATE TABLE IF NOT EXISTS systemroles(
  SystemRoleId int(11) NOT NULL AUTO_INCREMENT,
  SystemUserId int(11) NOT NULL,
  SystemRoleName varchar(100) NOT NULL,
  FOREIGN KEY (SystemUserId) references systemusers (SystemUserId),
  PRIMARY KEY (SystemRoleId)
)

DROP TABLE IF EXISTS systemright;
CREATE TABLE IF NOT EXISTS systemright(
  SystemRightId int(11) NOT NULL AUTO_INCREMENT,
  SystemRoleId int(11) NOT NULL,
  MenuName varchar(100) NOT NULL,
  Page varchar(100) NOT NULL,
  FOREIGN KEY (SystemRoleId) references systemroles (SystemRoleId),
  PRIMARY KEY (SystemRightId)
) 

DROP TABLE IF EXISTS status;
CREATE TABLE IF NOT EXISTS status(
  StatusId int(11) NOT NULL AUTO_INCREMENT,
  StatusName varchar(100) NOT NULL,
  PRIMARY KEY (StatusId)
)    

DROP TABLE IF EXISTS systemuserstatus;
CREATE TABLE IF NOT EXISTS systemuserstatus(
  SystemUserStatusId int(11) NOT NULL AUTO_INCREMENT,
  SystemUserId int(11) NOT NULL,
  StatusId int(11) NOT NULL,
  FOREIGN KEY (SystemUserId) references systemusers (SystemUserId),
  FOREIGN KEY (StatusId) references status (StatusId),
  PRIMARY KEY (SystemUserStatusId)
)   

DROP TABLE IF EXISTS house;
CREATE TABLE IF NOT EXISTS house(
  HouseId int(11) NOT NULL AUTO_INCREMENT,
  HouseNumber int(11) NOT NULL,
  FilePath varchar(100) NULL,
  FileName varchar(100) NULL,
  HouseType varchar(100) NOT NULL,
  Rent varchar(100) NOT NULL,
  PRIMARY KEY (HouseId)
)

DROP TABLE IF EXISTS estate;
CREATE TABLE IF NOT EXISTS estate(
EstateId int(11) NOT NULL AUTO_INCREMENT,
EstateName varchar(100) NOT NULL,
EstateLocation varchar(100) NOT NULL,
HouseId int(11) NOT NULL,
FOREIGN KEY (HouseId) references house(HouseId),
PRIMARY KEY (EstateId)
)

DROP TABLE IF EXISTS systemusercridentials;
CREATE TABLE IF NOT EXISTS systemusercridentials(
  SystemUserCridentialsId int(11) NOT NULL AUTO_INCREMENT,
  SystemUserId int(11) NOT NULL,
  Password varchar(100) NOT NULL,
  FOREIGN KEY (SystemUserId) references systemusers (SystemUserId),
  PRIMARY KEY (SystemUserCridentialsId)
) 

DROP TABLE IF EXISTS booking;
CREATE TABLE IF NOT EXISTS booking(
  BookingId int(11) NOT NULL AUTO_INCREMENT,
  BookingStatus varchar(100) NOT NULL,
  PRIMARY KEY (BookingId)
)

DROP TABLE IF EXISTS housebooking;
CREATE TABLE IF NOT EXISTS housebooking(
HouseBookingId int(11) NOT NULL AUTO_INCREMENT,
SystemUserId int(11) NOT NULL,
HouseId int(11) NOT NULL,
BookingId int(11) NOT NULL,
FOREIGN KEY (HouseId) references house(HouseId),
FOREIGN KEY (BookingId) references booking(BookingId),
FOREIGN KEY (SystemUserId) references systemusers(SystemUserId),
PRIMARY KEY (HouseBookingId)
)
