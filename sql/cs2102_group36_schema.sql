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
    c_plate VARCHAR(10) PRIMARY KEY,
    d_email VARCHAR(64) NOT NULL UNIQUE,
    c_brand VARCHAR(64),
    c_model VARCHAR(64),
    FOREIGN KEY(d_email) REFERENCES Users(u_email)
);

CREATE TABLE Rides (
    r_id SERIAL PRIMARY KEY,
    c_plate VARCHAR(10),
    r_date DATE,
    r_time TIME,
    r_origin VARCHAR(64) NOT NULL,
    r_destination VARCHAR(64) NOT NULL,
    a_status VARCHAR(10) NOT NULL CHECK(a_status IN ('AVAILABLE', 'CANCELLED', 'TAKEN')) DEFAULT 'AVAILABLE',
    FOREIGN KEY(c_plate) REFERENCES Drivers(c_plate)
);

/* Relationships */
CREATE TABLE Bids (
    r_id INT PRIMARY KEY,
    p_email VARCHAR(64),
    bid NUMERIC CHECK(bid > 0) NOT NULL,
    FOREIGN KEY(r_id) REFERENCES Rides(r_id) 
);