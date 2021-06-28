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

#### PHP
