CREATE TABLE users(
 	username varchar(15) PRIMARY KEY NOT NULL,
    passwd varchar(15) NOT NULL,
    name_user varchar(20) NOT NULL,
    surname varchar(20) NOT NULL,
    email varchar(50) NOT NULL,
    verified int(1) NOT NULL,
    verif_key VARCHAR(8000) NOT NULL
);

CREATE TABLE feed (
    image_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    img LONGBLOB NOT NULL,
    username varchar(15) NOT NULL,
    upload_date date NOT NULL
);