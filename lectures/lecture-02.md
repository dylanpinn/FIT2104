---
title: 'Lecture 2'
created: '2019-10-04T03:56:51.429Z'
modified: '2019-10-04T04:50:37Z'
tags: [Notebooks/Computer Science Degree, FIT2104]
---

# Lecture 2

## Lecture Overview

- Applications development
  - Planning
  - System development lifecycle
  - Database design
- Usability

## Applications Development

- The steps involved in building a web application shouldn't be any different
  than those involved in any other type of application.
- Planning
  - Who is the most important person in the planning process?
    - Often project managers/analysts/designers/programmers all think it is them
    - But it really the client
      - Experts in their own business
      - Being able to determine their requirements is often very difficult.
- System Development Life Cycle
  - The most common method used to be the waterfall method
    - Very rigid with steps completed sequentially and once completed never
      re-visited.
    - Assumed all requirements are specified fully and correctly right from the
      start.
  - Agile methodology
    - Introduced in 2001 and promotes rapid, iterative and flexible development.
    - Breaks the proposed application down into "builds" or "delivery cycles"
      which are vertically complete.
    - The builds are then fully developed and delivered to the client
      - Client sees working software quicker
      - Easier to make changes
    - Common misconception that is means "no rules" and is a way to allow
      programmers to get out of producing documentation so that they can just
      write code.
      - All of the waterfall steps are often still used within each build
      - Requires training and practice to be used successfully.
- Eliciting requirements is often very difficult
  - Client may not be sure what they want
  - Client may not be able to articulate what they want
  - Client may have a poor understanding of the capabilities and/or limitations
    of technology
  - Client may leave out information they consider obvious
- Identify stakeholders
  - The proprieties and vision for the project may be different for different
    users within an organisation and the analyst needs to create a shared vision
    which is acceptable to everyone.
  - May be useful to find a project champion who is invested in the success of
    the project.
- Interviews
  - Determine what information you are seeking
  - Consider props - forms, reports, screen shots
  - Avoid long interviews as enthusiasm drops
  - Distribute findings and get everyone's confirmation
- Questionnaires
  - Best for limited and specific information from many stakeholders
  - Response rate may be variable and result in unusable data
- Review existing forms, procedures and reports
  - Must be done carefully as it may result in automating current system
- Observation
  - Most useful as it shows actual system interactions
  - Can be time consuming, and observed staff may be self conscious and not act
    naturally.
- Once requirements are finalised, it's a good time to prioritise them
  - Helps avoid "scope creep"
  - The client needs to be involved in this and it may require some negotiation
- A common approach is the MoSCoW method
  - M - MUST have
  - S - SHOULD have it at all possible
  - C - COULD have if it doesn't affect anything else
  - W - Probably WON'T have but WOULD like to have in the future.
- Change management
  - A formal policy should be established to ensure a consistent approach to
    changes
    - Detailed description of the proposed change
    - Impact of implementing and not implementing the change
    - Estimation of time and cost of implementation
  - Allows an informed decision to be made regarding whether or not to implement
    the change.
- Proposal evaluation
  - Should the project go ahead?
  - Is a web application the best solution?
    - If the application will only ever by accessed from a single location maybe
      a client-server application is a better option.
- If the client wants a solution to a common business problem maybe someone has
  already developed a good solution
  - Buy off the shelf may be an option
  - Buy off the shelf and then customise may be an option
- Prototyping
  - Mock-ups of a proposed system to allow client to experience look and feel of
    system
  - Drawbacks
    - Client may think that they are looking at a finished system and don't
      understand why they cannot use it.
    - Developers may spend a lot of time developing prototypes then discard them
  - May be necessary to scope prototypes in the same way we scope a system
    - May not be necessary to scope the whole system - possibly just the most
      used functions.
- Prototypes can take may forms:
  - Low fidelity
    - Usually rough and paper based
    - Allows rapid feed back on concepts, colours, workflow, etc.
  - Medium fidelity
    - Usually produced using a software based tool
    - Usually able to demonstrate behaviour such as interaction and navigation
  - High fidelity
    - Usually a high-tech representation of the application
    - Can provide partial to complete functionality
    - Usually provides an almost complete UI/UX
