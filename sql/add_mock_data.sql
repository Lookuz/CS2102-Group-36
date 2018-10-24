INSERT INTO users VALUES ('david@gmail.com', '123123', 'David');
INSERT INTO users VALUES ('john@gmail.com', '123123', 'John');
INSERT INTO users VALUES ('luke@gmail.com', '123123', 'Luke');
INSERT INTO users VALUES ('james@gmail.com', '123123', 'James');
INSERT INTO users VALUES ('melissa@gmail.com', '123123', 'Melissa');
INSERT INTO users VALUES ('jane@gmail.com', '123123', 'Jane');
INSERT INTO users VALUES ('darren@gmail.com', '123123', 'Darren');
INSERT INTO users VALUES ('vanessa@gmail.com', '123123', 'Vanessa');
INSERT INTO users VALUES ('amelia@gmail.com', '123123', 'Ivan');
INSERT INTO users VALUES ('rachel@gmail.com', '123123', 'Rachel');

INSERT INTO drivers VALUES('SAA4231A', 'david@gmail.com', 'Mazda', '3');
INSERT INTO drivers VALUES('SBE6581I', 'darren@gmail.com', 'Honda', 'Vezel');
INSERT INTO drivers VALUES('SKK2261Q', 'john@gmail.com', 'Honda', 'Vezel');
INSERT INTO drivers VALUES('SJQ9238J', 'luke@gmail.com', 'Toyota', 'Altis');
INSERT INTO drivers VALUES('SRY1153J', 'james@gmail.com', 'Hyundai', 'Avante');

INSERT INTO rides(c_plate, r_date, r_time, r_origin, r_destination, a_status) VALUES('SAA4231A', '2018-10-11', '16:00', 'Suntec City', 'COM 1, NUS', 'AVAILABLE');
INSERT INTO rides(c_plate, r_date, r_time, r_origin, r_destination, a_status) VALUES('SKK2261Q', '2018-10-11', '16:15', 'Junction 8', 'BIZ, NUS', 'AVAILABLE');
INSERT INTO rides(c_plate, r_date, r_time, r_origin, r_destination, a_status) VALUES('SRY1153J', '2018-10-11', '16:40', 'COM 1, NUS', 'Changi Airport T3', 'AVAILABLE');
INSERT INTO rides(c_plate, r_date, r_time, r_origin, r_destination, a_status) VALUES('SJQ9238J', '2018-10-11', '17:00', 'SDE, NUS', 'NorthPoint', 'AVAILABLE');
INSERT INTO rides(c_plate, r_date, r_time, r_origin, r_destination, a_status) VALUES('SAA4231A', '2018-10-11', '17:50', 'Suntec City', 'East Coast Park', 'AVAILABLE');
