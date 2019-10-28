# Website Design

## Overview

1. Web site design
2. CSS
3. Bootstrap
4. jQuery

## Introduction

- Website design
  - Colour
  - Typography
  - Forms
  - CSS
  - Bootstrap
  - jQuery

## Website Design

- Don't hide stuff like prices.

### Colour

- Easy to add with image, text background colours, etc.
- Often over used in web site design.
- Colour theory is a scientific theory which explains why the human brain finds
  some colour combinations more appealing than others.

  ![](https://i.loli.net/2019/10/28/a8SW3MrPZYmxKHq.png)

  - Monochromatic
    - Variations in hue and saturation of a single colour
  - Analagous
    - Colours adjacent to each other on the wheel.
    - Often found in the nature and tend to be pleasing to the eye.
  - Complementary
    - 180$\degree$ opposite each other on the wheel.
    - Intrinsically high contrast
    - Not good for text, e.g. red text on green background.
  - Colours chosen form equidistant areas on the wheel tend to look together.

- Pick a dominant colour (or possibly two) and use accents in a complementary
  colour.
- The colour scheme should apply to images as well and will give the site a well
  through out, integrated look.
- A good place to look for dominant colour is often the company logo or
  signature colour.
- Since the web is international, we also need to consider the colour
  significance of other cultures
  - In western culture green is often associated with nature, environmental
    issues or growth.

#### Colour by Gender

- 35% of women said blue was their favourite colour.
- 57% of males said blue was their favourite colour.
- Culturally (western culture) we tend to think that pink suggests femininity,
  but only a small percentage of women nominated it as their favourite colour.
- Women tend not to like earthy tones and have a preference for bright, primary
  colours like red and blue.
- Blue is a favourite with both genders
- Blue is also seen as a colour of trust, peace, security and loyalty.

### Typography

- Font's also have the ability to set the tone for a website
  - Are we aiming for a business audience or a more casual audience?
- The more "fancy" a font, the more specific its emotional appeal is likely to
  be and we are (usually) trying to appeal to as a large an audience as
  possible.
- Text needs to be big enough and have enough contrast from the background, to
  be easy to read.
- Don't overwhelm your users with text.
- The human eye finds it difficult to read long lines of text, particularly on a
  screen.
- Cantered text or fully justified text is also very difficult to read on a
  screen.

### Forms

- Forms are often how your users will talk to you and if they are poorly
  designed, they put users off.
- Forms must serve 2 purposes:
  - Customers must find them easy to use
  - Web site owners must find it easy to retrieve the entered information.
- Try to make the process as painless as possible
  - Default values
    - Pre-populate fields with the most common values
  - In-line validation
    - If passwords or emails don't match tell the user prior to submission
  - Tab ordering
    - Allow users to navigate through form fields using the tab key.
  - Hints for specific format requirements such as passwords, telephone numbers,
    etc.
- Label form elements clearly
- Use length of field to provide balance to the form layout.
  - Not all fields need to the same length
  - BUT - they need to be long enough to enter required data and see it all when
    entered.
- Group related data or even use tabs. Then the user doesn't see it as one
  continuous (and very long) form:
  - Consider allowing partially completed forms to be saved.
- Make it clear which field caused an error and how to fix it.
- Use different controls for different data
  - e.g. dropdown list of states.
  - Minimises the variances in collected data and makes it more useful.
- Use specific mobile form elements to make it easier to use the form on a
  mobile device
  - Date, email address, etc.
- For every piece of information we are collecting, we need to ask:
  - Is this piece of information valuable to us
  - Is this piece of information so valuable to us, that it's worth rejecting
    this potential user or potential sale
    - Do we really need the title?
    - Do we really need the phone number?
- Mark mandatory fields clearly
- When the process is complete - let the user know with a success or failure
  message
  - Thank you for your enquiry - a company representative will contact you seen.
  - Thanks for signing up with us - we'll get back to you within 2 days.
- Don't leave them wondering if their form submission was successful?
  - Was my credit card just debited?

### CSS

- CSS - Cascading Style Sheets
  - First developed by Tim Berners-Lee in 1990
  - IE5 achieved 99% support in 2000.
  - We then went backwards with no browsers fully supporting CSS 2 and W3C
    deciding to split CSS 3 into modules rather than a single huge
    specification.
  - Browsers now implement modules of CSS 3 or CSS 4 but will be unlikely to
    implement everything.
- Enables separation of content and presentation.
- Enables multiple pages to share the same formatting
  - Makes changes/updating much easier
- Enables information presentation in different formats such as for screen or
  print or mobile devices.
- Inline - formatting included in HTML tag

```html
<div style="font-style:italic; color: blue;">Blue Italic</div>
```

- Embedded - formatting included in document separate from tag

```html
<style>
  h1 {
    color: red;
    font-family: Arial;
  }
</style>
<h1>Arial Red</h1>
```

- External/imported - formatting in a separate document

```html
<style>
  @import url('style.css');
</style>

<!-- OR -->

<link rel="stylesheet" type="text/css" href="style.css" />
```

```css
// style.css
h1 {
  font-family: Arial, sans-serif;
  font-size: 10pt;
  color: green;
}
```

### Bootstrap

- Developed in 2011 by a couple of Twitter employees.
- Described as a collection of tools (framework) for creating websites and web
  applications.
- Made up of HTML and CSS based design templates for components such as forms,
  buttons, navigation and JavaScript extensions.
- Since V2.0 has supported responsive design
  - Page layouts automatically adjust to the characteristics of the requesting
    client device, e.g. mobile phones, tablets, etc.
- [Boostrap](https://getbootstrap.com) has some useful information and
  tutorials.
- The easiest way to integrate is to use the CDN (Content Delivery Network)
  - No download required and browsers are able to cache the content which is
    more efficient

```html
<link
  rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/boostrap.min.css"
/>
```

- The latest version of also requires several JS files.
- Bootstrap recommends placing these links right before the closing `</body>`
  tag in the HTML document.

```html
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
```

- Bootstrap is designed to be responsive to mobile devices
- To ensure proper rendering and touch zooming, add this `<meta>` tag inside the
  `<head>` element

```html
<meta name="viewport" content="width=device-width, initial-scale=1" />
```

- `width=device-width` sets the width of the page to adjust to the screen width
  of the viewing device.
- `initial-scale=1` sets the initial zoom level when the page is first displayed
  by the browser.
- Container - ensures content is centred on the screen and is responsive.
- Jumbotron - enlarges font size and places them in a box with rounded corners
  and a grey background.

```html
<div class="container">
  <div class="jumbotron">
    <h1>Welcome to JUMBOTRON</h1>
    inside a container
  </div>
  This bit is outside the container
</div>
```

- Grid System (multi (up to 12) column layout)
  - Bootstrap divides the screen columns which will resize themselves when
    viewed on different screen sizes.

```html
<div class="container">
  <div class="jumbotron">
    <h1>Welcome to JUMBOTRON</h1>
    inside a container
  </div>
  <div class="row">
    <div class="col-md-4">
      <h2>Column 1</h2>
      <p>Content for column 1.</p>
    </div>
    <div class="col-md-4">
      <h2>Column 2</h2>
      <p>Content for column 2.</p>
    </div>
    <div class="col-md-4">
      <h2>Column 3</h2>
      <p>Content for column 3.</p>
    </div>
  </div>
</div>
```

- `col-md-4`
  - Translates to targeting a medium size screen
  - 4 indicates the relative size of the column by dividing 12 by this number,
    so we have 3 columns of even size.
  - We could also have unevenly sized columns

```html
<div class="col-md-6">Biggest Column</div>
<div class="col-md-4">Smaller Column</div>
<div class="col-md-2">Smallest Column</div>
```

### Navigation

- A standard navigation bar is created with the `.navbar` class, followed by a
  responsive collapsing class `.navbar-expand-xl|lg|md|sm` which will stack the
  navbar vertically if required

```html
<nav class="navbar navbar-expand-sm bg-dark">...</nav>
```

- To add a link we use a `<ul>` element with a `class="navbar-nav"` and `<li>`
  elements with a `.nav-item` class and an `<a>` element with a `.nav-link`
  class.

```html
<nav class="navbar navbar-expand-sm bg-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Menu 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Menu 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Menu 3</a>
    </li>
  </ul>
</nav>
```

- A navigation bar can extend or collapse, depending on screen size
- Often referred to as the "hamburger" menu.

```html
<button
  type="button"
  class="navbar-toggle"
  data-toggle="collapse"
  data-target="#myNavbar"
>
  <span class="navbar-toggler-icon"></span>
</button>
```

- Indicates the id of the element that will affected when the button is clicked

```html
<div class="collapse navbar-collapse" id="myNavbar"></div>
```

```html
<nav class="navbar navbar-expand-md bg-light navbar-light">
  <!– Toggler button -->
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#myNavBar"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <!– Navigation Links -->
  <div class="collapse navbar-collapse" id="myNavBar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Menu 1</a>
      </li>
      other menu links
    </ul>
  </div>
</nav>
```

- A navigation aspect which is growing in popularity is the idea of a "fixed"
  navigation bar.
- When the user scrolls down a page, the navigation bar remains anchored, so
  that it always visible and therefore, usable
- Change this line:

```html
<nav class="navbar navbar-expand-md bg-light navbar-light"></nav>
```

- To this

```html
<nav class="navbar navbar-expand-md bg-light navbar-light fixed-top"></nav>
```

- We can also add a "brand" to our navbar

```html
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <a class="navbar-brand" href="#">Famox</a>
</nav>
```

## jQuery

- Free, open source collection of JS libraries designed to allow for ease of use
  for things such as:
  - Modifying the appearance of a web page after it has been rendered
  - Providing special effects such as hiding, fading, sliding and animations of
    various types
  - Allowing the retrieval of information from a server and updating parts of a
    web page without refreshing the entire web page (AJAX)
  - Simplifying common JavaScript tasks
  - We've already got a link to the latest jQuery version (or we could download
    it from https://jquery.com/download/

```html
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3. 3.1/jquery.min.js"></script>
```

- Uses the DOM – Document Object Model which is created when the browser loads
  and finished processing a HTML document
- Hierarchical model where the JS Objects represent each element in the
  document, e.g. `html, head, body, title, table, tr, etc`
  - We can programatically engage with and change these elements via their id or
    their type
- Access to jQuery is through the `$(...)function` short hand for the jQuery
  function
- Pass the document object (web page) to the function and call the ready method
  which means once the HTML document is fully loaded our jQuery functions can be
  executed

#### Examples

##### Table rows striped

```javascript
$(document).ready(function() {
  $('#data tbody tr:even').addClass('listeven');
});
```

- Load JS file in HTML

```html
<script src="/js/my-script.js" type="text/javascript"></script>
```

##### Add class on table hover

```javascript
$(document).ready(function() {
  $('#data tbody tr:even').addClass('listeven');
  $('#data tbody tr').mouseover(function() {
    $(this).addClass('data-hover');
  });
  $('#data tbody tr').mouseout(function() {
    $(this).removeClass('data-hover');
  });
});
```
