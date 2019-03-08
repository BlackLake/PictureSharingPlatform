<<<<<<< HEAD
Picture Sharing Platform

**Oğuzhan Karagöl**

# OVERVIEW

A social media site that people can post pictures, upvote and downvote and comment other user’s pictures. The Upvote-Downvote difference will be the point of the post. There will be 4 Categories;Hot: most recent posts which can pass the 1000 points limit.Trading: most recent posts which can pass the 500 points limit.Fresh: most recent posts Ordered by date.Bests: Top 20 posts which has the maximum points. 

# GOALS

1. Everyone can create an account just with an Email and username

2. Every user can post pictures lesser than 2mb in specific file types.

3. Every user can upvote or downvote other user’s pictures.

4. Every user can comment something on any post unlimitedly.

5. Every user can Change account details such as password or username.

6. Every user can login.

7. Every user can logout.

8. Users can not vote or Comment without login.

9. Users can not access account settings page without login.

10. Users can not post pictures without login.

11. All posts in the pages should contain the information of vote and comment count.

12. If user vote a post the vote button should be converted into blue.

13. All users have a profile that show the posts of that user ordered by date.

14. Post names should be unique so the post names are encrypted current time in disk.

# ELEMENTS

# Web Server

As a web server i am using apache http server because it is free , open source and working well with mysql and php.

# Database

As database i choose the mysql because it is free to use, open source and easy to use. Also for ease of use i am using phpmyadmin tool to administrate mysql database management system.

There is 4 tables in the database;

* Users

* Posts

* Comments

* Vote

And the database diagram ; 

![image alt text](image_0.png)

As it seen in the picture there is 1 to N relation between all the tables. It means;

* One user can comment unlimited comments

* One user can post unlimited pictures

* One user can vote unlimited times

* One post can have unlimited comments

* One post can have unlimited votes

Yellow keys means it is a primary key and red columns means it is a foreign key. It means the tables have relations and we can identify the user who posted,commented or voted.  Relations good for when you want to normalize your tables and use them in most efficient way.

The database is Designed in MySql and phpMyAdmin and the diagram of the database (in the picture) is created in MySql Workbench

# Programming  Language

I am using php and javascript as the programming languages. 

Php for all the database connections, database processes, validations, session management and http requests.

Javascript for some visual effects.

I have used PhpStorm from Jetbrains as development environment

# Interface

As the interface i am using html, css and for good graphics and fonts bootstrap.

The background of project is not white because it is tiring for eyes to read something or look pictures with white background.

And there is so much empty spaces in the pages because if there is only main thing to see, people will automatically focus on the pictures.

# Users guide

# Sign up

In sign up pages you can create account to be able to use comment post and vote features.To sign up you should provide an E-mail that didn’t used  before, a Nickname that didn’t used before and a password.

E-mail can be max 50 characters.Nickname can be max 15 characters.Password can be max 40 characters.

# Sign in

You should sign in to be able to use comment post and vote features. But you can see posts without signing in.

# Posting

To upload a post press the button "+Upload" at the top-right corner of the page. At the upload page enter a title and press the “choose file button” and select a image file. And press the “post” button

Title can be max 50 characters.Image can be max 2MB.Image file type should be JPG, GIF or PNG.

# Voting

You can upvote or downvote a post by clicking the arrow buttons at the bottom of the image.The second click will be revert the vote. 

# Commenting

If you want to comment something click the talking balloon button  at the bottom of the image. At the opened page type your comment on the textbox and press the post button.

# Settings

To go to the settings page click your profile picture at the top-right of the page and click the settings. At the settings page there is 3 categories;

* Account is for changing your e-mail and nickname.

* Password for changing the password.

* Profile picture is for changing the profile picture.

# Logout

To logout click your profile picture at the top-right of the page and click the logout button

=======
# Picture Sharing Platform

**Oğuzhan Karagöl**

# OVERVIEW

