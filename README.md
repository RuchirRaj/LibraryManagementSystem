# LibraryManagementSystem

<h2>Description:</h2>
Given librery managemest system is a database management system for librarians.<br>
Librarian can perform following major tasks:<br>
   • Add borrowers<br>
   • search book based on ISBN, title or author<br>
   • check in and check out books<br>
   • fine management <br>

<h2>Technical Dependancies:</h2>

`Language:`PHP, HTML, CSS, SQL<br>
`Framework:` Xampp server, MySQL Workbench<br>
`Platform:` Xampp, Google Chrome<br>
`OS:` Microsoft windows 10<br>
`Software libraries:` -<br>
`Software versions:` 1.0.0<br>

<h2>How to install:</h2>
• Project has already been compiled and build.<br>
• To work with library book management, <br>
  * put libraryManagementSystem code in the xampp -> htdocs<br>
  * load the database in the mySQL workbench<br>
  * change the user name and password of the php files according to database credentials <br>
  * start xampp Apache module<br>
  * Go to Google chrome browser<br>
  * add URL: <a href="http://localhost/libraryManagementSystem/index.html">http://localhost/libraryManagementSystem/index.html</a> <br>
   
<h2>User guide:</h2>

<h3>User:</h3>
<h4>1. System administrator</h4>
  • Must be knowledgeable about Database design, standard database queries and PHP<br>
  • Performs installation of project in the system<br>
  • He has the right to add librarian credentials for different librarians<br>
<h4>2. Librarian</h4>
  • Open the browser (preferably Google Chrome)<br>
  • Enter the URL: <a href="http://localhost/libraryManagementSystem/index.html">http://localhost/libraryManagementSystem/index.html</a><br>
  • Enter the log in credentials provided by System administrator<br>
  
  <h5>Search:</h5>
  • Search book by ISBN, Title, Author name<br>
      i. Partial details in Title and Author name is allowed<br>
      ii. If ISBN is provided than enter the correct ISBN<br>
  • Click on search button<br>
  • Book details of related topic will be provided with their availability<br>
  
  <h5>Check out:</h5>
  • If book is available, check out link is provided, click on it to check out the book<br>
  • Provide card id of borrower and click on submit button<br>
  • 1 user can only borrow at max 3 books<br>
  • If book is already checked out at current time than it will not be available even if on the home page, the availability was true.<br>
  
  <h5>View borrower</h5>
  • This functionality is provided to see the details of borrowers who have loaned the book<br>
  • Enter ISBN of book or Card id of user or name of user<br>
  • If given details is available with loaned details, it will display user details, else it will display no book has been loaned with given user or book details and fine details if exist<br>
  • If user has borrowed book, the details of all borrowed books has been provided<br>
  • You can check in the book and pay fine<br>
  
  <h5>Check in</h5>
  • Find user details from view borrower, the details of the borrowed books are provided, click on check in link.<br>
  <h5>Pay fine</h5>
  • If pay fine is there in the view borrower, click on the pay fine once user has paid fine. It will update fine database<br>
  <h5>Fines</h5>
  • Make sure to click on fine link in the navigator every day<br>
  • It will refresh the fine details and provide the total fine each user has to pay<br>
  <h5>Log out</h5>
  • Click on log out at the end of the day to log out from the system<br>
