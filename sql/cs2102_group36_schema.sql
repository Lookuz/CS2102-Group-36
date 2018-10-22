/* Clean Tables if present */
DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Rides CASCADE;
DROP TABLE IF EXISTS Drivers;
DROP TABLE IF EXISTS Bids;

/* Entities */
CREATE TABLE Users ( 
    u_email VARCHAR(64) PRIMARY KEY,
    u_password VARCHAR(64) NOT NULL,
    u_name VARCHAR(64) NOT NULL,
    isAdmin VARCHAR(10) DEFAULT 'FALSE' CHECK(isAdmin IN ('TRUE', 'FALSE'))
);

CREATE TABLE Drivers (
    c_plate VARCHAR(10),
    d_email VARCHAR(64),
    c_brand VARCHAR(64),
    c_model VARCHAR(64),
    FOREIGN KEY(d_email) REFERENCES Users(u_email),
    PRIMARY KEY(d_email, c_plate)
);

CREATE TABLE Rides (
    d_email VARCHAR(64),
    c_plate VARCHAR(10),
    r_date DATE,
    r_time TIME,
    r_origin VARCHAR(64) NOT NULL,
    r_destination VARCHAR(64) NOT NULL,
    a_status VARCHAR(10) NOT NULL CHECK(a_status IN ('AVAILABLE', 'CANCELLED', 'TAKEN')),
    FOREIGN KEY(d_email, c_plate) REFERENCES Drivers(d_email, c_plate),
    PRIMARY KEY(d_email, c_plate, r_date, r_time)
);

/* Relationships */
CREATE TABLE Bids (
    d_email VARCHAR(64),
    c_plate VARCHAR(10),
    r_date DATE,
    r_time TIME,
    p_email VARCHAR(64) CHECK(p_email <> d_email),
    bid NUMERIC CHECK(bid > 0) NOT NULL,
    FOREIGN KEY(d_email, c_plate, r_date, r_time) REFERENCES Rides(d_email, c_plate, r_date, r_time),
    FOREIGN KEY(p_email) REFERENCES Users(u_email),
    PRIMARY KEY(d_email, c_plate, r_date, r_time, p_email) 
);