## dwa15.com P4 Cesar Zavala Mesta
Live URL

Open Shift http://final-zavala.rhcloud.com/

## Description

(This started as the P4 repository but then moved to this repository)

## Requisites

It uses PHP/Laravel, User Authentication and a database with more than 1 table (4).

It's hosted in OpenShift, it has a github repository and uses a mySQL database (both in local and in production)

## Basic functionality

The idea is to merge a picture with a frame or template. For example, I could have a frame called "Harvard Summer School 2014", which is an image with the Harvard Summer School logo, and I can use a picture of Susan and I and mix it with that frame.  I have a bunch of pre-defined frames.

It works on mobile.  You can take a picture from a phone and use it.

You can do the basic operation (frame a picture) as a guest.  However, if you sign up you can see the pictures you've framed/mixed.  


## Technical details

The app is based on a database, and I use Models, Views and Controllers.  The main objects are: User, Template, Picture and Mingle. Each one has a table.  The users table is for authentication. The templates table is for the frames, and it stores the user.  The pictures table is for the uploaded/unprocessed pictures. The mingles table is for the processed mixes.

I loved using migrations and database seeding, super useful while developing. Also loved using version control and MVC.  


## Details for teaching team

The administrative login is:
cesarzavalamesta@g.harvard.edu
susanbuck

The non-admin login is:
test@test.com
testing

The differences are that the admin can Manage frames and it sees all Saved Pictures (no matter which user created them).  The non-admin will not manage frames and will only see his/her own images.  The guest (not authenticated) user can only create an image but he/she can't see it later.


## Outside code

Bootstrap: http://getbootstrap.com/ - for the User Interface and to be responsive in mobile devices.

Image Picker: http://rvera.github.io/image-picker/ - for the frames list in the first page, it made it easy to select an image (both in mobile and desktop)


## Thank you!

I really enjoyed the class and learned a lot! 
