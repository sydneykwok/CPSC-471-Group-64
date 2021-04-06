# Environment Setup
1. Download [AppServ](https://www.appserv.org). Take note of your root password when configuring your MySQL Server.<br/>
2. Download all files in the main branch of this repo.<br/>
3. Navigate to *C:/AppServ/www* on your local PC and copy the entire *real-estate-db* folder into this directory.<br/>
4. Open the *connection.php* file in a text editor and put your password from step 1 as the value for *db_pass*.<br/>
5. Open a web browser and enter into the address bar: *localhost/phpmyadmin*. Log in with username "root" and the password you took note of in step 1.<br/>
6. Once logged in, select "Databases" from the menu at the top and create a new database called "real_estate_db". <br/>
7. From the same menu at the top of the page, select "Import" and import the "real_estate_db.sql" file from the *database* folder of this repository.<br/>
8. Now, open another tab in your browser and enter into the address bar: [localhost/real-estate-db](http://localhost/real-estate-db/).<br/>
<br/>
If setup was successful, you should see a login page.
