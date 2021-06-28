# sitBlog
Semester project for ,,Web applications" subject. Winter semester 2020/2021.

Running project: https://wa.toad.cz/~pavelpa2/semestralka/

Documentation including user guide (in Czech only): https://wa.toad.cz/~pavelpa2/semestralka/documentation.php

## Assignment
Web application sitBlog is a blog for registered users. Users can write blogs of two categories: blog and bug. When browsing all blogs of sitBlog, user can filter our these two categories. User is able to create articles and delete them. He must be logged in. User logs in using unique username and email.

## Acceptance conditions
- Forms are well validated to prevent attacks such as XSS
- Blog must work without JavaScript, so it can be used in old browsers.
- Blog is immune to evil users.
- User can swtich between light mode and dark mode.

## Implementation
For server-side I used PHP without any framework. On frontend I used HTML and SCSS compilation to css. I've also used Bootstrap framework and JQuery libraries with JavaScript.

I use AJAX to load blog article header on homepage. So when clicking on pagination, the site doesn't reload as a whole. Only blog results get updated. 

For CSS I work mainly with flexbox. That is also given because of Bootstrap 5 library. 

JavaScript handles changing of dark and light mode and that a cookie remembers this setting. You are also able to rotate the bug in footer of the site. JS changes classes of this bug and CSS handles the animations.

