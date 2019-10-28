---
title: 'Lecture 1: Web database interface'
created: '2019-10-04T03:49:56.612Z'
modified: '2019-10-04T03:54:51Z'
tags: [Notebooks/Computer Science Degree, FIT2104]
---

# Lecture 1: Web database interface

## Lecture Overview

1. Welcome
2. Academic Staff
3. Unit Outline and Objectives
4. Software Requirements
5. Unit Content
6. Web database concepts and technologies
7. GIT

## Learning Outcomes

- explain the need and importance for system developers to have skills in this
  area of IT applications;
- describe and compare the key basic technologies which underlie the development
  of web-database applications;
- evaluate and access the key technological issues confronting developers
  building applications of this type;
- implement the key features of programming languages which are commonly used
  for developing web-database application;
- analyse, design, develop and implement a web-database application using a
  well-known programming language;
- evaluate and critique proposed web-database solutions to a business problem.

## Web database concepts

- Why are web interfaced databases useful for businesses?
  - Most businesses maintain a database of clients, products, etc.
  - It makes sense to display this content on a website
    - If the database is well designed, clients can easily search for products.
    - Price alterations can be immediately updated on the website.
    - Sales via the web site can be immediately reflected in inventory levels.
    - The website can be personalised for clients when the log in.
- Content Management Systems (CMS) / blogs etc. are heavily used and popular
  examples of web database applications.

## Web database technologies

- We are currently in the third generation of dynamic web pages
  - Static Generation
    - static, mainly text, some images, required "experts" to maintain them.
  - Dynamic - Generation 1
    - Technologies such as JavaScript and VBScript allowed dynamic "client side"
      functionality.
    - Different browsers tended to implement the scripts differently.
  - Dynamic - Generation 2
    - First generation of server-side scripting
    - CGI (Common Gateway Interface - 1993) scripts which executed on the web
      server
      - Often using Cookies to overcome statelessness of the web.
    - Problems
      - Required a programming language which has good communication facilities
        such as C, C++, Perl or Python.
      - Scalability - CGI spawned a separate process on the web server for each
        request it received.
  - Dynamic - Generation 3
    - Microsoft released ASP (Active Server Pages) in 1996 (became .NET in 2002)
    - Several competitors were created
      - ColdFusion
      - Sun released Java Servlets (1997) and then JSP (1999) and then JEE
        (1999).
    - PHP became publicly available in 1998
      - Server-side scripting language.

## Uses for server-side technologies

- Two most common uses
  - Retrieving data from a data store, in response to a query and inserting it
    into a web page.
  - Handling POST form input and writing it to storage, e.g. database, file
    system or retrieving data from storage and displaying in a web page.

## Web database technologies

- The web server passes control to another processes (PHP engine), creates the
  HTML and passes it back to the web server, which sends it back to the browser.
- Benefits
  - Universal browser readability
  - User platform independence
  - Protection (hiding) of source code
- Drawbacks
  - Increased network load (multiple trips to the server)
  - Increased server load
  - Dates, times, currency symbols, etc. are taken from the web server.

## Lecture Summary

- Why we need web interfaced databases
- The history of web interfaced databases
- Some of the most popular technologies and programming/scripting languages
  involved with web interfaced databases
- An overview of GIT and why we use it
