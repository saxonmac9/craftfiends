<?php
require_once 'KLogger.php';
require_once 'user.php';
require_once 'breweryObject.php';
require_once 'beerObject.php';

class Dao {
    
    private $host = "127.0.0.1";
    private $db = "CraftFiendsWebsite";
    private $user = "root";
    private $pass = "root";
    private $logger; 

    public function __construct() {
        $this->logger = new KLogger ("log.txt" , KLogger::DEBUG);
    }

    public function getLogger() {
        return $this->logger;
    }

    public function getConnection() {
        //$db = parse_url("postgres://eldmvfquckyeqw:3e2998e51890b3950407b7dd66cb27a6922765309aa608425ef9bd4a1ea8a8a2@ec2-52-1-95-247.compute-1.amazonaws.com:5432/ddhrv2dk1ln0vu");
        $this->logger->LogDebug("getting a connection\n");
        try {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            // $conn = new PDO("pgsql:" . sprintf(
            //     "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            //     $db["host"],
            //     $db["port"],
            //     $db["user"],
            //     $db["pass"],
            //     ltrim($db["path"], "/")
            // ));
            return $conn;
        } catch (Exception $e) {
            $this->logger->LogFatal("connection failed:" . print_r($e,1));
            exit();
        }
    }

    public function getHost() {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        return "Location: http://$host$uri/";
    }

    public function getAdmin($username, $password) {
        $this->logger->LogInfo("getting admin");
        $conn = $this->getConnection();
        $userQuery = "SELECT adminname, password from adminuser WHERE adminname=:adminname and password=:password";
        $q = $conn->prepare($userQuery);
        $q->bindParam(":adminname", $username);
        $q->bindParam(":password", $password);
        $q->execute();
        return $q->fetch() != null; 
    }

    public function validateUsername($username) {
        try{
            $conn = $this->getConnection();
            $userQuery = $conn->prepare("SELECT * from clientuser WHERE username= ?");
            $userQuery->execute(array($username));
            $count = $userQuery->rowCount();
            if ($count != 0) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            print_r($e, 1);
        }
    } 

    public function createNewUser($username, $password, $email) {
        $this->logger->LogDebug("create new user");
        $conn = $this->getConnection();
        $userQuery = "INSERT into clientuser (username, email, password) VALUES (:username, :email, :password)";
        $q = $conn->prepare($userQuery);
        return $q->execute(array(':username'=>$username, ':email'=>$email, ':password'=>$password));
    }

    public function getUser($userName, $password) {
        $this->logger->LogInfo("checking if user exists");
        try {
            $conn = $this->getConnection();
            $userQuery = "SELECT * from clientuser WHERE username=? and password=?";
            $q = $conn->prepare($userQuery);
            $q->execute(array($userName, $password));
            $count = $q->rowCount();
            if ($count == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $this->logger->LogFatal("get user failed:" . print_r($e,1));
        }
    }

    public function deleteUser($username) {
        $this->logger->LogInfo("deleting user");
        $conn = $this->getConnection();
        $deleteQuery = "DELETE from clientuser where username=:username";
        $q = $conn->prepare($deleteQuery);
        $q->bindParam(":username", $username);
        return $q->execute();
    }

    public function getAllReviewPosts() {
        $this->logger->LogInfo("getting review post");
        $conn = $this->getConnection();
        $reviewPostQuery = "SELECT title, beer_brewer, location, review, time from reviews order by time desc";
        $q = $conn->prepare($reviewPostQuery);
        $q->execute();
        return $q->fetchAll();
    }

    public function addReviewPost($reviewerID, $title, $beerName, $reviewLocation, $reviewPost) {
        $this->logger->LogInfo("adding a review comment [($reviewPost)]");
        $conn = $this->getConnection();
        $saveQuery = "INSERT into reviews (reviewerid, title, beer_brewer, location, review) values (:reviewerID, :title, :beer_brewer, :location, :review)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":reviewerID", $reviewerID);
        $q->bindParam(":title", $title);
        $q->bindParam(":beer_brewer", $beerName);
        $q->bindParam(":location", $reviewLocation);
        $q->bindParam(":review", $reviewPost);
        return $q->execute();
    }

    public function deleteReviewPost($id) {
        $this->logger->LogInfo("deleting a review post [{$id}]");
        $conn = $this->getConnection();
        $deleteQuery = "DELETE from reviews where reviewid = :reviewID";
        $q = $conn->prepare($deleteQuery);
        $q->bindParam(":reviewID", $id);
        return $q->execute();
    }

    public function getAllReviewComments() {
        $this->logger->LogInfo("getting review comment");
        $conn = $this->getConnection();
        return $conn->query("SELECT review_commentid, userid, reviewid, comment from review_comments order by time desc");
    }

    public function addReviewComment($userID, $reviewID, $reviewComment) {
        $this->logger->LogInfo("adding a review comment [($reviewComment)]");
        $conn = $this->getConnection();
        $saveQuery = "INSERT into review_comments (userid, reviewid, comment) values (:userID, :reviewID, :comment)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":userID", $userID);
        $q->bindParam(":reviewID", $reviewID);
        $q->bindParam(":comment", $reviewComment);
        return $q->execute();
    }

    public function deleteReviewComment($id) {
        $this->logger->LogInfo("deleting a comment [{$id}]");
        $conn = $this->getConnection();
        $deleteQuery = "DELETE from review_comments where review_commentid = :review_commentID";
        $q = $conn->prepare($deleteQuery);
        $q->bindParam(":review_commentID", $id);
        return $q->execute();
    }

    public function getAllBlogPosts() {
        $this->logger->LogInfo("getting blog post");
        $conn = $this->getConnection();
        $blogPostQuery = "SELECT title, post, time from blogs order by time desc";
        $q = $conn->prepare($blogPostQuery);
        $q->execute();
        return $q->fetchAll();
    }

    public function getUserBlogPosts($bloggerID) {
        $this->logger->LogInfo("getting user's blog posts");
        $conn = $this->getConnection();
        $userBlogQuery = "SELECT title, post, time from blogs, clientusers WHERE blogs.bloggerid = clientusers.:userid order by time desc ";
        $q = $conn->prepare($userBlogQuery);
        $q->bindParam(":userID", $bloggerID);
        $q->execute();
        return $q->fetchAll();
    } 

    public function addBlogPost($bloggerID, $blogTitle, $blogPost) {
        $this->logger->LogInfo("adding a review comment [($blogPost)]");
        $conn = $this->getConnection();
        $saveQuery = "INSERT into blogs (bloggerid, title, post) values (:bloggerID, :title, :post)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":bloggerID", $bloggerID);
        $q->bindParam(":title", $blogTitle);
        $q->bindParam(":post", $blogPost);
        return $q->execute();
    }

    public function getAllBlogComments() {
        $this->logger->LogInfo("getting blog comment");
        $conn = $this->getConnection();
        $blogCommentsQuery = "SELECT comment from blog_comments order by time desc";
        $q = $conn->prepare($blogCommentsQuery);
        $q->execute();
        return $q->fetchAll();
    }

    public function addBlogComment($userID, $postID, $blogComment) {
        $this->logger->LogInfo("adding a blog comment [($blogComment)]");
        $conn = $this->getConnection();
        $saveQuery = "INSERT into blog_comments (userid, postid, comment) values (:userID, :postID, :comment)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":userID", $userID);
        $q->bindParam(":postID", $postID);
        $q->bindParam(":comment", $blogComment);
        return $q->execute();
    }

    public function deleteBlogComment($id) {
        $this->logger->LogInfo("deleting a comment [{$id}]");
        $conn = $this->getConnection();
        $deleteQuery = "DELETE from blog_comments where blog_commentid = :postID";
        $q = $conn->prepare($deleteQuery);
        $q->bindParam(":postID", $id);
        return $q->execute();
    }

    public function getBrewery($breweryName) {
        $this->logger->LogInfo("getting brewery");
        $conn = $this->getConnection();
        $saveQuery = "SELECT breweryid, breweryname from breweries WHERE breweryname = :breweryName";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":breweryName", $breweryName);
        return $q->execute();
    }

