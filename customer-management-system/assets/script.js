/*
EDIT AN ENTRY
Add event listener to .customer-table
On click on edit button:
  Get id of the entry clicked
  Get the entry with this id from database 
  Open modal / page that displays current entry
  On that modal/page:
    On submit:
      Insert all fields into database, overwrite current entry
      Redirect back to dashboard-page / close modal
*/

const customerTable = document.querySelector("#customer-table");
customerTable.addEventListener('click', function(event) {
  if (event.target.classList.contains('edit-btn')) {
    let entryId = +event.target.parentElement.parentElement.firstChild.textContent;
  }
  // open modal


});

// Do I need to add the event listeners for edit and delete buttons on window load to make sure the list of entries is always displayed BEFORE script.js runs?
// Assumption: yes, because database might take longer to respond. script.js MUST wait for database response, in order to add the event listeners.