A social media site that people can post pictures, upvote and downvote and comment other user’s pictures. The Upvote-Downvote difference will be the point of the post. There will be 4 Categories;
Hot: most recent posts which can pass the 1000 points limit.
Trading: most recent posts which can pass the 500 points limit.
Fresh: most recent posts Ordered by date.
Bests: Top 20 posts which has the maximum points. 

# GOALS

1. Everyone can create an account just with an Email and username

2. Every user can post pictures lesser than 2mb in specific file types.

3. Every user can upvote or downvote other user’s pictures.

4. Every user can comment something on any post unlimitedly.

5. Every user can Change account details such as password or username.

6. Every user can login.

7. Every user can logout.

8. Users can not vote or Comment without login.

9. Users can not access account settings page without login.

10. Users can not post pictures without login.

11. All posts in the pages should contain the information of vote and comment count.

12. If user vote a post the vote button should be converted into blue.

13. All users have a profile that show the posts of that user ordered by date.

14. Post names should be unique so the post names are encrypted current time in disk.

# ELEMENTS

# Web Server

As a web server i am using apache http server because it is free , open source and working well with mysql and php.

# Database

As database i choose the mysql because it is free to use, open source and easy to use. Also for ease of use i am using phpmyadmin tool to administrate mysql database management system.

There is 4 tables in the database;

* Users

* Posts

* Comments

* Vote

And the database diagram ; 

![alt text](https://lh6.googleusercontent.com/HpJS8PcXfl7YEPVUb4QsArZyIn3-TFaM66022Fv5oaciikCeIafNiMl-j5XuXtKh0RXuUKCYvff84fg6iqi8rgXCjhWf36cUNtcA=w1366-h648-rw)


As it seen in the picture there is 1 to N relation between all the tables. It means;

* One user can comment unlimited comments

* One user can post unlimited pictures

* One user can vote unlimited times

* One post can have unlimited comments

* One post can have unlimited votes

Yellow keys means it is a primary key and red columns means it is a foreign key. It means the tables have relations and we can identify the user who posted,commented or voted.  Relations good for when you want to normalize your tables and use them in most efficient way.

The database is Designed in MySql and phpMyAdmin and the diagram of the database (in the picture) is created in MySql Workbench

# Programming  Language

I am using php and javascript as the programming languages. 

Php for all the database connections, database processes, validations, session management and http requests.

Javascript for some visual effects.

I have used PhpStorm from Jetbrains as development environment

# Interface

As the interface i am using html, css and for good graphics and fonts bootstrap.

The background of project is not white because it is tiring for eyes to read something or look pictures with white background.

And there is so much empty spaces in the pages because if there is only main thing to see, people will automatically focus on the pictures.

# Users guide

# Sign up

In sign up pages you can create account to be able to use comment post and vote features.
To sign up you should provide an E-mail that didn’t used  before, a Nickname that didn’t used before and a password.

E-mail can be max 50 characters.
Nickname can be max 15 characters.
Password can be max 40 characters.

# Sign in

You should sign in to be able to use comment post and vote features. But you can see posts without signing in.

# Posting

To upload a post press the button "+Upload" at the top-right corner of the page. At the upload page enter a title and press the “choose file button” and select a image file. And press the “post” button

Title can be max 50 characters.
Image can be max 2MB.
Image file type should be JPG, GIF or PNG.

# Voting

You can upvote or downvote a post by clicking the arrow buttons at the bottom of the image.
The second click will be revert the vote. 

# Commenting

If you want to comment something click the talking balloon button  at the bottom of the image. At the opened page type your comment on the textbox and press the post button.

# Settings

To go to the settings page click your profile picture at the top-right of the page and click the settings. At the settings page there is 3 categories;

* Account is for changing your e-mail and nickname.

* Password for changing the password.

* Profile picture is for changing the profile picture.

# Logout

To logout click your profile picture at the top-right of the page and click the logout button

>>>>>>> ca282800f09b603e15921022d434129ff367f110
