Shabd Sampadaa शब्द सम्पदा
========================

This is a descendant of the [Hindi Wordnet](http://www.cfilt.iitb.ac.in/wordnet/webhwn/) project of Centre for Indian Language Technology, IIT Mumbai.
Hindi Wordnet is in Java. Shabd Sampadaa converts it to a PHP MySQL application and exposes a basic word search API.

Shabd Sampadaa is available under the GNU GPL v3 license.

To speed up development the PHP framework Laravel 4.2 has been used. Lumen would be quite sufficient too actually.

The downloaded Hindi Wordnet code and database is available in the JHWNL_1_2 and HindiWN_1_4 folders.
The SQL data dump of the database is available in the file dbdump.zip in the root folder. This does not contain all the information from the Hindi Wordnet project. It contains the database of words and their synonym sets. Hyponym, hypernym, ontology information that is available in the Hindi Wordnet project is not there in the SQL dump. For this information please see the Hindi Wordnet data files.

**A working copy of Shabd Sampadaa** can be seen at [http://manaskriti.com/shabd-sampadaa](http://manaskriti.com/shabd-sampadaa).

API
===
Shabd Sampadaa exposes one API call to search a word. 
http://host/api/word?word=word-in-devanagari-unicode
example
[http://manaskriti.com/shabd-sampadaa/api/word?word=आनंद](http://manaskriti.com/shabd-sampadaa/api/word?word=%E0%A4%86%E0%A4%A8%E0%A4%82%E0%A4%A6)
