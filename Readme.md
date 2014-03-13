# Nando's Circle of Trust

A website to motivate people to attend Nando's trips. Aimed at companies or large groups.

## Concept

Inspired by lack of attendance at bi-weekly work Nando's lunches. Regular attendees are put in the inner circle. Moderately regular attendees are placed in the outer circle. People who are invited but never attend are placed outside the circle and should be scowled upon angrily.

### Usage

Just download and host on a server supporting PHP. Homepage is Index.php and Internet Explorer is not supported at all.

Default Login Details:

Username: admin    
Password: Peri-Peri-Chicken!

### Technical Details

All functionality is coded using PHP, JavaScript, HTML, and CSS. No database is used, instead all data is stored in an XML file.

Jquery UI is used for a lot of the UI elements.

Default login details can be deleted after a new account has been created by modifying the users.xml file. No GUI system exists, sorry.

Passwords are not stored in clear text. MD5 hashes are used.

