# Nando's Circle of Trust

A website to motivate people to attend Nando's trips. Aimed at companies or large groups.

## Concept

Inspired by lack of attendance at bi-weekly work Nando's lunches. Regular attendees are put in the inner circle. Moderately regular attendees are placed in the outer circle. People who are invited but never attend are placed outside the circle and should be scowled upon angrily.

### Usage

Internet Explorer is not supported at all.

Just modify `db/dbinfo.json` according to your PostgreSQL installation and deploy to a PHP server. Load `index.php` to automatically create the schema and fill initial values in the database.

To deploy to Heroku, simply clone the repo and push it to a Heroku app. Attach a Heroku Postgres instance to the app and update `dbinfo.json` accordingly.

Currently the website is hosted [here](http://circle-of-trust.herokuapp.com/ "Nando's Circle of Trust"). 

The below log in details are created by default by the schema and can be used to log into the above example instance.

Default Login Details:

Username: admin    
Password: Peri-Peri-Chicken!

### Technical Details

All functionality is coded using PHP, JavaScript, HTML, and CSS. PostgreSQL is used as the database.

Jquery UI is used for a lot of the UI elements.

Admin management screen in under construction.

Passwords are not stored in clear text. MD5 hashes are used.


