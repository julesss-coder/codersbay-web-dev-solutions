# Requirements
## Home index.html
- [x] Login link
- [x] Registration link

## Dashboard
- [x] Create new customer via contact form
- [x] Overview of all customers 
  - [x] For each entry: edit button
    - [x] Make edit button functional
  - [x] For each entry: Delete button
    - [x] Make delete button functional
  - [ ] Create session per user so that:
      - [ ] Logged in users can see all customer entries
      - [ ] Logged in users can only edit the entries that they created
  - [ ] Style `All customers` table with bootstrap classes
  - [ ] Center and set width on `create new customer` form
  - [ ] Style whole page
    - [ ] Make sure style.css is connected to dashboard-page.php
  - [ ] dashboard.php: Implement the steps in strategy marked with *.

## Register page
- [x] Build field to let user reenter password
- [ ] Deal with incorrect reentry of password
- [ ] Deal with already existing email address
- [x] Make form functional
- [x] Redirect to login page after successful registration

## Login page

## Logout button
- [ ] Make Logout link into submit button inside form. Redirect

# Questions
## Dashboard - create new user
- How do I get the current date and time of the submit?
- How do I send it to the database?
- How do I make sure the data the user input stays in the form in case there is an error and he has to correct some data (so that he does not have to re-enter all data)?
- What happens if I delete an entry with a unique ID? Do the IDs of the other entries have to be changed?
  - If I add a new id, the number of entries is requested. The new ID is length + 1. If I have deleted entries from the table (except the last one), the last ID does not match `length`.
  - Get last entry's ID and add 1?
- Which function calls do I need to send a database query?
  - $query = $connection->query($lengthQuery);
  - $query->execute();
  - $queryOutput = $query->fetchAll();
- What's the difference between prepared statements and sending an SQL query with `exec()`?


===

Export databse to upload it to GitHub