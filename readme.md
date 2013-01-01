<<<<<<< HEAD
The application is provided with both an in-memory datastore (default) and a RESTful back-end implemented in PHP (see the /api directory).

The in-memory datastore allows you to experience the app without setting up a back-end. All the changes you make to the data will be lost the next time you access the app or hit Refresh.
To use the app with the persistent RESTful back-end, set up the database as documented below and comment out the memorystore.js script import in index.html.

## Database Set Up (Optional): ##

1. Create a MySQL database name "cellar".
2. Execute cellar.sql to create and populate the "wine" table:

	mysql cellar -uroot < cellar.sql

Your feedback is appreciated. Please post your questions and comments in the blog post referenced above.

test for liana, and javed
=======
The application is provided with a RESTful back-end implemented in PHP (see the /api directory).


## Database Set Up: ##

1. Create a MySQL database name "<new database goes here>".
2. Execute <new database goes here>.sql to create and populate the "<replace this>" table:

	mysql <new database goes here> -uroot < <new database goes here>.sql
>>>>>>> Linked map.html to the "View Your Map" button
