<form action="../backend/luponForms.php" method="POST" class="lupon-form">
    <h2>Lupon Case Entry Form</h2>

    <div class="header">
        <div class="existing">
            <label>Docket Case Number</label>
            <input type="date" name="docket_case_number" required placeholder="Enter Docket Case Number">
            <button>Existing Docket ID for 2nd Hearing</button>
        </div>
        <label>Case Title</label>
        <input type="text" name="case_title" required placeholder="Enter Case Title">
    </div>

    <div class="complainant-form">
        <label>Complainant Name</label>
        <input type="text" name="complainant_name" required placeholder="Enter Complainant Name">

        <label>Complainant Address</label>
        <input type="text" name="complainant_address" required placeholder="Enter Complainant Address">
    </div>

    <div class="respondent-form">
        <label>Respondent Name</label>
        <input type="text" name="respondent_name" required placeholder="Enter Respondent Name">

        <label>Respondent Address</label>
        <input type="text" name="respondent_address" required placeholder="Enter Respondent Address">
    </div>

    <div class="hearing">
        <label>Hearing Type</label>
        <select name="hearing_type" required>
            <option value="">-- Select Hearing --</option>
            <option value="1st Hearing">1st Hearing</option>
            <option value="2nd Hearing">2nd Hearing</option>
            <option value="3rd Hearing">3rd Hearing</option>
        </select>

        <label>Hearing Date</label>
        <input type="date" name="hearing_date" required>
    </div>

    <input type="submit" value="Submit Case">
</form>
