# Requirements
## Home index.html
- Login link
- Registration link

## Dashboard
- Create new customer via contact form
- Overview of all customers 
  - For each entry: Edit
  - For each entry: Delete

Logged in users can see all customer entries
Logged in users can only edit the entries that they created

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