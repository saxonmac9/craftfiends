Create database IF NOT EXISTS CraftFiendsWebsite;
Use CraftFiendsWebsite;

CREATE TABLE IF NOT EXISTS User (
  userID int NOT NULL auto_increment,
  username varchar(255) NOT NULL UNIQUE,
  email varchar(255) NOT NULL,
  password varchar(64) NOT NULL,
  signUpTime datetime,
  access BOOLEAN,
  primary key(userID)
);

CREATE TABLE IF NOT EXISTS AdminUser (
	adminID int NOT NULL auto_increment,
    adminName varchar(64),
    password varchar(64),
    primary key(adminID)
);

INSERT into AdminUser (adminName, password)
	VALUES ('mad_mac9', 'letmein');

CREATE TABLE IF NOT EXISTS Blogs (
  blogID int NOT NULL auto_increment,
  bloggerID int NOT NULL,
  title varchar(64) NOT NULL,
  post text NOT NULL,
  time datetime DEFAULT current_timestamp(),
  primary key(blogID),
  foreign key(bloggerID)
    references User(userID)
);

CREATE TABLE IF NOT EXISTS Blog_Comments (
  commentID int NOT NULL auto_increment,
  userID int NOT NULL,
  postID int NOT NULL,
  comment tinytext NOT NULL,
  time datetime DEFAULT current_timestamp(),
  primary key(commentID),
  foreign key(userID)
    references User(userID),
  foreign key(postID)
    references Blogs(blogID)
);

CREATE TABLE IF NOT EXISTS Reviews (
  reviewID int NOT NULL auto_increment,
  reviewerID int NOT NULL,
  title varchar(64) NOT NULL,
  beer_brewer varchar(64) NOT NULL,
  location varchar(64) NOT NULL,
  review tinytext NOT NULL,
  time datetime DEFAULT current_timestamp(),
  primary key(reviewID),
  foreign key(reviewerID)
    references User(userID)
);

CREATE TABLE IF NOT EXISTS Review_Comments (
  review_commentID int NOT NULL auto_increment,
  userID int NOT NULL,
  reviewID int NOT NULL,
  review_comment tinytext NOT NULL,
  time datetime DEFAULT current_timestamp(),
  primary key(review_commentID),
  foreign key(userID)
    references User(userID),
  foreign key(reviewID)
    references Reviews(reviewID)
);

CREATE TABLE IF NOT EXISTS Breweries (
  breweryID int NOT NULL auto_increment,
  breweryName varchar(128),
  primary key(breweryID)
);

CREATE TABLE IF NOT EXISTS Beers (
  beerID int NOT NULL auto_increment,
  brewID int NOT NULL,
  beerName varchar(64) NOT NULL,
  percentAlcohol double,
  time datetime DEFAULT current_timestamp(), 
  primary key(beerID),
  foreign key(brewID)
    references Breweries(breweryID)
);