- Prototyping
  - Choice of method depends on factors such as client requirements, budget and
    available tools
  - May choose more than one method and fidelity to give client a more "real"
    experience
  - Ensure client understands the use and purpose of prototypes
  - Don't overreach and prototype something you can't deliver
  - Don't be a perfectionist
    - Should be good enough to give stakeholders a common understanding of
      proposed applications
  - Lot of other planning tools that we won't cover
    - User stories
    - Activity diagrams
    - UML
- Database
  - Crucial piece of the planning puzzle
  - Need to be mindful of application purpose
    - Don't go too big or too small
  - Client needs to be involved again
  - Determine what is important to the business
    - Who and what do we need to store information about?
    - How and when does it need to be accessed?
    - The who and what generally translate into entities
    - The how and when may enable establishment of relationships between
      entities
  - Database type is not very important at this stage
  - Attributes
    - Characteristics of entities
  - How and when data is accessed is important
    - Store client name as a single attribute or two separate attributes
    - Store addresses as a single attribute or split into component parts
  - Redundancy
    - Do we store customer name in order table?
    - Do we store order total?
- Database Normalisation
  - 1NF - identify PK and repeating groups
  - 2NF - remove partial dependencies
    - Ensure non key attributes are identified by all parts of a composite key.
  - 3NF - remove transitive dependencies
    - Ensure all non key attributes are identified by key attributes
- Database
  - Think about what the PK should be
    - If there is no obvious choice let the DBMS generate it
    - Generally don't need users to remember PKs
  - It is not necessary to tell a PK which table it belongs to
    - C001 for clients
      - Limits the number of possible clients
      - Makes it difficult for system to generate key
- Database Foreign Keys
- Database testing
  - Documentation is just as important for the database as for other aspects of
    the system
    - Create a data dictionary which describes the entities, the relationships
      between them and the attributes.

## Usability

- Definition
  - The ease of use and learnability of a human-made object
- A commonly used them, but often the most poorly implemented aspect of any
  software application - particularly web applications.

### Navigation

- Should be clear and intuitive
  - If the user cannot find what they want easily, you have already failed
- Shouldn't depend on JavaScript for Flash
- Should be usable on mobile devices.
- What's in
  - Simple. No sub menus
  - Fixed navbars
  - Vertical sliding navigation (good for mobile devices)
- What's out
  - Navigation in a non-standard location
    - Keep it on top of the left
  - Too many items in the menu
  - Menu items too long
  - Menu items in the word order - most commonly used items should be on the
    left or right
  - Using graphics for menu items rather than plain text.

### Familiarity

- User would like to use software - without having to think about it
- Microsoft is very good at this

### Consistency

- Could be considered as the other side of the familiarity coin
- Difficult to make your cutting edge web site seem familiar to users
  - Ensure all pages within the site are consistent with each other
  - The longer they use the site, the more familiar it will feel.
- Follow conventions established by well known web sites
  - Users may be familiar with Amazon or eBay where the "buy now" buttons are
    generally in the same location

### Error Prevention

- Almost impossible to make any product, application or web site 100% user
  proof.
- Users will always be able to perform some function or peculiar sequence of
  functions that was never tested and produces unexpected results.
- The developers job is to ensure recognition or errors and provide easy
  recovery
- Don't use jargon
- Don't apportion blame
- Allow the user to recover from an error or at least back out of their action

### Feedback

- The user needs to know WHEN a processed has been completed
- The user needs to know if a process completed SUCCESSFULLY
- Might be useful to break long processes up into several steps and let the user
  know where they are in the sequence.

### Visual Clarity

- Arranging and displaying content in the best way for user consumption
- Present information in a natural and logical manner to enable the most
  efficient and likely path through information
- Users should be able to start using your application or web site quickly, with
  little or no need of prior learning.

### Flexibility & Efficiency

- Flexibility is often the natural enemy of consistency & familiarity aspects
- It's not a welcome feature of some applications/web sites
- What sort of web site would it be useful for?
  - E-learning
    - Users can move ahead if they have prior knowledge of a topic
- Website should be designed with enough flexibility to display usefully on
  different browsers
  - The old practice of developing parallel sites for different devices should
    be avoided

## What have we covered

- Application planning
- System development life cycle
- Eliciting requirements
- Change management
- Solution evaluation
- Prototyping
- Usability