    public function getAllBreweries() {
        $this->logger->LogInfo("getting all breweries");
        $conn = $this->getConnection();
        $saveQuery = "SELECT * from breweries order by breweryname";
        $q = $conn->prepare($saveQuery);
        $q->execute();
        $breweriesArray = array();
        foreach ($q->fetchAll() as $result) {
            $brewery = new BreweryObject($result['breweryid'], $result['breweryname']);
            $brewery->setBeers($this->getAllBeers($brewery->getBreweryID()));
            $breweriesArray[] = $brewery;
        }
        return $breweriesArray;
    }

    public function addBrewery($brewery) {
        $this->logger->LogInfo("adding a brewery [{$brewery}]");
        $conn = $this->getConnection();
        $saveQuery = "INSERT into breweries (breweryname) values (:breweryName)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":breweryName", $brewery);
        return $q->execute();
    }

    public function deleteBrewery($id) {
        $this->logger->LogInfo("deleting a brewery [{$id}]");
        $conn = $this->getConnection();
        $deleteQuery = "DELETE from breweries where breweryid = :breweryID";
        $q = $conn->prepare($deleteQuery);
        $q->bindParam(":breweryID", $id);
        return $q->execute();
    }

    public function getBeer() {
        $this->logger->LogInfo("getting beer");
        $conn = $this->getConnection();
        return $conn->query("SELECT brewid, beername, percentalcohol from beers order by time desc");
    }

    public function getAllBeers($breweryID) {
        $this->logger->LogInfo("getting all beers for brewery");
        $conn = $this->getConnection();
        $saveQuery = "SELECT * from beers WHERE brewid = :breweryID order by beername";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":breweryID", $breweryID);
        $q->execute();
        $beerList = array();
        foreach ($q->fetchAll() as $result) {
            $beer = new BeerObject($result['beerid'], $result['breweryid'], $result['beername'], $result['percentalcohol']);
            $beerList[] = $beer;
        }
        return $beerList;
    }

    public function addBeer($breweryID, $beer, $abv) {
        $this->logger->LogInfo("adding a beer [{$beer}]");
        $conn = $this->getConnection();
        $saveQuery = "INSERT into beers (brewid, beername, percentalcohol) values (:brewID, :beerName, :percentAlcohol)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":brewID", $breweryID);
        $q->bindParam(":beerName", $beer);
        $q->bindParam(":percentAlcohol", $abv);
        return $q->execute();
    }

    public function deleteBeer($id) {
        $this->logger->LogInfo("deleting a beer [{$id}]");
        $conn = $this->getConnection();
        $deleteQuery = "DELETE from beers where beerid = :beerID";
        $q = $conn->prepare($deleteQuery);
        $q->bindParam(":beerID", $id);
        return $q->execute();
    }

    public function userAuthentication () {
        $this->logger->LogInfo("Authenticating user");
        if (isset($_SESSION['authenticated']) && !$_SESSION['authenticated'] || !isset($_SESSION['authenticated'])) {
            $this->logger->LogDebug("user authenticated");
            header("Location: http://localhost/logIn.php");
        }
    }   
}
?>