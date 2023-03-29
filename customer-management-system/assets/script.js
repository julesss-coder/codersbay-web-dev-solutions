// === Dashboard page ===
const editEntryModalBody = document.querySelector(".edit-entry-modal-body");
const deleteEntryModalBody = document.querySelector(".delete-entry-modal-body");
const customerTable = document.querySelector("#customer-table");

// Event listener for edit buttons
customerTable.addEventListener('click', function(event) {
  if (event.target.classList.contains('edit-btn')) {
    let btnClicked = event.target;
    let entry = btnClicked.parentElement.parentElement;
    let entryId = +entry.firstChild.textContent;
    let entryChildren = [];
    Array.from(entry.children).forEach((node) => {
      entryChildren.push(node.textContent);
    });

    // Create form for editing the selected database entry
    // Setting the form fields which I need to send, but not to display, to `hidden`
    let form = `
      <form
      method="post"
      action="../logic/edit-entry.php"
      >
        <div>
          <input 
            type="text" 
            class="form-control" 
            id="company-id" 
            name="company-id"
            value="${entryChildren[0]}" 
            hidden
          >
        </div>
        <div class="mb-3">
          <label for="company-name" class="form-label">Company name</label>
          <input 
            type="text" 
            class="form-control" 
            id="company-name" 
            name="company-name"
            value="${entryChildren[1]}"
            required
          >
        </div>
        <div class="mb-3">
          <label for="contact-person" class="form-label">Contact person</label>
          <input 
            type="text" 
            class="form-control" 
            id="contact-person" 
            placeholder="Contact person" 
            name="contact-person"
            value="${entryChildren[2]}"
            required
          >
        </div>
        <div class="mb-3">
          <label for="phone-number" class="form-label">Phone number</label>
          <input 
            type="text" 
            class="form-control" 
            id="phone-number" 
            placeholder="Phone number" 
            name="phone-number"
            value="${entryChildren[3]}"
            required
          >
        </div>
        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <input 
            type="text" 
            class="form-control" 
            id="address" 
            name="address"
            value="${entryChildren[4]}"
            required
          >
        </div>
        <div>
          <input 
            type="text" 
            class="form-control" 
            id="created_by" 
            name="created_by"
            value="${entryChildren[5]}"
            hidden
          >
        </div>
        <div>
          <input 
            type="text" 
            class="form-control" 
            id="created_at" 
            name="created_at"
            value="${entryChildren[6]}"
            hidden
          >
        </div>
        <div>
          <input 
            type="text" 
            class="form-control" 
            id="edited_at" 
            name="edited_at"
            value="${entryChildren[7]}"
            hidden
          >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
        </div>
    </form>`;

  editEntryModalBody.innerHTML = form;
  }
});

// Event listeners for delete buttons
customerTable.addEventListener('click', function(event) {
  if (event.target.classList.contains('delete-btn')) {
    let btnClicked = event.target;
    let entry = btnClicked.parentElement.parentElement;
    let entryId = +entry.firstChild.textContent;
    let entryChildren = [];
    Array.from(entry.children).forEach((node) => {
      entryChildren.push(node.textContent);
    });

    // Create form for deletiong the selected database entry
    let form = `
    <p>Are you sure you want to delete this entry with the id ${entryChildren[0]}?</p>
    <form
    method="post"
    action="../logic/delete-entry.php"
    >
      <div>
        <input 
          type="text" 
          class="form-control" 
          id="company-id" 
          name="company-id"
          value="${entryChildren[0]}" 
          hidden
        >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit">Delete entry</button>
      </div>
    </form>`;

    deleteEntryModalBody.innerHTML = form;
  }
});



// Do I need to add the event listeners for edit and delete buttons on window load to make sure the list of entries is always displayed BEFORE script.js runs?
// Assumption: yes, because database might take longer to respond. script.js MUST wait for database response, in order to add the event listeners.